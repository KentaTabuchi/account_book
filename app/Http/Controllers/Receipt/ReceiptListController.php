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

        //レシートを全件、カテゴリー名を含めて取得する。
        $record = Receipt::from('receipts as A')
                    ->JoinCategoryCode()
                    ->SelectWithCategoryName()
                    ->where('user_id',$user->id)
                    ->orderBy('pay_day','desc')
                    ->get();

        return view('receipt_list',compact('record','user'));
    }
}
