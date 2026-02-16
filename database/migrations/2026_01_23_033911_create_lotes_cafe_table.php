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
        Schema::create('lotes_cafe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caficultor_id')->constrained('users')->onDelete('cascade');
            $table->string('codigo_lote')->unique();
            $table->string('codigo_qr')->nullable();
            
            // Información del lote
            $table->decimal('peso_kg', 8, 2);
            $table->string('variedad'); // Caturra, Castillo, etc.
            $table->integer('altura_msnm');
            $table->date('fecha_cosecha');
            $table->text('descripcion')->nullable();
            
            // Proceso de producción
            $table->date('fecha_despulpado')->nullable();
            $table->date('fecha_fermentacion')->nullable();
            $table->date('fecha_lavado')->nullable();
            $table->date('fecha_secado')->nullable();
            
            // Certificaciones y calidad
            $table->boolean('es_organico')->default(false);
            $table->boolean('comercio_justo')->default(false);
            $table->integer('puntaje_calidad')->nullable();
            
            // Precio y disponibilidad
            $table->decimal('precio_por_kg', 10, 2);
            $table->decimal('peso_disponible', 8, 2);
            $table->enum('estado', ['disponible', 'vendido', 'reservado', 'en_proceso'])->default('disponible');
            
            // Blockchain simulado
            $table->string('hash_blockchain')->nullable();
            $table->timestamp('fecha_registro_blockchain')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes_cafe');
    }
};