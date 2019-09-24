<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\NoRelevantAnswersException;
use App\Exceptions\QuestionnaireShouldEndException;
use App\Exceptions\NoQuestionInProcedure;
use App\ExpressionParser;
use App\Question;
use App\Answer;
use App\Questionnaire;
use Illuminate\Support\Facades\File;
use App\Combination;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Exceptions\InvalidKeysException;
use App\Exceptions\NoMoreQuestionsException;
use Illuminate\Support\Facades\Cache;

use DB;
use App;
use Auth;

/** @noinspection PhpClassNamingConventionInspection */


/**
 * Class QuestionnaireQuestionsController
 * @package App\Http\Controllers
 */
class QuestionnaireQuestionsController extends ApiController
{

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function badToken(Request $request)
    {
        return response()->json('badToken');
    }

    /**
     * @param Request $request
     * @param $questionnaire_id
     * @return JsonResponse
     */
    public function create(Request $request, $questionnaire_id)
    {


        /** @var Questionnaire $questionnaire */
        /** @var Question $question */
        //$Time_1 = microtime(true);
        $questionnaire = Questionnaire::findOrFail($questionnaire_id);
        //$Time_1 = microtime(true) - $Time_1;
        //info("Time_1 = {$Time_1}");

        //$Time_1 = microtime(true);
        //$combinationProceduresNames  =  ($request->teach) ? null :  $questionnaire->combinationProceduresNames();
        //$parser = new ExpressionParser($questionnaire->procedure, $questionnaire->combinationProceduresNames());
        $parser = new ExpressionParser($questionnaire->procedure, $questionnaire->combinationProceduresNames());
        //$Time_1 = microtime(true) - $Time_1;
        //info("Time_2 = {$Time_1}");

        //$Time_1 = microtime(true);
        $latest = $questionnaire->latestAnswer();
        //$Time_1 = microtime(true) - $Time_1;
        //info("Time_3 = {$Time_1}");

        //$Time_1 = microtime(true);
        // info(print_r($latest,1));
        if($latest && $request->input('answers') && $request->input('question'))
           $this->checkDuplicateAnswerError($latest->answer_id,$request->input('answers'));

        try {
            /** @var Question $question */
            $question = Question::findOrFail($request->input('question'));
        } catch (ModelNotFoundException $exception) {

            if (!$latest) {

                try {
                    return $this->initialResponse($questionnaire);
                }
                catch(NoQuestionInProcedure $exception) {
                    return   response()->json(['error' => $exception->getMessage()],  $exception->getStatusCode() );
                }
            }

            $question = Question::findOrFail($latest->question_id);

        }
        //$Time_1 = microtime(true) - $Time_1;
        //info("Time_4 = {$Time_1}");

        //*Handle Double Question Answer Bug
        //       if ($request->input('answers') && $request->input('question'))
        //            $questionnaire->doubleQuestionsError($question,$questionnaire->id);

        $Time_5 = microtime(true);
        try {
            //$Time_11 = microtime(true);

               // info('still in answers');
                $questionnaire->addAnswers(
                $request->input('answers'),
                $question,
                $questionnaire->keys($latest),
                $questionnaire->indications($latest),
                $parser
            );
            //$Time_11 = microtime(true) - $Time_11;
            //info("Time_5.1 = {$Time_11}");

        } catch (QuestionnaireShouldEndException $exception) {
          if(Auth::user()->isHartford()  && !$questionnaire->isDummyPatientId()) MailController::endTestMail($questionnaire_id);
            return $this->responseNotFound($exception->getMessage());
        } catch (InvalidKeysException $exception) {

            return $this->responseNotAcceptable($exception->getMessage(), $exception->getExpression(), $exception->getOriginalExpression(), $exception->getSource());
        }
        $Time_5 = microtime(true) - $Time_5;
        info("Time_5 = {$Time_5}");

        //$Time_1 = microtime(true);
        $answered = $questionnaire->answers()->with('question')->get();

        // beginning continue test

        //check if the last question doesn't have answers  attached to it:
        //***if it finds it we know user pressed continue button!
        if(!isset($answered->last()->pivot )  ) {
           $unfinishedTest =  Questionnaire::where("id",$questionnaire_id)->whereNull('is_done_reason');
                 if ($unfinishedTest->get()->count()>0) {
                    if(DB::table('tests_answers')->where('test_id', $questionnaire_id)->latest('id')->count()==0){
                     return $this->initialResponse($questionnaire) ;
                    }

                 }
       }
       //$Time_1 = microtime(true) - $Time_1;
       //info("Time_6 = {$Time_1}");


        //$Time_1 = microtime(true);

        $latest = $answered->last()->pivot;

        $indications = $questionnaire->indications($latest);
         //return ['latest' => json_decode($latest['indications'],true) ,    'indications ' => $indications ];
        $keys = $parser->generateSystemKeys($questionnaire->keys($latest), $indications);

        if ( $questionnaire->combination_instance_id && $questionnaire->someIsDone()  )
        {

           // $keys = toObject( $questionnaire->voidKeys($questionnaire->proc_id) ,'_void' )->merge($keys);

            $keys =  collect($questionnaire->getCombinationKeys())->merge($keys) ;
        }
        //$Time_1 = microtime(true) - $Time_1;
        //info("Time_7 = {$Time_1}");

        //

        //$Time_1 = microtime(true);
        try {
            //$Time_11 = microtime(true);
            $possible = $questionnaire->nextPossibleQuestions($question, $indications);
            //$Time_11 = microtime(true) - $Time_11;
            //info("Time_8.1 = {$Time_11}");

            //$Time_11 = microtime(true);
            $question = $questionnaire->nextQuestion($possible, $keys, $parser)->load('answers.params');
            //$Time_11 = microtime(true) - $Time_11;
            //info("Time_8.2 = {$Time_11}");

            //$Time_11 = microtime(true);
            $answers = $questionnaire->filterAnswersByKeys($question->answers, $keys, $parser);
            //$Time_11 = microtime(true) - $Time_11;
            //info("Time_8.3 = {$Time_11}");

            //$Time_11 = microtime(true);
            if ($question->is_auto == 1) {
                return $questionnaire->resolveAutoQuestion($question, $answers, $keys, $indications, $parser);
            }
            //$Time_11 = microtime(true) - $Time_11;
            //info("Time_8.4 = {$Time_11}");

            //$possible = $questionnaire->nextPossibleQuestions($question, $indications);

            //$question = $questionnaire->nextQuestion($possible, $keys, $parser)->load('answers.params');

            //   $questionAnswers = $question->answers->map(function($a) {return ['vas'=>$a->vas_max_display ,  'parsed' => $a->parseAnswerVas($a->vas_max_display) ] ;});

            //$answers = $questionnaire->filterAnswersByKeys($question->answers, $keys, $parser);

            //if ($question->is_auto == 1) {

             //   return $questionnaire->resolveAutoQuestion($question, $answers, $keys, $indications, $parser);
           // }
        } catch (InvalidKeysException $exception) {

            return $this->responseNotAcceptable($exception->getMessage(), $exception->getExpression(), $exception->getOriginalExpression(), $exception->getSource());
        } catch (NoMoreQuestionsException $exception) {

            if(Auth::user()->isHartford()  && !$questionnaire->isDummyPatientId()) MailController::endTestMail($questionnaire_id);
            return $this->responseNotFound($exception->getMessage());
        } catch (QuestionnaireShouldEndException $exception) {

            if(Auth::user()->isHartford()  && !$questionnaire->isDummyPatientId()) MailController::endTestMail($questionnaire_id);
            return $this->responseNotFound($exception->getMessage());
        } catch (NoRelevantAnswersException $exception) {

            if(Auth::user()->isHartford()  && !$questionnaire->isDummyPatientId())  MailController::endTestMail($questionnaire_id);
            return $this->responseNotFound($exception->getMessage());
        }
        //$Time_1 = microtime(true) - $Time_1;
        //info("Time_8 = {$Time_1}");
        //$combinationKeys  = $questionnaire->getCombinationKeys();

        $allKeys  = $parser->allCurrentKeys($questionnaire->keys($latest));

        $Time_9 = microtime(true);
        //$get_display_group = $questionnaire->getDisplayGroups($questionnaire->answered(),$questionnaire->answered() );   # ???
        //$combineReportAnswers = $questionnaire->combineReportAnswers($get_display_group,$questionnaire->answered());
        //$cl_style = $questionnaire->mapApi($combineReportAnswers);

        //$Time_11 = microtime(true);
        //number_format($questionnaire->scenarios($possible));
        //$Time_11 = microtime(true) - $Time_11;
        //info("Time_9.1 = {$Time_11}");

        $cache_scenarios = $questionnaire->scenarios($possible);
        //$cache_scenarios = Cache::remember("", 10, function () use ($possible) {
        //    return $questionnaire->scenarios($possible);
        //});

        $get_display_group = $questionnaire->getDisplayGroups($questionnaire->answered());
        $combineReportAnswers = $questionnaire->combineReportAnswers($get_display_group,$questionnaire->answered());
        $cl_style = $questionnaire->mapApi($combineReportAnswers);
        $return = [
            'create-after-changes' => true,
            //'test_ANswers' =>$testAnswers,
            //        'initialCombinationKeys' => $initialCombinationKeys,
            //'combinationKeys' => $combinationKeys  ,
            'question' => $question,
            //      'c_i_i' =>  $questionnaire->combinationInstance->answered(),
            // '234' => ( $questionnaire->combination_instance_id && $questionnaire->someIsDone()  ),
            //'someIsDone' =>   $questionnaire->someIsDone()  ,
            'answered' => $questionnaire->answered(),
            //'map_answered' =>  $get_display_group,
            'cl_style' => $cl_style,
            'answers' => $question->getAnswersWithParams($answers) ,//$answers, // $question->pluckAnsParams(),// $answers,
            //'$questionAnswers'=>$questionAnswers,
            'keys' => $keys->reverse(),
            'allKeys' => $allKeys,
            'indications' => $indications,
            'possible' => $possible->count(),
            'scenarios' => number_format($cache_scenarios),
        ];
        $Time_9 = microtime(true) - $Time_9;
        info("Time_9 = {$Time_9}");

        return response()->json($return, 200);
    }

