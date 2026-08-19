<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestión de Beneficiarios - Biblioteca HMS</title>

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
            padding: 30px 40px;
        }

        .page-banner {
            padding: 24px 35px;
            margin-bottom: 25px;
            background: #573b29;
            color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .page-banner h2 {
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 28px;
            font-weight: bold;
        }

        .toolbar {
            display: flex;
            align-items: center;
            background: white;
            padding: 18px 25px;
            border-radius: 16px;
            border: 1px solid #eae2d8;
            margin-bottom: 25px;
            gap: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }

        .toolbar-stat {
            background: #fdfaf6;
            border: 1px solid #efe5d9;
            border-radius: 12px;
            padding: 10px 20px;
            min-width: 180px;
        }

        .toolbar-stat span {
            font-size: 12px;
            color: #777;
            display: block;
            margin-bottom: 2px;
        }

        .toolbar-stat strong {
            font-size: 26px;
            color: #75461f;
        }

        .toolbar-search {
            flex: 1;
            padding: 14px 20px;
            border: 1px solid #efe5d9;
            border-radius: 12px;
            outline: none;
            font-size: 14px;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #555;
        }

        .toolbar-search::placeholder {
            color: #a9a9a9;
        }

        .btn {
            padding: 14px 24px;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            font-size: 13px;
            cursor: pointer;
            font-family: "Segoe UI", Arial, sans-serif;
            text-decoration: none;
            display: inline-block;
        }

        .btn-buscar {
            background: #75461f;
        }

        .btn-nuevo {
            background: #573b29;
        }

        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #eae2d8;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #75461f;
            color: white;
            padding: 16px 20px;
            font-size: 13px;
            font-weight: bold;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f4f0ec;
            font-size: 13px;
            color: #444;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .btn-edit {
            background: #3b82f6;
        }

        .btn-delete {
            background: #ef4444;
        }
    </style>
</head>

<body>

<div class="app">

    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-book logo-icon"></i>
            <div class="logo-text">
                <span>Biblioteca</span>
                <strong>HMS</strong>
            </div>
        </div>

        <div class="sidebar-line"></div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="active">
                <i class="fa-solid fa-users"></i>
                <span>Beneficiarios</span>
            </a>
            <a href="{{ route('libros.index') }}">
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
            <h1>Gestión de Beneficiarios</h1>
            <div class="user">
                <div class="user-info">
                    <strong>Bibliotecario</strong>
                    <span>{{ session('usuario.nombre', 'Michi') }}</span>
                </div>
                <div class="user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <section class="content">

            <div class="page-banner">
                <h2>Gestión de Beneficiarios</h2>
            </div>

            <div class="toolbar">
                <div class="toolbar-stat">
                    <span>Beneficiarios encontrados</span>
                    <strong>{{ count($usuarios) }}</strong>
                </div>

                <input type="text" class="toolbar-search" placeholder="Buscar por nombre, documento, teléfono o correo...">

                <button class="btn btn-buscar">Buscar</button>
                <a href="{{ route('usuarios.create') }}" class="btn btn-nuevo">+ Nuevo Beneficiario</a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $index => $usuario)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->documento }}</td>
                            <td>{{ $usuario->telefono ?? '-' }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->rol->descripcion ?? 'Beneficiario' }}</td>
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn-icon btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este beneficiario?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

    </main>

</div>

</body>

</html>
