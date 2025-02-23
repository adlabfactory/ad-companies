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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('pack_name', 100);
            $table->decimal('price', 10, 2);
            $table->integer('duration');
            $table->string('pack_image')->nullable(); // Ajout du champ pack_image
            $table->timestamps();
            $table->softDeletes(); // Ajout de Soft Deletes
        });
        
    }
       
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
