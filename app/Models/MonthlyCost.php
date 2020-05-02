<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyCost extends Model
{
    protected $table = 'monthly_cost';
    protected $primaryKey = 'id';
    protected $guarded = array('id');

    public function category_small()
    {
        return $this->hasMany('App\Models\CategorySmall');
    }

    /**
     *  固定費年表の１マス分の金額を取得する。
     */
    public function scopeCell($query,$user_id,$year,$month,$small_code)
    {
        return $query->where('user_id',$user_id)
                     ->where('year',$year)
                     ->where('month',$month)
                     ->where('small_code',$small_code);
    }
}
