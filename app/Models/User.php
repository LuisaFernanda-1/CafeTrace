<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'telefono',
        'direccion',
        'documento',
        'estado',
        'nombre_finca',
        'hectareas',
        'ubicacion_gps',
        'departamento',
        'municipio',
        'nombre_empresa',
        'nit',
        'tipo_comprador',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELACIONES
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function lotesCafe()
    {
        return $this->hasMany(LoteCafe::class, 'caficultor_id');
    }

    public function compras()
    {
        return $this->hasMany(Transaccion::class, 'comprador_id');
    }

    public function ventas()
    {
        return $this->hasMany(Transaccion::class, 'caficultor_id');
    }

    // MÉTODOS AUXILIARES
    public function isAdmin()
    {
        return $this->role && $this->role->nombre === 'administrador';
    }

    public function isCaficultor()
    {
        return $this->role && $this->role->nombre === 'caficultor';
    }

    public function isComprador()
    {
        return $this->role && $this->role->nombre === 'comprador';
    }
}