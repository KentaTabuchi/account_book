<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;

class ComfirmCategoryController extends Controller
{
    /**
     *  詳細画面のアクション 詳細ボタン押下時
     */
    public function comfirm_category_get(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.detail');

        //カテゴリーモードの取得
        $category_mode = $request->category_mode;

        //DBから該当のcodeのレコードと親分類の名前を取り出してをCategoryインスタンスに詰める。
        $category = null;
        switch ($category_mode) {
            case Config::get('categorymode.middle'):
                $category = CategoryMiddle::where('code',$request->code)->get()->first();
                $category->parent_name = CategoryLarge::where('code',$category->large_code)->first()->name;
                break;
            case Config::get('categorymode.small'):
                $category = CategorySmall::where('code',$request->code)->get()->first();
                $category->parent_name = CategoryMiddle::where('code',$category->middle_code)->first()->name;
                break;
        }

        //詳細画面へ遷移する。
        return view('system/comfirm_category',compact('user','category','processmode','category_mode'));
    }

    /**
     *  新規登録のアクション 登録するボタン押下時
     */
    public function comfirm_category_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //カテゴリーモードの取得
        $category_mode = $request->category_mode;

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //入力フォームの値をCategoryインスタンスに詰める。
        $category = null;
        switch ($category_mode) {
            case Config::get('categorymode.middle'):
                $category = new CategoryMiddle;
                $category->fillform($decoded_request);
                break;
            case Config::get('categorymode.small'):
                $category = new CategorySmall;
                $category->fillform($decoded_request);
                break;
        }

        //DBへ登録する。
        $category->save();

        //完了画面へ遷移する。
        return view('system/complete_category',compact('user','category','processmode'));
    }

    public function comfirm_delete_get(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.delete');

        //カテゴリーモードの取得
        $category_mode = $request->category_mode;

        //DBから該当のcodeのレコードと親分類の名前を取り出してをCategoryインスタンスに詰める。
        $category = null;
        switch ($category_mode) {
            case Config::get('categorymode.middle'):
                $category = CategoryMiddle::where('code',$request->code)->get()->first();
                $category->parent_name = CategoryLarge::where('code',$category->large_code)->first()->name;
                break;
            case Config::get('categorymode.small'):
                $category = CategorySmall::where('code',$request->code)->get()->first();
                $category->parent_name = CategoryMiddle::where('code',$category->middle_code)->first()->name;
                break;
        }

        //確認画面へ遷移させる 次のアクションで使うためリクエストパラメータをhiddenに埋め込む
        return view('system/comfirm_category',compact('user','request','processmode','category','category_mode'));
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

        //カテゴリーモードの取得
        $category_mode = $request->category_mode;

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //DBから該当のcodeのレコードを削除する。
        $category = null;
        switch ($category_mode) {
            case Config::get('categorymode.middle'):
                $category = CategoryMiddle::find($decoded_request->code);
                break;
            case Config::get('categorymode.small'):
                $category = CategorySmall::find($decoded_request->code);
                break;
        }
        //DBから削除する。
        $category = CategorySmall::find($decoded_request->code);
        $category->delete();

        //削除完了画面へ進む
        return view('system/complete_category',compact('user','processmode'));
    }

    /**
     *  入力へ戻る実行のアクション 分類新規登録確認画面で入力へ戻るボタン押下時
     */
    public function back_input_post(Request $request)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //json化してhiddenに渡したフォームを復元する
        $decoded_request = json_decode($request->hidden_request);

        //カテゴリーモードの取得
        $category_mode = $request->category_mode;

        //入力中の分類名を復元する。
        $category_name = $decoded_request->name;

        //親カテゴリーをリストを取得。さらに、選択中の親カテゴリーを取得し復元する。
        switch($category_mode) {
            case Config::get('categorymode.large'):
                $parents_list = CategoryBalance::all();
                break;
            case Config::get('categorymode.middle'):
                $parents_list = CategoryLarge::where('code',$decoded_request->large_code)->first();
                break;
            case Config::get('categorymode.small'):
                $parents_list = CategoryMiddle::all();
                $selected_parent = CategoryMiddle::where('code',$decoded_request->middle_code)->first();
                break;
        }

        //編集用のセッションが残っているとバグるので解放する。
        $request->session()->forget('selected_id');

        //vue.jsから呼び出す用に、編集中のレコードのIDをクラスのセッションに保持する。
        $request->session()->put('restore_edit',$decoded_request);

        return view('system/input_category',compact('user','processmode','category_mode','parents_list','selected_parent','category_name'));
    }
}
