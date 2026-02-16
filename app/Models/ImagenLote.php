<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenLote extends Model
{
    use HasFactory;

    protected $table = 'imagenes_lote';

    protected $fillable = [
        'lote_id',
        'ruta_imagen',
        'tipo',
        'descripcion',
        'orden',
    ];

    // RELACIÓN
    public function lote()
    {
        return $this->belongsTo(LoteCafe::class, 'lote_id');
    }
}