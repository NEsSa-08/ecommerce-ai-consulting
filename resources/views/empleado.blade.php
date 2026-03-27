<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

@extends('layouts.app')

@section('content')

<style>
    :root {
        --accent: #0A84FF;
        --accent-soft: #e8f2ff;
        --success: #00C48C;
        --success-soft: #e6faf4;
        --warning: #FFB800;
        --warning-soft: #fff8e1;
        --danger: #FF4D4F;
        --danger-soft: #fff1f0;
        --text-primary: #0f1117;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --card-bg: #ffffff;
        --page-bg: #f4f6fb;
        --radius: 14px;
        --shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    body { background: var(--page-bg); font-family: 'DM Sans', sans-serif; }

    .panel-header { margin-bottom: 2rem; }
    .panel-header h2 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
        letter-spacing: -0.3px;
    }
    .panel-header p { color: var(--text-muted); font-size: 0.95rem; margin: 0; }

    .status-bar {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.78rem;
        font-weight: 500;
        color: var(--text-muted);
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--border);
    }
    .status-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: var(--success);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    /* Metric cards */
    .metric-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 1.25rem 1.5rem;
        box-shadow: var(--shadow);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.09);
    }
    .metric-label {
        font-size: 0.78rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }
    .metric-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
        margin-bottom: 0.4rem;
    }
    .metric-sub {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .metric-sub .badge-change {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 20px;
    }
    .badge-up { background: var(--success-soft); color: #007a5c; }
    .badge-down { background: var(--danger-soft); color: #b02020; }
    .badge-neutral { background: var(--warning-soft); color: #8a6000; }

    /* Section cards */
    .section-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .section-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.09);
    }
    .section-card .card-header-custom {
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .section-card .card-header-custom h6 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        margin: 0;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
    }
    .icon-blue { background: var(--accent-soft); }
    .icon-green { background: var(--success-soft); }
    .icon-amber { background: var(--warning-soft); }
    .icon-red { background: var(--danger-soft); }
    .section-card .card-body-custom { padding: 1.25rem 1.5rem; }

    /* Project list */
    .project-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
    }
    .project-item:last-child { border-bottom: none; }
    .project-name { font-size: 0.88rem; font-weight: 500; color: var(--text-primary); }
    .project-client { font-size: 0.78rem; color: var(--text-muted); }
    .progress-mini {
        height: 5px;
        border-radius: 10px;
        background: #eef0f4;
        overflow: hidden;
        width: 80px;
        flex-shrink: 0;
    }
    .progress-fill { height: 100%; border-radius: 10px; background: var(--accent); }

    /* Badge status */
    .status-badge {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        white-space: nowrap;
    }
    .badge-active { background: var(--success-soft); color: #007a5c; }
    .badge-review { background: var(--warning-soft); color: #8a6000; }
    .badge-paused { background: #f3f4f6; color: #6b7280; }
    .badge-critical { background: var(--danger-soft); color: #b02020; }

    /* Alert feed */
    .alert-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
    }
    .alert-item:last-child { border-bottom: none; }
    .alert-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        margin-top: 5px;
        flex-shrink: 0;
    }
    .dot-success { background: var(--success); }
    .dot-warning { background: var(--warning); }
    .dot-danger { background: var(--danger); }
    .dot-info { background: var(--accent); }
    .alert-text { font-size: 0.83rem; color: var(--text-primary); line-height: 1.45; }
    .alert-time { font-size: 0.75rem; color: var(--text-muted); margin-top: 2px; }

    /* Team table */
    .team-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 0;
        border-bottom: 1px solid var(--border);
    }
    .team-row:last-child { border-bottom: none; }
    .avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.72rem;
        font-weight: 600;
        flex-shrink: 0;
    }
    .av-blue { background: var(--accent-soft); color: #0051a8; }
    .av-green { background: var(--success-soft); color: #007a5c; }
    .av-amber { background: var(--warning-soft); color: #8a6000; }
    .av-purple { background: #f0eaff; color: #5e35b1; }
    .team-name { font-size: 0.85rem; font-weight: 500; color: var(--text-primary); flex: 1; }
    .team-role { font-size: 0.75rem; color: var(--text-muted); }

    /* CTA button */
    .btn-action {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 5px 13px;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.15s;
        text-decoration: none;
    }
    .btn-action:hover { opacity: 0.88; color: #fff; }
    .btn-ghost {
        background: transparent;
        color: var(--accent);
        border: 1px solid var(--accent);
        border-radius: 8px;
        padding: 5px 13px;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s;
        text-decoration: none;
    }
    .btn-ghost:hover { background: var(--accent-soft); }
</style>

{{-- HEADER --}}
<div class="panel-header">
    <h2>Panel Operativo</h2>
    <p>Gestión interna de proyectos y sistemas · Consultoría IA</p>
</div>

<div class="status-bar">
    <span class="status-dot"></span>
    Todos los sistemas operativos &nbsp;·&nbsp; Actualizado hace 2 min
</div>

{{-- MÉTRICAS CLAVE --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="metric-card">
            <div class="metric-label">Proyectos activos</div>
            <div class="metric-value">12</div>
            <div class="metric-sub">
                <span class="badge-change badge-up">+3</span> este mes
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="metric-card">
            <div class="metric-label">Horas registradas</div>
            <div class="metric-value">284</div>
            <div class="metric-sub">
                <span class="badge-change badge-neutral">semana actual</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="metric-card">
            <div class="metric-label">Entregas pendientes</div>
            <div class="metric-value">7</div>
            <div class="metric-sub">
                <span class="badge-change badge-down">3 urgentes</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="metric-card">
            <div class="metric-label">Satisfacción cliente</div>
            <div class="metric-value">94%</div>
            <div class="metric-sub">
                <span class="badge-change badge-up">+2%</span> vs anterior
            </div>
        </div>
    </div>
</div>

{{-- FILA PRINCIPAL --}}
<div class="row g-3 mb-3">

    {{-- Proyectos en ejecución --}}
    <div class="col-md-5">
        <div class="section-card h-100">
            <div class="card-header-custom">
                <h6>
                    <span class="card-icon icon-blue">🚀</span>
                    Proyectos en ejecución
                </h6>
                <a href="#" class="btn-ghost">Ver todos</a>
            </div>
            <div class="card-body-custom">
                <div class="project-item">
                    <div>
                        <div class="project-name">Modelo predictivo — LogisTech</div>
                        <div class="project-client">Cliente: LogisTech S.A.</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="progress-mini"><div class="progress-fill" style="width:72%"></div></div>
                        <span class="status-badge badge-active">Activo</span>
                    </div>
                </div>
                <div class="project-item">
                    <div>
                        <div class="project-name">Chatbot corporativo — BancSur</div>
                        <div class="project-client">Cliente: BancSur</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="progress-mini"><div class="progress-fill" style="width:45%; background: var(--warning)"></div></div>
                        <span class="status-badge badge-review">Revisión</span>
                    </div>
                </div>
                <div class="project-item">
                    <div>
                        <div class="project-name">Pipeline de datos — AgroMX</div>
                        <div class="project-client">Cliente: AgroMX</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="progress-mini"><div class="progress-fill" style="width:88%"></div></div>
                        <span class="status-badge badge-active">Activo</span>
                    </div>
                </div>
                <div class="project-item">
                    <div>
                        <div class="project-name">Auditoría de modelo — RetailCo</div>
                        <div class="project-client">Cliente: RetailCo</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="progress-mini"><div class="progress-fill" style="width:20%; background: var(--danger)"></div></div>
                        <span class="status-badge badge-critical">Crítico</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alertas del sistema --}}
    <div class="col-md-4">
        <div class="section-card h-100">
            <div class="card-header-custom">
                <h6>
                    <span class="card-icon icon-amber">⚡</span>
                    Alertas del sistema
                </h6>
                <span class="status-badge badge-review">4 nuevas</span>
            </div>
            <div class="card-body-custom">
                <div class="alert-item">
                    <span class="alert-dot dot-danger"></span>
                    <div>
                        <div class="alert-text">Modelo de RetailCo con drift > umbral crítico. Revisión inmediata requerida.</div>
                        <div class="alert-time">Hace 15 min</div>
                    </div>
                </div>
                <div class="alert-item">
                    <span class="alert-dot dot-warning"></span>
                    <div>
                        <div class="alert-text">API de BancSur respondiendo con latencia elevada (>1.8s).</div>
                        <div class="alert-time">Hace 1 hora</div>
                    </div>
                </div>
                <div class="alert-item">
                    <span class="alert-dot dot-info"></span>
                    <div>
                        <div class="alert-text">Nueva versión del pipeline de AgroMX desplegada correctamente.</div>
                        <div class="alert-time">Hace 3 horas</div>
                    </div>
                </div>
                <div class="alert-item">
                    <span class="alert-dot dot-success"></span>
                    <div>
                        <div class="alert-text">Backup semanal de modelos completado sin errores.</div>
                        <div class="alert-time">Hace 6 horas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Equipo activo --}}
    <div class="col-md-3">
        <div class="section-card h-100">
            <div class="card-header-custom">
                <h6>
                    <span class="card-icon icon-green">👥</span>
                    Equipo activo
                </h6>
            </div>
            <div class="card-body-custom">
                <div class="team-row">
                    <div class="avatar av-blue">AM</div>
                    <div>
                        <div class="team-name">Ana M.</div>
                        <div class="team-role">ML Engineer</div>
                    </div>
                    <span class="status-badge badge-active">Activa</span>
                </div>
                <div class="team-row">
                    <div class="avatar av-green">LR</div>
                    <div>
                        <div class="team-name">Luis R.</div>
                        <div class="team-role">Data Scientist</div>
                    </div>
                    <span class="status-badge badge-active">Activo</span>
                </div>
                <div class="team-row">
                    <div class="avatar av-amber">CP</div>
                    <div>
                        <div class="team-name">Carlos P.</div>
                        <div class="team-role">DevOps IA</div>
                    </div>
                    <span class="status-badge badge-review">Reunión</span>
                </div>
                <div class="team-row">
                    <div class="avatar av-purple">SG</div>
                    <div>
                        <div class="team-name">Sofía G.</div>
                        <div class="team-role">Consultora</div>
                    </div>
                    <span class="status-badge badge-paused">Fuera</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FILA SECUNDARIA --}}
<div class="row g-3">

    {{-- Próximas entregas --}}
    <div class="col-md-6">
        <div class="section-card">
            <div class="card-header-custom">
                <h6>
                    <span class="card-icon icon-red">📅</span>
                    Próximas entregas
                </h6>
                <a href="#" class="btn-action">+ Nueva tarea</a>
            </div>
            <div class="card-body-custom">
                <div class="project-item">
                    <div>
                        <div class="project-name">Informe de desempeño — LogisTech</div>
                        <div class="project-client">Vence: 28 mar 2026</div>
                    </div>
                    <span class="status-badge badge-critical">2 días</span>
                </div>
                <div class="project-item">
                    <div>
                        <div class="project-name">Entregable MVP — BancSur</div>
                        <div class="project-client">Vence: 2 abr 2026</div>
                    </div>
                    <span class="status-badge badge-review">7 días</span>
                </div>
                <div class="project-item">
                    <div>
                        <div class="project-name">Documentación técnica — AgroMX</div>
                        <div class="project-client">Vence: 10 abr 2026</div>
                    </div>
                    <span class="status-badge badge-active">15 días</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Accesos rápidos --}}
    <div class="col-md-6">
        <div class="section-card">
            <div class="card-header-custom">
                <h6>
                    <span class="card-icon icon-blue">⚙️</span>
                    Accesos rápidos
                </h6>
            </div>
            <div class="card-body-custom">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="#" class="d-block text-decoration-none p-3 rounded-3" style="background:var(--accent-soft); border:1px solid #c8dff9;">
                            <div style="font-size:1.2rem; margin-bottom:4px;">📊</div>
                            <div style="font-size:0.83rem; font-weight:600; color:#0051a8;">Reportes</div>
                            <div style="font-size:0.75rem; color:#5b8fc7;">Ver métricas</div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="d-block text-decoration-none p-3 rounded-3" style="background:var(--success-soft); border:1px solid #a0e4cc;">
                            <div style="font-size:1.2rem; margin-bottom:4px;">🤖</div>
                            <div style="font-size:0.83rem; font-weight:600; color:#007a5c;">Modelos IA</div>
                            <div style="font-size:0.75rem; color:#4cac8e;">Gestionar</div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="d-block text-decoration-none p-3 rounded-3" style="background:var(--warning-soft); border:1px solid #ffd77a;">
                            <div style="font-size:1.2rem; margin-bottom:4px;">📁</div>
                            <div style="font-size:0.83rem; font-weight:600; color:#8a6000;">Documentos</div>
                            <div style="font-size:0.75rem; color:#b08000;">Repositorio</div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="d-block text-decoration-none p-3 rounded-3" style="background:#f0eaff; border:1px solid #c9b8f5;">
                            <div style="font-size:1.2rem; margin-bottom:4px;">🗓️</div>
                            <div style="font-size:0.83rem; font-weight:600; color:#5e35b1;">Calendario</div>
                            <div style="font-size:0.75rem; color:#9270d4;">Agenda</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection