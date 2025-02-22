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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique(); // username VARCHAR(50) Unique
            $table->string('password', 255); // password VARCHAR(255) Hashed
            $table->string('company_name', 100); // company_name VARCHAR(100)
            $table->string('company_category', 50); // company_category VARCHAR(50)
            $table->text('company_description'); // company_description TEXT
            $table->string('company_email', 100); // company_email VARCHAR(100)
            $table->string('company_phone', 20); // company_phone VARCHAR(20)
            $table->text('company_address'); // company_address TEXT
            $table->string('company_rc', 50); // company_rc VARCHAR(50)
            $table->unsignedBigInteger('user_id');
            $table->string('company_website_domain', 100); // company_website_domain VARCHAR(100)
            $table->boolean('domain_exists')->default(false); // domain_exists BOOLEAN
            $table->string('contact_person_name', 100); // contact_person_name VARCHAR(100)
            $table->string('contact_person_role', 100); // contact_person_role VARCHAR(100))
            $table->dateTime('subscription_start_at'); // subscription_start_at DATETIME
            $table->dateTime('subscription_end_at'); // subscription_end_at DATETIME
            $table->string('status', 50); // status VARCHAR(50)
            $table->string('devis_status', 50); // devis_status VARCHAR(50)
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
