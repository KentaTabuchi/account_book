<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Budget;
use App\Http\Requests\_401_ValidatedRequest;


/*
|--------------------------------------------------------------------------
| 月別の変動費予算を設定する画面のコントローラー
|--------------------------------------------------------------------------
*/
class _4xx_EditBudgetController extends Controller
{
    /**
     *  401: 月別の変動費予算を入力する画面のアクション
     */
    public function edit_budget_get(Request $request)
    {
        //ログインのユーザ情報を取得
        $user = Auth::user();

        $user_id = $user->id;
        $year = $request->year;
        $budgets = array();
        
        //１２ヶ月分の変動費予算を取得
        for($i=1;$i<13;$i++){
            $month = $i;
            
            //引数に指定した年月の予算金額を取得する。
            $budget = Budget::TargetMonth($year,$month,$user_id)->first();

            //対象の年月に値がなかった場合初期値を代入。
            $budget_price = isset($budget) ? $budget->budget : 0;

            $budgets[$i] = $budget_price;
        }

        return view('401_edit_budget',compact('year','budgets','user'));
    }

    /**
     *  402: 処理完了画面アクション。
     */
    public function edit_budget_post(_401_ValidatedRequest $request)
    {
        //ログイン中のユーザ情報を取得
        $user = Auth::user();

        $year = $request->year;
        $user_id = $user->id;

        for($i=1;$i<13;$i++){
            $month=$i;
            $budget_price = isset($request->{'budget_'.$i}) ? $request->{'budget_'.$i} : 0;

            //対象の年月の予算インスタンスを呼び出す。
            $budget = Budget::TargetMonth($year,$month,$user_id)->first();
            
            //予算インスタンスがなかった場合は新規作成する。
            if(!isset($budget))
            {
                $budget = new Budget;
            }

            //入力値をDBへ保存する。
            $budget->fill(['year'=>$year,'month'=>$month,'user_id'=>$user_id,'budget'=>$budget_price]);
            $budget->save();
        }

        //１２ヶ月分の変動費予算を取得
        for($i=1;$i<13;$i++){
            $month = $i;

            //引数に指定した年月の予算金額を取得する。
            $budget = Budget::TargetMonth($year,$month,$user_id)->first();

            $budgets[$i] = $budget->budget;
        }

            return view('402_edit_budget_result',compact('year','budgets','user'));          
        }
    }

