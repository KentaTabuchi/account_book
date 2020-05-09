<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\Receipt;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;
use Illuminate\Support\Facades\DB;

class ComfirmReceiptController extends Controller
{
    /**
     *  詳細画面のアクション
     */
    public function comfirm_receipt_get(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.detail');

        //選択中のレシートを取得する。
        $receipt = Receipt::from('receipts as A')
                           ->JoinCategoryCode()
                           ->SelectWithCategoryName()
                           ->where('user_id',$user->id)
                           ->where('A.id',$request->id)
                           ->first();

        return view('comfirm_receipt',compact('user','receipt','processmode'));
    }

    /**
     *  新規登録のアクション 登録するボタン押下時
     */
    public function comfirm_input_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //入力フォームの値をDBへ登録する
        $receipt = new Receipt;
        $receipt->fillForm($decoded_request);
        $receipt->user_id = $user->id;
        $receipt->save();

        return view('complete_receipt',compact('user','receipt','processmode'));
    }

    /**
     *  新規登録確認画面で戻るアクション 入力へ戻るボタン押下時
     */
    public function back_input_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //vue.jsから呼び出す用に、編集中のレコードのIDをクラスのセッションに保持する。
        $request->session()->put('restore_edit',$decoded_request);

        return view('201_input_book',compact('user','processmode'));
    }

    /**
     *  変更登録のアクション 変更するボタン押下時
     */
    public function comfirm_update_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.update');

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //変更をDBへ登録する。
        $receipt = Receipt::find($decoded_request->id);
        $receipt->fillForm($decoded_request);
        $receipt->save();

        return view('complete_receipt',compact('user','receipt','processmode'));
    }

    /**
     *  変更確認画面で戻るアクション 変更入力へ戻るボタン押下時
     */
    public function back_update_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.update');

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //vue.jsから呼び出す用に、編集中のレコードのIDをクラスのセッションに保持する。
        $request->session()->put('restore_edit',$decoded_request);
                
        return view('201_input_book',compact('user','processmode'));
    }

    /**
     *  レシート削除確認のアクション 詳細画面で削除するボタン押下時
     */
    public function comfirm_delete_get(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.delete');

        //選択中のレシートを取得する。
        $receipt = Receipt::from('receipts as A')
        ->JoinCategoryCode()
        ->SelectWithCategoryName()
        ->where('user_id',$user->id)
        ->where('A.id',$request->id)
        ->first();

        return view('comfirm_receipt',compact('user','receipt','processmode'));
    }

    /**
     *  削除実行のアクション 削除確認画面で削除するボタン押下時
     */
    public function comfirm_delete_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.delete');

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //DBから削除する。
        $receipt = Receipt::find($decoded_request->id);
        $receipt->delete();

        return view('complete_receipt',compact('user','receipt','processmode'));
    }
}
