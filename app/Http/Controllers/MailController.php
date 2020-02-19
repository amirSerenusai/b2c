<?php

namespace App\Http\Controllers;
use App\Events\TestEvent;
use App\Mail\MessageFromCostumer;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class MailController
 * @package App\Http\Controllers
 */
class MailController extends Controller
{

    static public function error($array)
    {
        extract($array);

        $user = Auth::user();
        $to = explode(",", getenv('MAIL_USER_NAMES'));
        $raw = $message;
        Mail::send('emails.error' ,['request_params' => $request_params, 'raw' => $raw,'name' => $user->getFullName(), 'userID' => $user->id ],  function ($msg) use ($to , $user ) {
            $msg->to($to);
            $msg->subject($user->getFullName().'Had connection problem. ');
            $msg->from(['office@serenusai.com']);
        });

    }


    static public function endTestMail($questionnaire_id)
    {
        $to = explode(",",getenv('MAIL_USER_NAMES'));
        $raw = "This mail was sent by SerenusAI application to Hillary . office , Q-id: {$questionnaire_id} completed.  https://client.serenusai.com/reports/{$questionnaire_id}";
        Mail::raw( $raw, function ($msg) use ($to, $questionnaire_id){
            $msg->to($to);
            $msg->subject('SerenusAI Q-id'.$questionnaire_id.' completed.');
            $msg->from(['office@serenusai.com']);
        });
//        Mail::raw(`This mail was sent by medecide application to Hillary . office , Q-id: {$questionnaire_id}`. Carbon::now()->toDateTimeString(), function ($msg) {
//            $msg->to([(new MailController)->to]);
//            $msg->from(['office@medecide.net']);
//        });
    }

    /**
     * @param Request $request
     */
    public function pullRequest(Request $request)
    {
        info("pullRequest sent!12345678");
        //$to= [getenv('MAIL_UPLOAD_NOTIFY')];
        $to = explode(",",getenv('MAIL_UPLOAD_NOTIFY'));
        //$raw="pull Request sent";
        $raw = json_encode($request->all());
        $raw = json_decode($raw, true)['push']['changes'][0]['commits'][0]['message'];
        Mail::raw( $raw, function ($msg) use ($to, $raw){
            $msg->to($to);
            $msg->subject($raw);
            $msg->from(['office@serenusai.com']);
        });
//        Mail::raw(`This mail was sent by medecide application to Hillary . office , Q-id: {$questionnaire_id}`. Carbon::now()->toDateTimeString(), function ($msg) {
//            $msg->to([(new MailController)->to]);
//            $msg->from(['office@medecide.net']);
//        });
    }
    public function getMessageFromCostumer(Request $request)
    {
       $isSubscribe = Str::contains($request->url() , 'subscribe' );

        if($isSubscribe AND !$request->get('widget-subscribe-form-email')) {


            return   back()->withErrors(['PLEASE FILL IN EMAIL']);
        }
       try {

           /** @var Request $request */
           Mail::to(env('B2C_CLIENT_MAIL_TO'))
//        ->cc($moreUsers)
//        ->bcc($evenMoreUsers)
               ->send(new MessageFromCostumer( $request->all()));
           //TestEvent::dispatch(['qTitle' =>  '123']);
           if ($isSubscribe)  return back()->withInput(['subscribe-success' => "Subscribe email sent successfully!"]);
           return response(['sent' => "ok"]);
       }catch(\Throwable $th) {
          if(!$th) $fail = 'Submit failed. Please try again later.' ;
           if ($isSubscribe )  return back()->withErrors([$fail]);
           return response(['message' => $fail , 'alert' => 'error']);
       }

    }
}
