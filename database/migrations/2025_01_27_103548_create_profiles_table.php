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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id(); // Colonne 'id' (clé primaire auto-incrémentée)
            $table->unsignedBigInteger('user_id'); // user_id INT (Foreign Key)
            $table->string('first_name', 100); // Prénom (VARCHAR 100)
            $table->string('last_name', 100); // Nom de famille (VARCHAR 100)
            $table->string('phone', 20)->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
