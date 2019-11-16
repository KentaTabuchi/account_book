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
        
        $params[0] = ['code' => '1' ,'name' => '税金,保険,年金' ,'large_code' => '1'];
        $params[1] = ['code' => '2' ,'name' => '公共料金,家賃','large_code' => '1'];
        $params[2] = ['code' => '3' ,'name' => 'その他の固定費','large_code' => '1'];

        foreach($params as $param)
        {
            DB::Table('category_middle')->insert($param);
        }
    }
}
