<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategorySmall;
use App\Models\MonthlyCost;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class _5xx_InputMonthlyFixiedCostController extends Controller
{

    public function input_monthly_cost_get(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        $year = empty($request->year) ?  Carbon::now()->year : $request->year;
        
        //小分類から固定費の費目を取得する。
        $expenceList = CategorySmall::FixedCost()->get();
        
        $valuesList = array();//テキストボックスの初期値に現在の値を入力するためリストを作る。
        
            //固定費の小分類ごとに繰り返し(一覧表の縦軸)
            foreach($expenceList as $expence){

                $values['small_code'] = $expence->code;
                $values['name'] = $expence->name;

                //対象の小分類の１２ヶ月分の固定費を取得する。(一覧表の横軸)
                for($month = 1 ; $month < 13; $month++) {
                    //1月分の支払い金額を取得して、HTMLのname属性用にキーを生成して代入する。
                    $values['m_'.$month] = 
                      MonthlyCost::Cell($user->id,$year,$month,$expence->code)->first()->payment;
                }

                //完成した横一行分のデータを一覧表に追加する。
                $valuesList[] = $values;
            }

            return view('501_input_monthly_cost',compact('valuesList','year','user'));
    }

    public function input_monthly_cost_post(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();
        
        //小分類から固定費の費目を取得する。
        $expenceList = CategorySmall::FixedCost()->get();
        
        $user_id = $user->id;
        $year = $request->year;
        $small_code = 0;
        $payment = 0;           
        $str = "";              
        
        //支払い金額をテキストボックスからループ処理で取得
        foreach($expenceList as $expence){
            $small_code = $expence->code;
            for( $month=1; $month<13; $month++){

                //リクエストで送られてきた文字列がテキストボックスからかどうか検査する。
                $str = 'code' . $small_code . 'm' . $month; 
                $payment = isset($request->$str) ?  $request->$str : 0 ;
                
                //編集対象のセルの参照を取得する。
                $monthly_cost = MonthlyCost::Cell($user->id,$year,$month,$small_code)->first();
                
                //対象のセルのデータがDBにない場合は新規作成する。
                if(!isset($monthly_cost)) {
                    $monthly_cost = new MonthlyCost;
                }

                //フォームの値をDBへ保存する。
                $monthly_cost->fill(['year'=>$year,'month'=>$month,'user_id'=>$user->id,'payment'=>$payment,
                    'small_code' => $small_code]);
                    // dd($monthly_cost);
                $monthly_cost->save();
            }
        }

        return redirect('input_monthly_cost');
    }
}
