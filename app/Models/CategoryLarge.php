<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryLarge extends Model
{
    protected $table = 'category_large';
    protected $primaryKey = 'code';
    protected $guarded = array('id');

    /**
     * CategoryBalanceとリレーションシップする。
     * @return CategoryBlanceとの連携データ
     */
    public function category_balance()
    {
        return $this->belongsTo('App\Models\CategoryBalance');
    }
}
