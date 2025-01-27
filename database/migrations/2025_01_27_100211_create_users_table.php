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
        // Création de la table 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id();                       // id INT (Primary Key)
            $table->string('username', 50)->unique(); // username VARCHAR(50) Unique
            $table->string('email')->unique();  // email VARCHAR(100) Unique
            $table->string('password', 255)->unique();    // password VARCHAR(255)
            $table->boolean('is_active')->default(true); // is_active BOOLEAN Default true
            $table->string('role', 50)->default('admin'); // role VARCHAR(50) Default 'user'
            $table->rememberToken();            // remember_token VARCHAR(100)
            $table->timestamps();               // created_at and updated_at TIMESTAMPS
        });

        // Création de la table 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // email VARCHAR(255) Primary Key
            $table->string('token');            // token VARCHAR(255)
            $table->timestamp('created_at')->nullable(); // created_at TIMESTAMP Nullable
        });

        // Création de la table 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();    // id VARCHAR(255) Primary Key
            $table->foreignId('user_id')->nullable()->index(); // user_id BIGINT Nullable, Index
            $table->string('ip_address', 45)->nullable(); // ip_address VARCHAR(45) Nullable
            $table->text('user_agent')->nullable(); // user_agent TEXT Nullable
            $table->longText('payload');        // payload LONGTEXT
            $table->integer('last_activity')->index(); // last_activity INT Index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Suppression des tables en ordre inverse de création
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};