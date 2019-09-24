<?php

namespace App;
//use Illuminate\Support\Facades\Mail;
//use Illuminate\Http\Request;
//use App\Exceptions\InvalidKeysException;
use App\Exceptions\NoMoreQuestionsException;
use App\Exceptions\NoRelevantAnswersException;
use App\Exceptions\QuestionnaireShouldEndException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Log;
//use function Psy\debug;
//use Stringy\Stringy;
//use function Stringy\create as s;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


//use App\Http\Controllers\MailController;

/**
 * App\Questionnaires
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string|null $deleted_at
 * @property string|null $user_info
 * @property int|null $user_id
 * @property string|null $ip
 * @property string $created
 * @property string $modified
 * @property string $email
 * @property int $proc_id
 * @property string|null $manual_score
 * @property int|null $manual_decision
 * @property int|null $manual_decision_confidence
 * @property int|null $combination_instance_id
 * @property int $is_done
 * @property string|null $test_keys
 * @property string|null $label_json
 * @property string|null $notes
 * @property string|null $physician_name
 * @property int|null $decision_code
 * @property int|null $supervisor_decision
 * @property string|null $supervisor_decision_explanation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property-read \App\Procedure $procedure
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property mixed is_done_reason
 * @property mixed user
 * @property mixed combinationInstance
 * @method static Builder|Questionnaire where($field, $value)
 * @method static Builder|Questionnaire findOrFail($id)
 * @method public function|Questionnaire combineReportAnswers($groupedQuestions,$allAnswered)
 * @method static find($id)
 * @method static load()
 * @method  values()



 */
class Questionnaire extends Model
{

    // protected $fillable = ['proc_id', 'email', 'is_done', 'manual_decision', 'physician_name', 'notes', 'is_done_reason', 'combination_instance_id' ,'user_id'];
    protected $guarded= [];
    protected $show_final_result_api = '';
    protected $table = 'tests';
    protected $beforeForceScore;
    protected $hidden = [];
    protected $appends= ['link'];
    protected $answerProps=['question_auto','force_score','weight','vas_min_display','vas_max_display','params','id','title', 'sub_answer','question_id','question_title','question_short_title','display_groups'];

    const VAS_MIN = 0;

    const VAS_MAX = 0;

    const VAS_VOID = -0.03;

    const VAS_NO = -0.02;

    const VAS_UNKNOWN = -0.01;

    const VAS_LESS = -100000;

    const VAS_MORE = 100000;

    protected $secret_key="SecretKey:24fe350606";

    private function secretCode( ) {
        return  sha1($this->id.$this->secret_key);
    }

    public function getLinkAttribute()
    {
        $url =  "/reports/{$this->id}/".$this->secretCode($this->id);
        return $url;
    }

