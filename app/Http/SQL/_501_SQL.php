<?php
namespace App\Http\SQL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _501_SQL{
    
    //================================================================
    //  セレクトボックスに入れるリストを取得する
    //
    //================================================================
    /**
     * 分類（小）テーブルからコードと名前を全件取得
     */
    public static function get_expence_list()
    {
        $result = DB::select("
            SELECT 
                code,name
            FROM
                category_small
        ");

        return $result;
    }
    //================================================================
    //  テキストボックスから取得した月別固定費の年表金額をDBに登録する。
    //
    //================================================================

    public static function insert_expence_list($payment,$small_code,$year,$month)
    {
        $result = DB::insert("
            INSERT INTO
                monthly_cost
            (
                 payment
                ,small_code
                ,year
                ,month
            )
            VALUES
                (?,?,?,?)
        ",[$payment,$small_code,$year,$month]);

        return $result;
    }

    //================================================================
    //  テキストボックスから取得した月別固定費の年表金額を更新する。
    //
    //================================================================

    public static function update_expence_list($payment,$small_code,$year,$month)
    {
        $result = DB::update("
            UPDATE 
                monthly_cost
            SET 
                payment = :payment
            WHERE
                small_code = :small_code
              AND
                year = :year
              AND
                month = :month
        ",[$payment,$small_code,$year,$month]);

        return $result;
    }

}

