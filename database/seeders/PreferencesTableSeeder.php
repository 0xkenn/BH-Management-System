<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('preferences')->insert([
            ['name' => 'Wi-Fi'],
            ['name' => 'Kitchen'],
            ['name' => 'Electricity'],
            ['name' => 'Water'],
            ['name' => 'Rice Cooker']
            // Add more preferences as needed
        ]);
    }
}
