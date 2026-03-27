<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.app')

@section('content')

<h1>Contacto</h1>

<p>Email: contacto@aiconsulting.com</p>
<p>Teléfono: 9611234567</p>

<form>
    <input class="form-control mb-2" placeholder="Nombre">
    <input class="form-control mb-2" placeholder="Correo">
    <textarea class="form-control mb-2" placeholder="Mensaje"></textarea>
    <button class="btn btn-custom">Enviar</button>
</form>

@endsection