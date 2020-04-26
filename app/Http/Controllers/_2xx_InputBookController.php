<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\SQL\_201_SQL;
use App\Http\SQL\_211_SQL;
use App\Http\Requests\_201_ValidatedRequest;
use App\Http\Requests\_211_ValidatedRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| 入力・編集画面のコントローラー
|--------------------------------------------------------------------------
*/
class _2xx_InputBookController extends Controller
{
    public function input_book_get(Request $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //編集用のセッションが残っているとバグるので解放する。
        $request->session()->forget('selected_id');

        return view('201_input_book',compact('user','processmode'));
    }

    public function input_book_post(_201_ValidatedRequest $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //日付の指定がなければ当日を指定
        $today = isset($request->pay_day) ? $request->pay_day : Carbon::today()->toDateString();

        //入力フォームの値をDBへ登録する
        _201_SQL::insert_to_account_book(
            $request->category_balance
            ,$request->category_large
            ,$request->category_middle
            ,$request->category_small
            ,$request->memo
            ,Carbon::today()
            ,$request->payment
            ,Carbon::now()
            ,Auth::user()->id
        );

        //結果ページに名前で表示するため、分類名をコードから取得する。
        $request->category_balance = _201_SQL::get_category_name_by_code('balance',$request->category_balance);
        $request->category_large = _201_SQL::get_category_name_by_code('large',$request->category_large);
        $request->category_middle = _201_SQL::get_category_name_by_code('middle',$request->category_middle);
        $request->category_small = _201_SQL::get_category_name_by_code('small',$request->category_small);

        return view('202_input_book_result',compact('request','today','user','processmode'));
    }

    public function edit_book_get(Request $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.update');

        //vue.jsから呼び出す用に、編集中のレコードのIDをクラスのセッションに保持する。
        $request->session()->put('selected_id',$request->id);

        return view('201_input_book',compact('old','user','processmode'));
    }

    public function edit_book_post(_201_ValidatedRequest $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //画面モードの設定
        $processmode = Config::get('processmode.update');

        //入力フォームの値をDBへ登録する
        DB::table('account_book')->where('id','=',$request->id)
                                 ->update([
                                     'pay_day' => $request->pay_day
                                    ,'balance_code' => $request->category_balance
                                    ,'large_code' => $request->category_large
                                    ,'middle_code' => $request->category_middle
                                    ,'small_code' => $request->category_small
                                    ,'memo' => $request->memo
                                    ,'payment' => $request->payment
                                    ,'updated_at' => Carbon::now()
                                    ]);
        //結果ページに名前で表示するため、分類名をコードから取得する。
        $request->category_balance = _201_SQL::get_category_name_by_code('balance',$request->category_balance);
        $request->category_large = _201_SQL::get_category_name_by_code('large',$request->category_large);
        $request->category_middle = _201_SQL::get_category_name_by_code('middle',$request->category_middle);
        $request->category_small = _201_SQL::get_category_name_by_code('small',$request->category_small);
        
        return view('202_input_book_result',compact('request','user','processmode'));
    }
    //=====================================================================================
    //　分類コードと分類名のリストをjson形式で返すAPI vue.js側から呼び出し、セレクトボックスへセットする
    //=====================================================================================
    public function json_balance(Request $request){
        $category_balance = _201_SQL::select_balance();   
        $category_balance_encorded = json_encode($category_balance,JSON_UNESCAPED_UNICODE);
        return $category_balance_encorded;
    }
    public function json_large(Request $request){
        $category_large = _201_SQL::select_large($request->code_balance);   
        $category_large_encorded = json_encode($category_large,JSON_UNESCAPED_UNICODE);
        return $category_large_encorded;
    }
    public function json_middle(Request $request){
        $category_middle = _201_SQL::select_middle($request->code_large);//引数増やして分類と大コードがいる？   
        $category_middle_encorded = json_encode($category_middle,JSON_UNESCAPED_UNICODE);
        return $category_middle_encorded;
    }
    public function json_small(Request $request){
        $category_small = _201_SQL::select_small($request->code_middle); //引数増やして分類と大コードがいる？  
        $category_small_encorded = json_encode($category_small,JSON_UNESCAPED_UNICODE);
        return $category_small_encorded;
    }

    //=====================================================================================
    //　現在DBに書き込まれている詳細情報をIDをキーにしてjson形式で取得する。
    //=====================================================================================
    public function json_old(Request $request){
        $old = _211_SQL::get_old_data($request->session()->get('selected_id')); 
        $old_encorded = json_encode($old,JSON_UNESCAPED_UNICODE);
        return $old_encorded;
    }
}
