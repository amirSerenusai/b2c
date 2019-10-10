<?php

namespace App\Http\Controllers;
//use Request;
//use Response;
use App\Question;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\CombinationInstance;
use App\Questionnaire;
use Auth;
//use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Answer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use App\Exceptions\ClientMismatch;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Method;

/** @noinspection PhpClassNamingConventionInspection */

/**
 * Class QuestionnaireReportsController
 * @package App\Http\Controllers
 */
class QuestionnaireReportsController extends Controller
{
    protected $ml = '';
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->isAdmin= optional(Auth::user())->hasRole('admin')  ;
//        $this->isAdminPivot =  Auth::user()->roles()->get()[0]->name == "admin" ? true : false;
    }
    protected $isAdmin,$ml_force_score_search,$isAdminPivot; //

    /**
     * @param Request $request
     * @param $identifier
     * @return array
     */
    public function show(Request $request, $identifier )

    {

        $this->ml =  !$request->has('v2') ? false :  $request->v2 == "true" ?: false;
        try {
            /** @noinspection PhpVariableNamingConventionInspection */

            $combinationInstance = CombinationInstance::findOrFail($identifier);

            return $combinationInstance
                ->questionnaires()
                ->with('procedure.category')
                //->with('combinationInstance.combination:id,title')
                ->get()
                ->filter(function ($questionnaire) {
                    return $questionnaire->is_done;
                })
                ->reduce(/**
                 * @param $carry
                 * @param $questionnaire
                 * @return mixed
                 */
                    function ($carry, $questionnaire)   {
                        /** @noinspection PhpUndefinedMethodInspection */
                        $carry->push($this->getResultsFromQuestionnaire($questionnaire,null  ) );

                        return $carry;

                    }, collect());
        } catch (ModelNotFoundException $e) {
            /** @var Questionnaire $questionnaire */
            $questionnaire = Questionnaire::find($identifier)->load('procedure.category');
            $clCode = $request->input('clCode');

            return [$this->getResultsFromQuestionnaire($questionnaire,$clCode )];
        }
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $latest
     */
    protected function enterIndicationsToQuestionnaire($latest)
    {
        $latest=collect($latest);
        $current_test = new Questionnaire;
        $label_json = ['label_json' => $latest['indications'] ];
        $current_test->where('id' ,$latest['test_id'] )->update($label_json);


    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $questionnaire
     * @param null $clCode
     * @return array
     */
    protected function getResultsFromQuestionnaire(Questionnaire $questionnaire, $clCode=null)
    {
        //dd([$this->ml, __LINE__]);
//        $ml_report = $this->ml ? $this->mlReports($questionnaire->id) :'';
        $invertedVerdict='';
        $answered = $questionnaire->answered();
        $latest = $answered->last()->pivot;


//        $this->enterIndicationsToQuestionnaire($latest); // 24.7.18 // אני מכניס פה את האינדקציות שבאות משאלון רגיל כי עד עכשיו לא נכנס

        $getScoreBefore = $this->getScoreBefore($answered);
        $indications = collect(json_decode($latest->indications, true));
        foreach($indications as $ind_name=>&$ind){
            $ind['prettyName'] = $ind_name;
            $ind['before_force_score'] =  $getScoreBefore[$ind_name] ;
//           if (optional($questionnaire->user->client ) ->getParam('dont_show_final_result')  )
//               $ind['weight']='';
            $ans = Answer::where('indication' ,"{$ind_name}*")->first();
            if($ans && !empty($ans->title))
                $ind['prettyName'] = $ans->title;
            $indications[$ind_name] = $ind;

        }


        $allAnswered=    $answered =  $this->isAdmin  ? $answered : $questionnaire->normalizeWeight($answered);
        $keys = collect(json_decode($latest->current_keys, true));
        if ($questionnaire->invertedVerdict($indications)) {
            $invertedVerdict = "seemingly the procedure is justified but another indication necessitate further considuration";
            //  $max_weight = 55;
        }
        $max_weight =   optional($indications)->max('weight');



//


        /** @noinspection PhpVariableNamingConventionInspection */
        $answeredWithRegularScore=$answered->map(function ($item) { return ['id'=> $item->id,
            'is_positive' => $item->isPositive,
            'weight' => $item->weight, 'question_id' => $item->question_id ];}) ;
        if(!$clCode){
            $answered =  $this->isAdmin  ? $answered : $questionnaire->normalizeWeight($answered);
        }
        $patient_id=false;
        try {
            $patient_id = CombinationInstance::find($questionnaire->combination_instance_id )->patient_id;
        } /** @noinspection PhpFullyQualifiedNameUsageInspection */ catch(\Exception $exception){};
//        ->reject(function ($answer) {
//                return $answer->question->is_auto == 1; // עכשיו כולם יוכלו לראות את התשובות האוטומטיות
//            });

//        $displayGroupedAnswered=$allAnswered->groupBy('question.title_doctor')->map( function($item){
//           return  $item->groupBy('display_groups');
//        });

        $combined= $questionnaire->combineReportAnswers($questionnaire->getDisplayGroups($allAnswered),$allAnswered);

        $params = [ 'invertedVerdict' =>  $invertedVerdict,
            'short_desc' =>  $questionnaire->procedure->short_desc,
            'dont_show_final_result' => STR::contains(  strtolower( $questionnaire->procedure->short_desc ) , "do not show final result")
        ];
        /** @noinspection PhpUndefinedMethodInspection */


        if ($this->validateClientMatch($questionnaire ) )
        {
            $request_params = $questionnaire->combination_instance_id != 0 ?  [ 'combination_instance' => $questionnaire->combinationInstance ] : [ 'test' => $questionnaire] ;
            MailController::error(['message'=> 'Care ID mismatch',
                'request_params' => $request_params

            ]);
            throw new ClientMismatch( "Client ID mismatch", 400);
        }

        $clStyle = $questionnaire->mapApi($combined);
        $answered = $answered ->groupBy('question.title_doctor')->map( function(Collection $item){ return $item->sortByDesc('priority')->values();});
        $json  =[
            'answeredWithRegularScore'=> $answeredWithRegularScore,
            'patient_id' => $patient_id,
            'test' => $questionnaire,
            'procedure' => $questionnaire->procedure,
            'combinedAnswers'=> $combined, //Todo DONT TOUCH!
//            'answered' => $answered ->groupBy('question.title_doctor')->map( function(Collection $item){ return $item->sortByDesc('priority')->values();}),//Todo DONT TOUCH2!
            'answered' => $answered,
            'clStyle' =>  $clStyle ,
            'forceScoreSearch' => $questionnaire->forceScoreSearch($indications),
            'combined_indication' => $questionnaire->isCombinedIndication($indications),
            'params' => $params,
            'indications' => $indications,
            'keys' => $keys,
            'score' => $questionnaire->scoreForIndication(round($max_weight)),
            'max_weight' => $max_weight,
            'done_reason' => $questionnaire->is_done_reason,
        ];

        //Preview ML REPORT --->

        $ml ='';
        if($this->ml)  $ml =  $this->getMlDecision($questionnaire , $indications);
        if($ml AND !array_key_exists('error' ,$ml) AND  !array_key_exists('erorr' ,$ml)) {

            $json['ml'] = $ml;
            $json['ml_force_score_search'] = $this->ml_force_score_search;
            $json['mlStyle'] =  collect($clStyle)->groupBy('question_id');
            $json['ml_questions'] = $this->setMlQuestions($ml , $json);

        }

        //Preview END ML REPORT --->

//        $getBaseUrl= rtrim(app()->basePath('public' ), '/');
//        $fileName= $getBaseUrl."/reports/report{$questionnaire->id}.txt";
//        if (!File::exists($fileName)) File::put($fileName, json_encode($json) );
//        else $json =json_decode(file_get_contents($fileName) );
//        if(!$this->isAdmin)
//            try {
//                $json->answeredWithRegularScore='';
//            }
//            catch(\Exception $exception){
//                $json['answeredWithRegularScore']='';
//            }

        return  $json ;
    }/** @noinspection PhpMethodNamingConventionInspection */


    protected  function validateClientMatch(Questionnaire $questionnaire)
    {
        $user = Auth::user();
        if ($user->id == $questionnaire->user_id ) return false;
        $client_id =  optional($questionnaire->combinationInstance)->client_id;
        if ($this->isAdmin) return false;
        if ($this->isAdminPivot) return false;


        return $user->client_id == $client_id ;
    }
    /**
     * @param $questionnaire
     * @return array|mixed
     */
    public function  getMlDecision(Questionnaire $questionnaire , $indications)
    {
        $address =  App()->environment() == "development" ? "18.221.247.54:5000" : "172.31.30.252:5000" ;
        try {
            $client = new Client();
            $res = $client->post($address , [
                RequestOptions::JSON => ['test_id' => $questionnaire->id , 'proc_id' => $questionnaire->proc_id ]   //78052
            ])->getBody()->getContents() ;
            $ml =   json_decode($res ,true) ;
            try { if( $ml['status'] == 500 ) return false; } catch (\Exception $e) {}
            $this->ml_force_score_search = $questionnaire->forceScoreSearch($ml);
            return $ml;
        } catch (\Exception $exception) {
            info($exception);
            return false;
        }

    }

    /**
     * @param $answered
     * @return mixed
     */
    public function getScoreBefore( $answered )
    {

        try {
            $json=$answered->filter(function ($q) { return !$q->question_auto;} )->last();
            return collect(json_decode( json_decode($json,true)['pivot']['indications'],true))->map(function ($val , $key){ return  $val['weight'] ; } );
        } catch (\Exception $exception) {

            return ;
        }
    }
    public function saveReportFile($json,$questionnaire) {

        $getBaseUrl= rtrim(app()->basePath('public' ), '/');
        $fileName= $getBaseUrl."/reports/report{$questionnaire->id}.txt";
        if (!File::exists($fileName)) File::put($fileName, json_encode($json) );
        else $json =json_decode(file_get_contents($fileName) );
        if(!$this->isAdmin)
            try {
                $json->answeredWithRegularScore='';
            }
            catch(\Exception $exception){
                $json['answeredWithRegularScore'] = '';
            }

    }
    public function setMlQuestions($ml, $json)
    {
        return  collect($ml)->map(function($q) use($json) {
            return collect($q['Explanation_Bin'])->groupBy('question_id')->map(function ($q, $q_id) use($json){
                return  collect($q)->merge($json['mlStyle'][$q_id])->collapse();});
        }  );

    }


}
