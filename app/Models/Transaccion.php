<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
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
        'comprobante_pago',
        'fecha_pago',
        'fecha_envio',
        'fecha_entrega',
        'direccion_envio',
        'numero_guia',
        'notas',
    ];

    protected $casts = [
        'fecha_pago' => 'datetime',
        'fecha_envio' => 'datetime',
        'fecha_entrega' => 'datetime',
    ];

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