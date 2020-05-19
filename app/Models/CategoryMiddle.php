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

    /**
     *  フォームの入力値をCategoryMiddleインスタンスへ詰め込む
     *  @param $form フォームの入力値
     *  @return void
     */
    public function fillForm($form)
    {   
        if(isset($form->code)) {
            $this->code = $form->code;
        }
        $this->large_code = $form->category_large;
        $this->category_name = $form->category_name; 
    }
}
