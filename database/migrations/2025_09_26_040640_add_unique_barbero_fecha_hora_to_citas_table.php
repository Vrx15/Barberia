<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->unique(['barbero_id', 'fecha_hora']);
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropUnique(['barbero_id', 'fecha_hora']);
        });
    }
};
