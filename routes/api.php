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

Route::get('loans', 'LoanController@show');

Route::get('loans/{id}', 'LoanController@show');

Route::post('loans', 'LoanController@store');

Route::put('loans', 'LoanController@store');

Route::delete('loans/{id}', 'LoanController@destroy');


