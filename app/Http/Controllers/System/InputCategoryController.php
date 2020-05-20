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

class InputCategoryController extends Controller
{
    /**
     * カテゴリー管理一覧画面で新規作成ボタンを押した時のアクション
     */
    public function input_category_get(Request $request)
    {
        //ユーザー情報の取得
        $user = Auth::user();

        //画面モードの設定
        $processmode = Config::get('processmode.input');

        //入力する分類モードの設定
        $category_mode = $request->category_mode;

        //対象のリストと親分類のリストを取得
        $current_list = null;
        $parents_list = null;

        switch($category_mode) {
            case Config::get('categorymode.large'):
                $carrent_list = CategoryLarge::all();
                $parents_list = CategoryBalance::all();
                break;
            case Config::get('categorymode.middle'):
                $carrent_list = CategoryMiddle::all();
                $parents_list = CategoryLarge::all();
                break;
            case Config::get('categorymode.small'):
                $carrent_list = CategorySmall::all();
                $parents_list = CategoryMiddle::all();
                break;
        }
        //編集用のセッションが残っているとバグるので解放する。
        $request->session()->forget('selected_id');
        return view('system/input_category',compact('user','processmode','category_mode','parents_list'));
    }

    /**
     * 分類入力画面で確認へ進むを押した時のアクション
     */
    public function input_category_post(Request $request)
    {
        //ユーザー情報の取得
        $user = Auth::user();

        //TODO:リクエストからプロセスモードを取得する
        $processmode = $request->process_mode;
        
        //入力する分類モードの設定
        $category_mode = $request->category_mode;

        //入力フォームの値をCategoryインスタンスに詰める。
        $category = null;

        switch ($category_mode) {
            case Config::get('categorymode.middle'):
                $category = new CategoryMiddle;
                $category->fillform($request);
                $category->parent_name = CategoryLarge::where('code',$category->large_code)->first()->name;
                break;
            case Config::get('categorymode.small'):
                $category = new CategorySmall;
                $category->fillform($request);
                $category->parent_name = CategoryMiddle::where('code',$category->middle_code)->first()->name;
                break;
        }
        // dd($category);
        //確認画面へ遷移させる 次のアクションで使うためリクエストパラメータをhiddenに埋め込む
        return view('system/comfirm_category',compact('user','request','processmode','category','category_mode'));

    }
}
