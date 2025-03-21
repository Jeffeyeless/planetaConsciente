<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Planeta Consciente')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f8;
        }

        .navbar {
            background-color: #00C000;
            display: flex;
            align-items: center;
            padding: 10px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .navbar .logo {
            font-weight: bold;
            color: white;
            margin-right: 20px;
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 30px;
            margin-right: 10px;
        }

        .navbar .nav-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .navbar button {
            padding: 10px 15px;
            border: none;
            background: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        footer {
            background-color: green;
            color: white;
            text-align: center;
            padding: 30px 10px;
        }

        footer .info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        footer .info img {
            width: 50px;
        }

        .content {
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/1.jpg') }}" alt="Logo">
        </div>
        <div class="nav-buttons">
            <button>INICIO</button>
            <button>HERRAMIENTAS Y RECURSOS</button>
            <button>CUIDADO DEL AMBIENTE</button>
            <button>RETOS Y EVENTOS</button>
            <button>NOTICIAS</button>
            <button>FORMULARIO</button>
            <button>INICIAR SESIÓN</button>
            <button>INICIAR SESIÓN ADMINISTRADOR</button>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="info">
            <div>SENA CALLE 13 # 65-10</div>
            <div>+02 1234567890</div>
            <div>Planetaconsciente@gmail.com</div>
        </div>
    </footer>

</body>
</html>
