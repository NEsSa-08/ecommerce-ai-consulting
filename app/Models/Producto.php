<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'existencia',
        'usuario_id',
        'fotos',
    ];

    protected $casts = [
    'fotos' => 'array',
];
    // Un producto pertenece a un usuario (vendedor)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Un producto tiene muchas categorías (muchos a muchos)
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }

    // Un producto tiene muchas ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'producto_id');
    }
}