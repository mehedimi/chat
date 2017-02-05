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

Route::get('/', 'MessageController@index')->middleware('auth');
Route::get('/messages', 'MessageController@showMessages')->middleware('auth')->name('messages.all');
Route::post('/message/create', 'MessageController@create')->name('message.create');
Auth::routes();

Route::get('test', function(){
	dd();
});


