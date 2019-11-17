<?php
namespace App\Http\SQL\_201_index;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SQL{
    
    /**
     * 分類（収支）テーブルからコードと名前を全件取得
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
     *  分類（大）テーブルからコードと名前を全件取得
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
                category_balance.code = category_large.balance_code
            WHERE 
                category_large.balance_code = $code
        ");

        return $result;
    }
    /**
     *  分類（中）テーブルからコードと名前を全件取得
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
                category_large.code = category_middle.large_code
            WHERE 
                category_middle.large_code = $code
        ");

        return $result;
    }
    /**
     *  分類（小）テーブルからコードと名前を全件取得
     */
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
                category_middle.code = category_small.middle_code
            WHERE 
                category_small.middle_code = $code
        ");

        return $result;
    }
    /**
     * 分類（収支）名前を引数にコードを取得
     */
    public static function select_balance_code(string $name)
    {
        $result = DB::select("
            SELECT 
                code
            FROM
                category_balance
            WHERE
                name = '$name'
        ");

        return $result[0]->code;
    }
    /**
     * 分類（大）名前を引数にコードを取得
     */
    public static function select_large_code(string $name)
    {
        $result = DB::select("
            SELECT 
                code
            FROM
                category_large
            WHERE
                name = '$name'
        ");

        return $result[0]->code;
    }
    /**
     * 分類（中）名前を引数にコードを取得
     */
    public static function select_middle_code(string $name)
    {
        $result = DB::select("
            SELECT 
                code
            FROM
                category_middle
            WHERE
                name = '$name'
        ");

        return $result[0]->code;
    }
    /**
     * 分類（小）名前を引数にコードを取得
     */
    public static function select_small_code(string $name)
    {
        $result = DB::select("
            SELECT 
                code
            FROM
                category_small
            WHERE
                name = '$name'
        ");

        return $result[0]->code;
    }

}