    public function destroy(Request $request, $questionnaire_id)
    {
        /** @var Questionnaire $questionnaire */
        $getBaseUrl= rtrim(app()->basePath('public' ), '/');
        $fileName= $getBaseUrl."/reports/report{$questionnaire_id}.txt";
        File::delete($fileName);

        $questionnaire = Questionnaire::where('id', $questionnaire_id)->with(['answers'])->first();

        $answered = $questionnaire->answers()->get();

        if ($answered->isEmpty()) {
            $question = $questionnaire->firstQuestion();
            $answers = $question->answersWithParams()
                ->where('is_deleted', '=', 0)
                ->where('deleted_at', '=', null)
                ->get();
            return response()->json([
                'staging' =>true,
                "firstQuestion" => true,
                'question' => $question,
                'answers' =>$question->getAnswersWithParams($answers,$question) ,// $answers,

            ], 200);
        }

        $latest = $answered->last()->pivot;

        return $questionnaire->deleteLatestQuestion($latest->answer_id, $latest->question_id,$latest);
    }

    /**
     * @param $questionnaire
     * @return JsonResponse
//     */
//    public function getCombinationKeys($questionnaire){
//        //get other done procedures fromn same conmbination ,
//        //collect all keys., and return them
//        $keys = [];
//         foreach($questionnaire->combinationInstance->questionnaires()->where('is_done',1)->get() as $q) {
//
//             // take latest keys
//             $answered = $q->answered();
//             if (!empty($answered->last())) {
//                 $latest = $answered->last()->pivot;
//                 $k = $q->keys($latest)->toArray();
//                 $keys = array_merge($keys, $k);
//             }
//             return $keys;
//         }
//         return $keys;
//    }

