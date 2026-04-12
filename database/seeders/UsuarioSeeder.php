<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Crear administrador fijo
        Usuario::create([
            'nombre'    => 'Admin',
            'apellidos' => 'Sistema',
            'correo'    => 'admin@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => 'administrador',
        ]);

        // Crear gerente fijo
        Usuario::create([
            'nombre'    => 'Juan',
            'apellidos' => 'Lopez',
            'correo'    => 'jlopez@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => 'gerente',
        ]);

        // Generar 5 usuarios aleatorios con la factory
        Usuario::factory(5)->create();
    }
}