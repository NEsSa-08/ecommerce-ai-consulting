<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $vendedores = Usuario::where('rol', 'gerente')->get();
        $categorias = Categoria::all();

        $nombresProductos = [
            'Consultoría IA Básica',
            'Consultoría IA Avanzada',
            'Desarrollo de Chatbot',
            'Chatbot Empresarial',
            'Análisis Predictivo de Datos',
            'Modelo de Machine Learning',
            'Automatización de Procesos RPA',
            'Automatización Avanzada',
            'Dashboard de Business Intelligence',
            'Reporte de BI Personalizado',
            'Modelo de Visión por Computadora',
            'Sistema de Reconocimiento Facial',
            'Asistente Virtual IA',
            'Motor de Recomendaciones',
            'Detección de Anomalías',
            'Procesamiento de Lenguaje Natural',
            'Clasificador de Documentos',
            'Sistema de Predicción de Ventas',
            'Optimización de Rutas con IA',
            'Análisis de Sentimientos',
        ];

        foreach ($vendedores as $vendedor) {
            // Mínimo 3 productos por vendedor
            $cantidad = rand(3, 5);

            for ($i = 0; $i < $cantidad; $i++) {
                $nombre = $this->faker()->randomElement($nombresProductos)
                    . ' - ' . $vendedor->nombre;

                $producto = Producto::create([
                    'nombre'      => $nombre,
                    'descripcion' => 'Solución de inteligencia artificial para optimizar procesos empresariales y mejorar la toma de decisiones.',
                    'precio'      => rand(1000, 50000),
                    'existencia'  => rand(1, 20),
                    'usuario_id'  => $vendedor->id,
                    'fotos'       => [],
                ]);

                // Al menos 1 categoría, máximo 2
                $cats = $categorias->random(rand(1, 2))->pluck('id');
                $producto->categorias()->attach($cats);
            }
        }
    }

    private function faker()
    {
        return \Faker\Factory::create();
    }
}