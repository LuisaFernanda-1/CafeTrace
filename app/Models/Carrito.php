<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    protected $fillable = [
        'comprador_id',
        'lote_id',
        'cantidad_kg',
    ];

    // Relaciones
    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }

    public function lote()
    {
        return $this->belongsTo(LoteCafe::class, 'lote_id');
    }

    // Calcular subtotal del item
    public function getSubtotalAttribute()
    {
        return $this->cantidad_kg * $this->lote->precio_por_kg;
    }
}