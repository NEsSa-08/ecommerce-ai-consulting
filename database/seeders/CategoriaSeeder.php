<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre'      => 'Consultoría',
                'descripcion' => 'Servicios de asesoría y estrategia en inteligencia artificial.',
            ],
            [
                'nombre'      => 'Automatización',
                'descripcion' => 'Soluciones para automatizar procesos empresariales con IA.',
            ],
            [
                'nombre'      => 'Machine Learning',
                'descripcion' => 'Modelos predictivos y análisis avanzado de datos.',
            ],
            [
                'nombre'      => 'Chatbots',
                'descripcion' => 'Asistentes virtuales inteligentes para atención al cliente.',
            ],
            [
                'nombre'      => 'Business Intelligence',
                'descripcion' => 'Dashboards y visualización de datos para toma de decisiones.',
            ],
            [
                'nombre'      => 'Visión Artificial',
                'descripcion' => 'Sistemas de reconocimiento de imágenes y video.',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}