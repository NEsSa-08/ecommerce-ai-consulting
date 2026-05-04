<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; margin: 0; padding: 40px; }
        .card { background: #fff; border-radius: 12px; padding: 40px; max-width: 480px; margin: 0 auto; border: 1px solid #e2e8f0; }
        .logo { font-size: 20px; font-weight: 700; color: #6366f1; margin-bottom: 24px; }
        .dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #06b6d4; margin-right: 6px; }
        h2 { color: #1e293b; margin-bottom: 8px; }
        p { color: #64748b; line-height: 1.6; }
        .code { font-size: 42px; font-weight: 800; letter-spacing: 12px; color: #4f46e5; text-align: center; background: #f1f5f9; border-radius: 10px; padding: 24px; margin: 24px 0; }
        .warning { font-size: 13px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo"><span class="dot"></span>AI Consulting</div>
        <h2>Hola, {{ $nombre }} 👋</h2>
        <p>Recibimos una solicitud de inicio de sesión en tu cuenta. Usa el siguiente código para completar la verificación:</p>
        <div class="code">{{ $codigo }}</div>
        <p class="warning">⏱ Este código expira en <strong>5 minutos</strong>.</p>
        <p class="warning">Si no fuiste tú, ignora este correo.</p>
    </div>
</body>
</html>