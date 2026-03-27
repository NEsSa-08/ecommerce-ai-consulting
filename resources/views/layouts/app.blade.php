<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>AI Consulting</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc;
        color: #1e293b;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .navbar {
        background-color: #0f172a;
        border-bottom: 1px solid #e2e8f0;
    }

    .navbar a {
        color: #e2e8f0 !important;
        font-weight: 500;
    }

    .navbar-brand {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-pro {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
        transition: 0.2s;
    }

    .card-pro:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .section-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #2563eb;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg">
<div class="container">

<a class="navbar-brand fw-bold" href="/">AI Consulting</a>

<div>
    <a href="/quienes-somos" class="me-3">Quiénes somos</a>
    <a href="/mision" class="me-3">Misión</a>
    <a href="/vision" class="me-3">Visión</a>
    <a href="/contacto" class="me-3">Contacto</a>
</div>

<div>
@guest
    <a href="/login" class="btn btn-liht btn-sm">Login</a>
    <a href="/register" class="btn btn-warning btn-sm">Registro</a>
@endguest

@auth
    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-danger btn-sm">Cerrar sesión</button>
    </form>
@endauth
</div>

</div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>