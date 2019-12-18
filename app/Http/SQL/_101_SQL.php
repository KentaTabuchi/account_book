<?php
namespace App\Http\SQL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _101_SQL{
    //================================================================
    //  当月の変動費の合計を取得する
    //
    //================================================================

    public static function select_total_variable()
    {
        $result = DB::selectOne("
            SELECT 
                SUM(A.payment) AS total_cost
            FROM
                account_book A
            WHERE
                A.large_code = '22'
            AND
                MONTH(A.pay_day) =:month
        ",['month'=>Carbon::now()->month]);

        return $result;
    }
}

