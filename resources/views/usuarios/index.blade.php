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

        .search-form {
            display: flex;
            flex: 1;
            gap: 15px;
            margin: 0;
        }

        .search-form .toolbar-search {
            min-width: 0;
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

        .alert-success {
            margin-bottom: 25px;
            padding: 18px;
            border-radius: 8px;
            background: #20c95a;
            color: white;
            font-size: 15px;
        }

        .alert-error {
            margin-bottom: 22px;
            padding: 12px 16px;
            border: 1px solid #e2b8b8;
            border-radius: 2px;
            background: #fff0f0;
            color: #8c2929;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 10;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0, 0, 0, .48);
        }

        .modal-overlay.is-open {
            display: flex;
        }

        .beneficiary-modal {
            width: min(798px, 100%);
            background: #f5efe6;
            box-shadow: 0 20px 45px rgba(0, 0, 0, .3);
        }

        .modal-header {
            padding: 28px 34px 26px;
            border-bottom: 1px solid #bdb5ab;
        }

        .modal-header h2 {
            margin: 0;
            color: #8a633d;
            font-size: 27px;
            font-weight: 400;
        }

        .modal-header strong {
            color: #3f2919;
            font-weight: 700;
        }

        .modal-body {
            padding: 31px 34px 28px;
        }

        .modal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px 50px;
        }

        .modal-field-full {
            grid-column: 1 / -1;
        }

        .modal-body label {
            display: block;
            margin-bottom: 10px;
            color: #704723;
            font-size: 13px;
            font-weight: 700;
        }

        .modal-body input {
            width: 100%;
            height: 44px;
            padding: 0 12px;
            border: 1px solid #cbd2da;
            border-radius: 2px;
            background: #fff;
            font: inherit;
            outline: none;
        }

        .modal-body input:focus {
            border-color: #81522d;
        }

        .modal-password {
            position: relative;
        }

        .modal-password input {
            padding-right: 42px;
        }

        .modal-password button {
            position: absolute;
            top: 50%;
            right: 11px;
            padding: 0;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #566170;
            cursor: pointer;
            font-size: 17px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-top: 84px;
        }

        .modal-actions button,
        .modal-actions a {
            height: 35px;
            padding: 0 22px;
            border: 0;
            border-radius: 2px;
            font: 700 13px "Segoe UI", Arial, sans-serif;
            cursor: pointer;
            text-decoration: none;
        }

        .modal-cancel {
            min-width: 93px;
            background: #fff;
            color: #7b5837;
        }

        .modal-save {
            min-width: 190px;
            background: #653a1e;
            color: #fff;
        }

        .edit-beneficiary-trigger {
            background: #3b82f6;
        }

        @media (max-width: 650px) {
            .modal-grid {
                grid-template-columns: 1fr;
            }

            .modal-field-full {
                grid-column: auto;
            }

            .modal-header,
            .modal-body {
                padding-left: 22px;
                padding-right: 22px;
            }

            .modal-actions {
                gap: 10px;
                margin-top: 45px;
            }
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

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            gap: 0;
            background: #f5f2ef;
            border-radius: 8px;
            overflow: hidden;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0 14px;
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 14px;
            color: #555;
            text-decoration: none;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .pagination-wrapper nav a:hover {
            background: #ebe6e0;
        }

        .pagination-wrapper nav .active-page {
            background: white;
            color: #75461f;
            font-weight: bold;
            border: 2px solid #75461f;
            border-radius: 6px;
        }

        .pagination-wrapper nav .disabled {
            color: #bbb;
            cursor: default;
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

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="page-banner">
                <h2>Gestión de Beneficiarios</h2>
            </div>

            <div class="toolbar">
                <div class="toolbar-stat">
                    <span>Beneficiarios encontrados</span>
                    <strong>{{ $usuarios->total() }}</strong>
                </div>

                <form action="{{ route('usuarios.index') }}" method="GET" class="search-form">
                    <input type="text" name="buscar" class="toolbar-search" value="{{ request('buscar') }}" placeholder="Buscar por nombre, documento, teléfono o correo...">
                    <button type="submit" class="btn btn-buscar">Buscar</button>
                </form>
                <button type="button" class="btn btn-nuevo" id="open-beneficiary-modal">+ Nuevo Beneficiario</button>
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
                                <button type="button" class="btn-icon edit-beneficiary-trigger" data-edit-beneficiary="edit-beneficiary-{{ $usuario->id_usuario }}"><i class="fa-solid fa-pen"></i></button>
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

            @foreach($usuarios as $usuario)
                <div class="modal-overlay edit-beneficiary-modal" id="edit-beneficiary-{{ $usuario->id_usuario }}" role="dialog" aria-modal="true" aria-labelledby="edit-beneficiary-title-{{ $usuario->id_usuario }}">
                    <div class="beneficiary-modal">
                        <div class="modal-header">
                            <h2 id="edit-beneficiary-title-{{ $usuario->id_usuario }}">Editar <strong>Beneficiario</strong></h2>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-grid">
                                    <div class="modal-field-full">
                                        <label for="edit-name-{{ $usuario->id_usuario }}">Nombre completo</label>
                                        <input type="text" id="edit-name-{{ $usuario->id_usuario }}" name="nombre" value="{{ $usuario->nombre }}" required>
                                    </div>
                                    <div>
                                        <label for="edit-document-{{ $usuario->id_usuario }}">Documento</label>
                                        <input type="text" id="edit-document-{{ $usuario->id_usuario }}" name="documento" value="{{ $usuario->documento }}" required>
                                    </div>
                                    <div>
                                        <label for="edit-phone-{{ $usuario->id_usuario }}">Teléfono</label>
                                        <input type="text" id="edit-phone-{{ $usuario->id_usuario }}" name="telefono" value="{{ $usuario->telefono }}">
                                    </div>
                                    <div class="modal-field-full">
                                        <label for="edit-email-{{ $usuario->id_usuario }}">Correo Electrónico</label>
                                        <input type="email" id="edit-email-{{ $usuario->id_usuario }}" name="correo" value="{{ $usuario->email }}" required>
                                    </div>
                                    <div class="modal-field-full">
                                        <label for="edit-password-{{ $usuario->id_usuario }}">Nueva contraseña</label>
                                        <input type="password" id="edit-password-{{ $usuario->id_usuario }}" name="password" placeholder="Déjala vacía si no deseas cambiarla">
                                    </div>
                                </div>
                                <div class="modal-actions">
                                    <button type="button" class="modal-cancel close-edit-beneficiary">Cancelar</button>
                                    <button type="submit" class="modal-save">Actualizar Beneficiario</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($usuarios->hasPages())
            <div class="pagination-wrapper">
                <nav>
                    {{-- Primera página --}}
                    @if($usuarios->onFirstPage())
                        <span class="disabled">&laquo;</span>
                    @else
                        <a href="{{ $usuarios->url(1) }}">&laquo;</a>
                    @endif

                    {{-- Anterior --}}
                    @if($usuarios->onFirstPage())
                        <span class="disabled">&lsaquo; Anterior</span>
                    @else
                        <a href="{{ $usuarios->previousPageUrl() }}">&lsaquo; Anterior</a>
                    @endif

                    {{-- Números de página --}}
                    @for($i = 1; $i <= $usuarios->lastPage(); $i++)
                        @if($i == $usuarios->currentPage())
                            <span class="active-page">{{ $i }}</span>
                        @else
                            <a href="{{ $usuarios->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Siguiente --}}
                    @if($usuarios->hasMorePages())
                        <a href="{{ $usuarios->nextPageUrl() }}">Siguiente &rsaquo;</a>
                    @else
                        <span class="disabled">Siguiente &rsaquo;</span>
                    @endif

                    {{-- Última página --}}
                    @if($usuarios->hasMorePages())
                        <a href="{{ $usuarios->url($usuarios->lastPage()) }}">&raquo;</a>
                    @else
                        <span class="disabled">&raquo;</span>
                    @endif
                </nav>
            </div>
            @endif

        </section>

    </main>

</div>

<div class="modal-overlay{{ $errors->any() ? ' is-open' : '' }}" id="beneficiary-modal" role="dialog" aria-modal="true" aria-labelledby="beneficiary-modal-title">
    <div class="beneficiary-modal">
        <div class="modal-header">
            <h2 id="beneficiary-modal-title">Agregar <strong>Beneficiario</strong></h2>
        </div>

        <div class="modal-body">
            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-grid">
                    <div class="modal-field-full">
                        <label for="modal-nombre">Nombre completo</label>
                        <input type="text" id="modal-nombre" name="nombre" value="{{ old('nombre') }}" required autofocus>
                    </div>

                    <div>
                        <label for="modal-documento">Documento</label>
                        <input type="text" id="modal-documento" name="documento" value="{{ old('documento') }}" required>
                    </div>

                    <div>
                        <label for="modal-telefono">Teléfono</label>
                        <input type="text" id="modal-telefono" name="telefono" value="{{ old('telefono') }}">
                    </div>

                    <div class="modal-field-full">
                        <label for="modal-correo">Correo Electrónico</label>
                        <input type="email" id="modal-correo" name="correo" value="{{ old('correo') }}" required>
                    </div>

                    <div class="modal-field-full">
                        <label for="modal-password">Contraseña</label>
                        <div class="modal-password">
                            <input type="password" id="modal-password" name="password" required>
                            <button type="button" id="toggle-modal-password" aria-label="Mostrar contraseña">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="modal-cancel" id="close-beneficiary-modal">Cancelar</button>
                    <button type="submit" class="modal-save">Guardar Beneficiario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const beneficiaryModal = document.getElementById('beneficiary-modal');
    const openBeneficiaryModal = document.getElementById('open-beneficiary-modal');
    const closeBeneficiaryModal = document.getElementById('close-beneficiary-modal');
    const modalPassword = document.getElementById('modal-password');
    const toggleModalPassword = document.getElementById('toggle-modal-password');

    openBeneficiaryModal.addEventListener('click', () => {
        beneficiaryModal.classList.add('is-open');
        document.getElementById('modal-nombre').focus();
    });

    closeBeneficiaryModal.addEventListener('click', () => {
        beneficiaryModal.classList.remove('is-open');
    });

    beneficiaryModal.addEventListener('click', (event) => {
        if (event.target === beneficiaryModal) {
            beneficiaryModal.classList.remove('is-open');
        }
    });

    toggleModalPassword.addEventListener('click', () => {
        const isPassword = modalPassword.type === 'password';
        modalPassword.type = isPassword ? 'text' : 'password';
        toggleModalPassword.innerHTML = `<i class="fa-solid fa-eye${isPassword ? '-slash' : ''}"></i>`;
    });

    document.querySelectorAll('.edit-beneficiary-trigger').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = document.getElementById(button.dataset.editBeneficiary);
            modal.classList.add('is-open');
            modal.querySelector('input[name="nombre"]').focus();
        });
    });

    document.querySelectorAll('.close-edit-beneficiary').forEach((button) => {
        button.addEventListener('click', () => button.closest('.edit-beneficiary-modal').classList.remove('is-open'));
    });

    document.querySelectorAll('.edit-beneficiary-modal').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.classList.remove('is-open');
        });
    });
</script>

</body>

</html>
