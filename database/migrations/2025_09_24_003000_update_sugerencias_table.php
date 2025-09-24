<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sugerencias', function (Blueprint $table) {
            // 👇 Eliminar columnas antiguas si existen
            if (Schema::hasColumn('sugerencias', 'nombre')) {
                $table->dropColumn('nombre');
            }
            if (Schema::hasColumn('sugerencias', 'email')) {
                $table->dropColumn('email');
            }

            // 👇 Agregar relación con usuarios si no existe
            if (!Schema::hasColumn('sugerencias', 'usuario_id')) {
                $table->unsignedBigInteger('usuario_id')->after('id');
                $table->foreign('usuario_id')
                      ->references('id')
                      ->on('usuarios')
                      ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('sugerencias', function (Blueprint $table) {
            // Revertir cambios
            if (Schema::hasColumn('sugerencias', 'usuario_id')) {
                $table->dropForeign(['usuario_id']);
                $table->dropColumn('usuario_id');
            }

            $table->string('nombre', 100)->nullable();
            $table->string('email', 100)->nullable();
        });
    }
};

