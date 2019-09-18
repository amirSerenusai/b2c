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

use Illuminate\Support\Facades\Auth;


Route::get('original', function () {

    return view('original');
});

Route::get('index', 'HomeController@index')->name('home');
Auth::routes();
//Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Route::resource('procedures', 'ProceduresController');
Route::get('/{any?}', function () {

    return view('main');
});


