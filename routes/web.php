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

Route::get( '','_1xx_IndexController@index_get');
Route::get( 'json_total_cost','_1xx_IndexController@json_total_cost');
Route::get( 'json_budget_cost','_1xx_IndexController@json_budget_cost');

/*
|--------------------------------------------------------------------------
| 家計簿入力画面 
|   入力フォームの内容をDBへ登録
|--------------------------------------------------------------------------
*/

Route::get( 'input_book','_2xx_InputBookController@input_book_get');
Route::post( 'input_book','_2xx_InputBookController@input_book_post');

Route::get( 'edit_book','_2xx_InputBookController@edit_book_get');
Route::post( 'edit_book','_2xx_InputBookController@edit_book_post');

Route::get( 'json_balance','_2xx_InputBookController@json_balance');
Route::get( 'json_large','_2xx_InputBookController@json_large');
Route::get( 'json_middle','_2xx_InputBookController@json_middle');
Route::get( 'json_small','_2xx_InputBookController@json_small');

Route::get( 'get_balance_code','_2xx_InputBookController@code_balance');
Route::get( 'get_large_code','_2xx_InputBookController@code_large');
Route::get( 'get_middle_code','_2xx_InputBookController@code_middle');
Route::get( 'get_small_code','_2xx_InputBookController@code_small');

Route::get( 'json_old','_2xx_InputBookController@json_old');

/*
|--------------------------------------------------------------------------
| レシート確認画面 
|   新規登録・編集・削除の確認と詳細表示
|--------------------------------------------------------------------------
*/

Route::get( 'comfirm_receipt','ComfirmReceiptController@comfirm_receipt_get');

/*
|--------------------------------------------------------------------------
| 家計簿閲覧画面 
|  　1レコード単位で出力した表 
|--------------------------------------------------------------------------
*/

Route::get( 'read_book','_3xx_ReadBookController@read_book_get');

/*
|--------------------------------------------------------------------------
| 家計簿閲覧画面 
|  　月ごとに金額を集計した年表 
|--------------------------------------------------------------------------
*/

Route::get( 'read_book_aggregate','_3xx_ReadBookController@read_book_aggregate_get');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| 変動費編集画面
|  　月々の変動費を設定 
|--------------------------------------------------------------------------
*/

Route::get( 'edit_budget','_4xx_EditBudgetController@edit_budget_get');
Route::post( 'edit_budget','_4xx_EditBudgetController@edit_budget_post');
Route::get( 'edit_budget_result','_4xx_EditBudgetController@edit_budget_result_get');

/*
|--------------------------------------------------------------------------
| 固定費編集画面
|  　月々の固定費を年表形式で入力 
|--------------------------------------------------------------------------
*/

Route::get( 'input_monthly_cost','_5xx_InputMonthlyFixiedCostController@input_monthly_cost_get');
Route::post( 'input_monthly_cost','_5xx_InputMonthlyFixiedCostController@input_monthly_cost_post');



