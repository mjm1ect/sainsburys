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

Route::group([
    'prefix' => '/',
    'namespace' => 'Api'
], function () {
    Route::post('totals', [ 'uses' => 'TotalsController@index' ]);
    Route::get('totals', [ 'uses' => 'TotalsController@get' ]); // return a clean error message if get request.
    //Route::resource('totals', 'TotalsController');
});
