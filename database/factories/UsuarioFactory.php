<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        $nombres   = ['Juan', 'Mario', 'Maria', 'Pedro', 'Ana', 'Luis', 'Rosa', 'Carlos', 'Laura', 'Miguel'];
        $apellidos = ['Lopez', 'Sanchez', 'Hernandez', 'Martinez', 'Garcia', 'Ramirez', 'Torres', 'Flores', 'Rivera', 'Morales'];

        $nombre   = $this->faker->randomElement($nombres);
        $apellido = $this->faker->randomElement($apellidos);
        $numero   = $this->faker->unique()->numberBetween(1, 9999);

        return [
            'nombre'    => $nombre,
            'apellidos' => $apellido,
            'correo'    => strtolower(substr($nombre, 0, 1) . $apellido . $numero) . '@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => 'cliente', // se sobreescribe en el seeder
        ];
    }
}