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
     * トップページの表示
     */
    public function index_get(Request $requst){
        $user = Auth::user();

        if(isset($user)){
            return view('101_index',compact('user'));
        }
        else{
            return redirect('login');
        }
    }
    /**
     * 当月の変動費をjsonにして返すAPI
     */
    public function json_total_cost(Request $requst){
        $total_cost = _101_SQL::select_total_variable();
        $total_cost = json_encode($total_cost,JSON_UNESCAPED_UNICODE);
        return $total_cost;
    }
}
