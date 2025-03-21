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
        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes(); // Ajoute une colonne deleted_at nullable
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Supprime la colonne deleted_at en cas de rollback
        });
    }
};
