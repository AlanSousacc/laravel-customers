<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();
        
        $this->call([UserTableSeeder::class]);

        \App\Models\Customer::factory()->count(10)->create()->each(function($customer) {

            $number = \App\Models\Number::factory()->make();
            $customer->numbers()->save($number);        
        });
    }
}
