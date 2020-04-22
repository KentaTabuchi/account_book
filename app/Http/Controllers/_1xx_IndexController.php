<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\SQL\_101_SQL;

/*
|--------------------------------------------------------------------------
| 目次画面のコントローラー
|--------------------------------------------------------------------------
*/

class _1xx_IndexController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        //ログインしていない場合ログインページにリダイレクトする。
        $this->middleware('auth');
    }
    
    /**
     * トップページの表示
     */
    public function index_get(Request $requst){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        return view('101_index',compact('user'));

    }
    /**
     * 当月の変動費をjsonにして返すAPI
     */
    public function json_total_cost(Request $requst){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        $total_cost = _101_SQL::select_total_variable($user->id);
        $total_cost = json_encode($total_cost,JSON_UNESCAPED_UNICODE);
        
        return $total_cost;
    }
    /**
     * 当月の変動費予算をjsonにして返すAPI
     */
    public function json_budget_cost(Request $request){
        $user = Auth::user();
        $budget_cost = _101_SQL::select_budget_variable($user->id);
        $budget_cost = json_encode($budget_cost,JSON_UNESCAPED_UNICODE);
        return $budget_cost;
    }
}
