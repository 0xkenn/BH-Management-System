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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained()->cascadeOnDelete();
            $table->foreignId('boarding_house_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('capacity'); //6
            $table->integer('vacancy');
            $table->integer('price'); //1200 
            $table->string('room_image_1')->nullable();
            $table->string('room_image_2')->nullable();
            $table->string('room_image_3')->nullable(); // image room
            $table->string('room_image_4')->nullable(); // image room
            $table->boolean('is_occupied')->default(false); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
