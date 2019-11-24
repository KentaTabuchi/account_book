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
        $year=$request->year;
        $table_name = $request->table_name;

        $record_set = $this->get_aggregate_table($year,$table_name);
        return view('302_read_book_aggregate',compact('record_set','year'));
    }

    //1年分の年表を返す
    private function get_aggregate_table($year,$table_name){
        $list = DB::table($table_name)->get('code');
        $record_set = array();
        foreach($list as $item){
            $code = $item->code;
            $record = $this->get_record_unit($year,$code,$table_name);
            $record_set[] = $record;
        }
        return $record_set;
    }

    //コード1件分のレコードを返す。
    private function get_record_unit($year,$code,$table_name)
    {
        $target_code = str_replace('category_','',$table_name) . '_code';
        $record = SQL2::select_aggregate_balance($year,$code,$target_code);
        $name = DB::table($table_name)->where('code',$code)->get('name')->first()->name;
        $result = [
             'name'=>''
            ,'m1'=>0
            ,'m2'=>0
            ,'m3'=>0
            ,'m4'=>0
            ,'m5'=>0
            ,'m6'=>0
            ,'m7'=>0
            ,'m8'=>0
            ,'m9'=>0
            ,'m10'=>0
            ,'m11'=>0
            ,'m12'=>0
        ];
        $result['name'] = $name;
        foreach($record as $item){
            $month = $item->target_month;
            $result['m'.$month] = $item->sum_payment;
        }
        return $result;
    }
}
