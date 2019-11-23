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
        $params[1111] = ['code' => '1111' ,'name' => '月給' ,'middle_code' => '111'];
        $params[1112] = ['code' => '1112' ,'name' => '賞与' ,'middle_code' => '111'];
        //税金・年金
        $params[2110] = ['code' => '2110' ,'name' => '住民税' ,'middle_code' => '211'];
        $params[2111] = ['code' => '2111' ,'name' => '確定拠出年金' ,'middle_code' => '211'];
        $params[2112] = ['code' => '2112' ,'name' => '生命保険' ,'middle_code' => '211'];
        //公共料金
        $params[2120] = ['code' => '2120' ,'name' => '家賃','middle_code' => '212'];
        $params[2121] = ['code' => '2121' ,'name' => 'ガス','middle_code' => '212'];
        $params[2122] = ['code' => '2122' ,'name' => '水道','middle_code' => '212'];
        $params[2123] = ['code' => '2123' ,'name' => '携帯代','middle_code' => '212'];
        $params[2124] = ['code' => '2124' ,'name' => '光回線','middle_code' => '212'];
        $params[2125] = ['code' => '2125' ,'name' => 'プロバイダ','middle_code' => '212'];
        $params[2126] = ['code' => '2126' ,'name' => 'サーバーレンタル料','middle_code' => '212'];
        //その他固定
        $params[2131] = ['code' => '2131' ,'name' => '月次生活費振込','middle_code' => '213'];
        //食費
        $params[2210] = ['code' => '2210' ,'name' => 'スーパー・コンビニ等','middle_code' => '221'];
        $params[2211] = ['code' => '2211' ,'name' => '自動販売機','middle_code' => '221'];
        $params[2212] = ['code' => '2212' ,'name' => '飲食店一般','middle_code' => '221'];
        $params[2213] = ['code' => '2213' ,'name' => '会食','middle_code' => '221'];
        //雑貨・本・家具・家電等
        $params[2220] = ['code' => '2220' ,'name' => '日用雑貨','middle_code' => '222'];
        $params[2221] = ['code' => '2221' ,'name' => '本・雑誌','middle_code' => '222'];
        $params[2222] = ['code' => '2222' ,'name' => '電化製品','middle_code' => '222'];
        $params[2223] = ['code' => '2223' ,'name' => '家具','middle_code' => '222'];
        //交通費
        $params[2230] = ['code' => '2230' ,'name' => '通勤費','middle_code' => '223'];
        $params[2231] = ['code' => '2231' ,'name' => 'その他交通費','middle_code' => '223'];
        //医療費
        $params[2240] = ['code' => '2240' ,'name' => '病院・診療所','middle_code' => '224'];
        $params[2241] = ['code' => '2241' ,'name' => '医薬品','middle_code' => '224'];

        foreach($params as $param)
        {
            DB::Table('category_small')->insert($param);
        }
    }
}
