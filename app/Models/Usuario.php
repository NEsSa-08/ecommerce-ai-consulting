<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'clave',
        'rol',
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'clave' => 'hashed',
        ];
    }

    // Relaciones (las iremos agregando en los siguientes pasos)
    public function productos()
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }

    public function ventasComoVendedor()
    {
        return $this->hasMany(Venta::class, 'vendedor_id');
    }

    public function ventasComoCliente()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function categorias()
    {
        return $this->hasManyThrough(
            Categoria::class,
            Producto::class,
            'usuario_id',    // FK en productos
            'id',            // FK en categorias
            'id',            // PK en usuarios
            'id'             // PK en productos (se usa con la pivote)
        );
    }
}