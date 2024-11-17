<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Owner;
use App\Models\Admin;
use App\Models\School;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhilippineBarangaysTableSeeder;
use PhilippineCitiesTableSeeder;
use PhilippineProvincesTableSeeder;
use PhilippineRegionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'user@gmail.com',
        //     'age' => '21',
        //     'gender' => 'male',
        //     'mobile_number' => '09093563451',
        //     'is_student' => true,
        //     'password' => '123456789'

        // ]);

        // Owner::create([
        //     'name' => 'Edwin',
        //     'email' => 'owner@gmail.com',
        //     'address' => 'culaba',
        //     'mobile_number' => '09090909099',
        //     'business_permit' => '1234567876543',
        //     'approved' => 1,
        //     'password' => '123456789'
        // ]);

        // Admin::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => '123456789'
        // ]);

        $this->call(PreferencesTableSeeder::class);
        // $this->call(PhilippineRegionsTableSeeder::class);
        // $this->call(PhilippineProvincesTableSeeder::class);
        // $this->call(PhilippineCitiesTableSeeder::class);
        // $this->call(PhilippineBarangaysTableSeeder::class);


    }
}
