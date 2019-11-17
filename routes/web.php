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

Route::get( 'json_test','InputBookController@json_test');