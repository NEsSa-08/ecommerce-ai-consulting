<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        $nombres   = ['Juan', 'Mario', 'Maria', 'Pedro'];
        $apellidos = ['Lopez', 'Sanchez', 'Hernandez', 'Martinez'];

        $nombre   = $this->faker->randomElement($nombres);
        $apellido = $this->faker->randomElement($apellidos);

        // Agregamos un número único para evitar correos duplicados
        $numero = $this->faker->unique()->numberBetween(1, 999);

        return [
            'nombre'    => $nombre,
            'apellidos' => $apellido,
            'correo'    => strtolower(substr($nombre, 0, 1) . $apellido . $numero) . '@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => $this->faker->randomElement(['cliente', 'gerente']),
        ];
    }
}