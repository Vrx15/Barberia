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
    Schema::create('sugerencias', function (Blueprint $table) {
        $table->id();

        // 🔑 Relación con usuarios
        $table->unsignedBigInteger('usuario_id'); 
        $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

        // Solo el mensaje
        $table->text('mensaje');

        $table->timestamps();
    });

}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sugerencias');
    }
};
