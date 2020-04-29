<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBalance extends Model
{
    protected $table = 'category_balance';
    protected $primaryKey = 'code';
    protected $guarded = array('id');

    public function category_large()
    {
        return $this->hasMany('App\Models\CategoryLarge');
    }
}
