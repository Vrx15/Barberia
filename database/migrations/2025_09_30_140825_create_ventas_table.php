<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('barbero_id');
            $table->integer('cantidad')->default(1);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            // Relaciones
            $table->foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('barbero_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};

