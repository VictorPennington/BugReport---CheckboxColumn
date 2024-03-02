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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name'); //pet_name
            $table->string('pet_status');
            $table->dateTime('date_of_call')->nullable(); //date_of_call
            $table->string('species')->nullable(); //pet_species
            $table->string('age')->nullable(); //age
            $table->datetime('date_of_birth')->nullable(); //date_of_birth
            $table->string('owner_name')->nullable(); //owner_name
            $table->boolean('is_cremated')->default(false); //columbarium
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
