<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\Usuario;

class CategoriaPolicy
{
    public function create(Usuario $auth): bool
    {
        return in_array($auth->rol, ['administrador', 'gerente']);
    }

    public function update(Usuario $auth, Categoria $categoria): bool
    {
        return in_array($auth->rol, ['administrador', 'gerente']);
    }

    public function delete(Usuario $auth, Categoria $categoria): bool
    {
        return $auth->rol === 'administrador';
    }
}