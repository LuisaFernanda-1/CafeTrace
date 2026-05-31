<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
        'codigo_transaccion',
        'lote_id',
        'caficultor_id',
        'comprador_id',
        'cantidad_kg',
        'precio_por_kg',
        'precio_total',
        'comision_plataforma',
        'total_caficultor',
        'estado',
        'metodo_pago',
        'referencia_pago',
        'comprobante_pago',
        'notas_comprador',
        'notas_caficultor',
        'fecha_confirmacion',
        'fecha_entrega',
        'fecha_completada',
    ];

    protected $casts = [
        'fecha_confirmacion' => 'datetime',
        'fecha_entrega'      => 'datetime',
        'fecha_completada'   => 'datetime',
    ];

    // MÉTODOS ESTÁTICOS
    public static function calcularComision(float $monto): float
    {
        return round($monto * 0.05, 2);
    }

    public static function generarCodigo(): string
    {
        return 'TRX-' . strtoupper(\Illuminate\Support\Str::random(8)) . '-' . date('Ymd');
    }

    // RELACIONES
    public function lote()
    {
        return $this->belongsTo(LoteCafe::class, 'lote_id');
    }

    public function caficultor()
    {
        return $this->belongsTo(User::class, 'caficultor_id');
    }

    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }
}