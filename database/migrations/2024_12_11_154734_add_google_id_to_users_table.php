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
        Schema::table('users', function (Blueprint $table) {
            // Agregar la columna google_id a la tabla users, que puede ser nula
            $table->string('google_id')->nullable()->after('email'); // Puedes cambiar 'email' por la columna que prefieras
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la columna google_id en caso de rollback
            $table->dropColumn('google_id');
        });
    }
};
