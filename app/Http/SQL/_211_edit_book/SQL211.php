<?php
namespace App\Http\SQL\_211_edit_book;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SQL211{
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
    //  セレクトボックスで選択された名称からコード番号を取得する
    //
    //================================================================
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
    //================================================================
    //  前回データをラベル用に取得
    //  
    //================================================================
    public static function select_old_data_for_label($id)
    {
        $result = DB::selectone("
            SELECT 
				 A.id
				,A.pay_day
				,B.name as balance_name
				,C.name as large_name
				,D.name as middle_name
				,E.name as small_name
				,A.memo
				,A.payment
			FROM
				 account_book A
			LEFT JOIN
				category_balance B
			ON
				A.balance_code = B.code
			LEFT JOIN
				category_large C
			ON 
				A.large_code = C.code
			LEFT JOIN
				category_middle D
			ON 
				A.middle_code = D.code
			LEFT JOIN
				category_small E
			ON
				A.small_code = E.code
			WHERE
				A.id = :id
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

