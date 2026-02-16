<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lote_id')->constrained('lotes_cafe')->onDelete('cascade');
            $table->decimal('cantidad_kg', 10, 2);
            $table->timestamps();
            
            // Un comprador no puede tener el mismo lote dos veces en el carrito
            $table->unique(['comprador_id', 'lote_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};