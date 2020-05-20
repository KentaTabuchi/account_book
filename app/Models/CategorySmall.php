<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySmall extends Model
{
    protected $table = 'category_small';
    protected $primaryKey = 'code';
    protected $guarded = array('id','code');
    /**
     * CategorySmallとリレーションシップする。
     * @return CategorySmallとの連携データ
     */
    public function category_middle()
    {
        return $this->belongsTo('App\Models\CategorySmall','middle_code','code');
    }

    /**
     *  固定費に属する小分類のリストを取得する。
     */
    public function scopeFixedCost($query)
    {
        return $query->whereIn('middle_code',[211,212,213]);
    }

    /**
     *  フォームの入力値をCategorySmallインスタンスへ詰め込む
     *  @param $form フォームの入力値
     *  @return void
     */
    public function fillForm($form)
    {   
        if(isset($form->code)) {
            $this->code = $form->code;
        }
        $this->middle_code = $form->middle_code;
        $this->code = self::all()->last()->code + 1;
        $this->name = $form->name;
    }
}
