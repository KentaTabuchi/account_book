<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * 予算を表すクラス
 */
class Budget extends Model
{
    protected $table = 'budget';
    protected $primaryKey = 'id';
    protected $guarded = array('id');
    
    /**
     * 当月に絞り込むwhere句
     */
    public function scopeThisMonth($query,$user_id)
    {
        return $query->where('year',Carbon::now()->year)
                     ->where('month',Carbon::now()->month)
                     ->where('user_id',$user_id);
    }

    /**
     * 引数で指定した年月に絞り込むwhere句
     */
    public function scopeTargetMonth($query,$year,$month,$user_id)
    {
        return $query->where('year',$year)
                     ->where('month',$month)
                     ->where('user_id',$user_id);
    }
}
