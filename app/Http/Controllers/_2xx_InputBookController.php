<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\_201_ValidatedRequest;
use App\Http\Requests\_211_ValidatedRequest;
use App\Models\Receipt;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;
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
        $recipt = new Receipt;
        $recipt->add($request);
        
        //結果ページに名前で表示するため、分類名をコードから取得する。
        $request->category_balance  = CategoryBalance::where('code',$request->category_balance)->first()->name;
        $request->category_large = CategoryLarge::where('code',$request->category_large)->first()->name;
        $request->category_middle = CategoryMiddle::where('code',$request->category_middle)->first()->name;
        $request->category_small = CategorySmall::where('code',$request->category_small)->first()->name;

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
    /**
     *  編集画面で入力値をPOSTした時のAction
     */
    public function edit_book_post(_201_ValidatedRequest $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //画面モードの設定
        $processmode = Config::get('processmode.update');

        //フォームからの入力値をReceiptインスタンスへ詰める
        $receipt = new Receipt;
        $receipt->fillForm($request);

        //結果ページに名前で表示するため、分類名をコードから取得する。
        $receipt->balance_name  = CategoryBalance::where('code',$receipt->balance_code)->first()->name;
        $receipt->large_name = CategoryLarge::where('code',$receipt->large_code)->first()->name;
        $receipt->middle_name = CategoryMiddle::where('code',$receipt->middle_code)->first()->name;
        $receipt->small_name = CategorySmall::where('code',$receipt->small_code)->first()->name;
       
        return view('comfirm_receipt',compact('user','receipt','processmode'));
    }
    //=====================================================================================
    //　分類コードと分類名のリストをjson形式で返すAPI vue.js側から呼び出し、セレクトボックスへセットする
    //=====================================================================================
    public function json_balance(Request $request){
        //「収支」リストを取得
        $category_balance_list = CategoryBalance::all();
        $category_balance_encorded = json_encode($category_balance_list,JSON_UNESCAPED_UNICODE);
        return $category_balance_encorded;
    }
    public function json_large(Request $request){
        //「大分類」リストを取得
        $category_large_list = CategoryLarge::where('balance_code',$request->code_balance)->get();
        $category_large_encorded = json_encode($category_large_list,JSON_UNESCAPED_UNICODE);
        return $category_large_encorded;
    }
    public function json_middle(Request $request){
        //「中分類」リストを取得
        $category_middle_list = CategoryMiddle::where('large_code',$request->code_large)->get();
        $category_middle_encorded = json_encode($category_middle_list,JSON_UNESCAPED_UNICODE);
        return $category_middle_encorded;
    }
    public function json_small(Request $request){
        //「小分類」リストを取得
        $category_small_list = CategorySmall::where('middle_code',$request->code_middle)->get();
        $category_small_encorded = json_encode($category_small_list,JSON_UNESCAPED_UNICODE);
        return $category_small_encorded;
    }

    /**
     *  現在DBに書き込まれている詳細情報をIDをキーにしてjson形式で取得する。
     *  @param $request 
     *  @return データベースに保管されている入力値
     */
    public function json_old(Request $request){
        //選択中のレシートを取得する。
        $recipt = Receipt::find($request->session()->get('selected_id'));
        
        //文字コードをエンコードする。
        $old_encorded = json_encode($recipt,JSON_UNESCAPED_UNICODE);

        return $old_encorded;
    }
}