    /**
     * @return BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'proc_id');
    }
    public function notDone()
    {
        dd( $this->procedure->title);

        //->
        //where('is_done', '=',0)->
        //where('user_id', $id);
        //->
        //  pivot->title;
    }

    /**
     * @return  BelongsToMany
     */
    public function answers()
    {

        return $this->belongsToMany(Answer::class, 'tests_answers', 'test_id')
            ->withTimestamps()
            ->withPivot('current_keys', 'indications', 'sub_answer', 'question_id')->with('params');
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @return array
     */
    public function answersWithParams(){

        $paramsArray=[];
        foreach ($this->answers() as $answer) {
            $paramsArray[]= $answer->params->flatten()->pluck('pivot','title');
        }
        return $paramsArray;

    }

    /**
     * @return BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'tests_answers', 'test_id')
            ->withTimestamps()
            ->withPivot('current_keys', 'indications', 'sub_answer', 'question_id');
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @return BelongsTo
     */
    public function combinationInstance()
    {
        return $this->belongsTo(CombinationInstance::class, 'combination_instance_id');
    }

    /**
     * Check if the test should end on a specific answer
     *
     * @param Answer $answer the answer to check
     * @param array|Collection $keys the keys the user has so far
     *
     * @param ExpressionParser $parser
     * @return bool
     */
    public function shouldEndOn($answer, $keys, $parser)
    {
        if (!$answer->end_test) return false;

        if (!$answer->keys_for_end_test) return true;

        return $parser->parse($answer->keys_for_end_test, $keys, $answer);
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * Deletes the latest question added to the test and it's answers
     *
     * @param $answer_id
     * @param $question_id
     *

     * @return Question|array
     */
    public function deleteLatestQuestion($answer_id, $question_id)
    {
        /** @noinspection PhpVariableNamingConventionInspection */
        $aboutToDelete = $this->answered();
        $this->questions()->detach($question_id);

        if ($this->is_done) {
            $this->update(['is_done' => false]);
        }

        /** @var Question $question */
        $question = Question::where('id', $question_id)
            ->first();

        //$latest = DB::table('tests_answers')->where('test_id', $this->id)->latest('id')->first();
        $latest =  $this->latestAnswer(); //DB::table('tests_answers')->where('test_id', $this->id)->latest('id')->first();

        $answers = $question->answersWithParams()
            ->where('is_deleted', '=', 0)
            ->where('deleted_at', '=', null)
            ->get();

        if (!$latest) return ['question' => $question,

            'answers' => $question->getAnswersWithParams($answers,$question),
            'answered' => $aboutToDelete,
            'firstQuestion' => true];

        if ($question->is_auto == 1) {
            return $this->deleteLatestQuestion($latest->answer_id, $latest->question_id);
        }

        $parser = new ExpressionParser ($this->procedure, $this->combinationProceduresNames());
        $indications = $this->indications($latest);
        $keys = $this->keys($latest);

        $keys = $parser->generateSystemKeys($keys, $indications);
        try {

            $possible = $this->nextPossibleQuestions($question, $indications);
            $scenarios = number_format($this->scenarios($possible));
        }
        catch( \Exception $exception) {
            $possible=[];
            $scenarios=0;
        }
        // cache
        $tag = "get question answers  groups  {$this->id} {$question->id}";

        $answers = $this->filterAnswersByKeys( $answers, $keys, $parser);
        $answers->filter(function (Answer $answer) use ($keys, $parser) {
            if (!$answer->keys_for_showing_answer) return true;

            return $parser->parse($answer->keys_for_showing_answer, $keys, $answer);
        });
        return [
            'answered' => $this->answered()->merge($aboutToDelete),
            'back?' => true,
            'someIsDone' =>   $this->someIsDone(),
            '$aboutToDelete' => $aboutToDelete,
            'combinationKeys' => $this->getCombinationKeys(),
            //     'latest' => $_latest,
            'answers' =>   $question->getAnswersWithParams($answers,$question),
            //'answers' =>$answers,// $question->getAnswersWithParams($answers,$question),//$answers,
            'question' => $question,
            'keys' => $keys->reverse(),
            'indications' => $indications,
            'possible' => optional($possible)->count(),
            'scenarios' => $scenarios,
        ];
    }

    /**
     * Get the last answer that was answered
     * @return Collection
     */
    public function latestAnswer()
    {
        return DB::table('tests_answers')->where('test_id', $this->id)->latest('id')->first();
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * Updates the current indications for this test
     *
     * @param Question $question
     * @param Answer $answer the new answer added to the test
     * @param Collection $current_indications the current indications the test has
     * @param int $sub_answer
     *
     * @return Collection
     */
    public function updateIndications($question, $answer, $current_indications, $sub_answer)
    {
        collect($question->indication)
            ->merge($answer->indication)
            ->unique()
            ->each(function ($indication) use (&$current_indications, $sub_answer, $answer) {


                $has_star  = preg_match('/\*/', $indication);

                $indication = preg_replace('/\*/', '', $indication);
                if ($current_indications->has($indication)) {

                    $current_indications[$indication] = $this->updateIndication($current_indications[$indication], $answer, $sub_answer);
                } else {
                    if ($has_star  && $sub_answer !== '_no' && $sub_answer !== '_unknown' ){
                        $current_indications[$indication] = $this->addIndication($answer, $sub_answer);
                    }

                }

//                if ($current_indications->has($indication)) {
//
//                    $current_indications[$indication] = $this->updateIndication($current_indications[$indication], $answer, $sub_answer);

//                } else if (preg_match('/\*/', $indication) && $sub_answer !== '_no' && $sub_answer !== '_unknown') {
//                    // remove * from indication name
//                    $indication = preg_replace('/\*/', '', $indication);
//
//                    $current_indications[$indication] = $this->updateIndication(  0 , $answer, $sub_answer);
//
//                    $current_indications[$indication] = $this->addIndication($answer, $sub_answer);
//                }
            });

        return $current_indications;
    }

    /**
     * @param Answer $answer
     * @param int $sub_answer
     *
     * @return array
     */
    protected function addIndication($answer, $sub_answer)
    {

        return [
            'weight' => $this->indicationWeight($answer, $sub_answer),
            'notes' => [],
        ];
    }

    /**
     * @param Answer $answer
     * @param        $sub_answer
     *
     * @return float|int
     */
    public function indicationWeight($answer, $sub_answer)
    {
        //preview
        /*
         * if this answer belongs to display group, and display group is no/unknown/less/more

                    $score =  $answer->displayGroup->score;
                    if ( $score !==false){
                        $score = $score / $anwer->displaygorup->count();
                        }
             *      dont use the wiehgt of this answer , and use the weight of the deisplay group
         *
         */
        if ($answer->isVas()){

            return  $this->vasWeight($answer, $sub_answer);
        } else
            if (!empty($answer->weight)){


                return $answer->weight;
            } else
                return 0;

//        return $answer->isVas()
//            ? $this->vasWeight($answer, $sub_answer)
//            : ( !empty($answer->weight) ? $answer->weight : 0);
    }

    /**
     * @param array $indication
     * @param Answer $answer
     * @param int $sub_answer
     *
     * @return array
     */
    protected function updateIndication($indication, $answer, $sub_answer)
    {

        $indication['weight'] +=  $this->indicationWeight($answer, $sub_answer);

        if ($answer->notes && !in_array($answer->notes, $indication['notes'])) {
            if (!$answer->isVas() || $answer->isVasPositive($sub_answer)) {
                $indication['notes'][] = $answer->notes;
            }
        }
        $indication['seemingly_checking'] = true;
        if (  !empty($answer->force_score) ) {
            if (!isset ($indication['seemingly_justified']  ) ) $indication['seemingly_justified'] = false ;
            if ( $indication['weight'] > 58 ) $indication['seemingly_justified'] = true ;
            $indication['weight'] = $answer->force_score;

        }

        // return the corresponding  indication_score row
        $indication['score'] = $this->scoreForIndication($indication['weight']);

        return $indication;
    }

    /**
     * @param $answer
     * @param $sub_answer
     *
     * @return float
     */
    public function vasWeight($answer, $sub_answer)
    {
        $min_display = (int)$answer->vas_min_display;

        $max_display = (int)$answer->vas_max_display;

        $min_score = !empty($answer->vas_min) ? $answer->vas_min : self::VAS_MIN;

        $max_score = !empty($answer->vas_max) ? $answer->vas_max : self::VAS_MAX;
        //PATCH
        //if($sub_answer===0 && $min_display===0 ) return $min_score;
        if ((string)$sub_answer == '_no') {
            return $answer->vas_no ?? 0;
        }

        if ((string)$sub_answer == '_unknown') {
            return $answer->vas_unknown ?? 0;
        }
//FIX 18102018
        if( (string)$sub_answer!="_more" && (string)$sub_answer!="_less"){
            if ($sub_answer < $min_display) $sub_answer = "_less";
            if ($sub_answer > $max_display) $sub_answer = "_more";
        }
        if ((string)$sub_answer == '_less' ) {

            return is_null($answer->vas_less) ? $answer->vas_min : $answer->vas_less;
        }

        if ((string)$sub_answer == '_more') {
            return is_null($answer->vas_more) ? $answer->vas_max : $answer->vas_more;
        }

        if ($min_display == $max_display) {
            return $min_score;
        }

        if ($answer->vas_intermediate_score && !empty($answer->vas_intermediate_score)) {

            $scores = collect($answer->vas_intermediate_score)
                ->push($max_score)
                ->prepend($min_score);

            if (!empty($answer->vas_intermediate_display)) {

                $displays = collect($answer->vas_intermediate_display)
                    ->push($max_display)
                    ->prepend($min_display);

                foreach ($displays as $index => $display) {
                    if ($display >= $sub_answer) {
                        if ($index == 0) {
                            return $scores[$index];
                        }
                        $max_display = $display;
                        $min_display = $displays[$index - 1];
                        $max_score = $scores[$index];
                        $min_score = $scores[$index - 1];

                        break;
                    }
                };
            }
        }

        $a = ($min_score - $max_score) / ($min_display - $max_display);

        $b = ($max_display * $min_score - $min_display * $max_score) / ($max_display - $min_display);
        $return = $a * $sub_answer + $b;



        return round($return);
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $score
     *
     * @return Model|null|static
     */
    public function scoreForIndication($score = 0)
    {
        return Score::where('proc_id', $this->proc_id)
            ->where('score_from', '<=', $score)
            ->where('score_to', '>=', $score)
            ->where('is_deleted', 0)
            ->first();
    }

    /**
     * Update the current keys for this test
     *
     * @param Answer $answer the new answer added to the test
     * @param Collection $keys the current keys this test has
     * @param int $sub_answer the value to be assigned to the new key
     *
     * @return Collection
     */
    public function updateKeys($answer, $keys, $sub_answer)
    {
        //24102018FIX

        $group_key = collect($answer->display_groups)
            ->reduce(function ($carry, $group) use ($sub_answer) {
                $carry['_' . $group] =!empty($sub_answer) ? $sub_answer : 1;
                //$carry['_' . $group] = gettype($sub_answer) == 'string' ? $sub_answer : 1;

                return $carry;
            }, collect());

        return collect($answer->tag)
            ->flatMap(function ($key) use ($sub_answer,$answer) {
                if (!$answer->isVas() ) return [$key => 1];
                if($sub_answer===0) return [$key => 0];
                return [$key => !empty($sub_answer)  ?  $sub_answer   : 1];
            })
            ->merge($keys)
            ->merge($group_key);
    }

    /**
     * Add new answers to the test
     *
     * @param array|Collection $answers the answers to the question
     * @param Question $question id of the question that is being answered
     * @param array|Collection $keys the current keys the test has
     * @param array|Collection $indications the current indications the test has
     * @param ExpressionParser $parser
     *
     * @return void
     */
    public function addAnswers($answers, $question, $keys, $indications, $parser)
    {

        $end_test = false;
        $message = "";
        //$test_answers =TestAnswer::where('test_id', $this->id)->where('question_id',$question->id)->first();
        foreach ($answers as ['id' => $id, 'sub_answer' => $sub_answer]) {
            /** @var Answer $answer */
            $answer = Answer::findOrFail($id);

            $indications = $this->updateIndications($question, $answer, $indications, $sub_answer);
            //$indications = Cache::remember("", 10, function () use ($question, $answer, $indications, $sub_answer) {
            //    return $this->updateIndications($question, $answer, $indications, $sub_answer);
            //});

            //$Time_11 = microtime(true);
            $keys = $this->updateKeys($answer, $parser->generateSystemKeys($keys, $indications), $sub_answer);
            //$keys = Cache::remember("", 10, function () use ($answer, $sub_answer, $parser) {
            //    return $this->updateKeys($answer, $sub_answer, $parser);
            //});
            //$Time_11 = microtime(true) - $Time_11;
            //info("Time_5.12 = {$Time_11}");

            $this->attachAnswer($question->id, $answer->id, $sub_answer, $keys, $indications);
            //$indications = Cache::remember("", 10, function () use ($question, $answer, $sub_answer, $keys, $indications) {
            //    return $this->attachAnswer($question->id, $answer->id, $sub_answer, $keys, $indications);
            //});


            if ($this->shouldEndOn($answer, $keys, $parser)) {
                $end_test = true;
                $message .= "Ended on question ID {$question->id}, on answer ID {$answer->id}, due to answer's end test condition.\n";

            }
        }
        if ($end_test) {
            $this->markAsDone($message);
//            Mail::raw('This mail was sent by medecide application to Hillary . office 17:55', function ($msg) {
//                $msg->to(['amir1004@gmail.com']);
//                $msg->from(['office@medecide.net']);
//            });
            throw new QuestionnaireShouldEndException($message);
        }
    }

    /**
     * Get the next question inline for the test
     *
     * @param Collection $possible the possible questions to be next
     * @param Collection $keys the current keys the test has
     * @param ExpressionParser $parser
     *
     * @return Question
     */
    public function nextQuestion($possible, $keys, $parser)
    {
        $question = $possible->first(function ($question) use ($keys, &$current_question, $parser) {

            $result = true;
            $result_teach  = true ;

            if ($this->email == 'teach@gmail.com' && !empty($question->tag_teach)  ){
                $result_teach = $parser->parse($question->tag_teach, $keys, $question);
            }

            if (!empty($question->tag)  ){

                $result = $parser->parse($question->tag, $keys, $question);
            }
            return $result && $result_teach;
            //$result =  $parser->parse($question->tag, $keys, $question);

        });

        if (!$question) {

            $message = "No more relevant questions, possible questions remaining: {$possible->count()}.";

            $this->markAsDone($message);

            throw new NoMoreQuestionsException($message);
        }

        return $question;

    }

    /**
     * @param $latest_answer
     *
     * @return Collection|array
     */
    public function keys($latest_answer)
    {
        if (!$latest_answer) return new Collection;
        return collect(json_decode($latest_answer->current_keys, true));
    }

    /**
     * @param $latest_answer
     *
     * @return Collection
     */
    public function indications($latest_answer)
    {

        if (!$latest_answer) return new Collection;

        return collect(json_decode($latest_answer->indications, true))
            ->sortByDesc(function ($indication) {
                //  if(!is_array($indication) ) return true;
                if (!array_key_exists("weight", $indication)) return true;

                return $indication['weight'];
            });
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param Collection $answers
     * @param Collection $keys
     * @param ExpressionParser $parser
     * @return mixed
     */
    public function filterAnswersByKeys($answers, $keys, $parser)
    {
        $question_id = $answers[0]['question_id'];
        $answers = $answers->filter(function (Answer $answer) use ($keys, &$current_answer, $parser) {
            $answer->vas_max_display = $parser->parse($answer->vas_max_display, $keys, $answer);
            if (!$answer->keys_for_showing_answer) return true;

            return $parser->parse($answer->keys_for_showing_answer, $keys, $answer);
        });


        if ($answers->isEmpty()) {

            $message = 'No relevant possible answers where found for the supplied question. '.$question_id;

            $this->markAsDone($message);

            throw new NoRelevantAnswersException($message);
        }
        // parse answer vas display
        // loop through $answers

//        $answers = $answers->map(function (Answer $answer) use ($keys, &$current_answer, $parser) {
//            $answer->vas_max_display = $parser->parse($answer->vas_max_display, $keys, $answer);
////            $answer->vas_min_display = $parser->parse($answer->vas_min_display, $keys, $answer);
////            $answer->vas_min_display = $parser->parse($answer->vas_min_display, $keys, $answer);
//
//            return $answer;
//        });


        return $answers;
    }/** @noinspection PhpMethodNamingConventionInspection */


    /**
     * @return mixed
     */
    public function combinationProceduresNames(){

        try {

            //   $obj = [];
            $comb_proc_names = (new Combination)->procSiblingsKeys($this->procedure->title);

            //$Time_1 = microtime(true);
            //$indicationSiblingsKeys = $this->procedure->indicationSiblingsKeys($comb_proc_names);
            $keyRand = 'keyRand'.rand(0,1000000) / 1000000;
            $indicationSiblingsKeys = Cache::remember($keyRand, 10, function () use ($comb_proc_names) {
                return $this->procedure->indicationSiblingsKeys($comb_proc_names);
            });
            //$Time_1 = microtime(true) - $Time_1;
            //info("Time_temp = {$Time_1}");
            // $comb_proc_names= array_merge($comb_proc_names , $indicationSiblingsKeys);
            //            $comb_proc_names =   ((new Combination)->select('procedures')->where('procedures', 'like', '%'.$this->procedure->title.'%')->get()->pluck('procedures')
            //                ->map(function($a){
            //                    return $a;  })->collapse()->unique());
            //            $comb_proc_names
        }

        catch(\Exception $error ) {
            $comb_proc_names = [];
            $indicationSiblingsKeys =[];
        }

        foreach ($indicationSiblingsKeys as $key_key => $key_val)
        {


            $indicationSiblingsKeys["#score {$key_val}"] = "_void";
            unset( $indicationSiblingsKeys[$key_key]);
        }

        foreach ($comb_proc_names as $key_key => $key_val)
        {
            $comb_proc_names[$key_val] = "_void";
            unset( $comb_proc_names[$key_key]);
        }

        if (optional($this->combinationInstance)->id)  //(if no client id, combinationInstance_id = 0! )Todo Runs Over the voids!
        {
            $questionnaires = $this->combinationInstance->questionnaires();

            $comb_indications_weights= $this->scoreIndKeys($questionnaires);


            $indicationSiblingsKeys = $indicationSiblingsKeys->merge($comb_indications_weights);

            $arr = $this->combinationInstance->questionnaires()->get()->map(function($a){ return $a->procedure->title; });

            foreach ($arr as $val) {
                $comb_proc_names[$val] = 1;
            }

        }
        $returned =  $indicationSiblingsKeys->merge($comb_proc_names);

        //    info(print_r($returned,1 ));
        return  $returned;

    }
    /** @noinspection PhpMethodNamingConventionInspection */


    /**
     * @return array
     */
    public function getCombinationKeys() {

        //get other done procedures fromn same conmbination ,
        //collect all keys., and return them
        /** @noinspection PhpVariableNamingConventionInspection */
        try {
            $keys = [];
            if ($this->combinationInstance->id) //<= *** Todo if is client proceed, *** =>
            {

                $questionnaires = optional(optional($this->combinationInstance->questionnaires())->where('is_done',1));

                if($questionnaires) $questionnaires = $questionnaires->get() ;
            }
            else $questionnaires = [ $this ];
            if ($questionnaires)
                foreach($questionnaires  as $q) {

                    // take latest keys
                    $answered = $q->answered();
                    if (!empty($answered->last())) {
                        $latest = $answered->last()->pivot;
                        $k = $q->keys($latest)->toArray();

                        $keys = array_merge($keys, $k);
                    }
                    return $keys;
                }
            //   $questionnaires=optional(optional(optional($this->combinationInstance)->questionnaires()));
//            foreach($questionnaires as $q) {
//                return $keys["#procedure " . $q->procedure->title] = 1;
//            }
            // return $this->combinationInstance;
        } catch (\Exception $exception) {

            return [];
        }


    }


    /**
     * Calculate possible scenarios for every question
     *
     * @param  Collection $possible
     *
     * @return int
     */
    public function scenarios($possible)
    {

        if (!$possible) return null;
        return $possible->filter(function ($question) {
            return count($question->answers) > 0;
        })->reduce(function ($carry, $question) {
            return $carry * $question->answers->count();
        }, 1);
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * Automatically select answers for a given question and return the next one
     *
     * @param Question $question the question to be resolved
     * @param   Collection $answers
     * @param Collection $keys the current keys this test has
     * @param Collection $indications the current indications this test has
     * @param ExpressionParser $parser
     *
     * @return JsonResponse
     */
    public function resolveAutoQuestion($question, $answers, $keys, $indications, $parser)
    {




        if($answers) $this->doubleQuestionsError($question,$this->id);
        $end_test = false;
        $message = "";
        foreach ($this->autoAnswers($answers, $keys, $parser) as $answer) {
            /** @var Answer $answer */

            $sub_answer = $answer->isVas() && $answer->vas_auto_answer_formula ? $parser->parse($answer->vas_auto_answer_formula, $keys, $answer) : 0;
            $sub_answer = $sub_answer == Questionnaire::VAS_LESS ? '_less' : $sub_answer== Questionnaire::VAS_MORE ? "_more" : $sub_answer;
            $indications = $this->updateIndications($question, $answer, $indications, $sub_answer);

            $keys = $this->updateKeys($answer, $parser->generateSystemKeys($keys, $indications), $sub_answer);

            $this->attachAnswer($question->id, $answer->id, $sub_answer, $keys, $indications);

            if ($this->shouldEndOn($answer, $keys, $parser)) {
                $end_test = true;
                $message .= "Ended on question ID {$question->id}, on answer ID {$answer->id}, due to answer's end test condition.\n";
            }
            if ($question->answers_type != 'Multiple Answers') break;
        }

        if ($end_test) {
            $this->markAsDone($message);
            throw new QuestionnaireShouldEndException($message);
        }

        $possible = $this->nextPossibleQuestions($question, $indications);

        $question = $this->nextQuestion($possible, $keys, $parser)->load('answers');

        if ($question && $question->is_auto) {
            $answers = $this->filterAnswersByKeys($question->answers, $keys, $parser);

//              $ids = collect($answers)->pluck('id');
//            $answers =  $answers->filter(function($item) use ($ids) {
//
//                return  !in_array( $item->id,$ids->toArray());
//                    //return  != $testAnswers->get()->toArray()[0]['answer_id'];
//            });
            if(count($answers))  $this->doubleQuestionsError($question,$this->id, $answers);

//            info(print_r($answers->pluck('id'),1));
//            info("?ITS THE END");
//            die;
            return $this->resolveAutoQuestion($question, $answers, $keys, $indications, $parser);
        }

        $answers = $this->filterAnswersByKeys($question->answers()->get(), $keys, $parser);
        // trying to fix!
        $answers=$question->getAnswersWithParams($answers,$question);
        $latest = $this->answers()->with('question')->get()->last()->pivot;

        $get_display_group = $this->getDisplayGroups($this->answered(),$this->answered() );
        $combineReportAnswers = $this->combineReportAnswers($get_display_group,$this->answered());
        $cl_style = $this->mapApi($combineReportAnswers);
        array_pop($cl_style);
        return response()->json([
            //  'test' =>  $question->ansParams ,
            'resolve_auto_question' => true,
            'cl_style' =>$cl_style ,
            '234' => ( $this->combination_instance_id && $this->someIsDone()  ),
            'question' => $question,
            'answers' => $answers,
            "allKeys"  => $parser->allCurrentKeys($this->keys($latest)),
            'combinationKeys'=> $this->getCombinationKeys(),
            'keys' => $keys->reverse(),
            'indications' => $indications,
            'answered' => $this->answered(),
            'possible' => $possible->count(),
            'scenarios' => number_format($this->scenarios($possible)),
        ]);
    }

    /**
     * Attach a new answer to the test
     *
     * @param int $question_id the question id of the current answer
     * @param int $answer_id
     * @param int $sub_answer the value of the answer
     * @param array|Collection $keys the updated keys
     * @param array $indications the updated indications
     *
     * @return mixed
     */
    public function attachAnswer($question_id, $answer_id, $sub_answer, $keys = [], $indications = [] )
    {

        $this->answers()->attach($answer_id, [
            'created' =>   Carbon::today(),
            'modified' => Carbon::today() ,
            'tag' => '',
            //'vas_dont_show_global_unknown' => $params['vas_dont_show_global_unknown'] ,
            //  'vas_dont_show_global_no' => $params['vas_dont_show_global_no'] ,
            'question_id' => (int)$question_id,
            'sub_answer' => $sub_answer,
            'current_keys' => collect($keys)->toJson(),
            'indications' => collect($indications)->toJson(),

        ]);
    }

    /**
     * The highest priority question in this test
     * @return Question
     */
    public function firstQuestion()
    {
        return Question::where('proc_id', $this->proc_id)
            //->where('is_deleted', 0)
            ->whereNull('deleted_at')
            ->orderByDesc('priority')
            ->first();
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * The next possible questions to be loaded
     *
     * @param Question $question the current question
     * @param Collection $indications the current indications scores
     *
     * @return Collection
     */
    public function nextPossibleQuestions($question, $indications)
    {

        $possible = Question::where('priority', '<=', $question->priority)
            ->where('id', '!=', $question->id)
            ->where('proc_id', $question->proc_id)
            ->where('is_deleted', 0)
            ->whereNull('deleted_at')
            ->orderBy('priority', 'desc')
            ->get()
            ->when($indications->isNotEmpty(), function (Collection $questions) use ($indications) {
                return $questions->filter(function ($question) use ($indications) {
                    if ($question->min_score == 0 && $question->max_score == 0) return true;

                    // filter only relevant indications for these current question
                    $filtered_indications = $indications->filter(function ($_, $indication) use ($question) {
                        return in_array($indication, $question->indication);
                    });

                    if (empty($question->indication)) $filtered_indications = $indications;

                    return $question->min_score <= $filtered_indications->max('weight') &&
                        $question->max_score >= $filtered_indications->min('weight');
                });
            });

        if ($possible->isEmpty()) {

            $message = "No more relevant questions, possible questions remaining: 0.";
//            Mail::raw('This mail was sent by medecide application to Hillary . office medecide!!!55', function ($msg) {
//                $msg->to(['amir1004@gmail.com']);
//                $msg->from(['office@medecide.net']);
//            });

            $this->markAsDone($message);

            throw new NoMoreQuestionsException($message);
        }
        // $this->doubleQuestionsError($possible[0]['id'], $this->id);
        //print_r($possible[0]['id']);die;
        return $possible;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function answered()
    {

        $questions = [];

        return $this->answers()
            ->get()
            ->transform(function (Answer $answer) use (&$questions) {

                /** @var TYPE_NAME $answer */



                $answer->question =  $question = Question::find($answer->question_id)->load('polyParams');
                $answer->question_short_title  =  $question->getParam('short_title');

                //start Preview ML SHORT TITLE


                $answer->title =  trim($answer->getParam('short_title')) ?:  $answer->title  ;

                //end Preview

                if (in_array($answer->question_id, $questions)) {
                    $answer->question_title = optional($question)->title_doctor ;
                    //$answer->question_title = $short_title ?: optional($question)->title_doctor ;

                    $answer->question_indication = [];
                    $answer->question_auto = optional($question)->is_auto;
                } else {
                    //  $answer->question_title =isset( $question->title_doctor);
                    $answer->question_title =optional($question)->title_doctor ?? $question['title_doctor']  ;
                    //   $answer->question_title =  $short_title ?: $answer->question_title ;
                    //print_r($question->title_doctor);die;
                    $answer->question_indication = optional($question)->indication  ?? $question['indication'] ;
                    $answer->question_auto = optional($question)->is_auto ??  $question['is_auto'] ;
                    $questions[] = $answer->question_id;
                }

                $sub_answer = $answer->pivot->sub_answer;

                if ($answer->isVas()) {
//                    if ($answer->title=="Size") {print_r($this->vasWeight($answer, $sub_answer));die;}
                    $answer->weight = $this->vasWeight($answer, $sub_answer);

                }
                $answer->isPositive = $answer->weight > 0 ? true : false;
//                $answer->original_weight =  $answer->weight;
//                $answer->weight = $answer->weight!= 0 ?   $answer->weight - 59 : 0;
                return  $answer ;
            });
    }


    /**
     * @return array|bool
     */
    public function forceScoreSearch($indications)
    {

        $array =[];

        foreach ($indications as $key => $indication) {

            if  ( isset($indication['seemingly_justified']) &&  $indication['seemingly_justified'] )  $array[$key]['force_score_effective'] = true;

        }

        return  $array;

    }

    /**
     * @param Collection $answered
     * @param int $max
     *
     * @return $this|Collection
     */
    public function normalizeWeight(Collection $answered, $max = 0)
    {

        try {
            return $answered
                ->tap(function (Collection $answered) use (&$max) {
                    $max = $answered->max('weight');
                    $min = $answered->min('weight');
                    $max = max(abs($max),abs($min));


//                    $max = 0;
//                    $min = 0;
//                    foreach($answered as $a){
//                        if ($a->weight > 0) $max += $a->weight;
//                        if ($a->weight < 0) $min += abs($a->weight);
//                    }
//                    $max = max(abs($max),abs($min));
                })
                ->transform(function (Answer $answer) use ($max) {
                    $sub_answer = $answer->pivot->sub_answer;

                    if ($answer->isVas() && $sub_answer != '_no' && $sub_answer != '_unknown') {
                        $answer->weight = $this->vasWeight($answer, $sub_answer) * 100 / min(59, $max+25);
                    } else {
                        $answer->weight = $answer->weight * 100 / min(59, $max+25);
                    }

                    //$answer->weight = $answer->weight - 59;
//                    dd (  ['weight' => $answer->weight , "id" =>  $answer->id  ] );
                    return $answer;
                });
        } catch (\Exception $exception) {
            return $answered;
        }
    }

    /**
     * @param Collection $answers
     * @param            $keys
     * @param ExpressionParser $parser
     *
     * @return mixed
     */
    protected function autoAnswers($answers, $keys, $parser)
    {

        return $answers->filter(function ($answer) use ($keys, $parser) {
            if (empty($answer->auto_keys)) return false;

            return $parser->parse($answer->auto_keys, $keys, $answer);
        });
    }

    /**
     * @param $message
     */
    protected function markAsDone($message)
    {
        $latest=collect($this->answered()->last()->pivot);
        $this->update([
            'is_done' => true,
            'is_done_reason' => $message ,
            'label_json' => $latest['indications']
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testAnswers()
    {
        return $this->hasMany(TestAnswer::class,'test_id','id');
    }/** @noinspection PhpMethodNamingConventionInspection */


    /**
     * @param $question
     * @param $questionnaire_id
     * @param array $answers
     * @return array
     */
    public  function doubleQuestionsError($question, $questionnaire_id, $answers=null)
    {
        if($answers == null) $answers = collect();

        $testAnswersModel= new TestAnswer;
        $testAnswers = $testAnswersModel->where('question_id',$question['id'])->where('test_id',$questionnaire_id);

        if(!$testAnswers->get()->toArray()) return $answers;
        else {
            $questionMassage =" | Question ".$testAnswers->get()->toArray()[0]['question_id'];
            $answerMassage =" | Answer ".$testAnswers->get()->toArray()[0]['answer_id'];
            // info ( print_r ($testAnswers->get()->toArray(),true ) );
            info("ANSWERS doubleQuestionsError , QUESTION : $question->id");
            abort(409, 'double_answer, '.$questionMassage.$answerMassage);
        }


        // return 'double_answer';

    }

    public function isDummyPatientId()
    {

        return   $this->combinationInstance()->first()->patient_id == 57249 ? true : false;
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function combineReportAnswers($groupedQuestions,$allAnswered)
    {
        $allAnswered = $allAnswered->groupBy('question.title_doctor')->map( function($item){ return $item->sortByDesc('priority')->values();});
        $questionsArray = $answersArray=[];

        foreach ($groupedQuestions as $key => $displayGroupAnswers){
            $answersArray=[];
            if(!count($displayGroupAnswers)) $questionsArray[$key]=$allAnswered[$key];

            else{

                foreach ($groupedQuestions as $questionTitleKey => $display_groupsAnswers){

                    foreach ($display_groupsAnswers as $displayGroupKey => $answers) {

                        $answers = collect($answers);
                        $same_sub_answer = $answers->every(function ($a) {
                                return $a->pivot->sub_answer == "_no";
                            }) || $answers->every(function ($a) {
                                return $a->pivot->sub_answer == "_unknown";
                            });

                        $same_vas_display = $answers->every(function (Answer $a) { //Todo like Gender Type Question.

                            return ( $a->vas_max_display == 1 && $a->vas_max_display == $a->vas_min_display );
                        });
                        $isDropdown =  $answers->every(function (Answer $a) { //Todo like Gender Type Question.

                            return ( $a->getParam('answer_type') == "single sub-answer" );
                        });

                        $first_answer = head($answers)[0] ;
                        if ($first_answer['question_id'] == $allAnswered[$key][0]['question_id']
                            && $questionTitleKey == $key

                        ) { //Todo if its the same question

                            if ($same_sub_answer || $same_vas_display)  {
                                $filtered =  $answers->filter(function ($a) {
                                    return $a->pivot->sub_answer==1;
                                });
                                $subAnswer =
                                    $same_vas_display
                                        ? count($filtered)
                                        ? head(head($filtered))->title //$filtered[0]->title
                                        : '' : $answers[0]->pivot->sub_answer;
                                //if ($isDropdown)  $subAnswer =  $answers[0]->pivot->sub_answer;
                                $question =  $first_answer['question'];
                                $question_title = $question['title_doctor'];
                                $question_short_title =  $question->getParam('short_title');
                                $question_id = $first_answer['question_id'];
                                $answersArray[] = [
                                    'combined' => true,
                                    'isDropdown' => $isDropdown ,
                                    'display_groups' => $displayGroupKey,
                                    'title' => $displayGroupKey,
                                    'sub_answer' =>  $subAnswer,//$answers[0]->pivot->sub_answer,//studly_case($answers[0]->pivot->sub_answer),
                                    'ids' => $answers->pluck('id'),
                                    'params' => $answers[0]->params,
                                    'question_id' => $question_id ,
                                    'question_title' => $question_title ,
                                    'question_short_title' => $question_short_title,
                                    'key'=> $questionTitleKey,
                                    'weight' => array_sum($answers->pluck('weight')->values()->toArray()),
                                    'priority' => max($answers->pluck('priority')->values()->toArray())
                                ];
                            } //else if ($displayGroupKey=="Gender") $answersArray[$displayGroupKey]='samevas? '.$same_vas_display;

                            else $answersArray[$displayGroupKey] = $answers;

                        }

                    }

                }

                $answersWithNoDisplayGroups=$allAnswered[$key]->filter(function($a){return count($a['display_groups'])>0 ? false: true;  })->all();
                if ($answersWithNoDisplayGroups){
                    foreach ($answersWithNoDisplayGroups as $answersWithNoDisplayGroup) $answersArray[]=$answersWithNoDisplayGroup;}


                $questionsArray[$key]=$answersArray;

            }
        }
        return $this->prioritize($questionsArray);
    }

//    public  function  unsetFromAnswer($answer)
//    {
//        unset
//            (
//                $answer->created_at,$answer->updated_at,$answer->vas_min_display_teach ,$answer->vas_intermediate_score ,$answer->vas_intermediate_display ,$answer->keys_for_end_test ,$answer->weight_formula,
//                $answer->modified ,$answer->created ,$answer->validation ,$answer->keys_for_end_test, $answer->next_question_id , $answer->justification,
//                $answer->vas_auto_answer_formula , $answer->vas_min_teach ,$answer->vas_max_teach, $answer->vas_min
//
//
//        );
//        return $answer;
//    }

    public  function  prioritize($questionsArray)
    {
        //dd($questionsArray);
        return collect($questionsArray)->map(function ( $answers, $question_title){

            return collect($answers)->sortByDesc(function ($answer, $key) {
                if (array_key_exists('combined',$answer))return $answer['priority']; //Todo Combined!
                else if (collect($answer)->has('priority'))return  $answer->priority;
                else return $answer[0]->priority;
                //if(is_array($answer))dd($answer);


            })->values();
        });

    }

    public  function mapApi($newReportQuestions, $clApi=null) {

        if ($clApi) {
            $user = User::find(228);
//         dd(  optional($user->client )->getParam('show_final_result_api')  );
//           Auth::Login('228');
            $this->show_final_result_api = optional($user->client )->getParam('show_final_result_api');
            $this->answerProps=['id','title', 'sub_answer','question_id','question_title','display_groups'];
        }
        $newReportQuestions= collect($newReportQuestions)->map(function ($questionArray,$q_index) use($clApi) {

            return collect($questionArray)->map(function($reportAnswer,$a_index) use($clApi)  {

                $except = $clApi ?  ['weight' ,'params' ,'question.is_auto'] : [];

                if (array_key_exists('combined',$reportAnswer))

                    return $this->mapAnswer(array_except($reportAnswer, $except),true ) ;


                else if(!collect($reportAnswer)->has('id') )

                    return collect($reportAnswer)->map(function($displayGroupAnswer) {

                        return $this->mapAnswer($displayGroupAnswer);
                    });


                else

                    return   $this->mapAnswer($reportAnswer);


            });
        });

        $newReportQuestions = collect($newReportQuestions)->values()->all();

        return $this->mapArrayAnswers($newReportQuestions);
    }


    public function mapArrayAnswers($newReportQuestions)
    {

        return  array_map (
            function ($mappedQuestion) {
                $question = $mappedQuestion->toArray()[0];


                if (!array_key_exists('question_id', $question) )
                {

                    $question_id=$question[0]["question_id"] ;
                    $question_title = $question[0]["question_title"];

                    $arr= ["question_short_title" => $question[0]["question_short_title"] , "question_id" => $question_id ,  "question_title" =>   $question_title  , "answers" => $this->removeRedundantQuestionValues($mappedQuestion) ];

                    return $arr;
                }
                return  [ "question_short_title" => $question["question_short_title"] , "question_id" =>  $question["question_id"] ,  "question_title" =>   $question["question_title"]  , "answers" => $this->removeRedundantQuestionValues($mappedQuestion)  ];
            } , $newReportQuestions);
    }

    public function removeRedundantQuestionValues($mappedQuestion)
    {

        return array_map(function($v)
        {
            if(  !array_key_exists('question_id' ,$v)  )   { $v=['title'=>$v[0]['display_groups'][0],'characteristics' => $this->removeRedundantQuestionValues(collect($v))]; }
            return array_except($v, ['question_id' ,'question_title']);
        },$mappedQuestion->toArray() );
    }

    public function mapAnswer($mappedAnswer,$combined=false)
    {

        if ( $combined ) {
            $id=$mappedAnswer['ids'][0];
            if ( $mappedAnswer['sub_answer'] =="_no" or  $mappedAnswer['sub_answer'] =="_unknown" ) {
                if (array_key_exists("params", $mappedAnswer) )  $mappedAnswer['params'] =   $this->removeUnitsValue($mappedAnswer['params']);

                $mappedAnswer['sub_answer'] = Answer::find($id)->getParam("global{$mappedAnswer['sub_answer']}_label") ?: studly_case($mappedAnswer['sub_answer']);//$mappedAnswer['sub_answer'] =$this->mapNoUnknown($mappedAnswer['sub_answer'],  $id, 'global');  // $answer->getParam("global{$mappedAnswer['sub_answer'] }_label") ?: studly_case($mappedAnswer['sub_answer']) ;
            }
            return    array_except($mappedAnswer,['ids' ,'key']) ;

        }
        else  {

            //  $id=$mappedAnswer->id;

            if ( $mappedAnswer->pivot->sub_answer =="_no" or  $mappedAnswer->pivot->sub_answer =="_unknown" ) {
                $mappedAnswer->params =  $this->removeUnitsValue($mappedAnswer->params);
                $mappedAnswer->sub_answer = $mappedAnswer["vas{$mappedAnswer->pivot->sub_answer}_label"] ?: studly_case($mappedAnswer->pivot->sub_answer);
            }
            else if ( $mappedAnswer->pivot->sub_answer =="_less" or  $mappedAnswer->pivot->sub_answer =="_more" ) {
                $mappedAnswer->vas_max_display = number_format($mappedAnswer->vas_max_display)  ;
                $than = ' than ';
                $than .=  $mappedAnswer->pivot->sub_answer =="_less" ? number_format($mappedAnswer->vas_min_display) :  number_format($mappedAnswer->vas_max_display);
                $mappedAnswer->sub_answer = ltrim($mappedAnswer->pivot->sub_answer , '_')  . $than;
            }

            else if (empty ($mappedAnswer->vas_max_display) )   $mappedAnswer->sub_answer='';

            else if ( $mappedAnswer->vas_max_display==1 and $mappedAnswer->vas_max_display == $mappedAnswer->vas_min_display )   $mappedAnswer->sub_answer='Yes';

            else $mappedAnswer->sub_answer=$mappedAnswer->pivot->sub_answer ;
        }

        return $mappedAnswer->only($this->answerProps );
    }

    /**
     * @param $params
     * @return mixed
     */
    public  function  removeUnitsValue(Collection $params){

        return $params->map(function ($item, $key) {
            //dd($mappedAnswer['params']);
            if (  $item->title == 'plural_units' ) $item->pivot->value='';
            return $item;
        });

    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $indications
     * @return int
     */
    public function  isCombinedIndication(Collection $indications)
    {
        return count($indications->filter(function ($ind)  { return $ind['weight']==60;} ))>=2;

    }
    public  function beforeForceScore ($i) {

        return $i;

    }
    /**
     * @param $indications
     * @return bool
     */
    public function  invertedVerdict(Collection $indications)
    {


        $weights =   collect($indications->pluck('weight') );

        return  $weights->contains(55) && $weights->contains(function ($value, $key) {
            return $value > 50;
        }) ? true  : false  ;

    }

    /**
     * @param $allAnswered
     * @return mixed
     */

    public function getDisplayGroups(Collection $allAnswered)
    {
        return $allAnswered->groupBy('question.title_doctor')->map(function (Collection $item) {
            return $item->groupBy('display_groups');
        });
    }


    /**
     * @param Collection $questionnaires
     * @return mixed
     */
    public function scoreIndKeys ( $questionnaires )
    {
        /** @noinspection PhpParamsInspection */
        return  $questionnaires->where("is_done", 1)->get()

            ->flatMap( function (Questionnaire $questionnaire) {

                return $questionnaire->indications($questionnaire->latestAnswer())

                    ->flatMap(function($indValues,$indName) {

                        return ["#score {$indName}" => $indValues['weight'] ]  ;

                    });

            }
            );
    }

    /**
     * @return mixed
     */
    public function voidKeys() {


        $procedures = Procedure::select('id')->WhereIn('id', $this->procedure->getIDs((new Combination)->procSiblingsKeys($this->procedure->title)))->get() ;

        return $procedures->map(
            function (Procedure $procedure) {

                return   $procedure->keysQuery()   ;

            }
        )->collapse()->unique();

    }

    /**
     * @return mixed
     */
    public function  someIsDone()
    {

        try {
            if ($this->combinationInstance)
                return count(($this->combinationInstance->questionnaires())->where('is_done', 1)->get()) >= 1;

        } catch (\Exception $exception) {
            return false;

        }
    }

    /**
     * @return array
     */
    public static function setQuestionTitle($answers)
    {
        if (($answers)[0]->question() )
            return head($answers)[0]['question']['title_doctor'];
    }

    /**
     * @return array
     */
    public static function mapMlQuestions($clStyle , $ml)
    {
        $duplicated_questions_list = head($ml)['duplicated_questions_list'];
        if(!count($duplicated_questions_list)) return $clStyle;
        return collect($clStyle)->map( function ($item) use ($duplicated_questions_list){
            if ( in_array($item['question_id']   ,  $duplicated_questions_list ) ) $item['question_title'] = Question::find($item['question_id'])->getParam('short_title') ?: $item['question_title'];
            return $item;
        });
    }
}
