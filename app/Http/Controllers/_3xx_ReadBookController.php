<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Receipt;
use Illuminate\Support\Facades\Auth;

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
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //レシートを全件、カテゴリー名を含めて取得する。
        $record = Receipt::from('receipts as A')
                    ->JoinCategoryCode()
                    ->SelectWithCategoryName()
                    ->where('user_id',$user->id)
                    ->orderBy('pay_day','desc')
                    ->get();

        return view('301_read_book',compact('record','user'));
    }
/*
|--------------------------------------------------------------------------
| 302:月毎に集計した年表を表示する画面
|--------------------------------------------------------------------------
*/
    public function read_book_aggregate_get(Request $request){
        //ログイン中のユーザーを取得
        $user = Auth::user();

        $year = $request->year;
        $table_name = $request->table_name;

        $record_set = $this->get_aggregate_table($year,$table_name);
        return view('302_read_book_aggregate',compact('record_set','year','user'));
    }

    /**
     *  1年分の年表を返す
     */
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

    /**
     *  年表の一行分を返す。
     */
    private function get_record_unit($year,$code,$table_name)
    {
        //ログイン中のユーザーを取得
        $user_id = Auth::user()->id;

        //どの分類について集計するかを設定する。
        $category_type = str_replace('category_','',$table_name) . '_code';

        //項目名を取得する。
        $name = DB::table($table_name)->where('code',$code)->get('name')->first()->name;
        $result['name'] = $name;

        //対象の分類項目の支払額を月別に集計した結果を取得する。
        $aggregate_payment = Receipt::where('user_id',$user_id)
                         ->where($category_type,$code)
                         ->whereYear('pay_day',$year)
                         ->select(DB::raw('Month(pay_day) as target_month,SUM(payment) as sum_payment'))
                         ->groupBy(DB::raw('Month(pay_day)'))
                         ->get();

        //代入前に初期化する。
        for($month = 1; $month < 13; $month++) {
            $result['m'.$month] = '-';
        }
        
        //集計結果が存在した月の合計金額をbladeに渡す。
        foreach($aggregate_payment as $item){
            for($month = 1; $month < 13; $month++) {
                $result['m'.$month] =  $month == $item->target_month ? $item->sum_payment : '-';
            }
        }

        return $result;
    }
}
