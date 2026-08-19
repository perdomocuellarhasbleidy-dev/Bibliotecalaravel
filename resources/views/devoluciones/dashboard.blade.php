<style>
    .dashboard-returns { color: #3d2617; }
    .dashboard-returns .return-success, .dashboard-returns .return-error { margin-bottom: 25px; padding: 17px 20px; border-radius: 12px; font-size: 14px; }
    .dashboard-returns .return-success { border: 1px solid #16b84e; background: #20c95a; color: #fff; }
    .dashboard-returns .return-error { border: 1px solid #f2aaaa; background: #fff0f0; color: #a12626; }
    .dashboard-returns .return-hero { min-height: 106px; margin-bottom: 24px; padding: 32px 34px; border-radius: 26px; background: linear-gradient(110deg,#633a1d,#3d2110); box-shadow: 0 10px 18px rgba(66,38,18,.13); }
    .dashboard-returns .return-hero h2 { margin: 0; color: #fff; font-size: 31px; }
    .dashboard-returns .return-toolbar { display: grid; grid-template-columns: 210px 1fr auto auto; gap: 15px; align-items: center; margin-bottom: 25px; padding: 20px; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-returns .return-count { padding: 16px; border-radius: 14px; background: #f3ede5; color: #687791; font-size: 13px; }
    .dashboard-returns .return-count strong { display: block; margin-top: 3px; color: #70431e; font-size: 32px; }
    .dashboard-returns .return-toolbar input { width: 100%; height: 48px; padding: 0 15px; border: 1px solid #d4dbe5; border-radius: 12px; font: 14px inherit; outline: none; }
    .dashboard-returns .return-toolbar button { height: 48px; padding: 0 20px; border: 0; border-radius: 12px; background: #75461f; color: #fff; font-weight: 700; cursor: pointer; }
    .dashboard-returns .new-return { background: #57351f; white-space: nowrap; }
    .dashboard-returns .return-table { overflow: hidden; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-returns .return-table table { width: 100%; border-collapse: collapse; }
    .dashboard-returns th { padding: 15px 16px; background: #75461f; color: #fff; text-align: left; font-size: 13px; }
    .dashboard-returns td { padding: 16px; border-bottom: 1px solid #e3e5e8; color: #526b8b; font-size: 13px; }
    .dashboard-returns td strong { color: #2e2118; }
    .return-status { display: inline-block; padding: 7px 14px; border-radius: 18px; font-size: 12px; font-weight: 700; }
    .return-status.returned { background: #d9f8e5; color: #0a8b45; }
    .return-status.late { background: #ffe0e2; color: #c5252b; }
    .return-status.pending { background: #fff1b8; color: #a66b00; }
    .return-actions { display: flex; gap: 8px; }
    .return-icon { width: 38px; height: 38px; border: 0; border-radius: 50%; color: #fff; cursor: pointer; }
    .return-edit { background: #3b82f6; } .return-delete { background: #ef4444; }
    .return-empty { padding: 35px; color: #687791; text-align: center; }
    .return-pagination { display: flex; justify-content: center; margin-top: 25px; }
    .return-pagination nav { display: flex; align-items: center; gap: 8px; }
    .return-pagination a, .return-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 42px; padding: 0 11px; color: #6e4b30; font-size: 14px; text-decoration: none; }
    .return-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; font-weight: 700; }
    .return-pagination .disabled { color: #b8b2ac; }
    .return-modal { position: fixed; inset: 0; z-index: 20; display: none; align-items: center; justify-content: center; padding: 20px; background: rgba(0,0,0,.48); }
    .return-modal.is-open { display: flex; }
    .return-modal-box { width: min(700px,100%); background: #f5efe6; border-top: 2px solid #236078; box-shadow: 0 20px 45px rgba(0,0,0,.3); }
    .return-modal-header { padding: 30px 34px 25px; border-bottom: 1px solid #aaa197; }
    .return-modal-header h2 { margin: 0; color: #8a633d; font: 400 28px Georgia,serif; }
    .return-modal-header strong { color: #332012; }
    .return-modal-body { padding: 30px 34px; }
    .return-modal-body label { display: block; margin-bottom: 8px; color: #684321; font-size: 13px; font-weight: 700; }
    .return-modal-body select, .return-modal-body input { width: 100%; height: 42px; margin-bottom: 20px; padding: 0 12px; border: 1px solid #c9c5c0; border-radius: 2px; background: #fff; font: 14px inherit; }
    .return-modal-body input[readonly] { background: #f0f1f3; color: #4f5b6b; }
    .return-modal-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 0 48px; }
    .return-modal-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 15px; }
    .return-modal-actions button { height: 40px; padding: 0 22px; border: 0; border-radius: 4px; font-weight: 700; cursor: pointer; }
    .return-cancel { background: #fff; color: #7b5837; } .return-save { background: #653a1e; color: #fff; }
    .delete-return-modal { position: fixed; inset: 0; z-index: 30; display: none; align-items: center; justify-content: center; padding: 20px; background: rgba(0,0,0,.48); }
    .delete-return-modal.is-open { display: flex; }
    .delete-return-box { width: min(520px,100%); padding: 40px 32px 27px; border-radius: 5px; background: #f5efe6; text-align: center; box-shadow: 0 18px 45px rgba(0,0,0,.28); }
    .delete-return-warning { width: 88px; height: 88px; display: flex; align-items: center; justify-content: center; margin: 0 auto 34px; border: 4px solid #ffc080; border-radius: 50%; color: #ffbd7c; font-size: 46px; }
    .delete-return-box h2 { margin: 0 0 20px; color: #3e2618; font-size: 29px; }
    .delete-return-box p { margin: 0 0 30px; color: #654b39; font-size: 17px; }
    .delete-return-actions { display: flex; justify-content: center; gap: 10px; }
    .delete-return-actions button { height: 46px; padding: 0 20px; border: 0; border-radius: 4px; color: #fff; font-size: 15px; font-weight: 700; cursor: pointer; }
    .confirm-delete-return { background: #75461f; } .cancel-delete-return { background: #aeb8c7; }
    .edit-return-modal { position: fixed; inset: 0; z-index: 21; display: none; align-items: center; justify-content: center; padding: 20px; background: rgba(0,0,0,.48); }
    .edit-return-modal.is-open { display: flex; }
    @media (max-width: 850px) { .dashboard-returns .return-toolbar { grid-template-columns: 1fr 1fr; } .dashboard-returns .return-count { grid-row: span 2; } .dashboard-returns .return-table { overflow-x: auto; } .dashboard-returns table { min-width: 1000px; } }
</style>

<div class="dashboard-returns">
    @if(session('success')) <div class="return-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="return-error">{{ session('error') }}</div> @endif

    <div class="return-hero"><h2>Gestión de Devoluciones</h2></div>

    <form method="GET" action="{{ route('dashboard') }}" class="return-toolbar">
        <input type="hidden" name="modulo" value="devoluciones">
        <div class="return-count">Devoluciones encontradas<strong>{{ $totalDevoluciones }}</strong></div>
        <input type="text" name="buscar" value="{{ $buscarDevoluciones }}" placeholder="Buscar por libro, beneficiario, documento, fecha o estado...">
        <button type="submit">Buscar</button>
        <button type="button" class="new-return" id="open-return-modal">+ Nueva Devolución</button>
    </form>

    <div class="return-table">
        <table>
            <thead><tr><th>#</th><th>Préstamo</th><th>Libro</th><th>Beneficiario</th><th>Documento</th><th>Fecha préstamo</th><th>Fecha devolución</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse($devoluciones as $devolucion)
                    @php($estado = strtolower($devolucion->estado ?? ''))
                    <tr>
                        <td>{{ $devolucion->iddevolucion }}</td>
                        <td>{{ $devolucion->idprestamo }}</td>
                        <td><strong>{{ $devolucion->libro->titulo ?? 'Sin libro' }}</strong></td>
                        <td>{{ $devolucion->usuario->nombre ?? 'Sin beneficiario' }}</td>
                        <td>{{ $devolucion->usuario->documento ?? '-' }}</td>
                        <td>{{ optional($devolucion->prestamo?->fecha_prestamo)->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ optional($devolucion->fecha_devolucion)->format('Y-m-d') ?? '-' }}</td>
                        <td><span class="return-status {{ str_contains($estado, 'atras') ? 'late' : (str_contains($estado, 'pend') ? 'pending' : 'returned') }}">{{ $devolucion->estado }}</span></td>
                        <td><div class="return-actions"><button type="button" class="return-icon return-edit open-edit-return" data-edit-return="edit-return-{{ $devolucion->iddevolucion }}"><i class="fa-solid fa-pen"></i></button><button type="button" class="return-icon return-delete open-delete-return" data-delete-return="delete-return-{{ $devolucion->iddevolucion }}"><i class="fa-solid fa-trash"></i></button></div></td>
                    </tr>
                    <div class="edit-return-modal" id="edit-return-{{ $devolucion->iddevolucion }}" role="dialog" aria-modal="true" aria-labelledby="edit-return-title-{{ $devolucion->iddevolucion }}">
                        <div class="return-modal-box">
                            <header class="return-modal-header"><h2 id="edit-return-title-{{ $devolucion->iddevolucion }}">Editar <strong>Devolución</strong></h2></header>
                            <div class="return-modal-body">
                                <form method="POST" action="{{ route('devoluciones.update', $devolucion) }}">
                                    @csrf
                                    @method('PUT')
                                    <label for="edit-return-loan-{{ $devolucion->iddevolucion }}">Préstamo</label>
                                    <select id="edit-return-loan-{{ $devolucion->iddevolucion }}" name="idprestamo" required>
                                        @foreach($prestamosParaEditar as $prestamo)
                                            <option value="{{ $prestamo->idprestamo }}" @selected($prestamo->idprestamo == $devolucion->idprestamo)>{{ $prestamo->idprestamo }} - {{ $prestamo->libro->titulo ?? 'Sin libro' }} / {{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }} - {{ $prestamo->usuario->documento ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                    <div class="return-modal-columns">
                                        <div><label>ID Libro</label><input type="text" value="{{ $devolucion->idlibro }}" readonly></div>
                                        <div><label>ID Beneficiario</label><input type="text" value="{{ $devolucion->id_usuario }}" readonly></div>
                                        <div><label for="edit-return-date-{{ $devolucion->iddevolucion }}">Fecha devolución</label><input type="date" id="edit-return-date-{{ $devolucion->iddevolucion }}" name="fecha_devolucion" value="{{ optional($devolucion->fecha_devolucion)->format('Y-m-d') }}" required></div>
                                        <div><label for="edit-return-status-{{ $devolucion->iddevolucion }}">Estado</label><select id="edit-return-status-{{ $devolucion->iddevolucion }}" name="estado" required><option value="Atrasado" @selected($devolucion->estado === 'Atrasado')>Atrasado</option><option value="Devuelto" @selected($devolucion->estado === 'Devuelto')>Devuelto</option><option value="Pendiente" @selected($devolucion->estado === 'Pendiente')>Pendiente</option></select></div>
                                    </div>
                                    <div class="return-modal-actions"><button type="button" class="return-cancel close-edit-return">Cancelar</button><button type="submit" class="return-save">Actualizar Devolución</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr><td colspan="9" class="return-empty">No hay devoluciones registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($devoluciones->hasPages())
        <div class="return-pagination"><nav>
            @if($devoluciones->onFirstPage()) <span class="disabled">«</span><span class="disabled">‹ Anterior</span> @else <a href="{{ $devoluciones->url(1) }}">«</a><a href="{{ $devoluciones->previousPageUrl() }}">‹ Anterior</a> @endif
            @for($pagina = 1; $pagina <= $devoluciones->lastPage(); $pagina++) @if($pagina === $devoluciones->currentPage()) <span class="active-page">{{ $pagina }}</span> @else <a href="{{ $devoluciones->url($pagina) }}">{{ $pagina }}</a> @endif @endfor
            @if($devoluciones->hasMorePages()) <a href="{{ $devoluciones->nextPageUrl() }}">Siguiente ›</a><a href="{{ $devoluciones->url($devoluciones->lastPage()) }}">»</a> @else <span class="disabled">Siguiente ›</span><span class="disabled">»</span> @endif
        </nav></div>
    @endif
</div>

<div class="return-modal" id="return-modal" role="dialog" aria-modal="true" aria-labelledby="return-modal-title">
    <div class="return-modal-box">
        <header class="return-modal-header"><h2 id="return-modal-title">Agregar <strong>Devolución</strong></h2></header>
        <div class="return-modal-body">
            <form method="POST" action="{{ route('devoluciones.store') }}">
                @csrf
                <label for="return-loan">Préstamo</label>
                <select id="return-loan" name="idprestamo" required>
                    <option value="">Seleccione un préstamo</option>
                    @foreach($prestamosDisponibles as $prestamo)
                        <option value="{{ $prestamo->idprestamo }}" data-book-id="{{ $prestamo->idlibro }}" data-user-id="{{ $prestamo->id_usuario }}">{{ $prestamo->idprestamo }} - {{ $prestamo->libro->titulo ?? 'Sin libro' }} - {{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }}</option>
                    @endforeach
                </select>
                <div class="return-modal-columns">
                    <div>
                        <label for="return-book-id">ID Libro</label>
                        <input type="text" id="return-book-id" readonly>
                    </div>
                    <div>
                        <label for="return-user-id">ID Beneficiario</label>
                        <input type="text" id="return-user-id" readonly>
                    </div>
                    <div>
                        <label for="return-date">Fecha devolución</label>
                        <input type="date" id="return-date" name="fecha_devolucion" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label for="return-status">Estado</label>
                        <select id="return-status" name="estado" required><option value="">Seleccione un estado</option><option value="Atrasado">Atrasado</option><option value="Devuelto">Devuelto</option><option value="Pendiente">Pendiente</option></select>
                    </div>
                </div>
                <div class="return-modal-actions"><button type="button" class="return-cancel" id="close-return-modal">Cancelar</button><button type="submit" class="return-save">Guardar Devolución</button></div>
            </form>
        </div>
    </div>
</div>

@foreach($devoluciones as $devolucion)
    <div class="delete-return-modal" id="delete-return-{{ $devolucion->iddevolucion }}" role="dialog" aria-modal="true" aria-labelledby="delete-return-title-{{ $devolucion->iddevolucion }}">
        <div class="delete-return-box">
            <div class="delete-return-warning">!</div>
            <h2 id="delete-return-title-{{ $devolucion->iddevolucion }}">¿Eliminar devolución?</h2>
            <p>Esta acción eliminará la devolución del sistema.</p>
            <div class="delete-return-actions">
                <form method="POST" action="{{ route('devoluciones.destroy', $devolucion) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="confirm-delete-return">Sí, eliminar</button>
                </form>
                <button type="button" class="cancel-delete-return">Cancelar</button>
            </div>
        </div>
    </div>
@endforeach

<script>
    const returnModal = document.getElementById('return-modal');
    const returnLoan = document.getElementById('return-loan');
    const returnBookId = document.getElementById('return-book-id');
    const returnUserId = document.getElementById('return-user-id');
    document.getElementById('open-return-modal').addEventListener('click', () => returnModal.classList.add('is-open'));
    document.getElementById('close-return-modal').addEventListener('click', () => returnModal.classList.remove('is-open'));
    returnModal.addEventListener('click', (event) => { if (event.target === returnModal) returnModal.classList.remove('is-open'); });
    returnLoan.addEventListener('change', () => {
        const option = returnLoan.options[returnLoan.selectedIndex];
        returnBookId.value = option.dataset.bookId || '';
        returnUserId.value = option.dataset.userId || '';
    });

    document.querySelectorAll('.open-edit-return').forEach((button) => {
        button.addEventListener('click', () => {
            document.getElementById(button.dataset.editReturn).classList.add('is-open');
        });
    });

    document.querySelectorAll('.close-edit-return').forEach((button) => {
        button.addEventListener('click', () => button.closest('.edit-return-modal').classList.remove('is-open'));
    });

    document.querySelectorAll('.edit-return-modal').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.classList.remove('is-open');
        });
    });

    document.querySelectorAll('.open-delete-return').forEach((button) => {
        button.addEventListener('click', () => document.getElementById(button.dataset.deleteReturn).classList.add('is-open'));
    });

    document.querySelectorAll('.cancel-delete-return').forEach((button) => {
        button.addEventListener('click', () => button.closest('.delete-return-modal').classList.remove('is-open'));
    });

    document.querySelectorAll('.delete-return-modal').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.classList.remove('is-open');
        });
    });
</script>
