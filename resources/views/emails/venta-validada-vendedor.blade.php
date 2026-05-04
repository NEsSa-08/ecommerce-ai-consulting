<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; margin: 0; padding: 40px; }
        .card { background: #fff; border-radius: 12px; padding: 40px; max-width: 520px; margin: 0 auto; border: 1px solid #e2e8f0; }
        .logo { font-size: 20px; font-weight: 700; color: #6366f1; margin-bottom: 24px; }
        .badge { background: #f0fdf4; color: #16a34a; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        .info-label { color: #64748b; }
        .info-value { font-weight: 600; color: #1e293b; }
        .total { font-size: 24px; font-weight: 800; color: #4f46e5; text-align: center; padding: 20px; background: #f5f3ff; border-radius: 10px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">• AI Consulting</div>
        <span class="badge">✅ Venta validada</span>
        <h2 style="color: #1e293b; margin-top: 16px;">Hola, {{ $venta->vendedor->nombre }} 👋</h2>
        <p style="color: #64748b;">Una de tus ventas ha sido validada por el equipo de gerencia.</p>

        <div style="margin: 24px 0;">
            <div class="info-row">
                <span class="info-label">Producto</span>
                <span class="info-value">{{ $venta->producto->nombre }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Comprador</span>
                <span class="info-value">{{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Correo del comprador</span>
                <span class="info-value">{{ $venta->cliente->correo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha</span>
                <span class="info-value">{{ $venta->fecha }}</span>
            </div>
        </div>

        <div class="total">${{ number_format($venta->total, 2) }}</div>

        <p style="color: #94a3b8; font-size: 13px; text-align: center;">
            Este correo es una notificación automática de AI Consulting.
        </p>
    </div>
</body>
</html>