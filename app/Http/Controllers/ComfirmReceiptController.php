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
        // $receipt = Receipt::find($request->id);
        $receipt = Receipt::from('receipts as A')
                           ->JoinCategoryCode()
                           ->SelectWithCategoryName()
                           ->where('user_id',$user->id)
                           ->where('A.id',$request->id)
                           ->first();
                // //レシートを全件、カテゴリー名を含めて取得する。
                // $record = Receipt::from('receipts as A')
                // ->JoinCategoryCode()
                // ->SelectWithCategoryName()
                // ->where('user_id',$user->id)
                // ->orderBy('pay_day','desc')
                // ->get();
        // dd($receipt);
        // //結果ページに名前で表示するため、分類名をコードから取得する。
        // $request->category_balance  = CategoryBalance::where('code',$request->category_balance)->first()->name;
        // $request->category_large = CategoryLarge::where('code',$request->category_large)->first()->name;
        // $request->category_middle = CategoryMiddle::where('code',$request->category_middle)->first()->name;
        // $request->category_small = CategorySmall::where('code',$request->category_small)->first()->name;

        return view('comfirm_receipt',compact('user','receipt','processmode'));
    }
}
