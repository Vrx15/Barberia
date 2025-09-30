<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">
    <style>
        
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #7a7979ff;
            margin: 0;
            padding: 0;
            color: #333;
           
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.65);
            z-index: -1;
        }

        .btn-reserva {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #FFD700;
            color: #000;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-reserva:hover {
            background-color: #e6b800;
            transform: scale(1.05);
        }

        /* === Estilo del contenedor de error === */
        #error-page {

            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        #error-page img {
            max-width: 300px;
            width: 100%;
            height: auto;
            margin-bottom: 30px;
        }

        #error-page h1 {
            font-family: 'Abril Fatface', cursive;
            font-size: 50px;
            color: #ffcc00;
            margin-bottom: 15px;
        }

        #error-page p {
            font-family: 'Inter', sans-serif;
            color: #fff;
            font-size: 18px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div id="error-page">
        <img src="{{ asset('paginaerror.png') }}" alt="Error 500">
        <h1>¡Oops! Error Interno del Servidor</h1>
        <p>Algo salió mal en nuestro servidor. Intenta nuevamente más tarde.</p>
        <a href="{{ route('home') }}" class="btn-reserva">Volver al inicio</a>
    </div>
</body>
</html>

