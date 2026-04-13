<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $vendedor = Usuario::where('rol', 'gerente')->first();

        $productos = [
            [
                'nombre'      => 'Consultoría IA Básica',
                'descripcion' => 'Sesión de consultoría para identificar oportunidades de automatización con IA en tu empresa.',
                'precio'      => 2500.00,
                'existencia'  => 20,
            ],
            [
                'nombre'      => 'Desarrollo de Chatbot',
                'descripcion' => 'Diseño e implementación de chatbot inteligente para atención al cliente 24/7.',
                'precio'      => 15000.00,
                'existencia'  => 10,
            ],
            [
                'nombre'      => 'Análisis Predictivo de Datos',
                'descripcion' => 'Modelo de machine learning para predecir tendencias y comportamientos de tu negocio.',
                'precio'      => 18000.00,
                'existencia'  => 8,
            ],
            [
                'nombre'      => 'Automatización de Procesos RPA',
                'descripcion' => 'Implementación de robots de software para automatizar tareas repetitivas y reducir errores.',
                'precio'      => 22000.00,
                'existencia'  => 5,
            ],
            [
                'nombre'      => 'Dashboard de Business Intelligence',
                'descripcion' => 'Panel de control interactivo con visualización de datos en tiempo real para toma de decisiones.',
                'precio'      => 12000.00,
                'existencia'  => 15,
            ],
            [
                'nombre'      => 'Modelo de Visión por Computadora',
                'descripcion' => 'Sistema de reconocimiento de imágenes para control de calidad o seguridad empresarial.',
                'precio'      => 35000.00,
                'existencia'  => 3,
            ],
        ];

        foreach ($productos as $data) {
            $producto = Producto::create([
                ...$data,
                'usuario_id' => $vendedor->id,
            ]);

            $categorias = Categoria::inRandomOrder()->take(2)->pluck('id');
            $producto->categorias()->attach($categorias);
        }
    }
}