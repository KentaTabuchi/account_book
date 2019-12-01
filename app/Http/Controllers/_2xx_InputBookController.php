<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\SQL\_201_index\SQL;
use App\Http\SQL\_211_edit_book\SQL211;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| 入力画面のコントローラー
|--------------------------------------------------------------------------
*/
class _2xx_InputBookController extends Controller
{
    public function input_book_get(Request $request){
        return view('201_input_book');
    }

    public function input_book_post(Request $request){
        $request->validate([
             'payment' => 'required|integer'
            ,'balance_code' => 'not_in: 0'
            ,'large_code' => 'not_in: 0'
            ,'middle_code' => 'not_in: 0'
            ,'small_code' => 'not_in: 0'

        ]);
        $today = isset($request->pay_day) ? $request->pay_day : Carbon::today()->toDateString();
        SQL::insert_to_account_book(
             $request->balance_code
            ,$request->large_code
            ,$request->middle_code
            ,$request->small_code
            ,$request->memo
            ,Carbon::today()
            ,$request->payment
            ,Carbon::now()
        );
        return view('202_input_book_result',compact('request','today'));
    }
    /*
|--------------------------------------------------------------------------
| 編集画面のコントローラー
|--------------------------------------------------------------------------
*/

    public function edit_book_get(Request $request){
        $old = SQL211::select_old_data_for_label($request->id);
        // dd($result);
        return view('211_edit_book',compact('old'));
    }

    public function edit_book_post(Request $request){
        $request->validate([
             'payment' => 'required|integer'
            ,'balance_code' => 'not_in: 0'
            ,'large_code' => 'not_in: 0'
            ,'middle_code' => 'not_in: 0'
            ,'small_code' => 'not_in: 0'

        ]);

        DB::table('account_book')->where('id','=',$request->id)
                                 ->update([
                                     'pay_day' => $request->pay_day
                                    ,'balance_code' => $request->balance_code
                                    ,'large_code' => $request->large_code
                                    ,'middle_code' => $request->middle_code
                                    ,'small_code' => $request->small_code
                                    ,'memo' => $request->memo
                                    ,'payment' => $request->payment
                                    ,'updated_at' => Carbon::now()
                                    ]);

        
        return view('212_edit_book_result',compact('request'));
    }
    //=====================================================================================
    //　jsonを返すapi vueから呼び出し、セレクトボックスへバインドする
    //=====================================================================================
    public function json_balance(Request $request){
        $category_balance = SQL::select_balance();   
        $category_balance_encorded = json_encode($category_balance,JSON_UNESCAPED_UNICODE);
        return $category_balance_encorded;
    }
    public function json_large(Request $request){
        // dd($request->code_balance);
        $category_large = SQL::select_large($request->code_balance);   
        $category_large_encorded = json_encode($category_large,JSON_UNESCAPED_UNICODE);
        return $category_large_encorded;
    }
    public function json_middle(Request $request){
        $category_middle = SQL::select_middle($request->code_large);//引数増やして分類と大コードがいる？   
        $category_middle_encorded = json_encode($category_middle,JSON_UNESCAPED_UNICODE);
        return $category_middle_encorded;
    }
    public function json_small(Request $request){
        $category_small = SQL::select_small($request->code_middle); //引数増やして分類と大コードがいる？  
        $category_small_encorded = json_encode($category_small,JSON_UNESCAPED_UNICODE);
        return $category_small_encorded;
    }
    //=====================================================================================
    //　jsonを返すapi vueから呼び出し、選択されたセレクトボックスの名前からコードを返す。
    //=====================================================================================
    public function code_balance(Request $request){
        $balance_code = SQL::select_balance_code($request->code); 
        $balance_code_encorded = json_encode($balance_code,JSON_UNESCAPED_UNICODE);
        return $balance_code_encorded;
    }
    public function code_large(Request $request){
        $large_code = SQL::select_large_code($request->code); 
        $large_code_encorded = json_encode($large_code,JSON_UNESCAPED_UNICODE);
        return $large_code_encorded;
    }
    public function code_middle(Request $request){
        $middle_code = SQL::select_middle_code($request->code); 
        $middle_code_encorded = json_encode($middle_code,JSON_UNESCAPED_UNICODE);
        return $middle_code_encorded;
    }
    public function code_small(Request $request){
        $small_code = SQL::select_small_code($request->code); 
        $small_code_encorded = json_encode($small_code,JSON_UNESCAPED_UNICODE);
        return $small_code_encorded;
    }
}
