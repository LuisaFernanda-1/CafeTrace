<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_transaccion')->unique();
            
            // Relaciones
            $table->foreignId('comprador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('caficultor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lote_id')->constrained('lotes_cafe')->onDelete('cascade');
            
            // Datos de la transacción
            $table->decimal('cantidad_kg', 10, 2);
            $table->decimal('precio_por_kg', 10, 2);
            $table->decimal('precio_total', 12, 2);
            $table->decimal('comision_plataforma', 10, 2)->default(0);
            $table->decimal('total_caficultor', 12, 2);
            
            // Estado de la transacción
            $table->enum('estado', ['pendiente', 'confirmada', 'en_proceso', 'completada', 'cancelada'])->default('pendiente');
            
            // Información adicional
            $table->text('notas_comprador')->nullable();
            $table->text('notas_caficultor')->nullable();
            
            // Fechas
            $table->timestamp('fecha_confirmacion')->nullable();
            $table->timestamp('fecha_entrega')->nullable();
            $table->timestamp('fecha_completada')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};