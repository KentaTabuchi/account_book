<?php
namespace App\Http\SQL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _211_SQL{
    //================================================================
    //  セレクトボックスに入れるリストを取得する
    //
    //================================================================
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
    //================================================================
    //  セレクトボックスで選択された分類コードから分類名を取得する
    //
    //================================================================
    /**
     * @param $category: 取得する分類グループ
     * @param $code: 分類コード
     * @result 分類名   
     */
    public static function get_category_name_by_code(string $category,string $code)
    {
        $result = DB::selectOne("
            SELECT 
                name
            FROM
                category_$category
            WHERE
                code = :code
        ",['code' => $code]);

        return $result->name;
    }
    //================================================================
    //  前回データを取得
    //  
    //================================================================
    public static function get_old_data($id)
    {
        $result = DB::selectone("
            SELECT 
				 id
				,pay_day
				,balance_code
				,large_code
				,middle_code
				,small_code
				,memo
				,payment
			FROM
				 account_book
			WHERE
				id = :id
            ",['id' => $id]);

            return $result;
    }


    //================================================================
    //  コード番号を引数にして入力データを登録
    //
    //================================================================

    public static function insert_to_account_book(
        $balance_code
        ,$large_code
        ,$middle_code
        ,$small_code
        ,$memo
        ,$pay_day
        ,$payment
        ,$created_at
    )
    {
        $result = DB::insert("
            INSERT INTO 
                account_book
            (
                 balance_code
                ,large_code
                ,middle_code
                ,small_code
                ,memo
                ,pay_day
                ,payment
                ,created_at
            ) 
            VALUES(?,?,?,?,?,?,?,?)
        ",[
             $balance_code
            ,$large_code
            ,$middle_code
            ,$small_code
            ,$memo
            ,$pay_day
            ,$payment
            ,$created_at
        ]);
    }
}

