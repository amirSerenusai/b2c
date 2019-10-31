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

Route::get('index', 'HomeController@index')->name('home');

//Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Route::resource('procedures', 'ProceduresController', [
    'names' => [
        'index' => 'procedures',
        'store' => 'faq.new',
    ]   ]);

Route::get('create-scenario/{proc_id}', ['as' => 'createScenario', 'uses' => 'TeachController@createScenario']);
Route::get('q-answered', function (){ QuestionAnswered::dispatch(['amirarray' => rand(1,1000)]);

return 'q-answered';});

Route::get('/amir', function (){ return view('test'); });
Route::get('run-procedure/{procedure}', 'RedirectController@runTest')->name('procedures.run');
Route::get('run-combination/{combination}', 'RedirectController@runCombination')->name('combination.run');
Route::get('/questionnaire', function (){ return view('questionnaire'); });
Route::post('/validate-email' , 'Auth\RegisterController@emailExists');
Auth::routes();
Route::get('/{any?}', function () {

    return view('main');
});


Route::get('tests/{test}/reports', ['as' => 'tests.reports.show', 'uses' => 'QuestionnaireReportsController@show']);





//Route::get('/home', 'HomeController@index')->name('home');

