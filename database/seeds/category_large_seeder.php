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
        
        $params[0] = ['code' => '1' ,'name' => '固定費','balance_code' => '2'];
        $params[1] = ['code' => '2' ,'name' => '変動費','balance_code' => '2'];

        foreach($params as $param)
        {
            DB::Table('category_large')->insert($param);
        }
    }
}
