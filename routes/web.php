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
Route::get( 'json_total_cost','IndexController@json_total_cost');
Route::get( 'json_budget_cost','IndexController@json_budget_cost');

/*
|--------------------------------------------------------------------------
| 家計簿入力画面 
|   入力フォームの内容をDBへ登録
|--------------------------------------------------------------------------
*/

Route::get( 'input_book','InputBookController@input_book_get');
Route::post( 'input_book','InputBookController@input_book_post');

Route::get( 'edit_book','InputBookController@edit_book_get');
Route::post( 'edit_book','InputBookController@edit_book_post');

Route::get( 'json_balance','InputBookController@json_balance');
Route::get( 'json_large','InputBookController@json_large');
Route::get( 'json_middle','InputBookController@json_middle');
Route::get( 'json_small','InputBookController@json_small');

Route::get( 'get_balance_code','InputBookController@code_balance');
Route::get( 'get_large_code','InputBookController@code_large');
Route::get( 'get_middle_code','InputBookController@code_middle');
Route::get( 'get_small_code','InputBookController@code_small');

Route::get( 'json_old','InputBookController@json_old');

/*
|--------------------------------------------------------------------------
| レシート確認画面 
|   新規登録・編集・削除の確認と詳細表示
|--------------------------------------------------------------------------
*/

//詳細ボタン押下
Route::get( 'comfirm_receipt','ComfirmReceiptController@comfirm_receipt_get');
//新規登録確認画面で登録するボタン押下
Route::post( 'comfirm_input','ComfirmReceiptController@comfirm_input_post');
//入力へ戻るボタン押下 新規登録確認から戻る
Route::post( 'back_input','ComfirmReceiptController@back_input_post');
//変更確認画面で変更するボタン押下
Route::post( 'comfirm_update','ComfirmReceiptController@comfirm_update_post');
//編集へ戻るボタン押下
Route::post( 'back_update','ComfirmReceiptController@back_update_post');
//削除するボタン押下 (削除確認へ進む)
Route::get( 'comfirm_delete','ComfirmReceiptController@comfirm_delete_get');
//削除するボタン押下 (削除完了へ進む)
Route::post( 'comfirm_delete','ComfirmReceiptController@comfirm_delete_post');


/*
|--------------------------------------------------------------------------
| 家計簿閲覧画面 
|  　1レコード単位で出力した表 
|--------------------------------------------------------------------------
*/

Route::get( 'read_book','ReadBookController@read_book_get');

/*
|--------------------------------------------------------------------------
| 家計簿閲覧画面 
|  　月ごとに金額を集計した年表 
|--------------------------------------------------------------------------
*/

Route::get( 'read_book_aggregate','ReadBookController@read_book_aggregate_get');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| 変動費編集画面
|  　月々の変動費を設定 
|--------------------------------------------------------------------------
*/

Route::get( 'edit_budget','EditBudgetController@edit_budget_get');
Route::post( 'edit_budget','EditBudgetController@edit_budget_post');
Route::get( 'edit_budget_result','EditBudgetController@edit_budget_result_get');

/*
|--------------------------------------------------------------------------
| 固定費編集画面
|  　月々の固定費を年表形式で入力 
|--------------------------------------------------------------------------
*/

Route::get( 'input_monthly_cost','InputMonthlyFixiedCostController@input_monthly_cost_get');
Route::post( 'input_monthly_cost','InputMonthlyFixiedCostController@input_monthly_cost_post');

/*
|--------------------------------------------------------------------------
| システム管理画面
|  　システムメニュー 
|--------------------------------------------------------------------------
*/

Route::get( 'system/system_menu','System\SystemManageController@system_menu_get');
Route::get( 'system/manage_category','System\SystemManageController@manage_category_get');

/*
|--------------------------------------------------------------------------
| システム管理画面
|  　カテゴリー入力 
|--------------------------------------------------------------------------
*/

Route::get( 'system/input_category','System\InputCategoryController@input_category_get');
Route::post( 'system/input_category','System\InputCategoryController@input_category_post');

/*
|--------------------------------------------------------------------------
| システム管理画面
|  　カテゴリー確認 
|--------------------------------------------------------------------------
*/

//分類詳細画面へ進む
Route::get ( 'system/comfirm_category','System\ComfirmCategoryController@comfirm_category_get');
//新規分類登録へ進む
Route::post( 'system/comfirm_category','System\ComfirmCategoryController@comfirm_category_post');

