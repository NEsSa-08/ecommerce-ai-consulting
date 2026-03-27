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
        --purple: #7C3AED;
        --purple-soft: #f0eaff;
        --text-primary: #0f1117;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --card-bg: #ffffff;
        --page-bg: #f4f6fb;
        --radius: 14px;
        --shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    body { background: var(--page-bg); font-family: 'DM Sans', sans-serif; }

    /* ─── Header ─── */
    .admin-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .admin-header h2 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 0.2rem;
        letter-spacing: -0.3px;
    }
    .admin-header p { color: var(--text-muted); font-size: 0.9rem; margin: 0; }
    .header-actions { display: flex; gap: 0.5rem; }

    /* ─── Buttons ─── */
    .btn-primary-custom {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 9px;
        padding: 7px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: opacity 0.15s;
    }
    .btn-primary-custom:hover { opacity: 0.88; color: #fff; }
    .btn-ghost-custom {
        background: var(--card-bg);
        color: var(--text-primary);
        border: 1px solid var(--border);
        border-radius: 9px;
        padding: 7px 16px;
        font-size: 0.82rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: background 0.15s;
    }
    .btn-ghost-custom:hover { background: #f3f4f6; color: var(--text-primary); }

    /* ─── KPI strip ─── */
    .kpi-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 1.25rem 1.4rem;
        box-shadow: var(--shadow);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .kpi-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.09); }
    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: var(--radius) var(--radius) 0 0;
    }
    .kpi-blue::before  { background: var(--accent); }
    .kpi-green::before { background: var(--success); }
    .kpi-amber::before { background: var(--warning); }
    .kpi-purple::before { background: var(--purple); }

    .kpi-label { font-size: 0.76rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.45rem; }
    .kpi-value { font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; color: var(--text-primary); line-height: 1; margin-bottom: 0.4rem; }
    .kpi-sub { font-size: 0.78rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.3rem; }
    .badge-pill {
        font-size: 0.7rem; font-weight: 600;
        padding: 2px 8px; border-radius: 20px;
    }
    .pill-up    { background: var(--success-soft); color: #007a5c; }
    .pill-down  { background: var(--danger-soft);  color: #b02020; }
    .pill-warn  { background: var(--warning-soft); color: #8a6000; }
    .pill-info  { background: var(--accent-soft);  color: #0051a8; }

    /* ─── Section card ─── */
    .sec-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .sec-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.09); }
    .sec-head {
        padding: 1rem 1.4rem;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
    }
    .sec-head h6 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 600; font-size: 0.9rem;
        margin: 0; color: var(--text-primary);
        display: flex; align-items: center; gap: 0.5rem;
    }
    .sec-body { padding: 1.2rem 1.4rem; }
    .card-icon {
        width: 28px; height: 28px; border-radius: 7px;
        display: flex; align-items: center; justify-content: center; font-size: 0.85rem;
    }
    .ci-blue   { background: var(--accent-soft); }
    .ci-green  { background: var(--success-soft); }
    .ci-amber  { background: var(--warning-soft); }
    .ci-purple { background: var(--purple-soft); }
    .ci-red    { background: var(--danger-soft); }

    /* ─── User table ─── */
    .user-row { display: flex; align-items: center; gap: 0.7rem; padding: 0.65rem 0; border-bottom: 1px solid var(--border); }
    .user-row:last-child { border-bottom: none; }
    .avatar { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700; flex-shrink: 0; }
    .av-b  { background: var(--accent-soft);  color: #0051a8; }
    .av-g  { background: var(--success-soft); color: #007a5c; }
    .av-a  { background: var(--warning-soft); color: #8a6000; }
    .av-p  { background: var(--purple-soft);  color: #5e35b1; }
    .av-r  { background: var(--danger-soft);  color: #b02020; }
    .user-name  { font-size: 0.84rem; font-weight: 500; color: var(--text-primary); flex: 1; }
    .user-email { font-size: 0.74rem; color: var(--text-muted); }
    .role-badge { font-size: 0.68rem; font-weight: 600; padding: 3px 9px; border-radius: 20px; white-space: nowrap; }
    .role-admin  { background: var(--purple-soft); color: #5e35b1; }
    .role-op     { background: var(--accent-soft);  color: #0051a8; }
    .role-viewer { background: #f3f4f6; color: #555; }

    /* ─── Ingresos rows ─── */
    .ingreso-row { display: flex; align-items: center; justify-content: space-between; padding: 0.65rem 0; border-bottom: 1px solid var(--border); }
    .ingreso-row:last-child { border-bottom: none; }
    .ingreso-label { font-size: 0.85rem; font-weight: 500; color: var(--text-primary); }
    .ingreso-sub   { font-size: 0.74rem; color: var(--text-muted); }
    .ingreso-amount { font-family: 'Space Grotesk', sans-serif; font-size: 0.95rem; font-weight: 700; color: var(--text-primary); }
    .bar-track { height: 5px; border-radius: 10px; background: #eef0f4; overflow: hidden; width: 90px; }
    .bar-fill  { height: 100%; border-radius: 10px; }

    /* ─── Config grid ─── */
    .config-item {
        display: flex; align-items: center; gap: 0.8rem;
        padding: 0.75rem 0; border-bottom: 1px solid var(--border);
    }
    .config-item:last-child { border-bottom: none; }
    .config-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
    .config-label { font-size: 0.85rem; font-weight: 500; color: var(--text-primary); flex: 1; }
    .config-sub   { font-size: 0.74rem; color: var(--text-muted); }

    /* ─── Executive summary ─── */
    .exec-summary {
        background: linear-gradient(135deg, #0f1117 0%, #1a1f2e 100%);
        border-radius: var(--radius);
        padding: 1.75rem 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .exec-summary::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(10,132,255,0.12);
    }
    .exec-summary::after {
        content: '';
        position: absolute;
        bottom: -60px; left: 30%;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(124,58,237,0.09);
    }
    .exec-summary h5 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1rem; font-weight: 600;
        margin-bottom: 0.75rem;
        opacity: 0.7; letter-spacing: 0.04em;
        text-transform: uppercase; font-size: 0.75rem;
    }
    .exec-summary p {
        font-size: 0.92rem; line-height: 1.7;
        opacity: 0.85; margin-bottom: 1.25rem;
    }
    .exec-summary .insight-chips { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .insight-chip {
        font-size: 0.75rem; font-weight: 600;
        padding: 4px 12px; border-radius: 20px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: #fff;
    }
</style>

{{-- HEADER --}}
<div class="admin-header">
    <div>
        <h2>Panel de Administración</h2>
        <p>Visión general del negocio y control del sistema · Consultoría IA</p>
    </div>
    <div class="header-actions">
        <a href="/reports" class="btn-ghost-custom">📊 Exportar reporte</a>
        <a href="/settings" class="btn-primary-custom">⚙️ Configuración</a>
    </div>
</div>

{{-- KPIs --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-blue">
            <div class="kpi-label">Usuarios totales</div>
            <div class="kpi-value">148</div>
            <div class="kpi-sub"><span class="badge-pill pill-up">+12</span> este mes</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-green">
            <div class="kpi-label">Ingresos MXN</div>
            <div class="kpi-value">$2.4M</div>
            <div class="kpi-sub"><span class="badge-pill pill-up">+8.3%</span> vs anterior</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-amber">
            <div class="kpi-label">Proyectos activos</div>
            <div class="kpi-value">12</div>
            <div class="kpi-sub"><span class="badge-pill pill-warn">3 por revisar</span></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-purple">
            <div class="kpi-label">Modelos en prod.</div>
            <div class="kpi-value">9</div>
            <div class="kpi-sub"><span class="badge-pill pill-info">2 actualizando</span></div>
        </div>
    </div>
</div>

{{-- FILA PRINCIPAL --}}
<div class="row g-3 mb-3">

    {{-- Usuarios --}}
    <div class="col-md-4">
        <div class="sec-card h-100">
            <div class="sec-head">
                <h6><span class="card-icon ci-blue">👤</span> Usuarios</h6>
                <a href="/users" class="btn-primary-custom" style="padding:4px 12px; font-size:0.76rem;">+ Gestionar</a>
            </div>
            <div class="sec-body">
                <div class="user-row">
                    <div class="avatar av-p">DG</div>
                    <div class="flex-grow-1">
                        <div class="user-name">Diego García</div>
                        <div class="user-email">diego@consultoraia.mx</div>
                    </div>
                    <span class="role-badge role-admin">Admin</span>
                </div>
                <div class="user-row">
                    <div class="avatar av-b">AM</div>
                    <div class="flex-grow-1">
                        <div class="user-name">Ana Martínez</div>
                        <div class="user-email">ana@consultoraia.mx</div>
                    </div>
                    <span class="role-badge role-op">Operativo</span>
                </div>
                <div class="user-row">
                    <div class="avatar av-g">LR</div>
                    <div class="flex-grow-1">
                        <div class="user-name">Luis Ramírez</div>
                        <div class="user-email">luis@consultoraia.mx</div>
                    </div>
                    <span class="role-badge role-op">Operativo</span>
                </div>
                <div class="user-row">
                    <div class="avatar av-a">SG</div>
                    <div class="flex-grow-1">
                        <div class="user-name">Sofía González</div>
                        <div class="user-email">sofia@consultoraia.mx</div>
                    </div>
                    <span class="role-badge role-viewer">Viewer</span>
                </div>
                <div class="mt-3 pt-1" style="border-top:1px solid var(--border)">
                    <span style="font-size:0.78rem; color:var(--text-muted);">148 usuarios · 5 pendientes de aprobación</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Indicadores del sistema --}}
    <div class="col-md-4">
        <div class="sec-card h-100">
            <div class="sec-head">
                <h6><span class="card-icon ci-green">📈</span> Indicadores del sistema</h6>
            </div>
            <div class="sec-body">
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">Uptime plataforma</div>
                        <div class="ingreso-sub">Últimos 30 días</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:99%;background:var(--success)"></div></div>
                        <span class="ingreso-amount" style="color:var(--success)">99.8%</span>
                    </div>
                </div>
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">Precisión modelos IA</div>
                        <div class="ingreso-sub">Promedio general</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:91%;background:var(--accent)"></div></div>
                        <span class="ingreso-amount" style="color:var(--accent)">91.2%</span>
                    </div>
                </div>
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">Tickets resueltos</div>
                        <div class="ingreso-sub">Este mes</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:78%;background:var(--warning)"></div></div>
                        <span class="ingreso-amount">78%</span>
                    </div>
                </div>
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">NPS clientes</div>
                        <div class="ingreso-sub">Último trimestre</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:84%;background:var(--purple)"></div></div>
                        <span class="ingreso-amount" style="color:var(--purple)">+68</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ingresos --}}
    <div class="col-md-4">
        <div class="sec-card h-100">
            <div class="sec-head">
                <h6><span class="card-icon ci-amber">💰</span> Ingresos</h6>
                <a href="/finanzas" class="btn-ghost-custom" style="padding:4px 12px; font-size:0.76rem;">Ver detalle</a>
            </div>
            <div class="sec-body">
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">Consultoría IA</div>
                        <div class="ingreso-sub">Proyectos en curso</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:80%;background:var(--accent)"></div></div>
                        <span class="ingreso-amount">$1.2M</span>
                    </div>
                </div>
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">Licencias SaaS</div>
                        <div class="ingreso-sub">Suscripciones activas</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:55%;background:var(--success)"></div></div>
                        <span class="ingreso-amount">$680K</span>
                    </div>
                </div>
                <div class="ingreso-row">
                    <div>
                        <div class="ingreso-label">Capacitaciones</div>
                        <div class="ingreso-sub">Talleres y cursos</div>
                    </div>
                    <div class="text-end">
                        <div class="bar-track mb-1"><div class="bar-fill" style="width:28%;background:var(--warning)"></div></div>
                        <span class="ingreso-amount">$340K</span>
                    </div>
                </div>
                <div style="border-top:1px solid var(--border); padding-top:0.75rem; margin-top:0.25rem; display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:0.8rem; color:var(--text-muted); font-weight:500;">Total acumulado</span>
                    <span style="font-family:'Space Grotesk',sans-serif; font-size:1.1rem; font-weight:700; color:var(--text-primary);">$2.4M MXN</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FILA SECUNDARIA --}}
<div class="row g-3 mb-3">

    {{-- Configuración --}}
    <div class="col-md-5">
        <div class="sec-card">
            <div class="sec-head">
                <h6><span class="card-icon ci-purple">⚙️</span> Configuración del sistema</h6>
                <a href="/settings" class="btn-ghost-custom" style="padding:4px 12px; font-size:0.76rem;">Editar</a>
            </div>
            <div class="sec-body">
                <div class="config-item">
                    <div class="config-icon" style="background:var(--accent-soft)">🔐</div>
                    <div class="flex-grow-1">
                        <div class="config-label">Autenticación 2FA</div>
                        <div class="config-sub">Habilitada para todos los roles</div>
                    </div>
                    <span class="badge-pill pill-up">Activo</span>
                </div>
                <div class="config-item">
                    <div class="config-icon" style="background:var(--success-soft)">🌐</div>
                    <div class="flex-grow-1">
                        <div class="config-label">Ambiente de producción</div>
                        <div class="config-sub">v3.2.1 — estable</div>
                    </div>
                    <span class="badge-pill pill-up">Online</span>
                </div>
                <div class="config-item">
                    <div class="config-icon" style="background:var(--warning-soft)">💾</div>
                    <div class="flex-grow-1">
                        <div class="config-label">Backups automáticos</div>
                        <div class="config-sub">Último: hoy 03:00 AM</div>
                    </div>
                    <span class="badge-pill pill-warn">Revisar</span>
                </div>
                <div class="config-item">
                    <div class="config-icon" style="background:var(--purple-soft)">🤖</div>
                    <div class="flex-grow-1">
                        <div class="config-label">Integración API IA</div>
                        <div class="config-sub">Claude + OpenAI conectados</div>
                    </div>
                    <span class="badge-pill pill-info">Activo</span>
                </div>
                <div class="config-item">
                    <div class="config-icon" style="background:var(--danger-soft)">🛡️</div>
                    <div class="flex-grow-1">
                        <div class="config-label">Logs de auditoría</div>
                        <div class="config-sub">Retención: 90 días</div>
                    </div>
                    <span class="badge-pill pill-up">Activo</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Actividad reciente --}}
    <div class="col-md-7">
        <div class="sec-card h-100">
            <div class="sec-head">
                <h6><span class="card-icon ci-red">🕐</span> Actividad reciente</h6>
                <a href="/logs" class="btn-ghost-custom" style="padding:4px 12px; font-size:0.76rem;">Ver logs</a>
            </div>
            <div class="sec-body">
                @php
                $actividades = [
                    ['icono'=>'👤','color'=>'var(--accent-soft)','texto'=>'Diego García creó un nuevo usuario: sofia@consultoraia.mx','tiempo'=>'Hace 10 min','badge'=>'info'],
                    ['icono'=>'🚀','color'=>'var(--success-soft)','texto'=>'Modelo predictivo de LogisTech desplegado en producción v1.4','tiempo'=>'Hace 45 min','badge'=>'up'],
                    ['icono'=>'⚠️','color'=>'var(--warning-soft)','texto'=>'Alerta de drift detectada en modelo RetailCo — requiere revisión','tiempo'=>'Hace 1 hora','badge'=>'warn'],
                    ['icono'=>'💰','color'=>'var(--success-soft)','texto'=>'Pago recibido de BancSur — $180,000 MXN — contrato Q1','tiempo'=>'Hace 2 horas','badge'=>'up'],
                    ['icono'=>'🔐','color'=>'var(--purple-soft)','texto'=>'Actualización de permisos para rol Operativo aplicada','tiempo'=>'Hace 3 horas','badge'=>'info'],
                ];
                @endphp

                @foreach($actividades as $act)
                <div style="display:flex; align-items:flex-start; gap:0.75rem; padding:0.65rem 0; border-bottom:1px solid var(--border);">
                    <div style="width:32px;height:32px;border-radius:8px;background:{{ $act['color'] }};display:flex;align-items:center;justify-content:center;font-size:0.85rem;flex-shrink:0;">{{ $act['icono'] }}</div>
                    <div class="flex-grow-1">
                        <div style="font-size:0.83rem;color:var(--text-primary);line-height:1.45;">{{ $act['texto'] }}</div>
                        <div style="font-size:0.74rem;color:var(--text-muted);margin-top:2px;">{{ $act['tiempo'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- RESUMEN EJECUTIVO --}}
<div class="exec-summary">
    <h5>Resumen ejecutivo</h5>
    <div class="row align-items-center g-3">
        <div class="col-md-8">
            <p>
                El sistema presenta un crecimiento sostenido del <strong>8.3%</strong> en ingresos mensuales,
                impulsado principalmente por la expansión de proyectos de consultoría IA y la adopción de
                licencias SaaS. Se recomienda fortalecer la oferta de automatización empresarial y priorizar
                la resolución del drift detectado en modelos productivos para mantener la calidad del servicio.
            </p>
            <div class="insight-chips">
                <span class="insight-chip">🚀 Crecimiento sostenido</span>
                <span class="insight-chip">⚡ Automatización prioritaria</span>
                <span class="insight-chip">🤖 9 modelos en producción</span>
                <span class="insight-chip">⚠️ Revisar drift RetailCo</span>
                <span class="insight-chip">📊 NPS +68</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row g-2">
                <div class="col-6">
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.9rem;text-align:center;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:700;color:#fff;">$2.4M</div>
                        <div style="font-size:0.72rem;opacity:0.6;margin-top:2px;">ingresos MXN</div>
                    </div>
                </div>
                <div class="col-6">
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.9rem;text-align:center;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:700;color:#00C48C;">99.8%</div>
                        <div style="font-size:0.72rem;opacity:0.6;margin-top:2px;">uptime</div>
                    </div>
                </div>
                <div class="col-6">
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.9rem;text-align:center;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:700;color:#0A84FF;">148</div>
                        <div style="font-size:0.72rem;opacity:0.6;margin-top:2px;">usuarios</div>
                    </div>
                </div>
                <div class="col-6">
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.9rem;text-align:center;">
                        <div style="font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:700;color:#FFB800;">+68</div>
                        <div style="font-size:0.72rem;opacity:0.6;margin-top:2px;">NPS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection