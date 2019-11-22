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

/*
|--------------------------------------------------------------------------
| トップ画面 
|  メニューを選択して各コンテンツに入る入り口
|--------------------------------------------------------------------------
*/

Route::get( '','IndexController@index_get');
/*
|--------------------------------------------------------------------------
| 家計簿入力画面 
|   入力フォームの内容をDBへ登録
|--------------------------------------------------------------------------
*/

Route::get( 'input_book','InputBookController@input_book_get');
Route::post( 'input_book','InputBookController@input_book_post');

Route::get( 'json_balance','InputBookController@json_balance');
Route::get( 'json_large','InputBookController@json_large');
Route::get( 'json_middle','InputBookController@json_middle');
Route::get( 'json_small','InputBookController@json_small');

Route::get( 'get_balance_code','InputBookController@code_balance');
Route::get( 'get_large_code','InputBookController@code_large');
Route::get( 'get_middle_code','InputBookController@code_middle');
Route::get( 'get_small_code','InputBookController@code_small');

/*
|--------------------------------------------------------------------------
| 家計簿閲覧画面 
|   表形式で閲覧
|--------------------------------------------------------------------------
*/

Route::get( 'read_book','ReadBookController@read_book_get');
