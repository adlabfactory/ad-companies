<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->string('slug', 100)->unique();
            $table->string('logo', 255)->nullable();
            $table->json('colors')->nullable();
            $table->text('project_description')->nullable();
            $table->decimal('estimated_budget', 10, 2)->nullable();
            $table->json('uploaded_files')->nullable();
            $table->string('project_status', 50)->default('planned');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

