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
        .contact { background: #eff6ff; border-radius: 10px; padding: 16px; margin-top: 20px; font-size: 14px; color: #1d4ed8; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">• AI Consulting</div>
        <span class="badge">🎉 Compra confirmada</span>
        <h2 style="color: #1e293b; margin-top: 16px;">Hola, {{ $venta->cliente->nombre }} 👋</h2>
        <p style="color: #64748b;">Tu compra ha sido confirmada exitosamente.</p>

        <div style="margin: 24px 0;">
            <div class="info-row">
                <span class="info-label">Producto adquirido</span>
                <span class="info-value">{{ $venta->producto->nombre }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha de compra</span>
                <span class="info-value">{{ $venta->fecha }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Número de venta</span>
                <span class="info-value">#{{ $venta->id }}</span>
            </div>
        </div>

        <div class="total">${{ number_format($venta->total, 2) }}</div>

        <div class="contact">
            📧 Para cualquier consulta contacta al vendedor:<br>
            <strong>{{ $venta->vendedor->correo }}</strong>
        </div>

        <p style="color: #94a3b8; font-size: 13px; text-align: center; margin-top: 20px;">
            Este correo es una notificación automática de AI Consulting.
        </p>
    </div>
</body>
</html>