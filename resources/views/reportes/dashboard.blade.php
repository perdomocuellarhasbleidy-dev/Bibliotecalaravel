<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f7f4f1; color: #3d2617; font-family: "Segoe UI", Arial, sans-serif; }
        .app { display: flex; min-height: 100vh; }
        .sidebar { position: fixed; inset: 0 auto 0 0; z-index: 2; width: 234px; background: #2d1a0e; color: #fff; }
        .logo { height: 96px; padding: 24px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,.12); }
        .logo-icon { color: #d7b786; font-size: 25px; }.logo-text span { display: block; color: #d7b786; font-size: 12px; letter-spacing: 1px; }.logo-text strong { display: block; color: #fff; font: bold 20px Georgia,serif; }
        .menu a { height: 44px; padding: 0 21px; display: flex; align-items: center; gap: 14px; color: #f1e7dc; text-decoration: none; font-size: 14px; }.menu a i { width: 18px; text-align: center; color: #d7c5b1; }.menu a:hover,.menu a.active { background: #503522; border-left: 3px solid #d7b786; padding-left: 18px; }
        .main { width: calc(100% - 234px); min-height: 100vh; margin-left: 234px; }.topbar { height: 66px; padding: 0 28px; display: flex; align-items: center; justify-content: space-between; background: #75461f; color: #fff; }.topbar h1 { margin: 0; font: bold 21px Georgia,serif; }.user { display: flex; align-items: center; gap: 10px; text-align: right; }.user strong,.user span { display: block; }.user span { color: #f0e0ce; font-size: 12px; }.user-icon { width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #96724c; }
        .content { padding: 35px 40px; }.reports-hero { margin-bottom: 25px; padding: 34px 36px; border-radius: 26px; background: linear-gradient(110deg,#633a1d,#3d2110); box-shadow: 0 10px 18px rgba(66,38,18,.13); }.reports-hero h2 { margin: 0; color: #fff; font-size: 32px; }
        .filter-panel,.tabs-panel { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding: 20px 26px; border: 1px solid #e2e4e7; border-radius: 18px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.09); }.filter-panel label { display: block; margin-bottom: 7px; color: #684321; font-size: 13px; font-weight: 700; }.date-field { flex: 0 0 230px; }.date-field input { width: 100%; height: 55px; padding: 0 14px; border: 1px solid #d4dbe5; border-radius: 11px; font: 15px inherit; }.filter-button,.print-button { height: 52px; min-width: 180px; margin-top: 22px; border: 0; border-radius: 11px; color: #fff; font-weight: 700; font-size: 15px; cursor: pointer; }.filter-button { background: #75461f; }.print-button { background: #3d2110; }.tabs-panel { gap: 12px; }.report-tab { flex: 1; height: 54px; border: 1px solid #9a6d48; border-radius: 14px; background: #fff; color: #75461f; font-size: 15px; font-weight: 700; cursor: pointer; text-decoration: none; text-align: center; line-height: 54px; }.report-tab.active { background: #3d2110; color: #fff; }
        .report-cards { display: grid; grid-template-columns: repeat(6,1fr); gap: 18px; }.report-card { min-height: 112px; padding: 22px; border: 1px solid #e2e4e7; border-radius: 18px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.09); }.report-card span { display: block; color: #687791; font-size: 13px; }.report-card strong { display: block; margin-top: 12px; color: #70431e; font-size: 29px; }.report-card.money strong { font-size: 22px; white-space: nowrap; }
        .report-detail { margin-top: 25px; overflow: hidden; border: 1px solid #e2e4e7; border-radius: 18px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.09); }.report-detail h3 { margin: 0; padding: 20px 26px; background: #75461f; color: #fff; font-size: 20px; }.report-detail table { width: 100%; border-collapse: collapse; }.report-detail th { padding: 15px 26px; background: #f7f0e7; color: #2e2118; text-align: left; font-size: 13px; }.report-detail td { padding: 14px 26px; border-bottom: 1px solid #e3e5e8; color: #36557f; font-size: 13px; }.report-detail td strong { color: #17120e; }.report-detail .empty { padding: 35px; text-align: center; }
        .report-pagination { display: flex; justify-content: center; margin-top: 24px; }.report-pagination nav { display: flex; align-items: center; gap: 8px; }.report-pagination a,.report-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 42px; padding: 0 11px; color: #6e4b30; font-size: 14px; text-decoration: none; }.report-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; font-weight: 700; }.report-pagination .disabled { color: #b8b2ac; }
        @media print { .sidebar,.topbar,.filter-panel,.tabs-panel { display: none; }.main { width: 100%; margin: 0; }.content { padding: 0; }.reports-hero { box-shadow: none; }.report-detail { overflow: visible; box-shadow: none; page-break-inside: auto; }.report-detail thead { display: table-header-group; }.report-detail tr { page-break-inside: avoid; page-break-after: auto; }.report-pagination { display: none; } }
        @media (max-width: 1000px) { .report-cards { grid-template-columns: repeat(3,1fr); } }.@media (max-width: 700px) { .sidebar { width: 70px; }.logo { justify-content: center; padding: 20px 8px; }.logo-text,.menu a span { display: none; }.menu a { justify-content: center; padding: 0; }.main { width: calc(100% - 70px); margin-left: 70px; }.content { padding: 20px 15px; }.filter-panel,.tabs-panel { flex-wrap: wrap; }.date-field { flex-basis: calc(50% - 8px); }.filter-button,.print-button { flex: 1; }.report-cards { grid-template-columns: repeat(2,1fr); } }.@media (max-width: 450px) { .report-cards { grid-template-columns: 1fr; }.date-field { flex-basis: 100%; } }
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
            <a href="{{ route('prestamos.index') }}"><i class="fa-solid fa-hand-holding-heart"></i><span>Préstamos</span></a>
            <a href="{{ route('devoluciones.index') }}"><i class="fa-solid fa-rotate-left"></i><span>Devolución</span></a>
            <a href="{{ route('multas.index') }}"><i class="fa-solid fa-file-invoice-dollar"></i><span>Multa</span></a>
            <a href="{{ route('reportes.index') }}" class="active"><i class="fa-solid fa-chart-line"></i><span>Reporte</span></a>
            <form action="{{ route('logout') }}" method="POST" id="report-logout" style="display:none;">@csrf</form><a href="#" onclick="event.preventDefault(); document.getElementById('report-logout').submit();"><i class="fa-solid fa-power-off"></i><span>Cerrar Sesión</span></a>
        </nav>
    </aside>
    <main class="main">
        <header class="topbar"><h1>Reportes</h1><div class="user"><div><strong>Bibliotecario</strong><span>{{ session('usuario.nombre','Michi') }}</span></div><div class="user-icon"><i class="fa-solid fa-user"></i></div></div></header>
        <section class="content {{ $imprimir ? 'print-version' : '' }}">
            <div class="reports-hero"><h2>Reportes</h2></div>
            <form method="GET" action="{{ route('reportes.index') }}" class="filter-panel">
                <div class="date-field"><label for="fecha_inicio">Fecha inicio</label><input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ $fechaInicio }}"></div>
                <div class="date-field"><label for="fecha_fin">Fecha fin</label><input type="date" id="fecha_fin" name="fecha_fin" value="{{ $fechaFin }}"></div>
                <input type="hidden" name="tipo" value="{{ $tipo }}"><button type="submit" class="filter-button">Filtrar</button><button type="button" class="print-button" onclick="window.location.href='{{ route('reportes.index', array_filter(['tipo' => $tipo, 'fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin, 'imprimir' => 1])) }}'">Imprimir</button>
            </form>
            <div class="tabs-panel">
                @foreach(['resumen' => 'Resumen','prestamos' => 'Préstamos','devoluciones' => 'Devoluciones','multas' => 'Multas','libros' => 'Libros','beneficiarios' => 'Beneficiarios'] as $clave => $nombre)
                    <a class="report-tab {{ $tipo === $clave ? 'active' : '' }}" href="{{ route('reportes.index', array_filter(['tipo' => $clave, 'fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin])) }}">{{ $nombre }}</a>
                @endforeach
            </div>
            @if(!in_array($tipo, ['prestamos', 'devoluciones', 'multas', 'libros', 'beneficiarios']))
                <div class="report-cards">
                    <div class="report-card"><span>Beneficiarios</span><strong>{{ $totalBeneficiarios }}</strong></div>
                    <div class="report-card"><span>Libros</span><strong>{{ $totalLibros }}</strong></div>
                    @if($tipo !== 'multas')
                        <div class="report-card"><span>Préstamos</span><strong>{{ $totalPrestamos }}</strong></div>
                    @endif
                    <div class="report-card"><span>Devoluciones</span><strong>{{ $totalDevoluciones }}</strong></div>
                    <div class="report-card"><span>Multas</span><strong>{{ $totalMultas }}</strong></div>
                    @if($tipo === 'multas')
                        <div class="report-card money"><span>Valor Multas</span><strong>${{ number_format((float) $valorMultas, 2, ',', '.') }}</strong></div>
                    @endif
                </div>
            @endif
            @if($tipo === 'prestamos')
                <div class="report-detail">
                    <h3>Reporte de Préstamos</h3>
                    <table>
                        <thead><tr><th>#</th><th>Libro</th><th>Beneficiario</th><th>Documento</th><th>Fecha</th><th>Estado</th></tr></thead>
                        <tbody>
                            @forelse($prestamosReporte as $prestamo)
                                <tr><td>{{ $prestamo->idprestamo }}</td><td><strong>{{ $prestamo->libro->titulo ?? 'Sin libro' }}</strong></td><td>{{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }}</td><td>{{ $prestamo->usuario->documento ?? '-' }}</td><td>{{ optional($prestamo->fecha_prestamo)->format('Y-m-d') ?? '-' }}</td><td>{{ $prestamo->estado }}</td></tr>
                            @empty
                                <tr><td colspan="6" class="empty">No hay préstamos para el período seleccionado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($prestamosReporte->hasPages())
                    <div class="report-pagination"><nav>
                        @if($prestamosReporte->onFirstPage()) <span class="disabled">«</span><span class="disabled">‹ Anterior</span> @else <a href="{{ $prestamosReporte->url(1) }}">«</a><a href="{{ $prestamosReporte->previousPageUrl() }}">‹ Anterior</a> @endif
                        @for($pagina = 1; $pagina <= $prestamosReporte->lastPage(); $pagina++)
                            @if($pagina === $prestamosReporte->currentPage()) <span class="active-page">{{ $pagina }}</span> @else <a href="{{ $prestamosReporte->url($pagina) }}">{{ $pagina }}</a> @endif
                        @endfor
                        @if($prestamosReporte->hasMorePages()) <a href="{{ $prestamosReporte->nextPageUrl() }}">Siguiente ›</a><a href="{{ $prestamosReporte->url($prestamosReporte->lastPage()) }}">»</a> @else <span class="disabled">Siguiente ›</span><span class="disabled">»</span> @endif
                    </nav></div>
                @endif
            @endif
            @if($tipo === 'devoluciones')
                <div class="report-detail">
                    <h3>Reporte de Devoluciones</h3>
                    <table>
                        <thead><tr><th>#</th><th>Préstamo</th><th>Libro</th><th>Beneficiario</th><th>Documento</th><th>Fecha Devolución</th><th>Estado</th></tr></thead>
                        <tbody>
                            @forelse($devolucionesReporte as $devolucion)
                                <tr><td>{{ $devolucion->iddevolucion }}</td><td>{{ $devolucion->idprestamo }}</td><td><strong>{{ $devolucion->libro->titulo ?? 'Sin libro' }}</strong></td><td>{{ $devolucion->usuario->nombre ?? 'Sin beneficiario' }}</td><td>{{ $devolucion->usuario->documento ?? '-' }}</td><td>{{ optional($devolucion->fecha_devolucion)->format('Y-m-d') ?? '-' }}</td><td>{{ $devolucion->estado }}</td></tr>
                            @empty
                                <tr><td colspan="7" class="empty">No hay devoluciones para el período seleccionado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($devolucionesReporte->hasPages())
                    <div class="report-pagination"><nav>
                        @if($devolucionesReporte->onFirstPage()) <span class="disabled">«</span><span class="disabled">‹ Anterior</span> @else <a href="{{ $devolucionesReporte->url(1) }}">«</a><a href="{{ $devolucionesReporte->previousPageUrl() }}">‹ Anterior</a> @endif
                        @for($pagina = 1; $pagina <= $devolucionesReporte->lastPage(); $pagina++) @if($pagina === $devolucionesReporte->currentPage()) <span class="active-page">{{ $pagina }}</span> @else <a href="{{ $devolucionesReporte->url($pagina) }}">{{ $pagina }}</a> @endif @endfor
                        @if($devolucionesReporte->hasMorePages()) <a href="{{ $devolucionesReporte->nextPageUrl() }}">Siguiente ›</a><a href="{{ $devolucionesReporte->url($devolucionesReporte->lastPage()) }}">»</a> @else <span class="disabled">Siguiente ›</span><span class="disabled">»</span> @endif
                    </nav></div>
                @endif
            @endif
            @if($tipo === 'multas')
                <div class="report-detail">
                    <h3>Reporte de Multas</h3>
                    <table>
                        <thead><tr><th>#</th><th>Préstamo</th><th>Libro</th><th>Beneficiario</th><th>Documento</th><th>Motivo</th><th>Fecha</th><th>Valor</th></tr></thead>
                        <tbody>
                            @forelse($multasReporte as $multa)
                                <tr><td>{{ $multa->idmulta }}</td><td>{{ $multa->idprestamo }}</td><td><strong>{{ $multa->prestamo->libro->titulo ?? 'Sin libro' }}</strong></td><td>{{ $multa->prestamo->usuario->nombre ?? 'Sin beneficiario' }}</td><td>{{ $multa->prestamo->usuario->documento ?? '-' }}</td><td>{{ $multa->motivo }}</td><td>{{ optional($multa->fecha)->format('Y-m-d') ?? '-' }}</td><td><strong>${{ number_format((float) $multa->valor, 2, ',', '.') }}</strong></td></tr>
                            @empty
                                <tr><td colspan="8" class="empty">No hay multas para el período seleccionado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(!$imprimir && $multasReporte->hasPages())
                    <div class="report-pagination"><nav>
                        @if($multasReporte->onFirstPage()) <span class="disabled">«</span><span class="disabled">‹ Anterior</span> @else <a href="{{ $multasReporte->url(1) }}">«</a><a href="{{ $multasReporte->previousPageUrl() }}">‹ Anterior</a> @endif
                        @for($pagina = 1; $pagina <= $multasReporte->lastPage(); $pagina++) @if($pagina === $multasReporte->currentPage()) <span class="active-page">{{ $pagina }}</span> @else <a href="{{ $multasReporte->url($pagina) }}">{{ $pagina }}</a> @endif @endfor
                        @if($multasReporte->hasMorePages()) <a href="{{ $multasReporte->nextPageUrl() }}">Siguiente ›</a><a href="{{ $multasReporte->url($multasReporte->lastPage()) }}">»</a> @else <span class="disabled">Siguiente ›</span><span class="disabled">»</span> @endif
                    </nav></div>
                @endif
            @endif
            @if($tipo === 'libros')
                <div class="report-detail">
                    <h3>Reporte de Libros</h3>
                    <table>
                        <thead><tr><th>#</th><th>Título</th><th>Autor</th><th>Categoría</th><th>Año</th></tr></thead>
                        <tbody>
                            @forelse($librosReporte as $libro)
                                <tr><td>{{ $libro->idlibro }}</td><td><strong>{{ $libro->titulo }}</strong></td><td>{{ $libro->autor->nombre ?? 'Sin autor' }}</td><td>{{ $libro->categoria }}</td><td>{{ $libro->año_publicacion ?? 'No registrado' }}</td></tr>
                            @empty
                                <tr><td colspan="5" class="empty">No hay libros registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($librosReporte->hasPages())
                    <div class="report-pagination"><nav>
                        @if($librosReporte->onFirstPage()) <span class="disabled">«</span><span class="disabled">‹ Anterior</span> @else <a href="{{ $librosReporte->url(1) }}">«</a><a href="{{ $librosReporte->previousPageUrl() }}">‹ Anterior</a> @endif
                        @for($pagina = 1; $pagina <= $librosReporte->lastPage(); $pagina++) @if($pagina === $librosReporte->currentPage()) <span class="active-page">{{ $pagina }}</span> @else <a href="{{ $librosReporte->url($pagina) }}">{{ $pagina }}</a> @endif @endfor
                        @if($librosReporte->hasMorePages()) <a href="{{ $librosReporte->nextPageUrl() }}">Siguiente ›</a><a href="{{ $librosReporte->url($librosReporte->lastPage()) }}">»</a> @else <span class="disabled">Siguiente ›</span><span class="disabled">»</span> @endif
                    </nav></div>
                @endif
            @endif
            @if($tipo === 'beneficiarios')
                <div class="report-detail">
                    <h3>Reporte de Beneficiarios</h3>
                    <table>
                        <thead><tr><th>#</th><th>Nombre</th><th>Documento</th><th>Teléfono</th><th>Correo</th></tr></thead>
                        <tbody>
                            @forelse($beneficiariosReporte as $beneficiario)
                                <tr><td>{{ $beneficiario->id_usuario }}</td><td>{{ $beneficiario->nombre }}</td><td>{{ $beneficiario->documento }}</td><td>{{ $beneficiario->telefono ?? '-' }}</td><td>{{ $beneficiario->email }}</td></tr>
                            @empty
                                <tr><td colspan="5" class="empty">No hay beneficiarios registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(!$imprimir && $beneficiariosReporte->hasPages())
                    <div class="report-pagination"><nav>
                        @if($beneficiariosReporte->onFirstPage()) <span class="disabled">«</span><span class="disabled">‹ Anterior</span> @else <a href="{{ $beneficiariosReporte->url(1) }}">«</a><a href="{{ $beneficiariosReporte->previousPageUrl() }}">‹ Anterior</a> @endif
                        @for($pagina = 1; $pagina <= $beneficiariosReporte->lastPage(); $pagina++) @if($pagina === $beneficiariosReporte->currentPage()) <span class="active-page">{{ $pagina }}</span> @else <a href="{{ $beneficiariosReporte->url($pagina) }}">{{ $pagina }}</a> @endif @endfor
                        @if($beneficiariosReporte->hasMorePages()) <a href="{{ $beneficiariosReporte->nextPageUrl() }}">Siguiente ›</a><a href="{{ $beneficiariosReporte->url($beneficiariosReporte->lastPage()) }}">»</a> @else <span class="disabled">Siguiente ›</span><span class="disabled">»</span> @endif
                    </nav></div>
                @endif
            @endif
        </section>
    </main>
</div>
@if($imprimir)
    <script>window.addEventListener('load', () => window.print());</script>
@endif
</body>
</html>
