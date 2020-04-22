<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\SQL\_501_SQL;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class _5xx_InputMonthlyFixiedCostController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        //ログインしていない場合ログインページにリダイレクトする。
        $this->middleware('auth');
    }

    public function input_monthly_cost_get(Request $request){
        $user = Auth::user();

        $year = empty($request->year) ?  Carbon::now()->year : $request->year;
        $expenceList = _501_SQL::get_expence_list();
        $valuesList = array();//テキストボックスの初期値に現在の値を入力するためリストを作る。
        
            foreach($expenceList as $expence){
                $small_code = $expence->code;
                $name = $expence->name;
                $values = [
                    'small_code' => $small_code
                    ,'name' => $name
                    , 'm_1' => _501_SQL::get_payment($user->id,$year, 1,$small_code)
                    , 'm_2' => _501_SQL::get_payment($user->id,$year, 2,$small_code)
                    , 'm_3' => _501_SQL::get_payment($user->id,$year, 3,$small_code)
                    , 'm_4' => _501_SQL::get_payment($user->id,$year, 4,$small_code)
                    , 'm_5' => _501_SQL::get_payment($user->id,$year, 5,$small_code)
                    , 'm_6' => _501_SQL::get_payment($user->id,$year, 6,$small_code)
                    , 'm_7' => _501_SQL::get_payment($user->id,$year, 7,$small_code)
                    , 'm_8' => _501_SQL::get_payment($user->id,$year, 8,$small_code)
                    , 'm_9' => _501_SQL::get_payment($user->id,$year, 9,$small_code)
                    ,'m_10' => _501_SQL::get_payment($user->id,$year,10,$small_code)
                    ,'m_11' => _501_SQL::get_payment($user->id,$year,11,$small_code)
                    ,'m_12' => _501_SQL::get_payment($user->id,$year,12,$small_code)

                ];
                $valuesList[] = $values;
            }
            return view('501_input_monthly_cost',compact('valuesList','year'));

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

        return redirect('input_monthly_cost');
    }
}
