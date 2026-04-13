<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AI Consulting</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --accent: #06b6d4;
        --dark: #0f172a;
        --dark-2: #1e293b;
        --light: #f8fafc;
        --muted: #94a3b8;
        --border: #e2e8f0;
    }

    * { box-sizing: border-box; }

    body {
        background-color: var(--light);
        color: var(--dark-2);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    /* ── Navbar ── */
    .navbar {
        background: var(--dark);
        padding: 14px 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .navbar-brand {
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff !important;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .navbar-brand span.ai-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--accent);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
    .navbar a.nav-link {
        color: var(--muted) !important;
        font-size: 0.875rem;
        font-weight: 500;
        transition: color 0.2s;
        padding: 6px 12px;
    }
    .navbar a.nav-link:hover {
        color: #fff !important;
    }
    .badge-rol {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
        background: rgba(99,102,241,0.15);
        color: var(--primary);
        border: 1px solid rgba(99,102,241,0.3);
    }

    /* ── Botones ── */
    .btn-primary {
        background: var(--primary);
        border: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }
    .btn-warning {
        font-weight: 500;
        border-radius: 8px;
    }
    .btn-danger {
        font-weight: 500;
        border-radius: 8px;
    }
    .btn-secondary {
        font-weight: 500;
        border-radius: 8px;
        background: #334155;
        border: none;
        color: #fff;
    }
    .btn-secondary:hover {
        background: #475569;
        color: #fff;
    }
    .btn-outline-light {
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
    }
    .btn-sm { border-radius: 6px !important; }

    /* ── Cards ── */
    .card {
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .card:hover {
        box-shadow: 0 6px 24px rgba(99,102,241,0.08);
        transform: translateY(-2px);
    }
    .card-header {
        background: transparent;
        border-bottom: 1px solid var(--border);
        font-weight: 600;
        padding: 16px 20px;
    }

    /* ── Tablas ── */
    .table {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
    }
    .table thead th {
        background: var(--dark-2);
        color: #e2e8f0;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 12px 16px;
    }
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: #f1f5f9;
    }
    .table td {
        padding: 12px 16px;
        vertical-align: middle;
        font-size: 0.9rem;
        border-color: var(--border);
    }

    /* ── Formularios ── */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid var(--border);
        font-size: 0.9rem;
        padding: 10px 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
    }
    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark-2);
        margin-bottom: 6px;
    }

    /* ── Alerts ── */
    .alert {
        border-radius: 10px;
        font-size: 0.9rem;
        border: none;
    }
    .alert-success {
        background: #f0fdf4;
        color: #166534;
    }
    .alert-danger {
        background: #fef2f2;
        color: #991b1b;
    }

    /* ── Badges ── */
    .badge {
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.75rem;
        padding: 4px 10px;
    }

    /* ── Page header ── */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }
    .page-header h2 {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        color: var(--dark);
    }

    /* ── Footer ── */
    footer {
        margin-top: 60px;
        padding: 24px 0;
        border-top: 1px solid var(--border);
        text-align: center;
        font-size: 0.8rem;
        color: var(--muted);
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand" href="/">
            <span class="ai-dot"></span>
            AI Consulting
        </a>

        <div class="d-flex gap-1">
            <a href="/quienes-somos" class="nav-link">Quiénes somos</a>
            <a href="/mision" class="nav-link">Misión</a>
            <a href="/vision" class="nav-link">Visión</a>
            <a href="/contacto" class="nav-link">Contacto</a>
            @auth
                <a href="/productos" class="nav-link">Productos</a>
                <a href="/categorias" class="nav-link">Categorías</a>
                <a href="/ventas" class="nav-link">Ventas</a>
                @if(auth()->user()->rol === 'administrador')
                    <a href="/users" class="nav-link">Usuarios</a>
                @endif
            @endauth
        </div>

        <div class="d-flex align-items-center gap-3">
            @guest
                <a href="/login" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
                <a href="/register" class="btn btn-primary btn-sm">Registrarse</a>
            @endguest
            @auth
                <span class="badge-rol">{{ ucfirst(auth()->user()->rol) }}</span>
                <span style="color: #94a3b8; font-size: 0.85rem;">
                    {{ auth()->user()->nombre }}
                </span>
                <form method="POST" action="/logout" class="m-0">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Salir</button>
                </form>
            @endauth
        </div>

    </div>
</nav>

<div class="container mt-4 mb-5">
    @yield('content')
</div>

<footer>
    <div class="container">
        © {{ date('Y') }} AI Consulting — Todos los derechos reservados
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>