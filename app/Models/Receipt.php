<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 *  家計簿テーブル(account_book)の1レコードをモデル化したクラス
 */
class Receipt extends Model
{
    protected $table = 'receipts';
    protected $primaryKey = 'id';
    protected $guarded = array('id');

    private $balance_name;
    private $large_name;
    private $middle_name;
    private $small_name;

    /**
     *  家計簿テーブルに新規レシートを登録する。
     *  @param $form リクエストパラメータ等から受け取ったフォームの入力値
     *  @return void
     */
    public function add($form) 
    {
        $this->balance_code = $form->category_balance;
        $this->large_code = $form->category_large;
        $this->middle_code = $form->category_middle;
        $this->small_code = $form->category_small;
        $this->memo = $form->memo;
        $this->pay_day = $form->pay_day;
        $this->payment = $form->payment;
        $this->created_at = Carbon::now();
        $this->user_id = Auth::user()->id;
    }

    /**
     *  フォームの入力値をReceiptインスタンスへ詰め込む
     *  @param $form フォームの入力値
     *  @return void
     */
    public function fillForm($form)
    {   
        if(isset($form->id)) {
            $this->id = $form->id;
        }
        $this->pay_day = $form->pay_day;
        $this->balance_code = isset($form->category_balance) ? $form->category_balance :$form->balance_code;
        $this->large_code = isset($form->category_balance) ? $form->category_large :$form->large_code;
        $this->middle_code = isset($form->category_balance) ? $form->category_middle :$form->middle_code;
        $this->small_code = isset($form->category_balance) ? $form->category_small :$form->small_code; 
        $this->memo = $form->memo;
        $this->payment = $form->payment;
        $this->updated_at = Carbon::now();
    }

    /**
     *  当月の変動費の合計を取得する
     */
    public function scopeThisMonthVariable($query,$user_id)
    {
        return $query->where('large_code',22)
                     ->whereMonth('pay_day','=',Carbon::now()->month)
                     ->where('user_id',$user_id);
    }
    /**
     *  各種 category table を連結する。
     */
    public function scopeJoinCategoryCode($query)
    {
        return $query->join('category_balance as B','A.balance_code','=','B.code')
                     ->join('category_large as C','A.large_code','=','C.code')
                     ->join('category_middle as D','A.middle_code','=','D.code')
                     ->join('category_small as E','A.small_code','=','E.code');
    }

    /**
     *  分類コードに対応する名前をエイリアスとしてカラムに追加する。
     */
    public function scopeSelectWithCategoryName($query)
    {
        return $query->select('A.id as id'
                             ,'A.memo'
                             ,'A.payment'
                             ,'A.pay_day'
                             ,'B.name as balance_name'
                             ,'C.name as large_name'
                             ,'D.name as middle_name'
                             ,'E.name as small_name');
    }
}
