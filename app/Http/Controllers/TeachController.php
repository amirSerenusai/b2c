<?php /** @noinspection PhpVariableNamingConventionInspection */

namespace App\Http\Controllers;
//use App\User;
use App\Answer;
use App\DisplayGroup;
use App\Events\QuestionAnswered;
use App\Question;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Log;
//use Illuminate\Validation\Rule;
//use function MongoDB\BSON\toJSON;
//use phpDocumentor\Reflection\Types\Object_;
//use phpDocumentor\Reflection\Types\Self_;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Queries\Indications;
use DB;
use Auth;

use App\ExpressionParser;
use App\Questionnaire;
use Illuminate\Support\Facades\Cache;
use SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException;

use function GuzzleHttp\json_encode;

/** @noinspection PhpPropertyNamingConventionInspection */


/**
 * Class TeachController
 * @package App\Http\Controllers
 */
class TeachController extends Controller
{
    protected $questionnaire;
    protected $log= [] ;
    protected $dblog= [] ;

    protected $countCurrentAnswers;
    protected $questionDisplayGroups;
    //  protected $compare_count_rand_and_count_available_answers=false;
    protected $removedAnswers=[];
    protected $showAnswers=[];
    protected $overallTime;
    protected $startTime = 0;
    public $tempKeys = array();
    public $group_kfsat = [];
    public $group_global_no = [];

    /**
     * @param Request $request
     * @return mixed|string
     */
    public function storeIndication(Request $request){
        /** @noinspection PhpVariableNamingConventionInspection */
        $user = Auth::user();
    //    if (!$user) return "Not authorized.";
        $response=json_decode(json_decode($request->getContent(), true)['payload'], true);

        $answers = "";
        if (isset($response['answers']))
        {
            if (isset($response['final_decision'])) $response['answers']['final_decision'] = $response['final_decision'];
            $answers=json_encode($response['answers']);
        }

        info(json_encode($answers));
        $data = ['test_id' => $response['test_id'],
            'created_at' => DB::raw('now()'), //
            'user_id' => $user->id,
            'label_json' => $answers,
            'reconsider' => 0 // add new row
        ];

        $row = DB::table('teach')->where('user_id' ,$user->id )->where('test_id', $response['test_id']);

        if ($row->first()){
            info("UPDATE?");
            $row->update($data);
        } else{
            info("INSERT?");
            DB::table('teach')->insert($data);
        }
        return $row->get();
    }

    // actually its a logNormal bell
    /**
     * @param $min
     * @param $max
     * @param $s
     * @param int $m
     * @param int $step
     * @return float|int
     */
    public function logNormalBell($min , $max, $s, $m){

        $this->log[] ="<div> STARTING logNormalBell, LINE: ". __LINE__ .",STARTING logNormalBell---></div>";
        $this->log[] ="<div>before M: " .$m. ",S: ".$s."MIN: ".$min. ", MAX:". $max.", </div>";
        info("logNormalBell: min = {$min}, max = {$max}, mean = {$m}, STD = {$s}, LINE: ".__LINE__);
        $m = $m - $min; //1
        if ($m == 0 or $s == 0 ) {
            //$this->log[] = "both m and s are 0 . returning random value in range of {$min} - {$max}";
            $this->log[] ="<div>M: " .$m. "</div>";
            return rand($min,$max);
        }
        $s = $s*$s;
        // if ( $s+$m*$m == 0 or $s == 0 ) {
        // $this->log[] = " s + m*m = 0 . returning random value in range of {$min} - {$max}";
        // return rand($min,$max);
        // }

        $mu = log($m*$m/sqrt($s+$m*$m) , exp(1));
        $sigma = sqrt(log(($s+$m*$m)/($m*$m),exp(1)));
        # generate 2 random numbers between 0
        $randA= rand(0,1000000) / 1000000;
        $randB= rand(0,1000000) / 1000000;
        # convert the uniform random number to to normal distribution
        $randNumber = sqrt(-2 * log($randA,exp(1))) * cos(2 * pi() *$randB) * $sigma + $mu;
        # convert to lognormal distribution
        $randNumber = exp($randNumber);
        $randNumber = $randNumber + $min;
        if( $randNumber > $max ) $randNumber = $max ;

        return $randNumber;
    }

    /**
     * @param $condition
     * @return bool|int|null
     */
    public function parse($condition){

        if (trim($condition) == '' || $condition == null) return 0;

        $questionnaire = $this->questionnaire;

        $parser = new ExpressionParser($questionnaire->procedure );

        $latest = $questionnaire->latestAnswer();

        $indications = $questionnaire->indications($latest);

        $latest_id = isset($latest->id) ? $latest->id : 0;

        $tag = "current keys {$questionnaire->id} {$latest_id} ";

        $current_keys = Cache::remember($tag, 10, function () use ($parser,$indications,$latest,$questionnaire) {
            return $parser->generateSystemKeys($questionnaire->keys($latest), $indications);
        });

        if (sizeof($this->tempKeys) > 0)
            foreach ($this->tempKeys as $keyName => $value) {
                $this->log[] = "adding temp keys to parser {$keyName} : {$value}";

                $current_keys->put($keyName , $value);
            }


        try {
            $result = $parser->parse($condition , $current_keys);
            $this->log[]= "<div>Parse condition : <b>{$condition}</b></div>";

            $this->log[]= "<div>Parse result : <b>{$result}</b></div>";

        } catch (\Throwable $exception) {
            $result = null;
            // $this->log[]= "!!! parse {$condition} exception ".print_r($exception,1);

        }
        $this->logTime("finished parse {$condition}");

        return $result;
    }

    public function testTeach(){
        $answer= Answer::find(9480);
        return $this->randomSubAnswer($answer);
    }

