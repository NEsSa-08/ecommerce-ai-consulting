@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Cliente</h2>
    <p>Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-center p-3">
                <h5>Productos</h5>
                <p class="text-muted">Explora los productos disponibles</p>
                <a href="/productos" class="btn btn-primary mt-2">Ver productos</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center p-3">
                <h5>Mis compras</h5>
                <p class="text-muted">Consulta tus compras realizadas</p>
                <a href="/ventas" class="btn btn-success mt-2">Ver mis compras</a>
            </div>
        </div>
    </div>

    <form method="POST" action="/logout" class="mt-4">
        @csrf
        <button class="btn btn-secondary">Cerrar sesión</button>
    </form>
</div>
@endsection