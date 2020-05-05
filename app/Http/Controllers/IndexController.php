<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Receipt;
use App\Models\Budget;

/*
|--------------------------------------------------------------------------
| 目次画面のコントローラー
|--------------------------------------------------------------------------
*/

class IndexController extends Controller
{

    /**
     * トップページの表示
     */
    public function index_get(Request $requst){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        return view('index',compact('user'));

    }
    /**
     * 当月の変動費をjsonにして返すAPI
     */
    public function json_total_cost(Request $requst){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        //変動費の合計額を取得する。
        $receipt = Receipt::ThisMonthVariable($user->id)->get()->sum("payment");
        
        //js用にエンコードする。
        $total_cost = json_encode($receipt,JSON_UNESCAPED_UNICODE);
        
        return $total_cost;
    }
    /**
     * 当月の変動費予算をjsonにして返すAPI
     * @return 当月の予算一覧
     */
    public function json_budget_cost(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        //当月の予算を取得する。
        $budget = Budget::ThisMonth($user->id)->first();

        //エンコードする。
        $budget_encoded = json_encode($budget->budget,JSON_UNESCAPED_UNICODE);

        return $budget_encoded;
    }
}
