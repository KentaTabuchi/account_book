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
}
