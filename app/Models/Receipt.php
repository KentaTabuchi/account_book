<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 *  家計簿テーブル(account_book)の1レコードをモデル化したクラス
 */
class Receipt extends Model
{
    protected $table = 'account_book';
    protected $primaryKey = 'id';
    protected $guarded = array('id');

    /**
     *  家計簿テーブルに新規レシートを登録する。
     *  @param $form リクエストパラメータ等から受け取ったフォームの入力値
     *  @return void
     */
    public function add($form) 
    {
        $this->balance_code = $form->category_balance;
        $this->large_code = $form->category_large;
        $this->middle_code = $form->category_middle;
        $this->small_code = $form->category_small;
        $this->memo = $form->memo;
        $this->pay_day = $form->pay_day;
        $this->payment = $form->payment;
        $this->created_at = Carbon::now();
        $this->user_id = Auth::user()->id;
        $this->save();
    }

    /**
     *  家計簿テーブルのレシートを編集する。
     *  @param $form DBから受け取ったフォームの入力値
     *  @return void
     */
    public function edit($form)
    {
        $this->pay_day = $form->pay_day;
        $this->balance_code = $form->category_balance;
        $this->large_code = $form->category_large;
        $this->middle_code = $form->category_middle;
        $this->small_code = $form->category_small;
        $this->memo = $form->memo;
        $this->payment = $form->payment;
        $this->updated_at = Carbon::now();
        $this->save();
    }

    /**
     *  当月の変動費の合計を取得する
     */
    public function scopeThisMonthVariable($query,$user_id)
    {
        return $query->where('large_code',22)
                     ->whereMonth('pay_day','=',Carbon::now()->month)
                     ->where('user_id',$user_id);
    }

    //================================================================
    //  account_bookテーブルから家計簿を全件取得する。
    //  
    //  A:account_table
    //  B:category_balance
    //  C:category_large
    //  D:category_middle
    //  E:category_small
    //  結合条件:コード番号
    //================================================================
    public static function select_account_book($user_id){
        $result = DB::select("
            SELECT
                 A.id 
                ,A.created_at
                ,A.updated_at
                ,A.pay_day
                ,A.payment
                ,A.memo
                ,B.name AS balance_name
                ,C.name AS large_name
                ,D.name AS middle_name 
                ,E.name AS small_name
            FROM
                account_book A
            LEFT OUTER JOIN
                category_balance B
            ON 
                A.balance_code = B.code
            LEFT OUTER JOIN
                category_large C
            ON
                A.large_code = C.code
            LEFT OUTER JOIN
                category_middle D
            ON
                A.middle_code = D.code
            LEFT OUTER JOIN
                category_small  E
            ON
                A.small_code = E.code
            INNER JOIN
                users U
            ON
                A.user_id = U.id
            WHERE 
                A.user_id = :user_id
            ORDER BY
                A.pay_day DESC

        ",['user_id' => $user_id]);
        return $result;
    }
    
    //================================================================
    //  account_bookテーブルから対象の費目(収支)の合計値を月毎に集計して返す
    //  
    //  対象テーブル
    //      A:account_table
    //      B:category_balance
    //  射影条件:
    //      費目、1月〜12月の集計列
    //  抽出条件:
    //      $year:集計する年
    //
    //================================================================
    public static function select_aggregate_balance($year,$code,$target_code,$user_id){
        $result = DB::select("

					SELECT
							  SUM(V.sum_payment) AS sum_payment
							 ,MONTH(V.pay_day) AS target_month
					FROM
							(
								SELECT 
									A.pay_day As pay_day,SUM(A.payment) AS sum_payment
								FROM 
									account_book A
								INNER JOIN 
									users U
								ON
									A.user_id = U.id
								WHERE 
									A.$target_code = :code
								AND
									A.user_id = :user_id
								GROUP BY 
									A.pay_day
							) AS V
					WHERE
								YEAR(V.pay_day) = :year
					GROUP BY
								MONTH(V.pay_day)
        ",['code' => $code,'year' => $year,'user_id' =>$user_id]);
        return $result;
		}
}
