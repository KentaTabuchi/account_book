<?php

use Illuminate\Database\Seeder;

class category_large_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_large')->delete();
        //収入
        $params[0] = ['code' => '11' ,'name' => '固定給','balance_code' => '1'];
        $params[1] = ['code' => '12' ,'name' => '一時金','balance_code' => '1'];
        //支出
        $params[2] = ['code' => '21' ,'name' => '固定費','balance_code' => '2'];
        $params[3] = ['code' => '22' ,'name' => '変動費','balance_code' => '2'];

        foreach($params as $param)
        {
            DB::Table('category_large')->insert($param);
        }
    }
}
