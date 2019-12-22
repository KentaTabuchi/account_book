<?php
namespace App\Http\SQL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _101_SQL{
    //================================================================
    //  当月の変動費の合計を取得する
    //
    //================================================================

    public static function select_total_variable($user_id)
    {
        $result = DB::selectOne("
            SELECT 
                SUM(A.payment) AS total_cost
            FROM
                account_book A
            WHERE
                A.large_code = '22'
            AND MONTH(A.pay_day) =:month
            AND A.user_id =:user_id

        ",['month'=>Carbon::now()->month,'user_id'=>$user_id]);

        return $result;
    }
    //================================================================
    //  当月の変動費の予算を取得する
    //
    //================================================================

    public static function select_budget_variable($user_id)
    {
        $result = DB::selectOne("
            SELECT 
                A.budget AS budget_cost
            FROM
                budget A
            WHERE
                A.year =:year
            AND A.month =:month
            AND A.user_id =:user_id
            
        ",['year'=>Carbon::now()->year,'month'=>Carbon::now()->month,'user_id'=>$user_id]);
        return $result;
    }
}

