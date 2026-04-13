@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Gerente</h2>
    <p>Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Productos</h5>
                <p class="text-muted">Gestiona tus productos</p>
                <a href="/productos" class="btn btn-success mt-2">Ver productos</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Categorías</h5>
                <p class="text-muted">Gestiona las categorías</p>
                <a href="/categorias" class="btn btn-warning mt-2">Ver categorías</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Ventas</h5>
                <p class="text-muted">Registra y consulta ventas</p>
                <a href="/ventas" class="btn btn-danger mt-2">Ver ventas</a>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card text-center p-3">
                <h5>Clientes</h5>
                <p class="text-muted">Gestiona los clientes</p>
                <a href="/users" class="btn btn-info mt-2">Ver clientes</a>
            </div>
        </div>
    </div>

    <form method="POST" action="/logout" class="mt-4">
        @csrf
        <button class="btn btn-secondary">Cerrar sesión</button>
    </form>
</div>
@endsection