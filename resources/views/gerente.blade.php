<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2 class="section-title">Panel de Administración</h2>
    <p class="section-subtitle">Visión general del negocio y control del sistema</p>
</div>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card-pro">
            <h6>Usuarios</h6>
            <p class="text-muted">Administración de cuentas y roles.</p>
            <a href="/users" class="btn btn-primary btn-sm">Gestionar</a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-pro">
            <h6>Indicadores</h6>
            <p class="text-muted">Visualización de métricas del sistema.</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-pro">
            <h6>Ingresos</h6>
            <p class="text-muted">Seguimiento financiero y crecimiento.</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-pro">
            <h6>Configuración</h6>
            <p class="text-muted">Parámetros generales del sistema.</p>
        </div>
    </div>

</div>

<div class="card-pro mt-4">
    <h5>Resumen ejecutivo</h5>
    <p class="text-muted">
        El sistema presenta un crecimiento sostenido en la adopción de soluciones de inteligencia artificial. Se recomienda fortalecer la oferta de automatización empresarial para maximizar el valor generado.
    </p>
</div>

@endsection