<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoteCafe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lotes_cafe';

    protected $fillable = [
        'caficultor_id',
        'codigo_lote',
        'codigo_qr',
        'peso_kg',
        'variedad',
        'altura_msnm',
        'fecha_cosecha',
        'descripcion',
        'fecha_despulpado',
        'fecha_fermentacion',
        'fecha_lavado',
        'fecha_secado',
        'es_organico',
        'comercio_justo',
        'puntaje_calidad',
        'precio_por_kg',
        'peso_disponible',
        'estado',
        'hash_blockchain',
        'fecha_registro_blockchain',
    ];

    protected $casts = [
        'fecha_cosecha' => 'date',
        'fecha_despulpado' => 'date',
        'fecha_fermentacion' => 'date',
        'fecha_lavado' => 'date',
        'fecha_secado' => 'date',
        'es_organico' => 'boolean',
        'comercio_justo' => 'boolean',
        'fecha_registro_blockchain' => 'datetime',
    ];

    // RELACIONES
    public function caficultor()
    {
        return $this->belongsTo(User::class, 'caficultor_id');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenLote::class, 'lote_id');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'lote_id');
    }
}