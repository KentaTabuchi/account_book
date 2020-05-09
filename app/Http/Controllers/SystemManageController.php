<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;

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
        return view('/system/system_menu',compact('user'));

    }

    /**
     * 分類項目管理画面の表示
     */
    public function manage_category_get(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        //どの分類の設定にするかを取得
        $category_name = $request->category_name;

        //対象のリストと親分類のリストを取得
        $current_list = null;
        $parents_list = null;
        switch($category_name) {
            case 'large':
                $carrent_list = CategoryLarge::all();
                $parents_list = CategoryBalance::all();
                break;
            case 'middle':
                $carrent_list = CategoryMiddle::all();
                $parents_list = CategoryLarge::all();
                break;
            case 'small':
                $carrent_list = CategorySmall::all();
                $parents_list = CategoryMiddle::all();
                break;
        }

        return view('/system/manage_category',compact('user','category_name','parents_list','carrent_list'));
    }
}
