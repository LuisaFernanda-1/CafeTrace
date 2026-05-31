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
        Schema::table('transacciones', function (Blueprint $table) {
            $table->string('metodo_pago')->nullable()->after('estado');
            $table->string('referencia_pago')->nullable()->after('metodo_pago');
            $table->string('comprobante_pago')->nullable()->after('referencia_pago');
        });
    }

    public function down(): void
    {
        Schema::table('transacciones', function (Blueprint $table) {
            $table->dropColumn(['metodo_pago', 'referencia_pago', 'comprobante_pago']);
        });
    }
};
