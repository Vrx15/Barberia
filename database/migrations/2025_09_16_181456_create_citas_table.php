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
        $table->string('nombre_cliente_cita', 30);
        $table->dateTime('fecha', 6);
        $table->time('hora', 6);
        $table->unsignedBigInteger('barbero_id')->nullable();
        $table->string('estado', 20)->default('pendiente');
        $table->timestamps();

        
        $table->foreign('barbero_id')->references('id')->on('barberos')->onDelete('set null');
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
