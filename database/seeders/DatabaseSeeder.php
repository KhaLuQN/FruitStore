<?php


namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ReviewsTableSeeder::class,
        ]);
    }
}
