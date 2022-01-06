<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Number;
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
        \App\Models\Customer::factory()->count(10)->create()->each(function($customer) {

            $number = \App\Models\Number::factory()->make();
            $customer->numbers()->save($number);        
        });
    }
}
