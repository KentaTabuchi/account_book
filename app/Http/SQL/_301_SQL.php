<?php
namespace App\Http\SQL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _301_SQL{
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

}

