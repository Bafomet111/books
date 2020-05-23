<?php

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

Route::get('/', 'GuestController@index');
Route::get('/admin', 'AdminController@index');

Route::post('/admin', 'AdminController@auth');

Route::post('/book/add', 'AdminController@addBook');
Route::post('/book/{type}', 'AdminController@bookChange');

Route::post('/author/add', 'AdminController@addAuthor');
Route::post('/author/{type}', 'AdminController@authorChange');

Route::get('/admin/logout', 'AdminController@logout');



