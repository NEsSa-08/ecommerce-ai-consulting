<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2 class="section-title">Panel del Cliente</h2>
    <p class="section-subtitle">Resumen de servicios y actividad reciente</p>
</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card-pro">
            <h5>Proyectos activos</h5>
            <p class="text-muted">Consulta el estado de tus implementaciones de inteligencia artificial.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-pro">
            <h5>Servicios contratados</h5>
            <p class="text-muted">Revisión de soluciones desplegadas y en operación.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-pro">
            <h5>Reportes y métricas</h5>
            <p class="text-muted">Análisis de desempeño y resultados obtenidos.</p>
        </div>
    </div>

</div>

<div class="card-pro mt-4">
    <h5>Recomendaciones estratégicas</h5>
    <p class="text-muted">
        Se sugiere evaluar la integración de modelos predictivos para optimizar la toma de decisiones en áreas operativas clave.
    </p>
</div>

@endsection