<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\SQL\_301_read_book\SQL;
use App\Http\SQL\_302_read_book_aggregate\SQL2;
/*
|--------------------------------------------------------------------------
| 閲覧画面のコントローラー
|--------------------------------------------------------------------------
*/
class _3xx_ReadBookController extends Controller
{
/*
|--------------------------------------------------------------------------
| 301: 1件ごとのデータ一覧を表示する画面
|--------------------------------------------------------------------------
*/
    public function read_book_get(Request $request){
        $record = SQL::select_account_book();

        return view('301_read_book',compact('record'));
    }
/*
|--------------------------------------------------------------------------
| 302:月毎に集計した年表を表示する画面
|--------------------------------------------------------------------------
*/
    public function read_book_aggregate_get(Request $request){
        $year=2020;
        $code=2;
        $record = SQL2::select_aggregate_balance($year,$code);
        dd($record);
        return view('302_read_book_aggregate',compact('record'));
    }
}
