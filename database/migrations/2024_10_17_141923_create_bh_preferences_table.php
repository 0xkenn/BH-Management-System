<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bh_preferences', function (Blueprint $table) {
        $table->id();
        $table->foreignId('boarding_house_id')->constrained('boarding_houses')->cascadeOnDelete();
        $table->foreignId('preference_id')->constrained('preferences')->cascadeOnDelete();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bh_preferences');
    }
};
