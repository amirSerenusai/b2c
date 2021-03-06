<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\AnswerUpdate;
use App\Events\QuestionAnswered;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
Auth::routes();
Route::get('/', function () {
    return redirect('medical');
});
Route::get('original', function () {

    return view('original');
});

Route::get('check-mail-button', function () {

    return view('vendor/mail/html/layout');
});


Route::get('test-event', function () {
    AnswerUpdate::dispatch(['amirarray' => rand(1,1000)]);

//    $pusher = new Pusher( '64d4fa2735e28609907d' , 'a32e4d7e54e5d2061727' , '822869' );
//
//    $pusher->trigger('adminserenus',  'AnswerUpdate', ['message' => '123123']);
    dd("end");

});


//Route::get('home', 'HomeController@index')->name('home');
 Route::get('/old-main'  , function(){ return view('main');});
Route::get('/medical'  , function(){ return view('medical.index');});
//Route::get('/departments'  , function(){ return view('medical.departments');});
Route::get('/appointment'  , function(){ return view('medical.appointment');})->name('link.order');;
Route::get('/contact'  , function(){ return view('medical.contact');})->name('link.contact');;

Route::get('_about'  , function(){ return view('about');})->name('_about');
Route::get('about'  , function(){   return view('medical.about');})->name('about');
Route::get('order_old' , function(){ return view('order');

})->name('order');
//Route::get('doctors' , function(){ return view('doctors');
Route::get('doctors' , function(){ return view('medical.doctors');

})->name('doctors');
Route::get('blog' , function(){ return view('blog');

})->name('blog');
Route::get('order2' , function(){ return view('order2');
})->name('order2');
Route::get('paypal' , function(){ return view('paypal');
});



//Route::middleware(['Authenticate'])->group(function () {

    Route::get('run-procedure/{procedure}', 'RedirectController@runTest')->name('procedures.run');
    Route::get('run-combination/{combination}', 'RedirectController@runCombination')->name('combination.run');
//});
//Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Route::resource('procedures', 'ProceduresController', [
    'names' => [
        'index' => 'procedures',
        'store' => 'faq.new',
    ]   ]);
Route::resource('order', 'OrderController', [
    'names' => [
            'index' => 'link.order'
//        'store' => 'faq.new',
    ]   ]);
Route::get('create-scenario/{proc_id}', ['as' => 'createScenario', 'uses' => 'TeachController@createScenario']);
Route::get('q-answered', function (){ QuestionAnswered::dispatch(['amirarray' => rand(1,1000)]);

return 'q-answered';});
//Route::get('/get-api-token', 'RedirectController@getToken');
Route::get('/amir', function (){ return view('test'); });

Route::get('/questionnaire', function (){ return view('questionnaire'); });
Route::post('/validate-email' , 'Auth\RegisterController@emailExists');
Route::post('/pwd-link' , 'Auth\RegisterController@pwdLink');
Route::get('/landing2' , function (){ return view('landing-2'); });

Route::get('/create100' , function(){
// (\Illuminate\Support\Facades\Mail::to(env('MAIL_UPLOAD_NOTIFY'))->send( new \App\Mail\LabelProcedureChanged(['array1'])) )->delay(now()->addSeconds(5)) ;

//  dispatch()
//  $job = (new  App\Jobs\CreateScenarios)->delay(Carbon::now()->addSeconds(45)) ;
//   dispatch(App\Jobs\CreateScenarios);
// App\Jobs\CreateScenarios::dispatch() ;
    $user =App\User::find(227);
    \Illuminate\Support\Facades\Mail::to('amir1004@gmail.com')->send( new \App\Mail\UserCreated($user));


    return ["done"];
});






//Route::get('/{any?}', function () {
//
//    return view('main');
//});


Route::get('tests/{test}/reports', ['as' => 'tests.reports.show', 'uses' => 'QuestionnaireReportsController@show']);


Route::group(['prefix' => 'include' ], function ()   {
    Route::post('sendemail' , 'MailController@getMessageFromCostumer');
    Route::post('subscribe' , 'MailController@getMessageFromCostumer');
});



//Route::get('/home', 'HomeController@index')->name('home');
