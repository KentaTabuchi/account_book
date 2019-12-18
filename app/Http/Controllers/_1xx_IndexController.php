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
    public function index_get(Request $requst){
        $user = Auth::user();
        if(isset($user)){
            return view('101_index',compact('user'));
        }
        else{
            return redirect('login');
        }
    }

    public function json_total_cost(Request $requst){
        dd(_101_SQL::select_total_variable());
        $balance_code_encorded = json_encode($balance_code,JSON_UNESCAPED_UNICODE);
        return $balance_code_encorded;
    }
}
