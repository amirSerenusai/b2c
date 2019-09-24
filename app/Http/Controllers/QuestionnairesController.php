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
//        if ($request->has('combination')) {
//
//            $client_id = $user->client_id;
//            // info('CLIENTID:'.$client_id );
//            $queries = DB::getQueryLog();
//            $combination = Combination::where(function($q) use ($request) {
//                $q->where('code',$request->input('combination'))
//                    ->orWhere('id',$request->input('combination'));
//            })->where('client_id',$client_id)
//                ->first();
//
//            if (!$combination || empty($combination->client_id)){
//
//                try {
//                    throw new CareCodeDoesntExist( "Care code does not exist".$combination , 400  );
//                }
//                catch(CareCodeDoesntExist $exception) {
//                    MailController::error(['message'=> 'Care code does not exist', 'request_params' => $request->all() ]);
//                    return   response()->json(['error' => $exception->getMessage()],  $exception->getStatusCode() );
//                }
//                //return ["Care code does not exist.", $combination];
//            }
//
//            $patient_id = !empty($request->input('patient_id')) ? $request->input('patient_id') : "no patient id";
//
//            $user_role=$user->role;
//            if ($client_id != $combination->client_id &&  $user_role!='admin'){
//
//                return "You are not authorized to view combination (client: {$client_id} and correct one is  {$combination->client_id} user role is :  {$user_role} ";
//            }
//
//            $combination_instance = CombinationInstance::create([
//                'combination_id' => $combination->id,
//                'patient_id' => $patient_id,
//                'client_id' => Auth::user()->client_id
//            ]);
//
//            collect($combination->procedures)->map(function ($procedure_title) {
//                return Procedure::where('title', $procedure_title)
//                    ->with('category')
//                    ->where('is_deleted', 0)
//                    ->orderByDesc('version')
//                    ->first();
//            })->each(function ($procedure) use ($request, $combination_instance, $user_id) {
//                if(!empty($procedure->id)) {
//                    Questionnaire::create([
//                        'proc_id' => $procedure->id,
//                        'user_id' => $user_id,
//                        'email' => $request->email,
//                        'combination_instance_id' => $combination_instance->id
//                    ]);
//                }
//            });
//
//            $test = $combination_instance->questionnaires()->with('procedure')->first();
//            //$test = $combination_instance->questionnaires()->latest()->get()->first();
//            $test->combination = $combination ?? null;
//            return $test;
//        }
//

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
