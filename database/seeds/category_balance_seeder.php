<?php

use Illuminate\Database\Seeder;

class category_balance_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_balance')->delete();
        
        $params[0] = ['code' => '1' ,'name' => '収入'];
        $params[1] = ['code' => '2' ,'name' => '支出'];

        foreach($params as $param)
        {
            DB::Table('category_balance')->insert($param);
        }
    }
}
