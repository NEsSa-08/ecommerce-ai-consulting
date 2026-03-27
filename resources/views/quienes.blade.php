<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.app')

@section('content')

<div class="container">

    <!-- TÍTULO -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Quiénes Somos</h1>
        <p class="lead">Innovación en Inteligencia Artificial aplicada a negocios</p>
    </div>

    <!-- HISTORIA -->
    <div class="card-custom mb-4">
        <h3>Nuestra Historia</h3>
        <p>
            Fundada en 2024, <strong>AI Consultores</strong> nació con una misión clara: democratizar el acceso a tecnologías de vanguardia para empresas de todos los tamaños.
            Lo que comenzó como un pequeño laboratorio de experimentación en algoritmos de aprendizaje profundo, se ha transformado hoy en un e-commerce líder en soluciones de consultoría automatizada.
        </p>
        <p>
            Creemos que la Inteligencia Artificial no es solo una herramienta, sino el motor que permitirá a la humanidad alcanzar su siguiente nivel de productividad y creatividad.
        </p>
    </div>

    <!-- MISIÓN Y VISIÓN -->
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card-custom h-100">
                <h3>🎯 Misión</h3>
                <p>
                    Nuestra misión es transformar datos en decisiones estratégicas. Proporcionamos soluciones de consultoría personalizadas que integran 
                    <strong>Modelos de Lenguaje de Gran Escala (LLM)</strong>, visión por computadora y análisis predictivo para optimizar procesos operativos 
                    y maximizar el retorno de inversión de nuestros clientes.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-custom h-100">
                <h3>🔭 Visión</h3>
                <p>
                    Para el año 2030, aspiramos a ser la plataforma global de referencia en la implementación ética y eficiente de sistemas autónomos, 
                    siendo reconocidos por nuestra capacidad de simplificar la complejidad tecnológica en beneficios tangibles para la sociedad.
                </p>
            </div>
        </div>

    </div>

    <!-- VALORES -->
    <div class="card-custom mb-4">
        <h3>💡 Nuestros Valores Core</h3>
        <ul>
            <li><strong>Innovación Disruptiva:</strong> Siempre buscamos el siguiente avance en tecnología.</li>
            <li><strong>Ética Transparente:</strong> Privacidad de datos y eliminación de sesgos.</li>
            <li><strong>Agilidad Escalable:</strong> Soluciones que crecen con tu empresa.</li>
            <li><strong>Compromiso con el Cliente:</strong> Tu éxito es nuestra prioridad.</li>
        </ul>
    </div>

    <!-- POR QUÉ ELEGIRNOS -->
    <div class="card-custom mb-4">
        <h3>🚀 ¿Por qué elegirnos?</h3>
        <ul>
            <li><strong>Experiencia Técnica:</strong> Expertos en Laravel, Python y ciencia de datos.</li>
            <li><strong>Soluciones a Medida:</strong> Cada cliente recibe una solución personalizada.</li>
            <li><strong>Soporte 24/7:</strong> Monitoreo continuo con alta disponibilidad (99.9%).</li>
        </ul>
    </div>

    <!-- EQUIPO -->
    <div class="card-custom text-center">
        <h3>👥 Nuestro Equipo</h3>
        <p><em>"La tecnología es creada por personas, para personas."</em></p>

        <p>
            Contamos con una red global de más de 50 consultores certificados en arquitecturas de nube 
            (AWS, Azure, GCP) y especialistas en frameworks como PyTorch y TensorFlow, todos dedicados a llevar tu negocio al futuro.
        </p>
    </div>

</div>

@endsection