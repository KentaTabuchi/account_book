<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| 目次画面のコントローラー
|--------------------------------------------------------------------------
*/

class _1xx_IndexController extends Controller
{
    public function index_get(Request $requst){
        return view('101_index');
    }
}
