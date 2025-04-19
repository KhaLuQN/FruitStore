<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Seed the discounts table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            [
                'code' => 'SUMMER20',
                'percentage' => 20.00,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addDays(20),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'WINTER15',
                'percentage' => 15.00,
                'start_date' => Carbon::now()->subDays(30),
                'end_date' => Carbon::now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FALL25',
                'percentage' => 25.00,
                'start_date' => Carbon::now()->subDays(20),
                'end_date' => Carbon::now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SPRING10',
                'percentage' => 10.00,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BLACKFRIDAY30',
                'percentage' => 30.00,
                'start_date' => Carbon::now()->subDays(40),
                'end_date' => Carbon::now()->addDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
