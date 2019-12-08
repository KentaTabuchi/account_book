<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('user_id');         //ユーザーID
            $table->date('pay_day');            //支払日
            $table->integer('payment');         //支払い額
            $table->integer('balance_code');    //収入か支出か
            $table->integer('large_code');      //大分類 固定費か変動費か
            $table->integer('middle_code');     //中分類
            $table->integer('small_code');      //小分類
            $table->string('memo')->nullable(); //備考
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_book');
    }
}
