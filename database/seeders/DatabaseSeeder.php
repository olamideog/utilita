<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('energy_prices')->insert([
            'name' => 'Electricity',
            'code' => 'ELC',
            'rate' => '1.50',
            'start_time' => '07:00:00',
            'end_time' => '23:59:59',
        ]);

        DB::table('energy_prices')->insert([
            'name' => 'Electricity',
            'code' => 'ELC',
            'rate' => '1.00',
            'start_time' => '00:00:00',
            'end_time' => '06:59:59',
        ]);
    }
}
