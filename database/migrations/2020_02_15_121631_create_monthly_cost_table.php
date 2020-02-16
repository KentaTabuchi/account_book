<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_cost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('year');            //支払い年
            $table->integer('month');           //支払い月
            $table->integer('small_code');      //小分類
            $table->integer('payment');         //支払額
            $table->integer('user_id');         //ユーザーID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_cost');
    }
}