    /**
     * @param Questionnaire $questionnaire

     */
    public function initialResponse(Questionnaire $questionnaire)
    {
        //
        /** @var Questionnaire $questionnaire */

        $question = $questionnaire->firstQuestion();




       if(!$question)   // abort(403, 'notsss');
        throw new NoQuestionInProcedure( "No Question. please check procedure {$questionnaire->proc_id}.", 400  );

           return response()->json([
               '$questionnaire' =>$questionnaire,
               'question' => $question,
               'combinationKeys' => $questionnaire->getCombinationKeys(),
               'staging' => true,
               'firstQuestion' => true,
             //  'count_tags' => Auth::user()->isLabeler() ?  $this->showTeachTags($questionnaire->user_id) : '',
               'answers' => optional($question)->answersWithParams()->get(),

           ], 200);
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $latestAnswerId
     * @param $answersToCreate
     */
    public function checkDuplicateAnswerError($latestAnswerId, $answersToCreate)
    {
    foreach ($answersToCreate as $answerToCreate)
        {

         if ($answerToCreate['id'] == $latestAnswerId ) { abort(409, 'double_answer'); die;}
        }
    }

    /**
     * @param Request $answers
     * @return Request
     */
    public function parseTempKeys(Request $answers)
    {
        return   $answers;
    }
}
