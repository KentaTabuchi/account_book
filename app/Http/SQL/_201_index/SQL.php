<?php
namespace App\Http\SQL\_201_index;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SQL{
    
    /**
     * 収支テーブルからコードと名前を全件取得
     */
    public static function select_balance()
    {
        $result = DB::select("
            SELECT 
                code,name
            FROM
                category_balance
        ");

        return $result;
    }
    /**
     *  
     */
    public static function select_large(string $code)
    {
        $result = DB::select("
            SELECT 
                category_large.code,category_large.name
            FROM
                category_large
            INNER JOIN
                category_balance
            ON
                category_balance.code = $code
        ");

        return $result;
    }
        /**
     *  
     */
    public static function select_middle(string $code)
    {
        $result = DB::select("
            SELECT 
                category_middle.code,category_middle.name
            FROM
                category_middle
            INNER JOIN
                category_large
            ON
                category_large.code = $code
        ");

        return $result;
    }
    public static function select_small(string $code)
    {
        $result = DB::select("
            SELECT 
                category_small.code,category_small.name
            FROM
                category_small
            INNER JOIN
                category_middle
            ON
                category_middle.code = $code
        ");

        return $result;
    }
}