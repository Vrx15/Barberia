<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Cita</title>
</head>
<body>
    <h2>¡Tu cita fue agendada con éxito! 🎉</h2>

    <p><strong>Cliente:</strong> {{ $cita->cliente->username }}</p>
    <p><strong>Correo:</strong> {{ $cita->cliente->email }}</p>

    @if($cita->barbero)
        <p><strong>Barbero asignado:</strong> {{ $cita->barbero->username }}</p>
    @else
        <p><strong>Barbero asignado:</strong> Pendiente</p>
    @endif

    <p><strong>Servicio:</strong> {{ ucfirst($cita->servicio) }}</p>
    <p><strong>Fecha y hora:</strong> {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y H:i') }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($cita->estado) }}</p>

    <hr>
    <p>Gracias por confiar en nuestra barbería 💈</p>
</body>
</html>

