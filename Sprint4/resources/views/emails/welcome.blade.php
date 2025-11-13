<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a Cocteleando</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fafafa; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 20px;">
        <h2 style="color: #d35400;">¡Hola {{ $user->name }}!</h2>

        <p><strong>Bienvenido a <span style="color:#27ae60;">Cocteleando</span>!</strong></p>

        <p>
            Gracias por formar parte de nuestra comunidad.  
            Aquí vas a poder ver cócteles creados por otras personas,  
            así como publicar los tuyos propios 🍸
        </p>

        <p style="margin-top: 30px;">Saludos,<br>
        <strong>El equipo de Cocteleando</strong></p>
    </div>
</body>
</html>
