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
    Schema::table('sugerencias', function (Blueprint $table) {
        if (Schema::hasColumn('sugerencias', 'nombre')) {
            $table->dropColumn('nombre');
        }
        if (Schema::hasColumn('sugerencias', 'email')) {
            $table->dropColumn('email');
        }
    });
}

public function down()
{
    Schema::table('sugerencias', function (Blueprint $table) {
        $table->string('nombre', 100)->nullable();
        $table->string('email', 100)->nullable();
    });
}

};
