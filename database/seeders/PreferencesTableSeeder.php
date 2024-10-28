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
            // Amenities
            ['category' => 'amenities', 'name' => 'Free Water'],
            ['category' => 'amenities', 'name' => 'Free Electricity'],
            ['category' => 'amenities', 'name' => 'With Internet Connectivity'],
            ['category' => 'amenities', 'name' => 'Shared CR'],
            ['category' => 'amenities', 'name' => 'Not Shared CR'],
            ['category' => 'amenities', 'name' => 'With Electric Fan'],
        
            // Vacancy
            ['category' => 'vacancy', 'name' => 'Solo'],
            ['category' => 'vacancy', 'name' => 'Bed Spacer'],
        
            // Location
            ['category' => 'location', 'name' => 'Near BIPSU'],
            ['category' => 'location', 'name' => 'Near Public Market and Pier'],
        
            // Budget Range
            ['category' => 'budget_range', 'name' => '500-1000'],
            ['category' => 'budget_range', 'name' => '1000-1500'],
            ['category' => 'budget_range', 'name' => '1500-3500'],
            ['category' => 'budget_range', 'name' => '3500-4500'],
        ]);
        
    }
}
