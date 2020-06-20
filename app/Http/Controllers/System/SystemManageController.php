<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;
use Illuminate\Support\Facades\Config;
use App\Define;

/**
 *  各種設定を行う
 */
class SystemManageController extends Controller
{
    /**
     * システムメニューの表示
     */
    public function system_menu_get(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();
        return view('system/system_menu',compact('user'));

    }

    /**
     * 分類項目管理画面の表示
     */
    public function category_list_get(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        //どの分類の設定にするかを取得
        $category_mode = $request->category_mode;
        
        //表示件数の初期値を設定
        //1ページに表示するレコード数を取得
        $page_size = $request->page_size ? $request->page_size : Define::INITIAL_PAGE_SIZE;

        //対象のリストと親分類のリストを取得
        $current_list = null;
        $parents_list = null;
        switch($category_mode) {
            case Config::get('categorymode.large'):
                $current_list = CategoryLarge::all();
                $parents_list = CategoryBalance::all();
                break;
            case Config::get('categorymode.middle'):
                $current_list = CategoryMiddle::Paginate($page_size);
                $parents_list = CategoryLarge::all();
                break;
            case Config::get('categorymode.small'):
                $current_list = CategorySmall::Paginate($page_size);
                $parents_list = CategoryMiddle::all();
                break;
        }

        return view('system/category_list',compact('user','category_mode','parents_list','current_list','page_size'));
    }
    /**
     *  検索ボタン押下時の処理
     */
    public function find_category_post (Request $request)
    {
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        //どの分類の設定にするかを取得
        $category_mode = $request->category_mode;

        //表示件数の初期値を設定
        //1ページに表示するレコード数を取得
        $page_size = $request->page_size ? $request->page_size : 10;
        //検索用パラメータマップを生成
        $param = [
            'item_name' => $request->item_title
            ,'parent_code' => $request->parent_category
        ];

        //対象のリストと親分類のリストを取得
        $current_list = null;
        $parents_list = null;
        switch($category_mode) {
            case Config::get('categorymode.large'):
                $current_list = CategoryLarge::all();
                $parents_list = CategoryBalance::all();
                break;
            case Config::get('categorymode.middle'):
                if(empty($param['item_name'])) {
                    $current_list = CategoryMiddle::Paginate($page_size);
                } else {
                    $current_list = CategoryMiddle::where('name',$param['item_name'])->Paginate($page_size);
                }
                $parents_list = CategoryLarge::all();
                break;
            case Config::get('categorymode.small'):
                if(empty($param['item_name'])) {
                    $current_list = CategorySmall::Paginate($page_size);
                } else {
                    $current_list = CategorySmall::where('name',$param['item_name'])->Paginate($page_size);
                }
                $parents_list = CategoryMiddle::all();
                break;
        }
        return view('system/category_list',compact('user','category_mode','parents_list','current_list','page_size'));
    }
}
