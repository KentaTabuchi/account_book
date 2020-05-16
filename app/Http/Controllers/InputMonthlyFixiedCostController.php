<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategorySmall;
use App\Models\CategoryMiddle;
use App\Models\MonthlyCost;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Config;

class InputMonthlyFixiedCostController extends Controller
{

    public function input_monthly_cost_get(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        $year = empty($request->year) ?  Carbon::now()->year : $request->year;
        
        //large_codeが固定費の小分類リストを取得する。
        $expenceList = $this->get_fixed_cost_small_category_list();

        //テキストボックスの初期値に現在の値を入力するためリストを作る。
        $valuesList = array();
        
            //固定費の小分類ごとに繰り返し(一覧表の縦軸)
            foreach($expenceList as $expence){

                $values['small_code'] = $expence->code;
                //項目名ラベル用に名前を取得
                $values['name'] = $expence->name;

                //対象の小分類の１２ヶ月分の固定費を取得する。(一覧表の横軸)
                for($month = 1 ; $month < 13; $month++) {
                    //1月分の支払い金額を取得して、HTMLのname属性用にキーを生成して代入する。
                    $monthly_cost = MonthlyCost::Cell($user->id,$year,$month,$expence->code)->first();
                    $values['m_'.$month] = $monthly_cost != null ? $monthly_cost->payment : 0;  
                }

                //完成した横一行分のデータを一覧表に追加する。
                $valuesList[] = $values;
            }

            return view('input_monthly_cost',compact('valuesList','year','user'));
    }

    public function input_monthly_cost_post(Request $request){
        //ログイン中のユーザ情報を取得
        $user = Auth::user();
        
        //小分類から固定費の費目を取得する。
        $expenceList = $this->get_fixed_cost_small_category_list();
        
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
                $monthly_cost->save();
            }
        }

        return redirect('input_monthly_cost');
    }

    /**
     *  large_codeが固定費の小分類だけを取り出してリストにして返却する。
     *  @return large_codeが固定費の小分類リスト
     */
    private function get_fixed_cost_small_category_list() {
        //小分類を一旦全て取得する。
        $smallCategoryList = CategorySmall::all();
        $expenceList = [];

        //large_codeが固定費の小分類だけを取り出してリストに詰め直す。
        foreach($smallCategoryList as $smallCategory) {
            $middleCategory = CategoryMiddle::where('code',$smallCategory->middle_code)->first();

            if($middleCategory != null && $middleCategory->large_code == Config::get('category_code.fixed_cost')) {
                $expenceList[] = $smallCategory;
            }
        }
        
        return $expenceList;
    }
}
