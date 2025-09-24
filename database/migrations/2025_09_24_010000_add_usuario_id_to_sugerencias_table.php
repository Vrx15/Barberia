<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sugerencias', function (Blueprint $table) {
            // Si la columna usuario_id ya existe, no la volvemos a crear
            if (!Schema::hasColumn('sugerencias', 'usuario_id')) {
                $table->unsignedBigInteger('usuario_id')->after('id');
            }

            // Crear la relación con usuarios solo si no existe
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = array_map(fn($fk) => $fk->getName(), $sm->listTableForeignKeys('sugerencias'));

            if (!in_array('sugerencias_usuario_id_foreign', $foreignKeys)) {
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
            $table->dropForeign(['usuario_id']);
            $table->dropColumn('usuario_id');
        });
    }
};

