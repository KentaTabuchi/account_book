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
        $params[111] = ['code' => '111' ,'name' => '給料' ,'large_code' => '11'];
        //一時金
        $params[121] = ['code' => '121' ,'name' => '株式','large_code' => '12'];
        $params[122] = ['code' => '122' ,'name' => 'お小遣い','large_code' => '12'];
        //固定費
        $params[211] = ['code' => '211' ,'name' => '税金 保険 年金' ,'large_code' => '21'];
        $params[212] = ['code' => '212' ,'name' => '公共料金 家賃','large_code' => '21'];
        $params[213] = ['code' => '213' ,'name' => 'その他の固定費','large_code' => '21'];
        //変動費
        $params[221] = ['code' => '221' ,'name' => '食費' ,'large_code' => '22'];
        $params[222] = ['code' => '222' ,'name' => '雑貨・本・家具・家電等','large_code' => '22'];
        $params[223] = ['code' => '223' ,'name' => '交通費','large_code' => '22'];
        $params[224] = ['code' => '224' ,'name' => '医療費','large_code' => '22'];
        $params[225] = ['code' => '225' ,'name' => 'その他サービス','large_code' => '22'];
        $params[226] = ['code' => '226' ,'name' => '祭事 イベント','large_code' => '22'];


        foreach($params as $param)
        {
            DB::Table('category_middle')->insert($param);
        }
    }
}
