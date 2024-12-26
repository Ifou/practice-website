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
            $table->string('room_title')->nullable();
            $table->string('room_description')->nullable();
            $table->string('room_image')->nullable();
            $table->string('room_price')->nullable();
            $table->string('room_type')->nullable();
            $table->enum('room_status', ['Vacant', 'Waiting', 'Booked'])->nullable();
            $table->string('room_capacity')->nullable();
            $table->string('room_wifi')->nullable();
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
