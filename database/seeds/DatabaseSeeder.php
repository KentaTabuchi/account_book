<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  $this->call(account_book_seeder::class);
         $this->call(category_large_seeder::class);
         $this->call(category_middle_seeder::class);
         $this->call(category_small_seeder::class);
         $this->call(category_balance_seeder::class);
    }
}
