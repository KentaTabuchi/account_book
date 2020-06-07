<?php

namespace App\Http\Controllers\Receipt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

/**
 *  レシート一覧を閲覧するクラス
 */
class ReceiptListController extends Controller
{
    /**
     *  条件に合致するレシート一覧を出力する。
     */
    public function receipt_list_get(Request $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //1ページに表示するレコード数を取得
        $page_size = 20;
        $page_size = $request->page_size;
        
        //レシートを全件、カテゴリー名を含めて取得する。
        $receipts = Receipt::from('receipts as A')
                    ->JoinCategoryCode()
                    ->SelectWithCategoryName()
                    ->where('user_id',$user->id)
                    ->orderBy('pay_day','desc')
                    ->Paginate($page_size);
                    
        return view('receipt_list',compact('receipts','user','page_size'));
    }
}
