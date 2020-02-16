<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\SQL\_501_SQL;
use Illuminate\Support\Facades\Auth;

class _5xx_InputMonthlyFixiedCostController extends Controller
{
    public function input_monthly_cost_get(Request $request){
        $user = Auth::user();

        if(isset($user)){
            $expenceList = _501_SQL::get_expence_list();
            $year = '2020';
            //----テキストボックスの初期値に現在の値を入力するためリストを作る。--


            //----------------------------------------------------------
            return view('501_input_monthly_cost',compact('expenceList','year'));
        }
        else{
            return redirect('login');
        }

    }

    public function input_monthly_cost_post(Request $request){
        $expenceList = _501_SQL::get_expence_list();
        $user_id = Auth::user()->id;
        $year = $request->year;
        $small_code = 0;
        $payment = 0;           //支払い金額をテキストボックスからループ処理で取得
        $str = "";              //リクエストで送られてきた文字列がテキストボックスからかどうか検査するのに使用する一時変数

        foreach($expenceList as $expence){
            $small_code = $expence->code;
            for( $month=1; $month<13; $month++){
                $str = 'code' . $small_code . 'm' . $month; 
                $payment = isset($request->$str) ?  $request->$str : 0 ;
                
                $update_num = _501_SQL::update_monthly_cost($user_id,$payment,$small_code,$year,$month);
                if($update_num == 0) {
                     _501_SQL::insert_monthly_cost($user_id,$payment,$small_code,$year,$month);
                }
            }
        }
        $expenceList = _501_SQL::get_expence_list();
        return view('501_input_monthly_cost',compact('expenceList','year'));
    }


}