    /**
     * @param Answer $randAnswer
     * @param array $answered
     * @param string $force_sub_answer
     * @return float|int|mixed|string
     */
    public function randomSubAnswer(Answer $randAnswer, $answered = [], $force_sub_answer = "", $SingleAnsFlag = false){

        $sub_answer = '';
        // echo "<hr>random sub_Answer for anwer ".$randAnswer->title."<Br>";
        // echo "is vas:".$randAnswer->isVas()."<br>";
        $force = "";
        // if already answered from same display_group, the sub_answer should match the other answer (but not for single_sub_answer cases)
        if (sizeof($answered)>0)
            foreach($answered as $a){

                // check if the display group is not single sub answer
                $ANSWER_TYPE = strtolower(trim($randAnswer->getParam('answer_type'))) == 'single sub-answer' ? 'single_sub_answer' : false;
                if ($ANSWER_TYPE) info("ANSWER_TYPE = {$ANSWER_TYPE}, LINE = ".__LINE__);

                if (trim($a['display_group']) > "" AND !$ANSWER_TYPE){
                    if ($a['display_group'] == head($randAnswer->display_groups) ){
                        // if prev answer is vas value, so this should be also vas value
                        $force = "value";
                        // if prev was no, this should be no as well
                        if ( $a['sub_answer'] == "_no" || $a['sub_answer'] == "_unknown"){
                            $force = $a['sub_answer'];
                        }
                    }
                    if ($force)
                        $this->log[] = "force sub_answer : {$force} - in {$a['display_group']} | sub_answer: {$a['sub_answer']}";
                    info("force sub_answer : {$force} - in {$a['display_group']} | sub_answer: {$a['sub_answer']}, LINE: ".__LINE__);

                }
            }
        if ($force == "" && $force_sub_answer != "") return $force_sub_answer;

        //info("randAnswer = ".print_r($randAnswer,1));
        $teach_vas_min_display = trim($randAnswer->getParam('teach_vas_min_display')) ? $this->parse($randAnswer->getParam('teach_vas_min_display')) : $randAnswer->vas_min_display;
        $teach_vas_max_display = trim($randAnswer->getParam('teach_vas_max_display')) ? $this->parse($randAnswer->getParam('teach_vas_max_display')) : $randAnswer->vas_max_display;

        //info("min: teach_vas_min_display = {$teach_vas_min_display}, vas_min = {$randAnswer->vas_min_display}");
        //info("max: teach_vas_max_display = {$teach_vas_max_display}, vas_max = {$randAnswer->vas_max_display}");

        $teach_vas_min_display = max($randAnswer->vas_min_display , $teach_vas_min_display);
        $teach_vas_max_display = min($randAnswer->vas_max_display , $teach_vas_max_display);

        $distribution_std = $this->parse($randAnswer->getParam('distribution_std')) ?: false;
        $distribution_mean = $this->parse($randAnswer->getParam('distribution_mean')) ?: false;


        $randAnswerisvas = $randAnswer->isVas();
        $teach_probability = trim($randAnswer->getParam('teach_probability')) ?: false;
        if (!$teach_probability){
            if($randAnswerisvas OR $SingleAnsFlag){
                $teach_probability = '{"yes": 1}';
            }else{
                $teach_probability = '{"yes": 0.5,"_no":0.5}';
            }
        }
        info("teach_probability = {$teach_probability}");
        $this->log []= "<br><b>Answer ID:</b> {$randAnswer->id}, <b>Answer title:</b> {$randAnswer->title}, LINE: ".__LINE__."<br>";
        $this->log []= "<b>teach_probability:</b> {$teach_probability}, LINE: ".__LINE__."<br>";
        $this->log[]="<br><b> isVas = </b> {$randAnswerisvas}, <b>distribution_std = </b> {$distribution_std}, <b>distribution_mean =</b> {$distribution_mean}, LINE: ".__LINE__."<br>";
        info("isVas = {$randAnswerisvas}, distribution_std = {$distribution_std}, distribution_mean = {$distribution_mean}, LINE: ".__LINE__);

        info("teach vas display: {$teach_vas_min_display} - {$teach_vas_max_display}");
        $DistributionType = '';
        if (!empty($distribution_std) AND !empty($distribution_mean) AND $randAnswerisvas){
            $DistributionType = "LogNormal_distribution";
        }else if ((empty($distribution_std) or empty($distribution_mean)) AND ($randAnswerisvas)){
            $DistributionType = "Constant_distribution";
        }else if(!($randAnswerisvas)){
            $DistributionType = "NotVas";
        }
        $this->log[]="<b> <b>DistributionType = </b> {$DistributionType}, LINE: ".__LINE__."<br>";
        info("DistributionType = {$DistributionType}");

        $otherOptions = [];
        if (empty($teach_vas_min_display) && empty($teach_vas_max_display)){
            if (!$randAnswer->vas_dont_show_no) $otherOptions[] = '_no';
            if (!$randAnswer->vas_dont_show_unknown) $otherOptions[] = '_unknown';
        }
        //$this->log[]="show answers from k.f.s.a.t: ".print_r($this->showAnswers,1)." <br>";
        //$this->log[]="teach vas display: {$teach_vas_min_display} - {$teach_vas_max_display} | show answer: ".in_array( $randAnswer->id , $this->showAnswers)." <br>";

        // if teach_vas and keyForShowingAnswerTeach is true , force value for this answer
        if (!empty($teach_vas_min_display) && !empty($teach_vas_max_display) && in_array( $randAnswer->id , $this->showAnswers ) ){
            $force = "value";
            $this->log[]="teach vas and keyForShowingAswerTeach -> force sub answer value<br>";
        }

        if ($randAnswer->vas_show_more && !isset($teach_vas_max_display)) $otherOptions[] = '_more';
        if ($randAnswer->vas_show_less && !isset($teach_vas_min_display)) $otherOptions[] = '_less';

        if ($force == "_no" || $force == "_unknown"){
            $sub_answer = $force;
            $this->log[]="force {$force }<br>";
        }else{
            info("ANSWER ID: ". $randAnswer->id);
            info("teach_probability: ". $teach_probability." LINE: ".__LINE__);
            $this->log[] ="<br><div> \"ANSWER ID: \". $randAnswer->id </div>";
            $this->log[] ="<br><div> PROBABILTY: ".trim($teach_probability).", LINE: ". __LINE__ ." </div>" ;
            //$vas_step = $randAnswer->getParam('vas_step') ?: false;
            $vas_step = $randAnswer->vas_step ?: false;
            info("vas_step = {$vas_step}");
            $sub_answer = $this->discreteProbability($teach_probability, $teach_vas_min_display, $teach_vas_max_display, $DistributionType, $distribution_std,$distribution_mean, $vas_step);
            //info("sub_answer_before = {$sub_answer}");
            //if($sub_answer == '_no' and $DistributionType == 'NotVas') $sub_answer = 0;
            //info("sub_answer_after = {$sub_answer}");
            info("sub answer: {$sub_answer }");
            $this->log[] ="<br> sub_answer = {$sub_answer}";
        }

        $this->log[] = "l131; | sub_answer: {$sub_answer}";
        if (empty($sub_answer)) {
            info("sub answer = {$sub_answer} == NULL, now it will be forced to be 0. LINE: ".__LINE__);
            $sub_answer = 0;
            $this->log[] = "sub answer = $sub_answer == NULL , now it will be forced to be 0. LINE: ".__LINE__;
        }

        return $sub_answer;
    }

    /**
     * @param $teachProbabilities
     * @return int|string
     */
    public function discreteProbability($teachProbabilities ,$min, $max, $DistributionType, $distribution_std, $distribution_mean, $vas_step){

        //$time_discreteProbability = microtime(true);

        info("INSIDE discreteProbability LINE: ".__LINE__);
        info(print_r($teachProbabilities,true));
        $teachProbabilities = json_decode($teachProbabilities,true);

        $teachProbabilities = array_filter($teachProbabilities);
        $NoProb = 1 - array_sum($teachProbabilities);
        //info("NoProb = {$NoProb}");
        if(!array_key_exists("_no", $teachProbabilities)){
            info("_no key not exists in teachProbabilities. Add _no key with probability of {$NoProb} LINE: ".__LINE__);
            $teachProbabilities['_no'] = $NoProb;
        }

        /**
         * @param $val
         * @param $key
         * @param $new_array
         */
        //Todo new Breaker
        $prob = 0;
        $randA = rand (0,100) / 100 ;
        info("discreteProbability random number = {$randA}");

        foreach ($teachProbabilities as $key => $probability){
            $key = strtolower($key);
            info("key = {$key}, probability = {$probability}");
            //$key = strtolower($key) == "yes" ? 1 : $key ;
            $prob = $prob + floatval($probability );
            info("prob = {$prob} ");
            if ($randA <= $prob){
                info("Choosen_key = {$key}");
                if (($key == "yes" OR $key == "value") AND $DistributionType == "LogNormal_distribution"){
                    info("DistributionType = {$DistributionType}");
                    //$time_logNormalBell = microtime(true);
                    $key = $this->logNormalBell($min, $max , $distribution_std ,$distribution_mean);
                    //$time_logNormalBell = microtime(true) - $time_logNormalBell;
                    //info("Time_logNormalBell = {$time_logNormalBell}");
                    info("Value/yes = {$key}");
                    if($vas_step){
                        $key = $vas_step * round($key / $vas_step);
                        info("vas_step = {$vas_step}, round value = {$key}, LINE = ".__LINE__);
                    }
                }
                if (($key) == "yes" AND $DistributionType == "Constant_distribution"){
                    info("DistributionType = {$DistributionType}");
                    $key = rand($min,$max);
                    info("Value/yes = {$key}");
                    if($vas_step){
                        $key = $vas_step * round($key / $vas_step);
                        info("vas_step = {$vas_step}, round value = {$key}, LINE = ".__LINE__);
                    }
                }
                //NotVas
                info("returned key = {$key}");
                //$time_discreteProbability = microtime(true) - $time_discreteProbability;
                //info("time_discreteProbability = {$time_discreteProbability}");
                return $key;
            }
        }
    }

