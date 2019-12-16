<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('create-payment' , function (){


    var_dump('213412423');
});

//Route::post('paypal-transaction-complete' , function (){
//
//
//    return ['completed'];
//});

Route::post('paypal-transaction-complete' , 'PayPalController@getOrder');

