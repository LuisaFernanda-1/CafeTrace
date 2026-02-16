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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->onDelete('set null');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('documento')->unique()->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'pendiente'])->default('pendiente');
            
            // Campos específicos para caficultores
            $table->string('nombre_finca')->nullable();
            $table->decimal('hectareas', 8, 2)->nullable();
            $table->string('ubicacion_gps')->nullable();
            $table->string('departamento')->nullable();
            $table->string('municipio')->nullable();
            
            // Campos específicos para compradores
            $table->string('nombre_empresa')->nullable();
            $table->string('nit')->nullable();
            $table->enum('tipo_comprador', ['cafeteria', 'tostador', 'exportador', 'otro'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id', 'telefono', 'direccion', 'documento', 'estado',
                'nombre_finca', 'hectareas', 'ubicacion_gps', 'departamento', 'municipio',
                'nombre_empresa', 'nit', 'tipo_comprador'
            ]);
        });
    }
};