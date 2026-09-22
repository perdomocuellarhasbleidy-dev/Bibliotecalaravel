<style>
    .dashboard-fines { color: #3d2617; }
    .dashboard-fines .fine-alert { margin-bottom: 25px; padding: 17px 20px; border-radius: 12px; background: #20c95a; color: #fff; font-size: 14px; }
    .dashboard-fines .fine-hero { min-height: 106px; margin-bottom: 24px; padding: 32px 34px; border-radius: 26px; background: linear-gradient(110deg,#633a1d,#3d2110); box-shadow: 0 10px 18px rgba(66,38,18,.13); }
    .dashboard-fines .fine-hero h2 { margin: 0; color: #fff; font-size: 31px; }
    .dashboard-fines .fine-toolbar { display: grid; grid-template-columns: 210px 1fr auto auto; gap: 15px; align-items: center; margin-bottom: 25px; padding: 20px; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-fines .fine-count { padding: 16px; border-radius: 14px; background: #f3ede5; color: #687791; font-size: 13px; }
    .dashboard-fines .fine-count strong { display: block; margin-top: 3px; color: #70431e; font-size: 32px; }
    .dashboard-fines .fine-toolbar input { width: 100%; height: 48px; padding: 0 15px; border: 1px solid #d4dbe5; border-radius: 12px; font: 14px inherit; outline: none; }
    .dashboard-fines .fine-toolbar button { height: 48px; padding: 0 20px; border: 0; border-radius: 12px; background: #75461f; color: #fff; font-weight: 700; cursor: pointer; }
    .dashboard-fines .new-fine { background: #57351f !important; white-space: nowrap; }
    .dashboard-fines .fine-table { overflow: hidden; border: 1px solid #e2e4e7; border-radius: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .dashboard-fines table { width: 100%; border-collapse: collapse; }
    .dashboard-fines th { padding: 15px 16px; background: #75461f; color: #fff; text-align: left; font-size: 13px; }
    .dashboard-fines td { padding: 16px; border-bottom: 1px solid #e3e5e8; color: #526b8b; font-size: 13px; }
    .dashboard-fines td strong { color: #2e2118; }
    .dashboard-fines .fine-value { color: #2e2118; font-weight: 700; }
    .dashboard-fines .fine-actions { display: flex; gap: 8px; }
    .dashboard-fines .fine-icon { width: 38px; height: 38px; border: 0; border-radius: 50%; color: #fff; cursor: pointer; }
    .dashboard-fines .fine-edit { background: #3b82f6; } .dashboard-fines .fine-delete { background: #ef4444; }
    .dashboard-fines .fine-empty { padding: 35px; color: #687791; text-align: center; }
    .fine-pagination { display: flex; justify-content: center; margin-top: 25px; }
    .fine-pagination nav { display: flex; align-items: center; gap: 8px; }
    .fine-pagination a, .fine-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 42px; padding: 0 11px; color: #6e4b30; font-size: 14px; text-decoration: none; }
    .fine-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; font-weight: 700; } .fine-pagination .disabled { color: #b8b2ac; }
    .fine-modal { position: fixed; inset: 0; z-index: 30; display: none; align-items: flex-start; justify-content: center; padding: 40px 20px; background: rgba(0,0,0,.48); overflow-y: auto; }
    .fine-modal.is-open { display: flex; }
    .fine-modal-box { width: min(700px,100%); background: #f5efe6; border-top: 2px solid #236078; box-shadow: 0 20px 45px rgba(0,0,0,.3); }
    .fine-modal-header { padding: 30px 34px 25px; border-bottom: 1px solid #aaa197; } .fine-modal-header h2 { margin: 0; color: #8a633d; font: 400 28px Georgia,serif; } .fine-modal-header strong { color: #332012; }
    .fine-modal-body { padding: 30px 34px; } .fine-modal-body label { display: block; margin-bottom: 8px; color: #684321; font-size: 13px; font-weight: 700; }
    .fine-modal-body input, .fine-modal-body select { width: 100%; height: 42px; margin-bottom: 20px; padding: 0 12px; border: 1px solid #c9c5c0; border-radius: 2px; background: #fff; font: 14px inherit; }
    .fine-info { margin-bottom: 24px; border: 1px solid #c9b6b0; border-radius: 6px; background: #fff8f7; }
    .fine-info-title { padding: 12px 20px; border-bottom: 1px solid #d9c9c4; color: #684321; font-weight: 700; }
    .fine-info-body { padding: 16px 20px 12px; color: #684321; font-size: 15px; line-height: 1.9; }
    .fine-info-body strong { color: #3e2618; }
    .fine-modal-body .fine-main-label { color: #684321; font: 18px Georgia, serif; }
    .fine-modal-body .fine-main-label + select { height: 44px; }
    .fine-modal-body input[readonly] { background: #f0f1f3; }
    .fine-modal-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 0 45px; } .fine-modal-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 15px; }
    .fine-modal-actions button { height: 40px; padding: 0 22px; border: 0; border-radius: 4px; font-weight: 700; cursor: pointer; } .fine-cancel { background: #fff; color: #7b5837; } .fine-save { background: #653a1e; color: #fff; }
    .fine-delete-box { width: min(565px,100%); padding: 42px 36px 31px; border-radius: 16px; background: #f5efe6; text-align: center; box-shadow: 0 16px 35px rgba(0,0,0,.18); } .fine-warning { width: 96px; height: 96px; display: flex; align-items: center; justify-content: center; margin: 0 auto 43px; border: 4px solid #ffc080; border-radius: 50%; color: #ffbd7c; font-size: 49px; font-weight: 300; } .fine-delete-box h2 { margin: 0 0 23px; color: #3e2618; font-size: 30px; } .fine-delete-box p { margin: 0 0 34px; color: #654b39; font-size: 18px; }
    @media (max-width: 850px) { .dashboard-fines .fine-toolbar { grid-template-columns: 1fr 1fr; } .dashboard-fines .fine-count { grid-row: span 2; } .dashboard-fines .fine-table { overflow-x: auto; } .dashboard-fines table { min-width: 900px; } }
    @media print { 
        body * { visibility: hidden; } 
        .active-print-area, .active-print-area * { visibility: visible; } 
        .active-print-area { position: absolute; left: 0; top: 0; width: 100% !important; margin: 0; padding: 20px; box-shadow: none; border: none; background: #fff; } 
        .fine-modal-actions { display: none !important; } 
    }
</style>

<div class="dashboard-fines">
    <div class="fine-hero"><h2>Gestión de Multas</h2></div>
    <form method="GET" action="{{ route('dashboard') }}" class="fine-toolbar">
        <input type="hidden" name="modulo" value="multas">
        <div class="fine-count">Multas encontradas<strong>{{ $totalMultas }}</strong></div>
        <input type="text" name="buscar" value="{{ $buscarMultas }}" placeholder="Buscar por préstamo, libro, beneficiario, documento, motivo o valor...">
        <button type="submit">Buscar</button><button type="button" class="new-fine" id="open-fine-modal">+ Nueva Multa</button>
    </form>
    <div class="fine-table">
        <table><thead><tr><th>#</th><th>Préstamo</th><th>Libro</th><th>Beneficiario</th><th>Documento</th><th>Motivo</th><th>Fecha</th><th>Valor</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse($multas as $multa)
                    <tr><td>{{ $multa->idmulta }}</td><td>{{ $multa->idprestamo }}</td><td><strong>{{ $multa->prestamo->libro->titulo ?? 'Sin libro' }}</strong></td><td>{{ $multa->prestamo->usuario->nombre ?? 'Sin beneficiario' }}</td><td>{{ $multa->prestamo->usuario->documento ?? '-' }}</td><td>{{ $multa->motivo }}</td><td>{{ optional($multa->fecha)->format('Y-m-d') }}</td><td class="fine-value">${{ number_format((float) $multa->valor, 2, ',', '.') }}</td><td><div class="fine-actions"><button type="button" class="fine-icon open-print-fine" data-print-fine="print-fine-{{ $multa->idmulta }}" style="display:flex;align-items:center;justify-content:center;background:#633a1d;border:none;" title="Imprimir"><i class="fa-solid fa-print"></i></button><button type="button" class="fine-icon fine-edit open-edit-fine" data-edit-fine="edit-fine-{{ $multa->idmulta }}"><i class="fa-solid fa-pen"></i></button><button type="button" class="fine-icon fine-delete open-delete-fine" data-delete-fine="delete-fine-{{ $multa->idmulta }}"><i class="fa-solid fa-trash"></i></button></div></td></tr>
                @empty
                    <tr><td colspan="9" class="fine-empty">No hay multas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($multas->hasPages())<div class="fine-pagination"><nav>@if($multas->onFirstPage())<span class="disabled">«</span><span class="disabled">‹ Anterior</span>@else<a href="{{ $multas->url(1) }}">«</a><a href="{{ $multas->previousPageUrl() }}">‹ Anterior</a>@endif @for($pagina=1;$pagina<=$multas->lastPage();$pagina++) @if($pagina===$multas->currentPage())<span class="active-page">{{ $pagina }}</span>@else<a href="{{ $multas->url($pagina) }}">{{ $pagina }}</a>@endif @endfor @if($multas->hasMorePages())<a href="{{ $multas->nextPageUrl() }}">Siguiente ›</a><a href="{{ $multas->url($multas->lastPage()) }}">»</a>@else<span class="disabled">Siguiente ›</span><span class="disabled">»</span>@endif</nav></div>@endif
</div>

<div class="fine-modal" id="fine-modal">
    <div class="fine-modal-box">
        <header class="fine-modal-header"><h2>Generar <strong>Multa</strong></h2></header>
        <div class="fine-modal-body">
            <form method="POST" action="{{ route('multas.store') }}">
                @csrf
                <div class="fine-info">
                    <div class="fine-info-title">Información de la Multa</div>
                    <div class="fine-info-body">
                        <label class="fine-main-label" for="new-fine-loan">Seleccione el préstamo</label>
                        <select id="new-fine-loan" name="idprestamo" required>
                            <option value="">Seleccione un préstamo</option>
                            @foreach($prestamosParaMulta as $prestamo)
                                <option value="{{ $prestamo->idprestamo }}" data-book="{{ $prestamo->libro->titulo ?? 'Sin libro' }}" data-user="{{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }}" data-document="{{ $prestamo->usuario->documento ?? '---' }}">{{ $prestamo->idprestamo }} - {{ $prestamo->libro->titulo ?? 'Sin libro' }} / {{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }}</option>
                            @endforeach
                        </select>
                        <div>Libro : <strong id="fine-book-detail">Seleccione un préstamo</strong></div>
                        <div>Beneficiario: <strong id="fine-user-detail">---</strong></div>
                        <div>Documento: <strong id="fine-document-detail">---</strong></div>
                    </div>
                </div>
                <label class="fine-main-label" for="new-fine-reason">Motivo de la Multa :</label>
                <select id="new-fine-reason" name="motivo" required>
                    <option value="">Seleccione un motivo</option>
                    <option value="Devolución tardía">Devolución tardía</option>
                    <option value="Libro perdido">Libro perdido</option>
                    <option value="Libro dañado">Libro dañado</option>
                </select>
                <div class="fine-modal-columns">
                    <div><label class="fine-main-label" for="new-fine-date">Fecha de la Multa :</label><input type="date" id="new-fine-date" name="fecha" required></div>
                    <div><label class="fine-main-label" for="new-fine-days">Días de Retraso :</label><input type="text" id="new-fine-days" name="dias_retraso" placeholder="Ejemplo: 1 mes"></div>
                    <div style="grid-column: 1 / -1;"><label class="fine-main-label" for="new-fine-value">Valor :</label><input type="number" id="new-fine-value" name="valor" min="0" step="0.01" placeholder="Ejemplo 100000" required></div>
                </div>
                <div class="fine-modal-actions"><button type="button" class="fine-cancel close-fine-modal">Cancelar</button><button type="submit" class="fine-save">Generar Multa</button></div>
            </form>
        </div>
    </div>
</div>

@foreach($multas as $multa)
    <div class="fine-modal edit-fine-modal" id="edit-fine-{{ $multa->idmulta }}">
        <div class="fine-modal-box">
            <header class="fine-modal-header"><h2>Editar <strong>Multa</strong></h2></header>
            <div class="fine-modal-body">
                <form method="POST" action="{{ route('multas.update', $multa) }}">
                    @csrf
                    @method('PUT')
                    <label for="edit-fine-loan-{{ $multa->idmulta }}">Préstamo</label>
                    <select id="edit-fine-loan-{{ $multa->idmulta }}" name="idprestamo" required>
                        @foreach($prestamosParaMulta as $prestamo)
                            <option value="{{ $prestamo->idprestamo }}" @selected($prestamo->idprestamo == $multa->idprestamo)>{{ $prestamo->idprestamo }} - {{ $prestamo->libro->titulo ?? 'Sin libro' }} / {{ $prestamo->usuario->nombre ?? 'Sin beneficiario' }} - {{ $prestamo->usuario->documento ?? '-' }}</option>
                        @endforeach
                    </select>
                    <label for="edit-fine-reason-{{ $multa->idmulta }}">Motivo</label>
                    <select id="edit-fine-reason-{{ $multa->idmulta }}" name="motivo" required>
                        <option value="Devolución tardía" @selected($multa->motivo === 'Devolución tardía')>Devolución tardía</option>
                        <option value="Libro perdido" @selected($multa->motivo === 'Libro perdido')>Libro perdido</option>
                        <option value="Libro dañado" @selected($multa->motivo === 'Libro dañado')>Libro dañado</option>
                        <option value="{{ $multa->motivo }}" @selected(!in_array($multa->motivo, ['Devolución tardía', 'Libro perdido', 'Libro dañado']))>{{ $multa->motivo }}</option>
                    </select>
                    <div class="fine-modal-columns">
                        <div><label for="edit-fine-date-{{ $multa->idmulta }}">Fecha</label><input type="date" id="edit-fine-date-{{ $multa->idmulta }}" name="fecha" value="{{ optional($multa->fecha)->format('Y-m-d') }}" required></div>
                        <div><label for="edit-fine-value-{{ $multa->idmulta }}">Valor</label><input type="number" id="edit-fine-value-{{ $multa->idmulta }}" name="valor" value="{{ $multa->valor }}" min="0" step="0.01" required></div>
                    </div>
                    <div class="fine-modal-actions"><button type="button" class="fine-cancel close-fine-modal">Cancelar</button><button type="submit" class="fine-save">Actualizar Multa</button></div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@foreach($multas as $multa)
    <div class="fine-modal delete-fine-modal" id="delete-fine-{{ $multa->idmulta }}"><div class="fine-delete-box"><div class="fine-warning">!</div><h2>¿Eliminar multa?</h2><p>Esta acción eliminará la multa del sistema.</p><div class="fine-modal-actions"><form method="POST" action="{{ route('multas.destroy', $multa) }}">@csrf @method('DELETE')<button type="submit" class="fine-save">Sí, eliminar</button></form><button type="button" class="fine-cancel close-fine-modal">Cancelar</button></div></div></div>
@endforeach

@foreach($multas as $multa)
    <div class="fine-modal print-fine-modal" id="print-fine-{{ $multa->idmulta }}">
        <div class="fine-modal-box" style="width: min(850px, 100%); background: #fff; padding: 0; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="invoice-content" style="padding: 50px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #eaeaea; padding-bottom: 30px; margin-bottom: 40px;">
                    <div>
                        <h1 style="margin: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; color: #3e2618; text-transform: uppercase; letter-spacing: 2px;">FACTURA</h1>
                        <p style="margin: 5px 0 0; color: #888; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px;">Original para el Cliente</p>
                    </div>
                    <div style="text-align: right;">
                        <h2 style="margin: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 22px; color: #75461f; font-weight: bold;">Biblioteca Humberto Montealegre Sánchez</h2>
                        <p style="margin: 5px 0 0; color: #555; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.5;">
                            Comprobante de Multa<br>
                            Sistema de Préstamos
                        </p>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 40px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                    <div style="width: 45%;">
                        <h3 style="margin: 0 0 15px; font-size: 12px; color: #999; text-transform: uppercase; letter-spacing: 1px;">Facturar a:</h3>
                        <h4 style="margin: 0 0 5px; font-size: 18px; color: #333; font-weight: bold;">{{ $multa->prestamo->usuario->nombre ?? 'N/A' }}</h4>
                        <p style="margin: 0 0 5px; color: #555; font-size: 14px; line-height: 1.5;">
                            Documento: {{ $multa->prestamo->usuario->documento ?? 'N/A' }}<br>
                            ID Préstamo: #{{ $multa->idprestamo }}<br>
                        </p>
                    </div>
                    <div style="width: 45%;">
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eaeaea; padding-bottom: 10px; margin-bottom: 10px;">
                            <span style="color: #555; font-size: 14px; font-weight: bold;">Nº de Factura:</span>
                            <span style="color: #333; font-size: 14px;">INV-{{ str_pad($multa->idmulta, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eaeaea; padding-bottom: 10px; margin-bottom: 10px;">
                            <span style="color: #555; font-size: 14px; font-weight: bold;">Fecha de Emisión:</span>
                            <span style="color: #333; font-size: 14px;">{{ optional($multa->fecha)->format('d M, Y') ?? now()->format('d M, Y') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eaeaea; padding-bottom: 10px;">
                            <span style="color: #555; font-size: 14px; font-weight: bold;">Monto a Pagar:</span>
                            <span style="color: #75461f; font-size: 16px; font-weight: bold;">${{ number_format((float) $multa->valor, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                    <thead>
                        <tr>
                            <th style="padding: 15px; text-align: left; background-color: #f8f9fa; color: #333; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; border-top: 2px solid #333; border-bottom: 2px solid #eaeaea;">Descripción</th>
                            <th style="padding: 15px; text-align: center; background-color: #f8f9fa; color: #333; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; border-top: 2px solid #333; border-bottom: 2px solid #eaeaea; width: 15%;">Cant.</th>
                            <th style="padding: 15px; text-align: right; background-color: #f8f9fa; color: #333; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; border-top: 2px solid #333; border-bottom: 2px solid #eaeaea; width: 25%;">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 20px 15px; border-bottom: 1px solid #eaeaea; color: #555; font-size: 15px;">
                                <strong style="color: #333; display: block; margin-bottom: 5px;">{{ $multa->motivo }}</strong>
                                <span style="font-size: 13px; color: #888;">Libro: {{ $multa->prestamo->libro->titulo ?? 'N/A' }}</span>
                                @if($multa->dias_retraso)
                                <br><span style="font-size: 13px; color: #888;">Días de retraso: {{ $multa->dias_retraso }}</span>
                                @endif
                            </td>
                            <td style="padding: 20px 15px; text-align: center; border-bottom: 1px solid #eaeaea; color: #555; font-size: 15px;">1</td>
                            <td style="padding: 20px 15px; text-align: right; border-bottom: 1px solid #eaeaea; color: #555; font-size: 15px;">${{ number_format((float) $multa->valor, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div style="display: flex; justify-content: flex-end; margin-bottom: 50px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                    <div style="width: 40%;">
                        <div style="display: flex; justify-content: space-between; padding: 15px; margin-top: 10px; background-color: #f4ece4; border-radius: 6px; color: #75461f; font-size: 18px; font-weight: bold;">
                            <span>Total a Pagar</span>
                            <span>${{ number_format((float) $multa->valor, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div style="border-top: 1px solid #eaeaea; padding-top: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                    <h3 style="margin: 0 0 5px; font-size: 14px; color: #333;">Términos y Condiciones</h3>
                    <p style="margin: 0; color: #777; font-size: 12px; line-height: 1.5;">El pago de esta multa es obligatorio para habilitar nuevamente el servicio de préstamos. Por favor, presente este documento en el momento del pago. Gracias por utilizar la Biblioteca Humberto Montealegre Sánchez.</p>
                </div>
            </div>
            
            <div class="fine-modal-actions" style="background: #fcfcfc; padding: 20px 50px; border-top: 1px solid #eaeaea; display: flex; justify-content: flex-end; gap: 15px;">
                <button type="button" class="fine-cancel close-fine-modal" style="height: 42px; padding: 0 24px; border: 1px solid #ccc; border-radius: 6px; background: #fff; color: #333; font-weight: 600; cursor: pointer;">Cerrar</button>
                <button type="button" class="fine-save" onclick="window.print()" style="height: 42px; padding: 0 24px; border: none; border-radius: 6px; background: #75461f; color: #fff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-print"></i> Imprimir Factura
                </button>
            </div>
        </div>
    </div>
@endforeach

<script>
    const newFineLoan = document.getElementById('new-fine-loan');
    const updateFineLoanDetails = () => {
        const option = newFineLoan.options[newFineLoan.selectedIndex];
        document.getElementById('fine-book-detail').textContent = option.dataset.book || 'Seleccione un préstamo';
        document.getElementById('fine-user-detail').textContent = option.dataset.user || '---';
        document.getElementById('fine-document-detail').textContent = option.dataset.document || '---';
    };
    newFineLoan.addEventListener('change', updateFineLoanDetails);
    document.getElementById('open-fine-modal').addEventListener('click', () => {
        document.getElementById('fine-modal').classList.add('is-open');
        document.getElementById('new-fine-date').value = new Date().toISOString().slice(0, 10);
    });
    document.querySelectorAll('.open-edit-fine').forEach((button) => {
        button.addEventListener('click', () => {
            document.getElementById(button.dataset.editFine).classList.add('is-open');
        });
    });

    document.querySelectorAll('.open-delete-fine').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = document.getElementById(button.dataset.deleteFine);
            modal.classList.add('is-open');
        });
    });

    document.querySelectorAll('.open-print-fine').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = document.getElementById(button.dataset.printFine);
            document.querySelectorAll('.print-fine-modal .fine-modal-box').forEach(box => box.classList.remove('active-print-area'));
            modal.querySelector('.fine-modal-box').classList.add('active-print-area');
            modal.classList.add('is-open');
        });
    });

    document.querySelectorAll('.close-fine-modal').forEach((button) => button.addEventListener('click', () => button.closest('.fine-modal').classList.remove('is-open')));
    document.querySelectorAll('.fine-modal').forEach((modal) => modal.addEventListener('click', (event) => { if (event.target === modal) modal.classList.remove('is-open'); }));
</script>

@include('partials.alerts')
