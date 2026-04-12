<?php

namespace App\Policies;

use App\Models\Usuario;

class UsuarioPolicy
{
    // Solo administrador puede crear usuarios
    public function crear(Usuario $auth): bool
    {
        return $auth->rol === 'administrador';
    }

    // Solo administrador puede editar usuarios
    public function editar(Usuario $auth, Usuario $objetivo): bool
    {
        if ($auth->rol === 'administrador') {
            return true;
        }

        // Gerente solo puede editar clientes
        if ($auth->rol === 'gerente') {
            return $objetivo->rol === 'cliente';
        }

        return false;
    }

    // Solo administrador puede eliminar usuarios
    public function eliminar(Usuario $auth, Usuario $objetivo): bool
    {
        return $auth->rol === 'administrador';
    }
}