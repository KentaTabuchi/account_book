<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMiddle extends Model
{
    protected $table = 'category_middle';
    protected $primaryKey = 'code';
    protected $guarded = array('id');

    /**
     * CategoryMiddleとリレーションシップする。
     * @return CategoryBlanceとの連携データ
     */
    public function category_large()
    {
        return $this->belongsTo('App\Models\CategoryLarge','large_code','code');
    }
}
