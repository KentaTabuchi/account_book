<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
