<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class RedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function runPdf($test_id)
    {

        //$token = session('api-token');
        $token = $this->getToken();
        if (App::isLocal()) {
            return redirect("http://medecide-api.localhost/pdf/{$test_id}?token={$token}");
        }
        if (RedirectController::isSerenusAI())
            return  redirect("https://corebeta.serenusai.com/reports/{$test_id}?token={$token}");
        return redirect("https://core.medecide.net/pdf/{$test_id}?token={$token}");

        //return redirect("http://mybeta.medecide.net/reports/{$test_id}?token={$token}");
    }

    public function runTest($procedure_id)
    {

        // $token = session('api-token');
        try {
            $id = auth()->user()->id;
        }catch(\Throwable $e){
            $id = null;
        }
        $token = $this->getToken();
        //

        $domain = request()->query('domain');

        if($domain) return redirect("https://{$domain}.serenusai.com/run-test/{$procedure_id}?token={$token}&chat=true");
        if (App::isLocal()) {

            return redirect("http://localhost:8080/run-test/{$procedure_id}?token={$token}&chat=true");
        }



        if (RedirectController::isSerenusAI())

            return redirect("https://client.serenusai.com/run-test/{$procedure_id}?token={$token}");
        return redirect("http://client.medecide.net/run-test/{$procedure_id}?token={$token}");
    }
    public function runProceduresPage()
    {
        $token = $this->getToken();

        if (App::isLocal()) {

            return redirect("http://localhost:8080/run-procedures?token={$token}");

        }
        if (RedirectController::isSerenusAI())
        {

            if ( Auth::user()->isAdmin() )  return redirect("https://mybeta.serenusai.com/run-procedures?token={$token}");
            return redirect("https://client.serenusai.com/run-procedures?token={$token}");
        }
        //  return redirect("http://client.medecide.net/run-procedures?token={$token}");
    }

    public function runCombination(Request $request, $combination_id)
    {


        $token = $this->getToken();
////        if ( Auth::user()->isAdmin() ) {
//            $token = $this->getToken($request->query()['user_id']);
//        }
        if (App::isLocal()) {
            return redirect("http://localhost:8080/run-combination/{$combination_id}?chat=true&token={$token}");
        }
        $domain =$request->query()['domain'];
        return  redirect("https://{$domain}.serenusai.com/run-combination/{$combination_id}?token={$token}");

    }

    public function runUnfinishedCombination($combination_id)
    {
        // $token = session('api-token');
        $token = $this->getToken();
        if (App::isLocal()) {
            return redirect("http://localhost:8080/run-unfinished-combination/{$combination_id}?token={$token}");
        }
        if (RedirectController::isSerenusAI())
            redirect("https://client.serenusai.com/run-unfinished-combination/{$combination_id}?token={$token}");
        //  return redirect("http://test.medecide.net/run-unfinished-combination/{$combination_id}?token={$token}");
        return redirect("https://client.medecide.net/run-unfinished-combination/{$combination_id}?token={$token}");
    }
    public function runReport(Request $request ,$test_id)

    {
        //$token = session('api-token');
        $is_ml = $request->query() ?  $request->query()['v2'] : '';
        $is_ml  = $is_ml  ? '&ml=-v2' : '';
        $token = $this->getToken();
        if (App::isLocal()) {
            if ($is_ml)  return redirect("http://localhost:8080/run-reports/{$test_id}?token={$token}{$is_ml}");
            return redirect("http://localhost:8080/run-reports/{$test_id}?token={$token}");
        }
        if ($is_ml)  return redirect("http://staging.serenusai.com/run-reports/{$test_id}?token={$token}{$is_ml}");
        return  redirect("https://client.serenusai.com/reports/{$test_id}?token={$token}");
    }

    public function runTeach(Request $request , $procedure_id)
    {
        $token = session('api-token');
        $domain =$request->query() ? $request->query()['domain'] : false;
        if($domain) return redirect("https://{$domain}.serenusai.com/teach/{$procedure_id}?token={$token}");
        if (App::isLocal()) {
            return redirect("http://localhost:8080/teach/{$procedure_id}?token={$token}");
        }
        if (RedirectController::isSerenusAI())
            return redirect("https://client.serenusai.com/teach/{$procedure_id}?token={$token}");
        return redirect("http://client.medecide.net/teach/{$procedure_id}?token={$token}");
    }
    public function runBetaTeach($procedure_id)
    {

        $token = $this->getToken();
        if (App::isLocal()) {
            return redirect("http://localhost:8080/teach/{$procedure_id}?token={$token}");
        }
        if (RedirectController::isSerenusAI())
            return redirect("https://mybeta.serenusai.com/teach/{$procedure_id}?token={$token}");
        return redirect("http://mybeta.medecide.net/teach/{$procedure_id}?token={$token}");
    }
    public static function getToken()

    {
        $client = new Client();

            $id = auth()->user()->id   ; //Send Supervisor as Demo!




           //   $id = $u_id ;

            $myQuery= $client->request('GET', static::getApiUrl().'/loginWithToken', [
                'query' => ['id' => $id , 'serenus-ai-login-secret' => '496351b' ] ]) ; //->getContents();->getBody() ;

        return json_decode($myQuery->getBody()->getContents() ,1)['token'] ;


         //  return $exception->getMessage();

    }

    public static function getApiUrl()
    {
        if (App::isLocal()) {

            return  "http://localhost/medecide-api/public/"; //"http://medecide-api.localhost";
        }
        if (RedirectController::isSerenusAI())
            return  "https://core.serenusai.com/public";

        return "https://core.medecide.net/public";
    }

    public static function isSerenusAI()
    {

        return  str_contains(url('/') , 'serenusai.com')  ;
    }
}


