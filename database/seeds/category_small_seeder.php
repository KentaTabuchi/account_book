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
        //給料
        $params[1] = ['code' => '1' ,'name' => '月給' ,'middle_code' => '1'];
        $params[2] = ['code' => '2' ,'name' => '賞与' ,'middle_code' => '1'];
        //株式
        $params[3] = ['code' => '3' ,'name' => '配当金' ,'middle_code' => '2'];
        $params[4] = ['code' => '4' ,'name' => '売却益' ,'middle_code' => '2'];
        //お小遣い
        $params[5] = ['code' => '5' ,'name' => '配当金' ,'middle_code' => '3'];

        //税金・年金
        $params[6] = ['code' => '6' ,'name' => '住民税' ,'middle_code' => '4'];
        $params[7] = ['code' => '7' ,'name' => '確定拠出年金' ,'middle_code' => '4'];
        $params[8] = ['code' => '8' ,'name' => '生命保険' ,'middle_code' => '4'];
        //公共料金
        $params[9] = ['code' => '9' ,'name' => '家賃','middle_code' => '5'];
        $params[10] = ['code' => '10' ,'name' => 'ガス','middle_code' => '5'];
        $params[11] = ['code' => '11' ,'name' => '水道','middle_code' => '5'];
        $params[12] = ['code' => '12' ,'name' => '携帯代','middle_code' => '5'];
        $params[13] = ['code' => '13' ,'name' => '光回線','middle_code' => '5'];
        $params[14] = ['code' => '14' ,'name' => 'プロバイダ','middle_code' => '5'];
        $params[15] = ['code' => '15' ,'name' => 'サーバーレンタル料','middle_code' => '5'];
        $params[16] = ['code' => '16' ,'name' => '電気','middle_code' => '5'];
        //その他固定
        $params[17] = ['code' => '17' ,'name' => '月次生活費振込','middle_code' => '6'];
        //食費
        $params[18] = ['code' => '18' ,'name' => '生鮮品','middle_code' => '7'];
        $params[19] = ['code' => '19' ,'name' => '加工食品','middle_code' => '7'];
        $params[20] = ['code' => '20' ,'name' => '菓子','middle_code' => '7'];
        $params[21] = ['code' => '21' ,'name' => 'ソフトドリンク','middle_code' => '7'];
        $params[22] = ['code' => '22' ,'name' => '酒類','middle_code' => '7'];
        //雑貨・本・家具・家電等
        $params[23] = ['code' => '23' ,'name' => '日用雑貨','middle_code' => '8'];
        $params[24] = ['code' => '24' ,'name' => '本・雑誌','middle_code' => '8'];
        $params[25] = ['code' => '25' ,'name' => '電化製品','middle_code' => '8'];
        $params[26] = ['code' => '26' ,'name' => '家具','middle_code' => '8'];
        $params[27] = ['code' => '27' ,'name' => '服飾','middle_code' => '8'];
        //交通費
        $params[28] = ['code' => '28' ,'name' => '通勤費','middle_code' => '9'];
        $params[29] = ['code' => '29' ,'name' => 'その他交通費','middle_code' => '9'];
        //医療費
        $params[30] = ['code' => '30' ,'name' => '病院・診療所','middle_code' => '10'];
        $params[31] = ['code' => '31' ,'name' => '医薬品','middle_code' => '10'];
        //その他サービス
        $params[32] = ['code' => '32' ,'name' => '散髪代','middle_code' => '11'];
        //祭事・イベント
        $params[33] = ['code' => '33' ,'name' => '誕生日','middle_code' => '12'];
        $params[34] = ['code' => '34' ,'name' => 'クリスマス','middle_code' => '12'];
        $params[35] = ['code' => '35' ,'name' => '正月','middle_code' => '12'];
        $params[36] = ['code' => '36' ,'name' => 'その他','middle_code' => '12'];

        foreach($params as $param)
        {
            DB::Table('category_small')->insert($param);
        }
    }
}
