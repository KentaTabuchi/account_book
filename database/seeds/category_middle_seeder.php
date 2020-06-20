<?php

use Illuminate\Database\Seeder;

class category_middle_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_middle')->delete();
        //固定給
        $params[1] = ['code' => '1' ,'name' => '給料' ,'large_code' => '1'];
        //一時金
        $params[2] = ['code' => '2' ,'name' => '株式','large_code' => '2'];
        $params[3] = ['code' => '3' ,'name' => 'お小遣い','large_code' => '2'];
        //固定費
        $params[4] = ['code' => '4' ,'name' => '税金 保険 年金' ,'large_code' => '3'];
        $params[5] = ['code' => '5' ,'name' => '公共料金 家賃','large_code' => '3'];
        $params[6] = ['code' => '6' ,'name' => 'その他の固定費','large_code' => '3'];
        //変動費
        $params[7] = ['code' => '7' ,'name' => '食費' ,'large_code' => '4'];
        $params[8] = ['code' => '8' ,'name' => '雑貨・本・家具・家電等','large_code' => '4'];
        $params[9] = ['code' => '9' ,'name' => '交通費','large_code' => '4'];
        $params[10] = ['code' => '10' ,'name' => '医療費','large_code' => '4'];
        $params[11] = ['code' => '11' ,'name' => 'その他サービス','large_code' => '4'];
        $params[12] = ['code' => '12' ,'name' => '祭事 イベント','large_code' => '4'];


        foreach($params as $param)
        {
            DB::Table('category_middle')->insert($param);
        }
    }
}
