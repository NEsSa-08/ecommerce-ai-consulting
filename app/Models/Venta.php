<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
    'producto_id',
    'vendedor_id',
    'cliente_id',
    'fecha',
    'total',
    'ticket',
    'validada',
];

protected $casts = [
    'validada' => 'boolean',
];

    // Una venta pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Una venta pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cliente_id');
    }

    // Una venta pertenece a un vendedor
    public function vendedor()
    {
        return $this->belongsTo(Usuario::class, 'vendedor_id');
    }
}