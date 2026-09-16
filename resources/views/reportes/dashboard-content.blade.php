<style>
    .reports-dashboard { color: #3d2617; }
    .reports-dashboard .reports-hero { margin-bottom: 25px; padding: 34px 36px; border-radius: 26px; background: linear-gradient(110deg,#633a1d,#3d2110); box-shadow: 0 10px 18px rgba(66,38,18,.13); }
    .reports-dashboard .reports-hero h2 { margin: 0; color: #fff; font-size: 32px; }
    .reports-dashboard .filter-panel, .reports-dashboard .tabs-panel { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding: 20px 26px; border: 1px solid #e2e4e7; border-radius: 18px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.09); }
    .reports-dashboard .filter-panel label { display: block; margin-bottom: 7px; color: #684321; font-size: 13px; font-weight: 700; }
    .reports-dashboard .date-field { flex: 0 0 230px; }
    .reports-dashboard .date-field input { width: 100%; height: 55px; padding: 0 14px; border: 1px solid #d4dbe5; border-radius: 11px; font: 15px inherit; }
    .reports-dashboard .filter-button, .reports-dashboard .print-button { height: 52px; min-width: 180px; margin-top: 22px; border: 0; border-radius: 11px; color: #fff; font-weight: 700; font-size: 15px; cursor: pointer; text-align: center; text-decoration: none; line-height: 52px; display: inline-block; }
    .reports-dashboard .filter-button { background: #75461f; }
    .reports-dashboard .print-button { background: #3d2110; }
    .reports-dashboard .tabs-panel { gap: 12px; }
    .reports-dashboard .report-tab { flex: 1; height: 54px; border: 1px solid #9a6d48; border-radius: 14px; background: #fff; color: #75461f; font-size: 15px; font-weight: 700; cursor: pointer; text-decoration: none; text-align: center; line-height: 54px; }
    .reports-dashboard .report-tab.active { background: #3d2110; color: #fff; }
    .reports-dashboard .report-cards { display: grid; grid-template-columns: repeat(6,1fr); gap: 18px; }
    .reports-dashboard .report-card { min-height: 112px; padding: 22px; border: 1px solid #e2e4e7; border-radius: 18px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.09); }
    .reports-dashboard .report-card span { display: block; color: #687791; font-size: 13px; }
    .reports-dashboard .report-card strong { display: block; margin-top: 12px; color: #70431e; font-size: 29px; }
    .reports-dashboard .report-card.money strong { font-size: 22px; white-space: nowrap; }
    .reports-dashboard .report-detail { margin-top: 25px; overflow: hidden; border: 1px solid #e2e4e7; border-radius: 18px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.09); }
    .reports-dashboard .report-detail h3 { margin: 0; padding: 20px 26px; background: #75461f; color: #fff; font-size: 20px; }
    .reports-dashboard .report-detail table { width: 100%; border-collapse: collapse; }
    .reports-dashboard .report-detail th { padding: 15px 26px; background: #f7f0e7; color: #2e2118; text-align: left; font-size: 13px; }
    .reports-dashboard .report-detail td { padding: 14px 26px; border-bottom: 1px solid #e3e5e8; color: #36557f; font-size: 13px; }
    .reports-dashboard .report-detail td strong { color: #17120e; }
    .reports-dashboard .report-detail .empty { padding: 35px; text-align: center; }
    .reports-dashboard .report-pagination { display: flex; justify-content: center; margin-top: 24px; }
    .reports-dashboard .report-pagination nav { display: flex; align-items: center; gap: 8px; }
    .reports-dashboard .report-pagination a, .reports-dashboard .report-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 42px; padding: 0 11px; color: #6e4b30; font-size: 14px; text-decoration: none; }
    .reports-dashboard .report-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; font-weight: 700; }
    .reports-dashboard .report-pagination .disabled { color: #b8b2ac; }
    @media print {
        .sidebar, .topbar, .filter-panel, .tabs-panel { display: none !important; }
        .main { width: 100% !important; margin: 0 !important; }
        .content { padding: 0 !important; }
        .reports-hero { box-shadow: none !important; }
        .report-detail { overflow: visible !important; box-shadow: none !important; page-break-inside: auto; }
        .report-detail thead { display: table-header-group; }
        .report-detail tr { page-break-inside: avoid; page-break-after: auto; }
        .report-pagination { display: none !important; }
    }
    @media (max-width: 1000px) { .reports-dashboard .report-cards { grid-template-columns: repeat(3,1fr); } }
    @media (max-width: 700px) {
        .reports-dashboard .filter-panel, .reports-dashboard .tabs-panel { flex-wrap: wrap; }
        .reports-dashboard .date-field { flex-basis: calc(50% - 8px); }
        .reports-dashboard .filter-button, .reports-dashboard .print-button { flex: 1; }
        .reports-dashboard .report-cards { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width: 450px) {
        .reports-dashboard .report-cards { grid-template-columns: 1fr; }
        .reports-dashboard .date-field { flex-basis: 100%; }
    }
</style>

<div class="reports-dashboard {{ $imprimir ? 'print-version' : '' }}">
    <div class="reports-hero"><h2>Reportes</h2></div>
    
    <form method="GET" action="{{ route('dashboard') }}" class="filter-panel">
        <input type="hidden" name="modulo" value="reportes">
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <div class="date-field">
            <label for="fecha_inicio">Fecha inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ $fechaInicio }}">
        </div>
        <div class="date-field">
            <label for="fecha_fin">Fecha fin</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="{{ $fechaFin }}">
        </div>
        <button type="submit" class="filter-button">Filtrar</button>
        <button type="button" class="print-button" onclick="window.location.href='{{ route('dashboard', array_filter(['modulo' => 'reportes', 'tipo' => $tipo, 'fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin, 'imprimir' => 1])) }}'">Imprimir</button>
    </form>

    <div class="tabs-panel">
        @foreach(['resumen' => 'Resumen','prestamos' => 'Préstamos','devoluciones' => 'Devoluciones','multas' => 'Multas','libros' => 'Libros','beneficiarios' => 'Beneficiarios'] as $clave => $nombre)
            <a class="report-tab {{ $tipo === $clave ? 'active' : '' }}" href="{{ route('dashboard', array_filter(['modulo' => 'reportes', 'tipo' => $clave, 'fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin])) }}">{{ $nombre }}</a>
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
</div>

@if($imprimir)
    <script>window.addEventListener('load', () => window.print());</script>
@endif
