<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CodigoVerificacion extends Model
{
    protected $table = 'codigos_verificacion';

    protected $fillable = [
        'usuario_id',
        'codigo',
        'expiracion',
        'usado',
    ];

    protected $casts = [
        'expiracion' => 'datetime',
        'usado'      => 'boolean',
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Verificar si el código está expirado
    public function estaExpirado(): bool
    {
        return Carbon::now()->isAfter($this->expiracion);
    }

    // Verificar si el código es válido
    public function esValido(string $codigo): bool
    {
        return !$this->usado
            && !$this->estaExpirado()
            && $this->codigo === $codigo;
    }
}