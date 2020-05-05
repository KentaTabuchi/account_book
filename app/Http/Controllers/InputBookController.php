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
class InputBookController extends Controller
{
    /**
     * 目次画面などから新規入力を押下した場合のアクション
     */
    public function input_book_get(Request $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //編集用のセッションが残っているとバグるので解放する。
        $request->session()->forget('selected_id');

        return view('input_book',compact('user','processmode'));
    }
    
    /**
     * 新規入力画面から確認へ進むを押下した時のアクション
     */
    public function input_book_post(_201_ValidatedRequest $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //日付の指定がなければ当日を指定
        $today = isset($request->pay_day) ? $request->pay_day : Carbon::today()->toDateString();
        
        //入力フォームの値をReceiptインスタンスに詰める。
        $receipt = new Receipt;
        $receipt->add($request);

        //結果確認ページに名前で表示するため、分類名をコードから取得する。
        $receipt->balance_name  = CategoryBalance::where('code',$receipt->balance_code)->first()->name;
        $receipt->large_name = CategoryLarge::where('code',$receipt->large_code)->first()->name;
        $receipt->middle_name = CategoryMiddle::where('code',$receipt->middle_code)->first()->name;
        $receipt->small_name = CategorySmall::where('code',$receipt->small_code)->first()->name;

        return view('comfirm_receipt',compact('user','today','receipt','processmode'));
    }

    /**
     *  詳細画面で編集するボタンを押下した時のアクション
     */
    public function edit_book_get(Request $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.update');

        //vue.jsから呼び出す用に、編集中のレコードのIDをクラスのセッションに保持する。
        $request->session()->put('selected_id',$request->id);

        return view('input_book',compact('user','processmode'));
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

    /**
     *  分類コードと分類名のリストをjson形式で返すAPI vue.js側から呼び出し、セレクトボックスへセットする
     */
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
     *  編集確認から戻ってきた場合sessionに退避した入力値から復元する。
     *  @param $request 
     *  @return データベースに保管されている入力値
     */
    public function json_old(Request $request){

        $old_encorded = null;

        if(($request->session()->has('restore_edit'))){
            //編集確認から編集へ戻る押下した場合(セッションからoldを復元)
            
            //セッションから復元する
            $restore_receipt = $request->session()->get('restore_edit');

            //jsで読み込むためオブジェクトからjson形式に変換する。
            $old_encorded = json_encode($restore_receipt,JSON_UNESCAPED_UNICODE);

            //セッションキーの存在がデータ取得のフラグになるため読み終えたら消去する。
            $request->session()->forget('restore_edit');

        } else {
            //詳細から編集画面に来た場合(DBからoldを復元)

            //選択中のレシートを取得する。
            $recipt = Receipt::find($request->session()->get('selected_id'));
        
            //文字コードをエンコードする。
            $old_encorded = json_encode($recipt,JSON_UNESCAPED_UNICODE);

        }
        
        return $old_encorded;
    }
}
