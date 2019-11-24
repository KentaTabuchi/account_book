<?php
namespace App\Http\SQL\_302_read_book_aggregate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SQL2{
    //================================================================
    //  account_bookテーブルから対象の費目(収支)の合計値を月毎に集計して返す
    //  
    //  対象テーブル
    //      A:account_table
    //      B:category_balance
    //  射影条件:
    //      費目、1月〜12月の集計列
    //  結合条件:
    //      コード番号
    //  抽出条件:
    //      $year:集計する年
    //
    //================================================================

    public static function select_aggregate_balance($year,$code){
        $result = DB::select("

					SELECT
							  SUM(V.sum_payment) AS sum_payment
							 ,MONTH(V.pay_day) AS sum_pay_day
					FROM
							(
								SELECT 
									A.pay_day As pay_day,SUM(A.payment) AS sum_payment
								FROM 
									account_book A
								WHERE 
									A.balance_code = :code
								GROUP BY 
									A.pay_day
							) AS V
					WHERE
								YEAR(V.pay_day) = :year
					GROUP BY
								MONTH(V.pay_day)
        ",['code' => $code,'year' => $year]);
        return $result;
    }

}

