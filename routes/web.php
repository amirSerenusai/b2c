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

use App\Events\QuestionAnswered;
use Illuminate\Support\Facades\Auth;


Route::get('original', function () {

    return view('original');
});

//Route::get('home', 'HomeController@index')->name('home');
Route::get('/'  , function(){ return view('main');});
Route::get('about'  , function(){ return view('about');})->name('about');
Route::get('order' , function(){ return view('order');

})->name('order');
Route::get('doctors' , function(){ return view('doctors');

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





Auth::routes();
Route::get('/{any?}', function () {

    return view('main');
});


Route::get('tests/{test}/reports', ['as' => 'tests.reports.show', 'uses' => 'QuestionnaireReportsController@show']);





//Route::get('/home', 'HomeController@index')->name('home');
