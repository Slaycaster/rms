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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/services', 'API\APIServiceController@index');
Route::get('/servicebytype/{id}', 'API\APIServiceController@byServiceType');

Route::get('/servicetypes', 'API\APIServiceController@servicetype');

/*-------------------------------------------------------------------------
		
--------------------------------------------------------------------------*/
Route::get('/transactions/max', 'API\APISalesController@getTransactionNumber');
Route::post('/transactions/save', 'API\APISalesController@transactionCheckout');