    /**
     * @param $test_id

     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getNextQuestion($test_id, $payLoad = []) {

        //$time_getNextQuestion = microtime(true);
        $this->removedAnswers=[];
        $qqc = new QuestionnaireQuestionsController();
        $request = new Request();
        $payLoad['teach'] = true;

        if(is_array($payLoad) AND count($payLoad)) $request->replace($payLoad);

        $time_temp = microtime(true);
        //$response = $qqc->create($request, $test_id);

        try {
            $response = $this->addAnswers($request, $this->questionnaire );
        }
        catch(ModelNotFoundException $e) {
            return $this->teachInitialResponse();
        }
        $time_temp = microtime(true) - $time_temp;
        info("time_create = {$time_temp}, LINE: ".__LINE__);

        $response = json_decode($response->getContent(), true);
        //$time_temp = microtime(true) - $time_getNextQuestion;
        //info("time_getNextQuestion = {$time_temp}");
        return $response;
    }

    // filter answers by key for showing answer teach
    public function checkKeyForShowingAnswerTeach($answer){


        $this->log[]= "<div style='background-color:lightGrey; color:red'>**checkKeyForShowingAnswerTeach** ans_id: {$answer->id}<br></div>";

        // if($answer->getParam('vas_dont_show_global_no'))return false;
        $display_group = head($answer->display_groups);
        $this->log[]= "<div style='background-color:lightGrey; color:cornflowerblue'>$display_group</div>";
        // check if another group member has keys_for_showing_answer_teach (all family goes together)
        if (isset($this->group_kfsat[$display_group] ) ){
            $this->log[] = "<div>found k.f.s.a.t for group {$display_group} : {$this->group_kfsat[$display_group]} </div>";
            return $this->group_kfsat[$display_group];
        }

        if (trim($answer->keys_for_showing_answer_teach) > '') {
            $parserResult = false;
            $this->log[]= "<div style='color:green'> Keys for showing answer teach: id: {$answer->id} - {$answer->keys_for_showing_answer_teach}</div>";
            try {
                $parserResult = $this->parse($answer->keys_for_showing_answer_teach);
                if ($parserResult){
                    //todo if condition success - we will force choosing thie answer later
                    $this->log[]= "<div style='color:green'><b> parserResult: {$parserResult}</div>";
                    $this->showAnswers[$answer->id] = $answer->id;
                    if ($display_group) $this->group_kfsat[$display_group] = true;
                    return true;
                }
                // we remove answers if condition is false AND it is not the last answer in the array.
                if (($parserResult <= 0 || $parserResult == null || $parserResult == false) ) {
                    $this->log[]= "<div style='color:plum'>$parserResult: {$parserResult} </div>";
                    // if part of group, dont delte, jsut mark it.
                    // if part of group with only one answer - delete!
                    if ($display_group ) {
                        info("display_group = {$display_group}, LINE = ".__LINE__);
                        if (count($answer->answer_groups) == 1){
                            $count_ans = count($answer->answer_groups);
                            info("Number of answer in display group = {$count_ans}, delete this answer (Ans ID = {$answer->id}), LINE = ".__LINE__);
                            return false;
                        }
                        $this->log[]= "<div style='color:red'><b> added to group_kfsat : </b>{$answer->id} .'display group=' {$display_group} will be marked as false </div>";
                        $this->group_kfsat[$display_group] = false;
                    }
                    $this->log[]= "<div style='color:red'><b> count answer groups: </b>".count($answer->answer_groups)." </div>";
                    if (count($answer->answer_groups)>0) return true;
                    else {
                        $this->log[]= "<div style='color:red'><b>l:392 Removed Answer: </b>{$answer->id} </div>";
                        $this->log[]= "<div style='color:red'><b> answer groups: </b>".json_encode($answer->answer_groups)." </div>";
                        unset($this->showAnswers[$answer->id]);
                    }

                    return false;
                    //if(!$this->compare_count_rand_and_count_available_answers)
                }

            } catch (\Throwable $exception) {
                $this->log[]= "<div style='color:green'><b> EXCEPTION: </b> {$answer->id} - {$exception}</div>";
            }

        }
        return true;
    }

    public function filterAnswers($answers){
        foreach($answers as $key=>$ans) {
            $answer = Answer::find($ans['id']);
            //$time_checkKeyForShowingAnswerTeach = microtime(true);
            $result = $this->checkKeyForShowingAnswerTeach($answer);
            //$time_checkKeyForShowingAnswerTeach = microtime(true) - $time_checkKeyForShowingAnswerTeach;
            //info("time_checkKeyForShowingAnswerTeach = {$time_checkKeyForShowingAnswerTeach}");
            if (!$result && count($answers)>1){
                $this->removedAnswers[$answer->id]=$answer;
                $this->log[]= "<div style='color:brown'><b>(M):filter Answers -> Removed Answer: </b>{$answer->id}. LINE: ".__LINE__."</div>";
                unset($answers[$key]);
            }
        }
        return $answers;
    }

    public function logTime($description){
        if ($this->startTime < 1) $this->startTime = microtime(true);
        // $this->log[] = $description." Time: ".round(microtime(true) - $this->startTime, 3) ." sec";
        $this->startTime = microtime(true);
    }

    /**
     * @param $user_id
     * @return array
     */
    public function showTeach($user_id){
        return showTeachTags($user_id);
        $showTeach=[];
        $showTeach['totalTags']=count(DB::table('teach')->where('user_id',$user_id)->get());
        $showTeach['todayTags']=count(DB::table('teach')->where('user_id',$user_id)->whereDate('created_at', Carbon::today())->get());
        return $showTeach;
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $bind
     * @return array
     */
    public function walker($bind){
        //$bind = ' Unknown-0.05 , Not tested-0.05 , logNormal-0.9' ;
        $nums = explode(',',$bind);
        info("inside wakjer");
        foreach ($nums as $key => $num) {
            $num = strtolower($num);
            $num = str_replace( "'" , '', $num);
            $num = str_replace( ' " ' , '', $num);
            info($num.' <---num');
            $num = explode('-',$num);
            $nums[trim($num[0])]= trim ($num[1] ) ;
            unset($nums[$key]);
        }
        return $nums;
    }

    /**
     * @param $answers
     * @return array
     */
    public function ChooseSingleAnsByProb($answers){

        if (count($answers) == 1) return array_search(true, $answers);

        $this->log[] = "<br><b>Single Answer case: Compute probability and choose one answer</b>, LINE:".__LINE__."<br>";
        info("Single Answer case, LINE: ".__LINE__);
        $AnsVec = [];
        foreach($answers as $key => $ans_i){
            $this->log[] = "<br>Answer ID = {$ans_i['id']}";
            $single_answer_probability = trim(Answer::find($ans_i['id'])->getParam('single_answer_probability')) ?: 0;
            $ans_i_vec = [];
            $ans_index = $key;
            info("Answer_ID = {$ans_i['id']}, single_answer_probability = {$single_answer_probability}, ans_index = {$ans_index}");
            $ans_i_vec[] = array_fill(0, round(($single_answer_probability * 100)), $ans_index);
            array_push($AnsVec, $ans_i_vec);
        }
        $AnsVec = collect($AnsVec)->flatten()->toArray();
        //info("AnsVec = ");
        //info(print_r($AnsVec,1));

        $RandomAnswerKey = $AnsVec[array_rand($AnsVec, 1)];
        info("RandomAnswerKey = {$RandomAnswerKey}");

        $RandomAnswer_ID = $answers[$RandomAnswerKey]['id'];
        $this->log[] = "<br>RandomAnswerKey = {$RandomAnswerKey}, ";
        $this->log[] = "RandomAnswer_ID: ".print_r($RandomAnswer_ID, 1)."</p>";

        return $RandomAnswerKey;
    }

    /**
     * @param $proc_id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function createScenario($proc_id){
        info("****************************************************************************************************************************************************************************************************");
        info("****************************************************************************************************************************************************************************************************");
        info("****************************************************************************************************************************************************************************************************");
        info("****************************************************************************************  New test id  *********************************************************************************************");

        //$time_DB_connection = microtime(true);
        DB::connection()->enableQueryLog();

        $this->logTime('start');
        // $this->log = "";
        //$user = Auth::user();
        $user =Auth::loginUsingId(227, TRUE);
    //    if (!$user) return "Not authorized.";
        // get procedure indications
        //$indicationsClass = new Indications($proc_id);
        $decisionCodes = DB::table('decision_codes')->select('title', 'code')->where('show_in_teach', '!=', 0)->orderBy('code')->get();

        // check if user has tests waiting for him for reconsidering
        // select from tests where reconsider = 1
        $user_id = $user->id;
        $reconsider_test = DB::table('teach')->where('reconsider', '=', 1)->where('user_id', '=', $user_id)->orderBy('created_at','DESC')->first();
        if ($reconsider_test){
            $test_id = $reconsider_test->test_id;
            if (Questionnaire::find($test_id)->user_id == $user_id) {
                $indications = $reconsider_test->label_json;
                $indications = array_keys(json_decode($indications, true));
                unset($indications['final_decision']);
                return response()->json([
                    //'count_tags' => $this->showTeach($user->id),
                    'log' => $this->log , // $time_elapsed_secs
                    'dblog' => $this->dblog , // $time_elapsed_secs
                    'test_id' => $test_id,
                    '$user_id' => $user_id,
                    'indications' => $indications,
                    'decisionCodes' => $decisionCodes,
                    'reconsider' => true
                ], 200);
            }
        }

        $teachResponse=[];
        // create new test (questionnaire)
        $request = new Request();
        $request->replace(['user_id'=>$user->id, 'procedure' => $proc_id,'email' => 'teach@gmail.com']);
        $q = new QuestionnairesController();
        $q->user_id = $user->id;
        $test = $q->store($request);
        $test_id = $test->id;



        $this->log[] = "<br><br><b>TEST ID: </b>{$test_id}<br>";
        info("TEST ID: {$test_id}");
        $questionnaire = Questionnaire::findOrFail($test_id);
        $this->questionnaire = $questionnaire;
        $parser = new ExpressionParser($questionnaire->procedure);

        //$time_DB_connection = microtime(true) - $time_DB_connection;
        //info("time_DB_connection = {$time_DB_connection}");


        // FIRST QUESTION

        $response = $this->getNextQuestion($test_id);

        $this->countCurrentAnswers=0;

        $question = $response['question'];
        $answers = $response['answers'];
        $loop = 0;

        $done = false;

        while(!$done) { //Start the LOOP

            $this->tempKeys = [];

            $this->countCurrentAnswers=0;
            $loop ++ ;

            $this->logTime("Question {$question['id']} {$question['title_doctor']} ");

            $this->log[] = "<b>Question ID:</b> {$question['id']} <br> <b>title_doctor: </b>{$question['title_doctor']}<br> <b>question_answers_type:</b> {$question['answers_type']}<br>";
            info("--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
            info("--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
            info("----------------------------------------------------------------------------- Start a new question -----------------------------------------------------------------------------------------");
            info("Question {$question['id']} {$question['title_doctor']}");
            QuestionAnswered::dispatch([
                'qTitle' => $question['title_doctor'],
                'qID' => $question['id'],
                'answers' =>  Arr::pluck($answers,'title')
            ]);
            $dispatchAnswers = collect($answers)->map(function($a) {return $a;});
            if(head($answers[0]['display_groups'])) dd($questionnaire->answered($dispatchAnswers)    );
            // randomize answers
            $answered = [];
            if(count($answers) == 0 ) {
                $this->log []= "<br><b>did not find answers</b><br>";
                info("did not find answers, LINE:").__LINE__;
            }

            $answers_ids = Arr::pluck($answers,'id');

            info("answers_ids:".print_r($answers_ids,1));

            info("++++++++++++++++++++++++++ Build ans_array & check Key For Showing Answer Teach +++++++++++++++++++++++++");
            $Ans_KeyForShowingAnswerTeach_list = [];
            $Ans_false_KeyForShowingAnswerTeach_list = [];
            $ans_array = [];
            $Group_array = [];
            $displayGroup_array = [];
            $SingleSubAns_displayGroup_array = [];
            foreach($answers_ids as $ans){
                $answer = Answer::find($ans);
                info("Checking Answer ID {$answer->id}: {$answer->title}, LINE:".__LINE__);
                //$time_checkKeyForShowingAnswerTeach = microtime(true);
                $checkKeyForShowingAnswerTeach = $this->checkKeyForShowingAnswerTeach($answer);
                info("checkKeyForShowingAnswerTeach = {$checkKeyForShowingAnswerTeach}");
                //$time_checkKeyForShowingAnswerTeach = microtime(true) - $time_checkKeyForShowingAnswerTeach;
                //info("time_checkKeyForShowingAnswerTeach = {$time_checkKeyForShowingAnswerTeach}");
                $answerGroup = $answer->answerGroups();
                $displayGroupName = $answer->displayGroup()['name'];
                $displayGroupProbability = $answer->displayGroup()['probability'];
                $ANSWER_TYPE = false;
                $single_sub_answer_prob = 0;
                if(!empty($displayGroupName)){
                    $ANSWER_TYPE = strtolower(trim($answer->getParam('answer_type'))) == 'single sub-answer' ? 'single_sub_answer' : false; // if single sub-ans
                    if($ANSWER_TYPE == 'single_sub_answer'){
                        $single_sub_answer_prob = trim($answer->getParam('single_answer_probability')) ?: 0; // the probability of 'yes'
                        //$single_sub_answer_prob = json_decode($answer->getParam('teach_probability'), true)['yes']; // the probability of 'yes'

                    }
                }
                //info("ANSWER_TYPE = {$ANSWER_TYPE}");


                //info("answerGroup: ".print_r($answerGroup,1));
                if(empty($answerGroup)){
                    $ans_array[] = array('Ans_ID' => $answer->id, 'checkKeyForShowingAnswerTeach' => $checkKeyForShowingAnswerTeach,
                        'answerGroupName' =>  false, 'answerGroupProbability' => false,
                        'displayGroupName' => $displayGroupName, 'displayGroupProbability' => $displayGroupProbability,
                        'ANSWER_TYPE' => $ANSWER_TYPE, 'single_sub_answer_prob' => $single_sub_answer_prob);

                    if($checkKeyForShowingAnswerTeach && !empty($displayGroupName)){
                        //$Group_array[] = array('answerGroupName' => false, 'answerGroupProbability' => false);
                        $displayGroup_array[] = array('answerGroupName' =>  false, 'displayGroupName' => $displayGroupName,
                            'displayGroupProbability' => $displayGroupProbability, 'ANSWER_TYPE' => $ANSWER_TYPE);
                        if($ANSWER_TYPE == 'single_sub_answer'){
                            $SingleSubAns_displayGroup_array[] = array('answerGroupName' =>  false, 'displayGroupName' => $displayGroupName,
                                'displayGroupProbability' => $displayGroupProbability, 'ANSWER_TYPE' => $ANSWER_TYPE, 'single_sub_answer_prob' => $single_sub_answer_prob);
                        }
                    }
                }else{
                    foreach($answerGroup as $answerGroup_i){
                        //$answerGroupName[] = $answerGroup_i['name'];
                        //$answerGroupProb[] = $answerGroup_i['probability'];
                        $ans_array[] = array('Ans_ID' => $answer->id, 'checkKeyForShowingAnswerTeach' => $checkKeyForShowingAnswerTeach,
                            'answerGroupName' =>  $answerGroup_i['name'], 'answerGroupProbability' => $answerGroup_i['probability'],
                            'displayGroupName' => $displayGroupName, 'displayGroupProbability' => $displayGroupProbability, 'ANSWER_TYPE' => $ANSWER_TYPE,
                            'single_sub_answer_prob' => $single_sub_answer_prob);

                        if($checkKeyForShowingAnswerTeach){
                            $Group_array[] = array('answerGroupName' =>  $answerGroup_i['name'], 'answerGroupProbability' => $answerGroup_i['probability']);
                            if(!empty($displayGroupName)){
                                $displayGroup_array[] = array('answerGroupName' =>  $answerGroup_i['name'], 'displayGroupName' => $displayGroupName,
                                    'displayGroupProbability' => $displayGroupProbability, 'ANSWER_TYPE' => $ANSWER_TYPE);
                                if($ANSWER_TYPE == 'single_sub_answer'){
                                    $SingleSubAns_displayGroup_array[] = array('answerGroupName' =>  $answerGroup_i['name'], 'displayGroupName' => $displayGroupName,
                                        'displayGroupProbability' => $displayGroupProbability, 'ANSWER_TYPE' => $ANSWER_TYPE, 'single_sub_answer_prob' => $single_sub_answer_prob);
                                }
                            }
                        }
                    }
                }
                //$ans_array[] = array('Ans_ID' => $answer->id, 'checkKeyForShowingAnswerTeach' => $checkKeyForShowingAnswerTeach,
                //                               'answerGroupName' => $answerGroupName, 'answerGroupProbability' => $answerGroupProb,
                //                               'displayGroupName' => $answer->displayGroup()['name'], 'displayGroupProbability' => $answer->displayGroup()['probability']);

                if($checkKeyForShowingAnswerTeach){
                    $Ans_KeyForShowingAnswerTeach_list[] = $ans;
                }
                else{
                    $Ans_false_KeyForShowingAnswerTeach_list[] = $ans;
                }
            }
            $Group_array = array_unique($Group_array, SORT_REGULAR);
            $displayGroup_array = array_unique($displayGroup_array, SORT_REGULAR);
            $SingleSubAns_displayGroup_array = array_unique($SingleSubAns_displayGroup_array, SORT_REGULAR);

            //info("Ans_KeyForShowingAnswerTeach_list: ".print_r($Ans_KeyForShowingAnswerTeach_list,1));
            //info("Ans_false_KeyForShowingAnswerTeach_list: ".print_r($Ans_false_KeyForShowingAnswerTeach_list,1));
            info("ans_array: ".print_r($ans_array,1));

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            info("+++++++++++++++++++++++++++++++ Select answer Groups ++++++++++++++++++++++++++++++++");
            info("AnswerGroups, LINE: ".__LINE__);
            //info("Group_array after checkKeyForShowingAnswerTeach: ".print_r($Group_array,1));

            $randomGroup = false;
            if(count($Group_array) > 0){
                $groups = [];
                foreach($Group_array as $Group_i){
                    $groups[] = array_fill(0, round(($Group_i['answerGroupProbability'] * 100)), $Group_i['answerGroupName']);
                }
                $groups = collect($groups)->flatten()->toArray();
                $randomGroup = $groups[array_rand($groups, 1)];
                info("Choosen Random Group: {$randomGroup}, LINE: ".__LINE__);
            }

            // remove from displayGroup_array all displaygroups that not in this group
            info("displayGroup_array = ".print_r($displayGroup_array,1));
            if(!empty($randomGroup)){
                foreach($displayGroup_array as $key => $displayGroup_i){
                    if(!empty($displayGroup_i['answerGroupName']) &&  $randomGroup != $displayGroup_i['answerGroupName']){
                        //if(!empty($displayGroup_i['answerGroupName']) && !in_array($randomGroup, $displayGroup_i['answerGroupName'])) {
                        unset($displayGroup_array[$key]);
                        info("Removing displayGroup: {$displayGroup_i['displayGroupName']} at AnswerGroup: {$displayGroup_i['answerGroupName']}, LINE: ".__LINE__);
                    }
                }
            }
            info("displayGroup_array after checkKeyForShowingAnswerTeach & remove answer groups = ".print_r($displayGroup_array,1));



            info("+++++++++++++++++++++++++++++++ Select Display Groups ++++++++++++++++++++++++++++++++");
            $ChoosenDisplayGroups = [];
            $DisplayGroupsArray = [];
            $SingleSubAns_ChoosenDisplayGroupsArray = [];
            $count = 1;
            if(!empty($displayGroup_array)){
                while(empty($ChoosenDisplayGroups)){
                    info("while loop #{$count}");
                    foreach($displayGroup_array as $displayGroup_i){
                        $displayGroup_Name = $displayGroup_i['displayGroupName'];
                        $randA = rand(1,100)/100;
                        $Prob = $displayGroup_i['displayGroupProbability'];
                        $displayGroup_chooseByProbability = $randA <= $Prob ? true : false;
                        if($displayGroup_chooseByProbability){
                            $ChoosenDisplayGroups[] = $displayGroup_Name;
                            if($displayGroup_i['ANSWER_TYPE'] == 'single_sub_answer') $SingleSubAns_ChoosenDisplayGroupsArray[] = $displayGroup_Name;
                        }
                        $DisplayGroupsArray[] = $displayGroup_Name;
                        info("displayGroup_name = {$displayGroup_Name}, LINE = ".__LINE__);
                        info("display group probability = {$Prob}, random number = {$randA}, displayGroup_chooseByProbability = {$displayGroup_chooseByProbability}");
                        $this->log[] = "<b>displayGroup_Name: {$displayGroup_Name}</b><br>";
                        $this->log[] = "DisplayGroup_probability: {$Prob} <br>";
                        $this->log[] = "random number: {$randA}, DisplayGroup_probability: {$Prob}, displayGroup_chooseByProbability: {$displayGroup_chooseByProbability}<br>";
                        $count = $count ++;
                    }
                }
            }
            $DisplayGroupsArray = array_unique($DisplayGroupsArray, SORT_REGULAR);
            $SingleSubAns_ChoosenDisplayGroupsArray = array_unique($SingleSubAns_ChoosenDisplayGroupsArray, SORT_REGULAR);
            info("ChoosenDisplayGroups: ".print_r($ChoosenDisplayGroups,1));
            info("DisplayGroupsArray: ".print_r($DisplayGroupsArray,1));
            info("SingleSubAns_ChoosenDisplayGroupsArray: ".print_r($SingleSubAns_ChoosenDisplayGroupsArray,1));


            info("++++++++++++++++++++++++++++++ Select Single sub-answer ++++++++++++++++++++++++++++++");
            //$ChoosenDisplayGroups
            //$SingleSubAns_displayGroup_array
            $Choosen_SingleSubAns = [];
            $NotChoosen_SingleSubAns = [];
            if(empty($SingleSubAns_ChoosenDisplayGroupsArray)){
                info("SingleSubAns_ChoosenDisplayGroupsArray is empty.");
            }else{
                foreach($SingleSubAns_ChoosenDisplayGroupsArray as $SingleSubAns_ChoosenDisplayGroupsArray_i){
                    $single_sub_answer_DG_prob_vec = [];
                    foreach($ans_array as $ans_i){
                        if($ans_i['displayGroupName'] == $SingleSubAns_ChoosenDisplayGroupsArray_i){
                            $single_sub_answer_DG_prob_vec[] = array_fill(0, round(($ans_i['single_sub_answer_prob'] * 100)), $ans_i['Ans_ID']);
                        }
                    }
                    $single_sub_answer_DG_prob_vec = collect($single_sub_answer_DG_prob_vec)->flatten()->toArray();
                    //info("single_sub_answer_DG_prob_vec = ".print_r($single_sub_answer_DG_prob_vec, 1));
                    $TheChoosenSingleSubAnsID = $single_sub_answer_DG_prob_vec[array_rand($single_sub_answer_DG_prob_vec,1)]; // choose one sub-answer
                    $notChoosen = array_diff(array_unique($single_sub_answer_DG_prob_vec), [$TheChoosenSingleSubAnsID]);
                    info("TheChoosenSingleSubAnsID = {$TheChoosenSingleSubAnsID}");
                    info("The Not Choosen SingleSubAns ID = ".print_r($notChoosen,1));
                    $Choosen_SingleSubAns[] = $TheChoosenSingleSubAnsID;
                    $NotChoosen_SingleSubAns[] = $notChoosen;
                }
                $NotChoosen_SingleSubAns = collect($NotChoosen_SingleSubAns)->flatten()->toArray();
            }
            info("Choosen_SingleSubAns: ".print_r($Choosen_SingleSubAns,1));
            info("NotChoosen_SingleSubAns: ".print_r($NotChoosen_SingleSubAns,1));



            info("++++++++++++++++++++++++++++ Checks which answer to answer ++++++++++++++++++++++++++++");
            // choose the quastion id according to the choosen answergroup

            $Answer_ID = [];
            $EmptyAnswer_ID = [];
            foreach($ans_array as $ans_i){
                //info("ans_i: ".print_r($ans_i,1));
                if($ans_i['checkKeyForShowingAnswerTeach']){
                    if(empty($randomGroup) && !in_array($ans_i['Ans_ID'],$NotChoosen_SingleSubAns)){
                        if(empty($DisplayGroupsArray) || empty($ans_i['displayGroupName'])){
                            $Answer_ID[] = $ans_i['Ans_ID'];
                        }else{
                            if(in_array($ans_i['displayGroupName'], $DisplayGroupsArray)){
                                $Answer_ID[] = $ans_i['Ans_ID'];
                            }else{
                                $EmptyAnswer_ID[] = $ans_i['Ans_ID'];
                            }
                        }
                    }else{
                        if($ans_i['answerGroupName'] == $randomGroup && !in_array($ans_i['Ans_ID'],$NotChoosen_SingleSubAns)){
                            if(empty($DisplayGroupsArray) || empty($ans_i['displayGroupName'])){
                                $Answer_ID[] = $ans_i['Ans_ID'];
                            }else{
                                if(in_array($ans_i['displayGroupName'], $DisplayGroupsArray)){
                                    $Answer_ID[] = $ans_i['Ans_ID'];
                                }else{
                                    $EmptyAnswer_ID[] = $ans_i['Ans_ID'];
                                }
                            }
                        }
                    }
                }
            }
            info("Should answer this answer ID: ".print_r($Answer_ID,1));
            info("Empty answer ID: ".print_r($EmptyAnswer_ID,1));

            //$Answer_ID
            //$EmptyAnswer_ID

            if($question['answers_type'] != 'Multiple Answers') { // Single answer case
                info("answers_type = Single Answer, LINE:").__LINE__;

                // filter answer
                //  $answers = $this->filterAnswers($answers); // old filter..
                foreach($answers as $key=>$ans) {
                    //info("ans_ID = ".print_r($ans['id'],1));
                    if(!in_array($ans['id'], $Answer_ID)){
                        info("Removed Answer: {$ans['id']}, LINE: ".__LINE__);
                        unset($answers[$key]);
                    }
                }

                //$time_ChooseSingleAnsByProb = microtime(true);
                $randomAnswerKey = $this->ChooseSingleAnsByProb($answers); // choose only one single answer
                //$time_ChooseSingleAnsByProb = microtime(true) - $time_ChooseSingleAnsByProb;
                //info("time_ChooseSingleAnsByProb = {$time_ChooseSingleAnsByProb}");
                info("randomAnswerKey = {$randomAnswerKey}");
                $this->log[] = "<br><b> randomAnswerKey: {$randomAnswerKey}</b><br>";
                //info(print_r($answers,1));
                $answer = Answer::find($answers[$randomAnswerKey]['id']);

                //$time_randomSubAnswer = microtime(true);
                $sub_answer = $this->randomSubAnswer($answer, $answered, '', true);
                //$time_randomSubAnswer = microtime(true) - $time_randomSubAnswer;
                //info("time_randomSubAnswer = {$time_randomSubAnswer}");
                $answered[] = [
                    'answer' => $answer,
                    'id' => $answer->id,
                    'display_group' => head($answer->display_groups),
                    'title' => $answer->title,
                    'sub_answer' => $sub_answer
                ];
                info("Chosen_random_answer_ID: {$answer->id}, Chosen_Sub_Answer: {$sub_answer}, Chosen_answer_title: {$answer->title}");
                $this->log[] = "<br><b> Single Answer: </b><br>";
                $this->log[] = "<br><b>Chosen_random_answer_ID:</b> {$answer->id}, <br>Chosen_Sub_Answer</b>: {$sub_answer}, <br>Chosen_answer_title:</b> {$answer->title}. LINE: ".__LINE__."<br>";
            }
            else {
                // Multiple Answers
                // run through all answers
                // randize answer
                info("answers_type = Multiple Answer");

                $latest = $questionnaire->latestAnswer();

                $indications = $questionnaire->indications($latest);

                //$current_keys = $parser->generateSystemKeys($questionnaire->keys($latest), $indications);

                $current_keys = Cache::remember("generate_system_keys", 10, function () use ($parser, $questionnaire,$latest, $indications) {
                    return $parser->generateSystemKeys($questionnaire->keys($latest), $indications);
                });


                $physicalDeleteGroup = [];
                $whilecount = 1;
                //$Answer_ID
                //$EmptyAnswer_ID
                while (!count($answered)){

                    info("while loop number = {$whilecount}");
                    $whilecount = $whilecount + 1;

                    foreach($answers_ids as $ans){
                        info("********************************************************************************************");
                        info("************************************ Start a new answer ************************************");

                        $force_sub_answer = "";
                        $answer = Answer::find($ans);
                        $this->log[]= "<div>Checking Answer {$answer->id} : {$answer->title}</div>";
                        info("Checking Answer ID {$answer->id}: {$answer->title}, LINE:".__LINE__);

                        if(!in_array($answer->id,array_merge($EmptyAnswer_ID,$Answer_ID))){
                            info("Do not answer this answer");
                        }
                        else{
                            //$time_checkKeyForShowingAnswerTeach = microtime(true);
                            $checkKeyForShowingAnswerTeach = $this->checkKeyForShowingAnswerTeach($answer);
                            info("checkKeyForShowingAnswerTeach = {$checkKeyForShowingAnswerTeach}");
                            //$time_checkKeyForShowingAnswerTeach = microtime(true) - $time_checkKeyForShowingAnswerTeach;
                            //info("time_checkKeyForShowingAnswerTeach = {$time_checkKeyForShowingAnswerTeach}");

                            $shouldAnswerThisAnswer = true;

                            if (!$checkKeyForShowingAnswerTeach){
                                // if dont_show_no , dont show answer

                                $shouldAnswerThisAnswer = false;

                                // if vas , force sub answer to be _no
                                if ( $answer->isVas()
                                    &&
                                    (
                                        !$answer->getParam('vas_dont_show_global_no')
                                        || (
                                            !$answer->vas_dont_show_no
                                            && !$answer->getParam('vas_dont_show_global_no')
                                        )
                                    )
                                ){
                                    // $this->log[]= "<div style='background-color:lightblue; color:orange'>global no*** ".$answer->getParam('vas_dont_show_global_no') ."</div>";
                                    // $this->log []= '<div style="background-color: blue;"> see answers before'.json_encode($this->group_kfsat).'</div>';
                                    $shouldAnswerThisAnswer = true;
                                    $force_sub_answer = "_no";
                                }
                            }

                            if(in_array($answer->id,$EmptyAnswer_ID)){
                                info("This is an empty answer");
                                $shouldAnswerThisAnswer = false;
                                $answered[] = [
                                    'answer' => $answer,
                                    'id' => $answer->id,
                                    'title' => $answer->title,
                                    'display_group' => head($answer->display_groups), // $answer->displayGroup()['name'],
                                    'sub_answer' => '_no'
                                ];
                            }



                            if ($shouldAnswerThisAnswer){

                                //$time_randomSubAnswer = microtime(true);
                                $sub_answer = $this->randomSubAnswer($answer , $answered, $force_sub_answer);
                                //$time_randomSubAnswer = microtime(true) - $time_randomSubAnswer;
                                //info("time_randomSubAnswer = {$time_randomSubAnswer}");
                                //info("A_sub_answer = {$sub_answer}");

                                $answered[] = [
                                    'answer' => $answer,
                                    'id' => $answer->id,
                                    'title' => $answer->title,
                                    'display_group' => head($answer->display_groups),
                                    'sub_answer' => $sub_answer
                                ];
                            }

                            $this->tempKeys[$answer->createdKeys()] = $sub_answer ? $sub_answer : 1;
                            $this->log[]= "temp keys ".print_r($this->tempKeys,1);

                            $this->countCurrentAnswers++;
                            //$answer->display_groups
                            //$this->displayGroupOfLastQuestion=head($answer->display_groups);
                            $this->log []= "<div style='text-decoration: underline;'>Added Answer {$answer->id} , sub answer = {$sub_answer}</div>";
                            $this->log []= "<div>count Current Answers: {$this->countCurrentAnswers}</div>";
                            $current_keys = $questionnaire->updateKeys($answer, $current_keys, $sub_answer);
                        }
                    }



                    // check if all answer = _no: delete $answered and choose again
                    $no_as_answer = trim(Question::find($question['id'])->getParam("no_as_answer"));
                    $no_as_answer = $no_as_answer == 1 ? True : False;
                    info("no_as_answer  {$no_as_answer}");
                    if(!$no_as_answer){
                        $no_count = 0;
                        foreach($answered as $ans_i){
                            if($ans_i['sub_answer'] == '_no'){
                                $no_count ++ ;
                            }
                        }
                        if ($no_count == count($answered)) $answered = [];
                    }
                }
            }

            // ELIMINATION

            // if teach_max_answers , start reducing answers till reaching the goal.
            //$countAnswered = count($answered);
            $answeredCollection = collect($answered);
            //info("answeredCollection = ");
            //info(print_r($answeredCollection,1));

            $groupedAnswered = $answeredCollection->groupBy(function ($item, $key) {
                return $item['display_group'] ? $item['display_group'] : $item['id'];
            })->toArray();
            // number of answers are the number of display groups + answers without group
            $countAnswered = sizeof($groupedAnswered);
            $this->log[]= "<div>Q_id: {$question['id']} : groupedAnswered : {$countAnswered} </div>";

            if ($countAnswered > $question['teach_max_answers'] && $question['teach_max_answers'] > 0) {
                $this->log[]= "<div>deleting answers to reach {$question['teach_max_answers']} answers (right now ".count($answered)." answers) </div>";
                $this->log[]= "<div> First, delete answers with subanswer = _no</div>";


                // delete answer with sub-answer = _no
                foreach($answered as $indx => $ans_i){
                    if ($ans_i['sub_answer'] == '_no'){
                        info("Delete Answer ID = {$ans_i['id']}");
                        unset($answered[$indx]);
                        $countAnswered -- ;
                    }
                }


                //$time_teach_max_answers = microtime(true);
                $tries = 0;
                while($countAnswered > $question['teach_max_answers'] && $tries<50){
                    $tries ++;
                    $this->log[]= "<div>Try {$tries}</div>";

                    $randomKey = array_rand($answered);

                    $randomAnswered = $answered[$randomKey];

                    // do not remove answers that were selected by keyForShowAnswerTeach
                    if (in_array( $answered[$randomKey]['id'] , $this->showAnswers ) ){
                        $this->log[]= "<div><b>should show this answer </b> - {$answered[$randomKey]['title']} {$answered[$randomKey]['id']} </div>";
                        continue;
                    }

                    // check if does not belong to group
                    if (trim($randomAnswered['display_group']) == ""){

                        $this->log[]= "<div><b>deleting answer (no group)</b> - {$answered[$randomKey]['title']} {$answered[$randomKey]['id']} | Sub Answer: {$answered[$randomKey]['sub_answer']} </div>";

                        if ((string)$answered[ $randomKey ]['sub_answer'] != "_no"){

                            info("aaaaa_no");
                            info(" Delete answer ID : {$answered[$randomKey]['id']}, LINE =".__LINE__);

                            // if no - remove answer
                            if ($answered[ $randomKey ]['answer']->isVas()
                                && !$answered[ $randomKey ]['answer']->vas_dont_show_no
                                //&& !$answered[ $randomKey ]['answer']->getParam('vas_dont_show_global_no')
                            ) {
                                $answered[ $randomKey ]['sub_answer'] = "_no";
                                $this->log[]= "<div><b>deleted - set to _NO</b> </div>";

                            } else {
                                unset( $answered[ $randomKey ] );
                                $this->log[]= "<div><b>deleted - physically deleted.</b> </div>";
                            }

                            $countAnswered -- ;
                            continue;
                        }
                    }
                    else {
                        // if belongs to group - check group size
                        $display_group = $randomAnswered['display_group'];
                        // check if we can reduce all group and dont affect limit.
                        $this->log[]= "<div>checking to delete group <b>{$display_group}</b> members</div>";

                        $answeredCollection = collect($answered);
                        $groupedAnswered = $answeredCollection->groupBy(function ($item, $key) {
                            return $item['display_group'];
                        })->toArray();

                        if (is_array( $groupedAnswered[ $display_group ] ) ){
                            // if sizeof(answered) - groupSize > teach max answers , lets remove group
                            //if ( $countAnswered - sizeof($groupedAnswered[ $display_group ]) >= $question['teach_max_answers'] ){
                            $this->log[]= "<div>deleting group <b>{$display_group}</b> members</div>";

                            foreach( $groupedAnswered[ $display_group ] as $groupAnswer ){

                                // find answer key to delete
                                foreach ($answered as $answeredKey => $answeredItem) {
                                    if ($answeredItem['id'] === $groupAnswer['id']) {
                                        $keyToDelete = $answeredKey;
                                        break;
                                    }
                                }


                                $this->log[]= "<div><b>deleting answer</b> - {$answered[$keyToDelete]['title']} (id {$answered[$keyToDelete]['id']}) </div>";

                                // if group global no does not exist for this group, create it.
                                if ( !isset($this->group_global_no[ $display_group ]) )
                                    $this->group_global_no[ $display_group ] = $answered[ $keyToDelete ]['answer']->getParam('vas_dont_show_global_no');

                                if ($answered[ $keyToDelete ]['answer']->isVas()
                                    &&
                                    (
                                        !$this->group_global_no[ $display_group ]
                                        || (
                                            !$answered[ $keyToDelete ]['answer']->vas_dont_show_no
                                            && $this->group_global_no[ $display_group ]
                                        )
                                    )

                                    && !isset( $physicalDeleteGroup[$display_group] )

                                ) {
                                    $answered[ $keyToDelete ]['sub_answer'] = "_no";

                                    $this->log[]= "<div><b>deleted - set to _NO</b> </div>";

                                } else {
                                    unset( $answered[ $keyToDelete ] );
                                    $this->log[]= "<div><b>deleted - physically deleted.</b> </div>";
                                    $physicalDeleteGroup[$display_group] = true;
                                    // if we delelte answer from group, we should delete all other answers of the same group:


                                }

                            } // end foreach
                            $countAnswered -- ;

                            //}
                        }

                    }

                }
                //$time_teach_max_answers = microtime(true) - $time_teach_max_answers;
            }


            $answersPayload =
                ['question' => $question["id"],
                    'answers' => $answered
                ];

            // $this->log []= "<div style='color:brown'><b> @@@@@@answersPayload@@@@@ : ".json_encode($answersPayload)."</b>></div>";
            // show answered
            // $this->displayQuestionAndAnswers($question,$answered);
            // call getNextQuestion
            $this->logTime(" before loading next question ");

            $response = $this->getNextQuestion($test_id, $answersPayload);

            $this->logTime(" after loading next question ");

            // echo "<br> getting response from next question:<br>";
            // print_r($response);
            if (isset($response['question']) && isset($response['answers']) ){
                $question = $response['question'];
                $answers = $response['answers'];

                // if answers have display groups<><><><><><>!!!
                //-------------------------------------------

                $this->log[]= "<hr><h3>{$question['id']} - {$question['title_doctor']} - Loop {$loop}</h3>";
                $this->log []= "<div style='color:blue'>Type: ".$question['answers_type']."</div>";
                $this->log []= "<div style='color:brown'> Required Key: ".$question['tag']."</div>";
                $this->log []= "<div style='color:purple'> Auto? : ".$question['is_auto']."</div>";


            } else{
                $done = true;
            }

            $teachResponse[$question['title_doctor']]=$answers;
        } // main looop
        $queries = DB::getQueryLog();
        foreach ($queries as $query){
            // if ($query['time'] > 100)
            $this->dblog[] = $query;
        }

        // get last indications

        $indicationsResult = DB::table('tests_answers')
            ->where('test_id', $test_id)
            ->select('indications')
            ->orderByDesc('id')
            ->first();

        // save the indication json into tests table
        $questionnaire = Questionnaire::findOrFail($test_id);
        $questionnaire->label_json = $indicationsResult->indications;
        $questionnaire->save();


        // dd($indicationsResult);
        $indications = array_keys(json_decode($indicationsResult->indications , true));


        //SAVE HTML LOG
        try {
            $getBaseUrl= rtrim(app()->basePath('public' ), '/');
            $fileName= $getBaseUrl."/teach_logs/{$questionnaire->id}.html";
            File::put($fileName, $this->log );
            $this->log[]="<hr> SAVED{$questionnaire->id}.html";
        } catch (\Exception $exception) {
            $this->log[]="<hr> couldnt save file {$questionnaire->id}.html";
        }

        return response()->json([
           // 'count_tags' => $this->showTeach($user->id),
         //   'log' => $this->log , // $time_elapsed_secs,,
         //   'dblog' => $this->dblog , // $time_elapsed_secs,,
            'test_id' => $test_id,
            'indications' => $indications,
            'decisionCodes' => $decisionCodes,
        ], 200);
    }
    public function addAnswers($request, Questionnaire $questionnaire )
    {
            $parser = new ExpressionParser($questionnaire->procedure,  $questionnaire->combinationProceduresNames());
            $latest = $questionnaire->latestAnswer();

             $question = Question::findOrFail($request->input('question'));
                $questionnaire->addAnswers(
                $request->input('answers'),
                $question,
                $questionnaire->keys($latest),
                $questionnaire->indications($latest),
                $parser
            );

    }
    public function teachInitialResponse( )
    {

    }
}
?>
