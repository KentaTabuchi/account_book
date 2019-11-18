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

//--管理メニュー TOP
Route::get( '','IndexController@index_get');

//--家計簿入力画面 
Route::get( 'input_book','InputBookController@input_book_get');
Route::post( 'input_book','InputBookController@input_book_post');

Route::get( 'json_balance','InputBookController@json_balance');
Route::get( 'json_large','InputBookController@json_large');
Route::get( 'json_middle','InputBookController@json_middle');
Route::get( 'json_small','InputBookController@json_small');
