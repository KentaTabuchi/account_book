<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\SQL\_301_read_book\SQL;
/*
|--------------------------------------------------------------------------
| 閲覧画面のコントローラー
|--------------------------------------------------------------------------
*/
class ReadBookController extends Controller
{
    public function read_book_get(Request $request){
        $record = SQL::select_account_book();

        return view('301_read_book',compact('record'));
    }
}
