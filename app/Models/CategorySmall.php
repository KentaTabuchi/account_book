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
     *  固定費に属する小分類のリストを取得する。
     */
    public function scopeFixedCost($query)
    {
        return $query->whereIn('middle_code',[211,212,213]);
    }
}
