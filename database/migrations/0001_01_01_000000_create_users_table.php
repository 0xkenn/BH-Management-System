<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile_image');
            $table->string('name');
            $table->string('email')->unique();
            $table->smallInteger('age');
            $table->string('gender');
            $table->string('mobile_number')->unique();
            $table->boolean('is_student');
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->string('region_code'); // region_code to link to philippine_regions
           $table->string('province_code'); // province_code to link to philippine_provinces
            $table->string('city_municipality_code'); // city_municipality_code to link to philippine_cities
          $table->string('barangay_code'); // barangay_code to link to philippine_barangays
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
