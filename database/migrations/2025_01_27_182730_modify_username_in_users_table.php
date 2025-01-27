<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsernameInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimez l'index unique existant s'il existe
            $table->dropUnique('users_username_unique');

            // Modifiez la colonne `username` pour qu'elle soit nullable et unique
            $table->string('username', 50)->nullable()->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revenir à l'état précédent : non nullable et unique
            $table->string('username', 50)->unique()->change();
        });
    }
}

