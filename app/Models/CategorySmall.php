<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySmall extends Model
{
    protected $table = 'category_small';
    protected $primaryKey = 'code';
    protected $guarded = array('id');

    /**
     * CategorySmallとリレーションシップする。
     * @return CategorySmallとの連携データ
     */
    public function category_small()
    {
        return $this->belongsTo('App\Models\CategorySmall');
    }

    /**
     * 
     */
    public function scopeFixedCost($query)
    {
        return $query->whereIn('middle_code',[211,212,213]);
    }
    //     /**
    //  * 分類（小）テーブルからコードと名前を全件取得
    //  */
    // public static function get_expence_list()
    // {
    //     $result = DB::select("
    //         SELECT 
    //             code,name
    //         FROM
    //             category_small
    //         WHERE
    //             middle_code in ('211','212','213')
    //     ");

    //     return $result;
    // }
}
