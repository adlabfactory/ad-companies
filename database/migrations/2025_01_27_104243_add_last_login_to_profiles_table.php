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
        Schema::table('profiles', function (Blueprint $table) {
            $table->dateTime('last_login')->nullable()->after('phone'); // Ajoute le champ last_login après la colonne phone
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('last_login'); // Supprime le champ last_login si on rollback
        });
    }
};
