<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Biblioteca HMS</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 13px;
            background: #f7f4f1;
            color: #333;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }


        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 255px;
            height: 100vh;

            background: #432713;
            color: white;
        }

        .logo {
            height: 94px;

            padding: 15px 18px;

            display: flex;
            align-items: center;

            gap: 12px;
        }

        .logo-icon {
            color: #d7b786;
            font-size: 28px;
        }

        .logo-text span {
            display: block;

            margin-bottom: 3px;

            font-family: "Segoe UI", Arial, sans-serif;

            color: #d7b786;

            font-size: 12px;

            letter-spacing: 1px;
        }

        .logo-text strong {
            display: block;

            font-family: Georgia, "Times New Roman", serif;

            color: #fff;

            font-size: 19px;

            font-weight: bold;

            line-height: 1;
        }

        .sidebar-line {
            height: 20px;

            border-bottom: 1px solid #ffffff12;
        }

        .menu a {
            height: 38px;

            padding: 0 24px;

            display: flex;
            align-items: center;

            gap: 14px;

            color: #f1e7dc;

            text-decoration: none;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 13px;

            font-weight: 400;
        }

        .menu a i {
            width: 18px;

            text-align: center;

            color: #d7c5b1;

            font-size: 14px;
        }

        .menu a:hover {
            background: #55341f;
        }

        .menu .active {
            background: #573b29;

            border-left: 3px solid #d7b786;

            padding-left: 21px;
        }

        .main {
            width: calc(100% - 255px);

            margin-left: 255px;
        }


        .topbar {
            height: 61px;

            padding: 0 30px 0 37px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: #75461f;

            color: white;
        }

        .topbar h1 {
            font-family: Georgia, "Times New Roman", serif;

            font-size: 21px;

            font-weight: bold;
        }

        .user {
            display: flex;
            align-items: center;

            gap: 10px;

            text-align: right;
        }

        .user strong {
            display: block;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 13px;
        }

        .user span {
            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 12px;

            color: #f0e0ce;
        }

        .user-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #96724c;
        }



        .content {
            padding: 60px 64px 0;
        }


        .welcome {
            padding: 28px 38px;

            margin-bottom: 18px;

            background: linear-gradient(
                110deg,
                #75451f,
                #4b2916
            );

            color: white;

            border-radius: 25px;

            box-shadow: 0 5px 12px #0002;
        }

        .welcome h2 {
            margin-bottom: 7px;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 32px;

            font-weight: 700;
        }

        .welcome p {
            color: #f0e5da;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 13px;
        }


        .cards {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 18px;
        }

        .card {
            height: 105px;

            padding: 22px;

            background: white;

            border: 1px solid #eee;

            border-radius: 16px;

            box-shadow: 0 2px 4px #0001;
        }

        .card-title {
            margin-bottom: 3px;

            color: #65758b;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 13px;
        }

        .card-number {
            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 30px;

            font-weight: bold;

            color: #75461f;
        }

        .card.blue .card-number {
            color: #2864d7;
        }

        .card.green .card-number {
            color: #159447;
        }

        .card.red .card-number {
            color: #ed4545;
        }


        .alert {
            height: 70px;

            padding: 0 24px;

            margin-bottom: 18px;

            display: flex;
            align-items: center;

            background: #fff4f4;

            border: 1px solid #ffbebe;

            border-radius: 17px;

            color: #bd2525;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 13px;
        }

        .alert strong {
            margin-right: 5px;

            font-size: 15px;
        }


        .footer {
            min-height: 260px;

            padding: 30px 47px 20px;

            background: #3e2413;

            color: white;
        }

        .footer-content {
            display: grid;

            grid-template-columns:
                1.1fr
                1fr
                1.2fr;

            gap: 40px;
        }

        .footer h3 {
            margin-bottom: 12px;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 16px;

            line-height: 1.4;
        }

        .footer p,
        .footer a {
            color: #f2e5d8;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 13px;

            line-height: 1.45;

            text-decoration: none;
        }

        .footer-links {
            display: grid;

            gap: 8px;
        }

        .footer a:hover {
            color: #d7b786;
        }

        .footer-bottom {
            margin-top: 25px;

            padding-top: 15px;

            border-top: 1px solid #75502e;

            text-align: center;

            color: #f0e1d2;

            font-family: "Segoe UI", Arial, sans-serif;

            font-size: 12px;
        }

        @media (max-width: 1000px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {

            .sidebar {
                width: 70px;
            }

            .main {
                width: calc(100% - 70px);

                margin-left: 70px;
            }

            .logo {
                justify-content: center;

                padding: 18px 0;
            }

            .logo-text,
            .menu span {
                display: none;
            }

            .menu a {
                justify-content: center;

                padding: 0;
            }

            .menu .active {
                padding-left: 0;
            }

            .content {
                padding: 35px 15px 0;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .user-info {
                display: none;
            }
        }

    </style>

</head>


<body>

<div class="app">

    <aside class="sidebar">


        <div class="logo">

            <i class="fa-solid fa-book logo-icon"></i>

            <div class="logo-text">

                <span>
                    Biblioteca
                </span>

                <strong>
                    HMS
                </strong>

            </div>

        </div>


        <div class="sidebar-line"></div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}" class="active">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>

            <a href="{{ route('usuarios.index') }}">
                <i class="fa-solid fa-users"></i>
                <span>Beneficiarios</span>
            </a>

            <a href="{{ route('dashboard', ['modulo' => 'libros']) }}">
                <i class="fa-solid fa-book"></i>
                <span>Libros</span>
            </a>

            <a href="{{ route('prestamos.index') }}">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <span>Préstamos</span>
            </a>

            <a href="{{ route('devoluciones.index') }}">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Devolución</span>
            </a>

            <a href="{{ route('multas.index') }}">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Multa</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-chart-line"></i>
                <span>Reporte</span>
            </a>

            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">
                @csrf
            </form>
            <a href="#" onclick="document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-power-off"></i>
                <span>Cerrar Sesión</span>
            </a>

        </nav>

    </aside>

    <main class="main">


        <header class="topbar">

            <h1>{{ isset($modulo) && $modulo === 'libros' ? 'Libros' : 'Inicio' }}</h1>


            <div class="user">

                <div class="user-info">

                    <strong>
                        Bibliotecario
                    </strong>

                    <span>
                        Michi
                    </span>

                </div>


                <div class="user-icon">

                    <i class="fa-solid fa-user"></i>

                </div>

            </div>

        </header>

        <section class="content">


            @if(isset($modulo) && $modulo === 'libros')
                @include('libros.catalogo-dashboard')
            @else
            <div class="welcome">

                <h2>
                    Bienvenido
                </h2>

                <p>
                    Panel de control de la biblioteca
                    Humberto Montealegre Sánchez.
                </p>

            </div>


            <div class="cards">


                <div class="card">

                    <div class="card-title">
                        Beneficiarios
                    </div>

                    <div class="card-number">
                        21
                    </div>

                </div>

                <div class="card blue">

                    <div class="card-title">
                        Libros
                    </div>

                    <div class="card-number">
                        10
                    </div>

                </div>


                <div class="card green">

                    <div class="card-title">
                        Préstamos
                    </div>

                    <div class="card-number">
                        20
                    </div>

                </div>


                <div class="card red">

                    <div class="card-title">
                        Multas
                    </div>

                    <div class="card-number">
                        9
                    </div>

                </div>

            </div>


            <div class="alert">

                <strong>
                    Atención:
                </strong>

                <span>
                    Hay 9 multas registradas.
                </span>

            </div>


            <footer class="footer">

                <div class="footer-content">



                    <div>

                        <h3>
                            Biblioteca Humberto<br>
                            Montealegre Sanchez
                        </h3>

                        <p>
                            Tecnología, organización y conocimiento
                            reunidos para una mejor gestión bibliotecaria.
                        </p>

                    </div>


                    <div>

                        <h3>
                            Enlaces Rápidos
                        </h3>

                        <div class="footer-links">

                            <a href="#">
                                Inicio
                            </a>

                            <a href="#">
                                Libros
                            </a>

                            <a href="#">
                                Préstamos
                            </a>

                        </div>

                    </div>


                    <div>

                        <h3>
                            Contacto
                        </h3>

                        <p>
                            Correo: bibliotecaHumbertoM@gmail.com
                        </p>

                        <p>
                            Teléfono: +57 3124225678
                        </p>

                    </div>

                </div>

                <div class="footer-bottom">

                    © {{ date('Y') }}
                    Sistema de Biblioteca.
                    Todos los derechos reservados.

                </div>

            </footer>
            @endif

        </section>

    </main>

</div>

</body>

</html>