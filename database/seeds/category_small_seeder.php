<?php

use Illuminate\Database\Seeder;

class category_small_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_small')->delete();
        //税金・年金
        $params[0] = ['code' => '1' ,'name' => '住民税' ,'middle_code' => '1'];
        $params[1] = ['code' => '2' ,'name' => '確定拠出年金' ,'middle_code' => '1'];
        $params[2] = ['code' => '3' ,'name' => '生命保険' ,'middle_code' => '1'];
        //公共料金
        $params[3] = ['code' => '2' ,'name' => '家賃','middle_code' => '2'];
        $params[4] = ['code' => '3' ,'name' => 'ガス','middle_code' => '2'];
        $params[5] = ['code' => '4' ,'name' => '水道','middle_code' => '2'];
        $params[6] = ['code' => '5' ,'name' => '携帯代','middle_code' => '2'];
        $params[7] = ['code' => '6' ,'name' => '光回線','middle_code' => '2'];
        $params[8] = ['code' => '7' ,'name' => 'プロバイダ','middle_code' => '2'];
        $params[9] = ['code' => '8' ,'name' => 'サーバーレンタル料','middle_code' => '2'];

        foreach($params as $param)
        {
            DB::Table('category_small')->insert($param);
        }
    }
}
