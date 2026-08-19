<style>
    .dashboard-loans { color: #2e2118; }
    .dashboard-loans .loan-hero { min-height: 112px; margin-bottom: 24px; padding: 34px 38px; border-radius: 26px; background: linear-gradient(110deg,#633a1d,#3d2110); box-shadow: 0 12px 20px rgba(66,38,18,.14); }
    .dashboard-loans .loan-hero h2 { margin: 0; color: #fff; font-size: 32px; }
    .dashboard-loans .loan-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; margin-bottom: 24px; }
    .dashboard-loans .loan-stat { min-height: 155px; padding: 20px; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-loans .loan-stat-icon { width: 46px; height: 46px; display: flex; align-items: center; justify-content: center; margin-bottom: 17px; border-radius: 15px; font-size: 18px; }
    .dashboard-loans .loan-stat span { display: block; color: #687791; font-size: 13px; }
    .dashboard-loans .loan-stat strong { display: block; margin-top: 10px; font-size: 34px; line-height: 1; }
    .dashboard-loans .total .loan-stat-icon { background: #f3ede5; color: #70431e; }
    .dashboard-loans .active .loan-stat-icon { background: #d9f8e5; color: #0a8b45; }
    .dashboard-loans .returned .loan-stat-icon { background: #dceaff; color: #2455d7; }
    .dashboard-loans .rejected .loan-stat-icon { background: #ffe0e2; color: #c5252b; }
    .dashboard-loans .total strong { color: #70431e; } .dashboard-loans .active strong { color: #0a9b49; } .dashboard-loans .returned strong { color: #2760e6; } .dashboard-loans .rejected strong { color: #df292d; }
    .dashboard-loans .loan-search { margin-bottom: 24px; padding: 20px; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-loans .loan-search form { display: flex; gap: 15px; }
    .dashboard-loans .loan-search input { flex: 1; height: 48px; padding: 0 15px; border: 1px solid #d4dbe5; border-radius: 12px; font: 14px inherit; outline: none; }
    .dashboard-loans .loan-search button { width: 105px; border: 0; border-radius: 12px; background: #75461f; color: #fff; font-weight: 700; cursor: pointer; }
    .dashboard-loans .loan-alert { margin-bottom: 20px; padding: 16px 20px; border: 1px solid #a6f0bd; border-radius: 15px; background: #effff3; color: #087d35; }
    .dashboard-loans .loan-table { overflow: hidden; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-loans .loan-table h3 { margin: 0; padding: 18px 20px; background: #75461f; color: #fff; font-size: 18px; }
    .dashboard-loans table { width: 100%; border-collapse: collapse; }
    .dashboard-loans th { padding: 15px 16px; background: #f7f0e7; color: #2e2118; text-align: left; font-size: 13px; }
    .dashboard-loans td { padding: 15px 16px; border-bottom: 1px solid #e3e5e8; color: #36557f; font-size: 13px; }
    .dashboard-loans td strong { color: #17120e; font-size: 14px; }
    .dashboard-loans .loan-status { display: inline-block; padding: 7px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; }
    .dashboard-loans .status-active { background: #d9f8e5; color: #0a8b45; } .dashboard-loans .status-returned { background: #dceaff; color: #2455d7; } .dashboard-loans .status-rejected { background: #ffe0e2; color: #c5252b; }
    .dashboard-loans .loan-delete { width: 38px; height: 38px; border: 0; border-radius: 50%; background: #4b5666; color: #fff; cursor: pointer; }
    .dashboard-loans .loan-empty { padding: 35px; color: #687791; text-align: center; }
    .loan-confirm-modal { position: fixed; inset: 0; z-index: 30; display: none; align-items: center; justify-content: center; padding: 20px; background: rgba(0,0,0,.48); }
    .loan-confirm-modal.is-open { display: flex; }
    .loan-confirm-box { width: min(555px, 100%); padding: 43px 35px 28px; border-radius: 5px; background: #f5efe6; text-align: center; box-shadow: 0 18px 45px rgba(0,0,0,.28); }
    .loan-warning { width: 96px; height: 96px; display: flex; align-items: center; justify-content: center; margin: 0 auto 38px; border: 4px solid #ffc080; border-radius: 50%; color: #ffbd7c; font-size: 49px; font-weight: 300; }
    .loan-confirm-box h2 { margin: 0 0 22px; color: #3e2618; font-size: 30px; }
    .loan-confirm-box p { margin: 0 0 32px; color: #654b39; font-size: 18px; }
    .loan-confirm-actions { display: flex; justify-content: center; gap: 10px; }
    .loan-confirm-actions button { height: 48px; padding: 0 21px; border: 0; border-radius: 4px; color: #fff; font-size: 16px; font-weight: 700; cursor: pointer; }
    .loan-confirm-delete { background: #75461f; }
    .loan-confirm-cancel { background: #aeb8c7; }
    .dashboard-loans .loan-pagination { display: flex; justify-content: center; margin-top: 28px; }
    .dashboard-loans .loan-pagination nav { display: flex; align-items: center; gap: 8px; }
    .dashboard-loans .loan-pagination a, .dashboard-loans .loan-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 45px; padding: 0 12px; color: #6e4b30; font-size: 14px; text-decoration: none; }
    .dashboard-loans .loan-pagination a:hover { color: #3d2110; }
    .dashboard-loans .loan-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; color: #3d2110; font-weight: 700; }
    .dashboard-loans .loan-pagination .disabled { color: #b8b2ac; }
    @media (max-width: 1050px) { .dashboard-loans .loan-stats { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 760px) { .dashboard-loans .loan-stats { grid-template-columns: 1fr; } .dashboard-loans .loan-search form { flex-direction: column; } .dashboard-loans .loan-search button { width: 100%; height: 48px; } .dashboard-loans .loan-table { overflow-x: auto; } .dashboard-loans table { min-width: 900px; } }
</style>

<div class="dashboard-loans">
    @if(session('success'))
        <div class="loan-alert">{{ session('success') }}</div>
    @endif

    <div class="loan-hero"><h2>Gestión de Préstamos</h2></div>

    <div class="loan-stats">
        <div class="loan-stat total"><div class="loan-stat-icon"><i class="fa-solid fa-book-open"></i></div><span>Total préstamos</span><strong>{{ $totalPrestamos }}</strong></div>
        <div class="loan-stat active"><div class="loan-stat-icon"><i class="fa-solid fa-circle-check"></i></div><span>Activos</span><strong>{{ $activos }}</strong></div>
        <div class="loan-stat returned"><div class="loan-stat-icon"><i class="fa-solid fa-rotate-left"></i></div><span>Devueltos</span><strong>{{ $devueltos }}</strong></div>
        <div class="loan-stat rejected"><div class="loan-stat-icon"><i class="fa-solid fa-circle-xmark"></i></div><span>Rechazados</span><strong>{{ $rechazados }}</strong></div>
    </div>

    <div class="loan-search">
        <form method="GET" action="{{ route('dashboard') }}">
            <input type="hidden" name="modulo" value="prestamos">
            <input type="text" name="buscar" value="{{ $buscarPrestamos }}" placeholder="Buscar por libro, beneficiario, documento, estado o fecha...">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="loan-table">
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
                        <td><span class="loan-status {{ str_contains($estado, 'activo') ? 'status-active' : (str_contains($estado, 'rechaz') ? 'status-rejected' : 'status-returned') }}">{{ $prestamo->estado }}</span></td>
                        <td><form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" class="loan-delete-form">@csrf @method('DELETE')<button class="loan-delete" type="button" data-loan-confirm><i class="fa-solid fa-trash"></i></button></form></td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="loan-empty">No hay préstamos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($prestamos->hasPages())
        <div class="loan-pagination">
            <nav aria-label="Paginación de préstamos">
                @if($prestamos->onFirstPage())
                    <span class="disabled">«</span>
                    <span class="disabled">‹ Anterior</span>
                @else
                    <a href="{{ $prestamos->url(1) }}">«</a>
                    <a href="{{ $prestamos->previousPageUrl() }}">‹ Anterior</a>
                @endif

                @for($pagina = 1; $pagina <= $prestamos->lastPage(); $pagina++)
                    @if($pagina === $prestamos->currentPage())
                        <span class="active-page">{{ $pagina }}</span>
                    @else
                        <a href="{{ $prestamos->url($pagina) }}">{{ $pagina }}</a>
                    @endif
                @endfor

                @if($prestamos->hasMorePages())
                    <a href="{{ $prestamos->nextPageUrl() }}">Siguiente ›</a>
                    <a href="{{ $prestamos->url($prestamos->lastPage()) }}">»</a>
                @else
                    <span class="disabled">Siguiente ›</span>
                    <span class="disabled">»</span>
                @endif
            </nav>
        </div>
    @endif
</div>

<div class="loan-confirm-modal" id="loan-confirm-modal" role="dialog" aria-modal="true" aria-labelledby="loan-confirm-title">
    <div class="loan-confirm-box">
        <div class="loan-warning">!</div>
        <h2 id="loan-confirm-title">¿Eliminar préstamo?</h2>
        <p>Esta acción eliminará el préstamo del sistema.</p>
        <div class="loan-confirm-actions">
            <button type="button" class="loan-confirm-delete" id="confirm-loan-delete">Sí, eliminar</button>
            <button type="button" class="loan-confirm-cancel" id="cancel-loan-delete">Cancelar</button>
        </div>
    </div>
</div>

<script>
    const loanConfirmModal = document.getElementById('loan-confirm-modal');
    const confirmLoanDelete = document.getElementById('confirm-loan-delete');
    const cancelLoanDelete = document.getElementById('cancel-loan-delete');
    let selectedLoanForm = null;

    document.querySelectorAll('[data-loan-confirm]').forEach((button) => {
        button.addEventListener('click', () => {
            selectedLoanForm = button.closest('.loan-delete-form');
            loanConfirmModal.classList.add('is-open');
        });
    });

    confirmLoanDelete.addEventListener('click', () => {
        if (selectedLoanForm) selectedLoanForm.submit();
    });

    cancelLoanDelete.addEventListener('click', () => {
        selectedLoanForm = null;
        loanConfirmModal.classList.remove('is-open');
    });

    loanConfirmModal.addEventListener('click', (event) => {
        if (event.target === loanConfirmModal) cancelLoanDelete.click();
    });
</script>
