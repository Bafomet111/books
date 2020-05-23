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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

Route::group(['prefix' => '/v1/books'], function (){
    Route::get('/list', 'ApiController@loadAllBooks');
    Route::get('/by-id', 'ApiController@loadById');

    Route::post('/update', 'ApiController@updateById');
    Route::delete('/{id}', 'ApiController@deleteById')->where('id', '[0-9]+');
});

