<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f7f4f1; color: #2e2118; font-family: "Segoe UI", Arial, sans-serif; }
        .app { display: flex; min-height: 100vh; }
        .sidebar { position: fixed; inset: 0 auto 0 0; z-index: 2; width: 234px; background: #2d1a0e; color: #fff; }
        .logo { height: 103px; padding: 24px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,.12); }
        .logo-icon { color: #d7b786; font-size: 25px; }
        .logo-text span { display: block; color: #d7b786; font-size: 13px; letter-spacing: 1px; }
        .logo-text strong { display: block; color: #fff; font: bold 20px Georgia, serif; }
        .menu { padding-top: 22px; }
        .menu a { height: 44px; padding: 0 21px; display: flex; align-items: center; gap: 14px; color: #f1e7dc; text-decoration: none; font-size: 14px; }
        .menu a i { width: 18px; text-align: center; color: #d7c5b1; }
        .menu a:hover, .menu a.active { background: #503522; border-left: 3px solid #d7b786; padding-left: 22px; }
        .main { width: calc(100% - 234px); min-height: 100vh; margin-left: 234px; }
        .topbar { height: 66px; padding: 0 28px; display: flex; align-items: center; justify-content: space-between; background: #75461f; color: #fff; }
        .topbar h1 { margin: 0; font: bold 21px Georgia, serif; }
        .user { display: flex; align-items: center; gap: 13px; text-align: right; }
        .user strong, .user span { display: block; }
        .user span { color: #f0e0ce; font-size: 14px; }
        .user-icon { width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #96724c; font-size: 18px; }
        .content { padding: 30px 40px; }
        .hero { min-height: 112px; margin-bottom: 24px; padding: 34px 38px; border-radius: 26px; background: linear-gradient(110deg, #633a1d, #3d2110); box-shadow: 0 12px 20px rgba(66,38,18,.14); }
        .hero h2 { margin: 0; color: #fff; font-size: 32px; line-height: 1; }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 24px; }
        .stat-card { min-height: 155px; padding: 20px; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
        .stat-icon { width: 46px; height: 46px; display: flex; align-items: center; justify-content: center; margin-bottom: 17px; border-radius: 15px; font-size: 18px; }
        .stat-total .stat-icon { background: #f3ede5; color: #70431e; }
        .stat-active .stat-icon { background: #d9f8e5; color: #0a8b45; }
        .stat-returned .stat-icon { background: #dceaff; color: #2455d7; }
        .stat-rejected .stat-icon { background: #ffe0e2; color: #c5252b; }
        .stat-card span { display: block; color: #687791; font-size: 13px; }
        .stat-card strong { display: block; margin-top: 10px; font-size: 34px; line-height: 1; }
        .stat-total strong { color: #70431e; }
        .stat-active strong { color: #0a9b49; }
        .stat-returned strong { color: #2760e6; }
        .stat-rejected strong { color: #df292d; }
        .search-panel { margin-bottom: 24px; padding: 20px; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
        .search-form { display: flex; gap: 15px; }
        .search-form input { flex: 1; height: 48px; padding: 0 15px; border: 1px solid #d4dbe5; border-radius: 12px; font: 14px inherit; outline: none; }
        .search-form button { width: 105px; border: 0; border-radius: 12px; background: #75461f; color: #fff; font-weight: 700; font-size: 14px; cursor: pointer; }
        .alert { margin-bottom: 24px; padding: 18px 22px; border-radius: 15px; }
        .alert-success { border: 1px solid #a6f0bd; background: #effff3; color: #087d35; }
        .loan-list { overflow: hidden; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
        .loan-list h3 { margin: 0; padding: 18px 20px; background: #75461f; color: #fff; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 15px 16px; background: #f7f0e7; color: #2e2118; text-align: left; font-size: 13px; }
        td { padding: 15px 16px; border-bottom: 1px solid #e3e5e8; color: #36557f; font-size: 13px; }
        td strong { color: #17120e; font-size: 14px; }
        .status { display: inline-block; padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 700; }
        .status-active { background: #d9f8e5; color: #0a8b45; }
        .status-returned { background: #dceaff; color: #2455d7; }
        .status-rejected { background: #ffe0e2; color: #c5252b; }
        .delete-loan { width: 38px; height: 38px; border: 0; border-radius: 50%; background: #4b5666; color: #fff; cursor: pointer; font-size: 14px; }
        .empty { padding: 40px; color: #687791; text-align: center; }
        @media (max-width: 1050px) { .stats { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 760px) { .sidebar { width: 70px; } .logo { justify-content: center; padding: 20px 8px; } .logo-text, .menu a span { display: none; } .menu a { justify-content: center; padding: 0; } .main { width: calc(100% - 70px); margin-left: 70px; } .topbar { padding: 0 16px; } .topbar h1 { font-size: 20px; } .user-info { display: none; } .content { padding: 20px 15px; } .hero { padding: 35px 25px; } .hero h2 { font-size: 34px; } .stats { grid-template-columns: 1fr; } .search-form { flex-direction: column; } .search-form button { width: 100%; height: 55px; } .loan-list { overflow-x: auto; } table { min-width: 950px; } }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="logo"><i class="fa-solid fa-book logo-icon"></i><div class="logo-text"><span>Biblioteca</span><strong>HMS</strong></div></div>
        <nav class="menu">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i><span>Inicio</span></a>
            <a href="{{ route('usuarios.index') }}"><i class="fa-solid fa-users"></i><span>Beneficiarios</span></a>
            <a href="{{ route('libros.index') }}"><i class="fa-solid fa-book"></i><span>Libros</span></a>
            <a href="{{ route('prestamos.index') }}" class="active"><i class="fa-solid fa-hand-holding-heart"></i><span>Préstamos</span></a>
            <a href="{{ route('devoluciones.index') }}"><i class="fa-solid fa-rotate-left"></i><span>Devolución</span></a>
            <a href="{{ route('multas.index') }}"><i class="fa-solid fa-file-invoice-dollar"></i><span>Multa</span></a>
            <a href="#"><i class="fa-solid fa-chart-line"></i><span>Reporte</span></a>
            <form action="{{ route('logout') }}" method="POST" id="loan-logout" style="display:none;">@csrf</form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('loan-logout').submit();"><i class="fa-solid fa-power-off"></i><span>Cerrar Sesión</span></a>
        </nav>
    </aside>
    <main class="main">
        <header class="topbar"><h1>Gestión de Préstamos</h1><div class="user"><div class="user-info"><strong>Bibliotecario</strong><span>{{ session('usuario.nombre', 'Michi') }}</span></div><div class="user-icon"><i class="fa-solid fa-user"></i></div></div></header>
        <section class="content">
            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            <div class="hero"><h2>Gestión de Préstamos</h2></div>
            <div class="stats">
                <div class="stat-card stat-total"><div class="stat-icon"><i class="fa-solid fa-book-open"></i></div><span>Total préstamos</span><strong>{{ $totalPrestamos }}</strong></div>
                <div class="stat-card stat-active"><div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div><span>Activos</span><strong>{{ $activos }}</strong></div>
                <div class="stat-card stat-returned"><div class="stat-icon"><i class="fa-solid fa-rotate-left"></i></div><span>Devueltos</span><strong>{{ $devueltos }}</strong></div>
                <div class="stat-card stat-rejected"><div class="stat-icon"><i class="fa-solid fa-circle-xmark"></i></div><span>Rechazados</span><strong>{{ $rechazados }}</strong></div>
            </div>
            <div class="search-panel"><form method="GET" action="{{ route('prestamos.index') }}" class="search-form"><input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar por libro, beneficiario, documento, estado o fecha..."><button type="submit">Buscar</button></form></div>
            <div class="loan-list">
                <h3>Listado de préstamos</h3>
                <table>
                    <thead><tr><th>#</th><th>Libro</th><th>Beneficiario</th><th>Documento</th><th>Fecha préstamo</th><th>Fecha devolución</th><th>Estado</th><th>Acciones</th></tr></thead>
                    <tbody>
                        @forelse($prestamos as $prestamo)
                            @php($estado = strtolower($prestamo->estado ?? ''))
                            <tr>
                                <td>{{ $prestamo->idprestamo }}</td>
                                <td><strong>{{ $prestamo->libro->titulo ?? 'Sin libro' }}</strong></td>
                                <td>{{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }}</td>
                                <td>{{ $prestamo->usuario->documento ?? '-' }}</td>
                                <td>{{ optional($prestamo->fecha_prestamo)->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ optional($prestamo->devolucion?->fecha_devolucion)->format('Y-m-d') ?? '-' }}</td>
                                <td><span class="status {{ str_contains($estado, 'activo') ? 'status-active' : (str_contains($estado, 'rechaz') ? 'status-rejected' : 'status-returned') }}">{{ $prestamo->estado }}</span></td>
                                <td><form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" onsubmit="return confirm('¿Eliminar este préstamo?')">@csrf @method('DELETE')<button class="delete-loan" type="submit" title="Eliminar préstamo"><i class="fa-solid fa-trash"></i></button></form></td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="empty">No hay préstamos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>
