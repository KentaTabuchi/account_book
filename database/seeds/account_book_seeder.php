<?php

use Illuminate\Database\Seeder;

class account_book_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
{
    DB::table('account_book')->delete();
    
    $params[0] = ['pay_day' => '2019-8-10' ,'payment' => '170000','balance_code' => '1' ,
    'large_code' => '11' ,'middle_code'=> '111','small_code' => '1111'];
    $params[1] = ['pay_day' => '2019-8-12' ,'payment' => '300','balance_code' => '2' ,
    'large_code' => '21' ,'middle_code'=> '212','small_code' => '2120'];
    $params[2] = ['pay_day' => '2019-9-16' ,'payment' => '1200','balance_code' => '2' ,
    'large_code' => '21' ,'middle_code'=> '212','small_code' => '2121'];
    $params[3] = ['pay_day' => '2020-5-3' ,'payment' => '6000','balance_code' => '2' ,
    'large_code' => '22' ,'middle_code'=> '222','small_code' => '2220'];
    $params[4] = ['pay_day' => '2020-7-6' ,'payment' => '400','balance_code' => '2' ,
    'large_code' => '22' ,'middle_code'=> '222','small_code' => '2221'];
    $params[5] = ['pay_day' => '2020-7-15' ,'payment' => '2200','balance_code' => '2' ,
    'large_code' => '22' ,'middle_code'=> '222','small_code' => '2222'];
    $params[0] = ['pay_day' => '2019-8-10' ,'payment' => '50000','balance_code' => '1' ,
    'large_code' => '11' ,'middle_code'=> '111','small_code' => '1112'];

    foreach($params as $param)
    {
        DB::Table('account_book')->insert($param);
    }
}
}
