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
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita'); 
            
            // Relación con el cliente que creó la cita
            $table->unsignedBigInteger('usuario_id'); 
            
            // Relación con el barbero asignado (opcional)
            $table->unsignedBigInteger('barbero_id')->nullable();

            $table->dateTime('fecha_hora'); // fecha + hora en una sola columna
            $table->string('servicio', 100);
            $table->string('estado', 20)->default('pendiente');
            $table->string('email')->nullable();
            $table->timestamps();

            // 🔗 Relaciones con usuarios
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('barbero_id')->references('id')->on('usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};

