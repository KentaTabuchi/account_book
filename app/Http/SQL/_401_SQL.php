<?php
namespace App\Http\SQL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _401_SQL{
			//================================================================
    //  budgetテーブルから月毎の変動費を取り出す
    //  
    //================================================================

    public static function select_budget($year,$month,$user_id){
			$result = DB::selectOne("
				SELECT
					A.budget
				FROM
					budget A
				WHERE
						A.year = :year
				AND A.month =:month
				AND A.user_id =:id

			",[$year,$month,$user_id]);
			return $result;
	}
		//================================================================
    //  budgetテーブルに月毎の変動費を新規挿入
    //  
    //================================================================

    public static function insert_budget($year,$month,$budget,$user_id){
			$result = DB::insert("
				INSERT INTO  
					budget
				(
					year
					,month
					,budget
					,user_id
				)
				VALUES
					(?,?,?,?)

			",[$year,$month,$budget,$user_id]);
			return $result;
	}
    //================================================================
    //  budgetテーブルに月毎の変動費を更新する
    //  
    //================================================================

    public static function update_budget($year,$month,$budget,$user_id){
        $result = DB::update("
					UPDATE 
						budget A 
					SET 
						A.budget = :budget
					WHERE 
							A.year = :year
					AND A.month = :month
					AND A.user_id = :user_id

        ",['budget' => $budget,'year' => $year,'month' =>$month,'user_id' =>$user_id]);
        return $result;
		}

}

