<?php

namespace App\Http\Controllers;
use App\Exceptions\CareCodeDoesntExist;
use function dd;
use App\Combination;
use App\CombinationInstance;
use App\Procedure;
use App\Questionnaire;
use Auth;
use  App\Decision;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use DB;
class QuestionnairesController extends Controller
{

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Questionnaire::with('answers')->with('procedures')->first();
    }

    public function getNotDone()
    {

        $user = Auth::user();


        //     return Questionnaire:: with('procedure') ->where('is_done',0)->where('user_id', $user->id) ->take(10)->get();

        return Questionnaire::where('is_done',0)
            ->where('user_id', $user->id)
            ->take(15)->orderBy('id','desc')->with('procedure')->with(array('combinationInstance'=>function($query){
                $query->select('id','patient_id','combination_id');
            }))
            ->get();
    }

    public function show($id)
    {
        return Questionnaire::find($id);
    }

    public function store(Request $request)
    {

        $user_id = 0;
//        if (isset($request->user_id)) $user_id = $request->user_id;
//        $user_id = isset($request->user_id['id']) ? $request->user_id['id'] : $user_id;
        $user= Auth::user();
        try {
            $user_id=$user->id;
        }
        catch(\Exception $exception){
        }
        $new = Questionnaire::create([

            // 'proc_id' => $request->procedure ,
            'decision_code' => 0,
            'physician_name' => 'amir',
            'is_done' => 0,
            'combination_instance_id'=>0,
            'proc_id' => $request->procedure,
            'user_id' => $user_id,
            'email' => $request->email,
        ]);

        return Questionnaire::whereId($new->id)->with('combinationInstance')->with('procedure')->first();
    }

    public function update(Request $request, $test_id)
    {
        $test = Questionnaire::find($test_id);
        $test->update([
            'physician_name' => $request->name,
            'manual_decision' => json_encode($request->decision),
            'notes' => $request->note,
        ]);
        $test->save();
        return $test;
    }
}
