<style>
    .dashboard-books { color: #2e2118; font-family: "Segoe UI", Arial, sans-serif; }
    .dashboard-books .book-success { margin-bottom: 25px; padding: 20px; border: 1px solid #a6f0bd; border-radius: 18px; background: #effff3; color: #087d35; font-size: 15px; }
    .dashboard-books .book-error { margin-bottom: 25px; padding: 20px; border-radius: 8px; background: #f44343; color: #fff; font-size: 15px; }
    
    /* Catalog Hero Banner */
    .dashboard-books .books-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 118px;
        margin-bottom: 24px;
        padding: 34px 38px;
        border-radius: 26px;
        background: linear-gradient(110deg, #633a1d, #3d2110);
        box-shadow: 0 12px 20px rgba(66,38,18,.14);
        position: relative;
        overflow: hidden;
    }
    .dashboard-books .books-hero::after {
        content: '';
        position: absolute;
        right: -60px;
        bottom: -60px;
        width: 280px;
        height: 280px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        pointer-events: none;
    }
    .dashboard-books .books-hero h2 { margin: 0; color: #fff; font-size: 34px; font-weight: 800; }
    .dashboard-books .add-book-button {
        padding: 14px 22px;
        border-radius: 14px;
        background: #fff;
        color: #3d2110;
        font-weight: 700;
        font-size: 14px;
        border: 0;
        cursor: pointer;
        transition: transform 0.15s ease;
        position: relative;
        z-index: 2;
    }
    .dashboard-books .add-book-button:hover { transform: scale(1.02); }

    /* Stat Cards */
    .dashboard-books .catalog-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }
    .dashboard-books .stat-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        border: 1px solid #e2e4e7;
        min-height: 155px;
    }
    .dashboard-books .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 17px;
        font-size: 18px;
    }
    .dashboard-books .icon-brown { background: #f3ede5; color: #70431e; }
    .dashboard-books .icon-green { background: #d9f8e5; color: #0a8b45; }
    .dashboard-books .icon-gold { background: #fff8e1; color: #f57f17; }

    .dashboard-books .stat-label { font-size: 13px; color: #687791; margin-bottom: 8px; font-weight: 500; }
    .dashboard-books .stat-value { font-size: 34px; font-weight: 700; line-height: 1; }
    .dashboard-books .val-brown { color: #70431e; }
    .dashboard-books .val-green { color: #0a9b49; }

    /* Search Filter Panel */
    .dashboard-books .book-filters {
        display: flex;
        gap: 14px;
        margin-bottom: 28px;
        padding: 20px;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,.08);
        border: 1px solid #e2e4e7;
    }
    .dashboard-books .book-filters input, .dashboard-books .book-filters select {
        flex: 1;
        height: 48px;
        padding: 0 18px;
        border: 1px solid #d4dbe5;
        border-radius: 12px;
        background: #fff;
        font-size: 14px;
        color: #2e2118;
        outline: none;
    }
    .dashboard-books .book-filters select { flex: 0.6; }
    .dashboard-books .book-search-button {
        width: 220px;
        height: 48px;
        border: 0;
        border-radius: 12px;
        background: #5c381e;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
    }
    .dashboard-books .book-search-button:hover { background: #432713; }

    /* Section Title */
    .dashboard-books .catalog-section-title {
        font-size: 24px;
        font-weight: 800;
        color: #2e2118;
        margin-bottom: 22px;
    }

    /* Grid of Cards */
    .dashboard-books .book-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: 24px;
        margin-bottom: 30px;
    }

    .dashboard-books .book-card {
        overflow: hidden;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,.06);
        border: 1px solid #e5e2dd;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .dashboard-books .book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .dashboard-books .book-card-header {
        background: linear-gradient(135deg, #5c381e 0%, #3e2210 100%);
        padding: 22px 24px;
        position: relative;
        color: #ffffff;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 24px 24px 0 0;
    }
    .dashboard-books .book-card-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .dashboard-books .book-category-tag {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.85);
    }
    .dashboard-books .book-badge-status {
        padding: 5px 12px;
        border-radius: 18px;
        font-size: 11px;
        font-weight: 700;
    }
    .dashboard-books .badge-unavailable { background: #ffe0e2; color: #c5252b; }
    .dashboard-books .badge-available { background: #d9f8e5; color: #0a8b45; }

    .dashboard-books .book-header-content {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .dashboard-books .book-cover-image {
        width: 72px;
        height: 98px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid rgba(255,255,255,0.3);
        box-shadow: 0 4px 12px rgba(0,0,0,0.35);
        flex-shrink: 0;
    }
    .dashboard-books .book-card-title {
        font-size: 22px;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.25;
        margin: 0;
    }

    .dashboard-books .book-card-body {
        padding: 22px 24px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        flex: 1;
    }
    .dashboard-books .book-author-section { display: flex; flex-direction: column; }
    .dashboard-books .book-label-small {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #8c8c8c;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .dashboard-books .book-author-name { font-size: 15px; font-weight: 700; color: #2e2118; }

    .dashboard-books .book-info-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .dashboard-books .book-info-box {
        background: #f8f5f1;
        border-radius: 14px;
        padding: 12px 14px;
        border: 1px solid #f0eae1;
    }
    .dashboard-books .book-info-value { font-size: 15px; font-weight: 700; color: #2e2118; }

    .dashboard-books .book-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 6px; }
    .dashboard-books .book-actions button {
        height: 42px;
        border: 0;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
    }
    .dashboard-books .book-edit { background: #5c381e; color: #fff; }
    .dashboard-books .book-edit:hover { background: #432713; }
    .dashboard-books .book-delete { background: #fff0f0; color: #d32f2f; border: 1px solid #ffdede; }
    .dashboard-books .book-delete:hover { background: #ffe0e0; }

    .dashboard-books .book-pagination { display: flex; justify-content: center; margin-top: 32px; }
    .dashboard-books .book-pagination nav { display: flex; align-items: center; gap: 8px; }
    .dashboard-books .book-pagination a, .dashboard-books .book-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 45px; padding: 0 12px; color: #6e4b30; font-size: 14px; text-decoration: none; }
    .dashboard-books .book-pagination a:hover { color: #3d2110; }
    .dashboard-books .book-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; color: #3d2110; font-weight: 700; }
    .dashboard-books .book-pagination .disabled { color: #b8b2ac; }

    /* Modals */
    .book-modal { position: fixed; inset: 0; z-index: 200; display: none; align-items: center; justify-content: center; padding: 20px; background: rgba(0,0,0,.48); }
    .book-modal.is-open { display: flex; }
    .book-modal-content { width: min(800px, 100%); background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,.3); }
    .book-modal-header { padding: 30px 35px; background: #5c381e; color: #ffffff; }
    .book-modal-header h2 { margin: 0; color: #ffffff; font-size: 24px; font-weight: 700; }
    .book-modal-body { padding: 35px; }
    .book-modal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .book-modal-field-full { grid-column: 1 / -1; }
    .book-modal-body label { display: block; margin-bottom: 8px; color: #2e2118; font-weight: 700; font-size: 13px; }
    .book-modal-body input, .book-modal-body select { width: 100%; height: 44px; margin: 0; padding: 0 16px; border: 1px solid #d4dbe5; border-radius: 10px; background: #fff; font-size: 14px; }
    .book-modal-actions { display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; }
    .book-modal-actions button { height: 44px; padding: 0 24px; border: 0; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; }
    .book-modal-cancel { background: #f0f0f0; color: #555; }
    .book-modal-save { background: #5c381e; color: #fff; }
    .book-modal-error { margin-bottom: 20px; padding: 14px; background: #fff0f0; color: #d32f2f; border-radius: 10px; }

    @media (max-width: 1050px) { .dashboard-books .book-grid { grid-template-columns: repeat(2,minmax(0,1fr)); } .dashboard-books .catalog-stats { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 600px) { .dashboard-books .book-grid { grid-template-columns: 1fr; } .dashboard-books .catalog-stats { grid-template-columns: 1fr; } .dashboard-books .book-filters { flex-direction: column; } .dashboard-books .book-search-button { width: 100%; } }
</style>

<div class="dashboard-books">
    <!-- Hero Banner -->
    <div class="books-hero">
        <h2>Catálogo de Libros</h2>
        <button type="button" class="add-book-button" id="open-book-modal">+ Añadir libro</button>
    </div>

    <!-- Stat Cards -->
    <div class="catalog-stats">
        <div class="stat-card">
            <div class="stat-icon icon-brown"><i class="fa-solid fa-book-bookmark"></i></div>
            <div class="stat-label">Libros encontrados</div>
            <div class="stat-value val-brown">{{ $totalLibrosEncontrados ?? $libros->total() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-label">Disponibles</div>
            <div class="stat-value val-green">{{ $librosDisponibles ?? 0 }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-gold"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-label">Prestados / pendientes</div>
            <div class="stat-value val-brown">{{ $librosPrestados ?? 0 }}</div>
        </div>
    </div>

    @if(session('success') || request('mensaje') === 'eliminado')
        <div class="book-success">{{ session('success') ?? 'Libro eliminado exitosamente.' }}</div>
    @endif

    @if(session('error'))
        <div class="book-error">{{ session('error') }}</div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('dashboard') }}" class="book-filters">
        <input type="hidden" name="modulo" value="libros">
        <input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar por título, autor, categoría, año o ubicación...">
        <button type="submit" class="book-search-button">Buscar</button>
    </form>

    <!-- Section Heading -->
    <h2 class="catalog-section-title">Libros del catálogo</h2>

    <!-- Books Grid -->
    <div class="book-grid">
        @forelse($libros as $libro)
            @php($estaPrestado = $libro->prestamos_activos_count > 0)
            <article class="book-card">
                <div class="book-card-header">
                    <div class="book-card-header-top">
                        <span class="book-category-tag">{{ strtoupper($libro->categoria ?? 'GENERAL') }}</span>
                        <span class="book-badge-status {{ $estaPrestado ? 'badge-unavailable' : 'badge-available' }}">
                            {{ $estaPrestado ? 'No disponible' : 'Disponible' }}
                        </span>
                    </div>
                    <div class="book-header-content">
                        @if($libro->imagen)
                            <img src="{{ asset('storage/' . $libro->imagen) }}" alt="Portada de {{ $libro->titulo }}" class="book-cover-image">
                        @endif
                        <h2 class="book-card-title">{{ $libro->titulo }}</h2>
                    </div>
                </div>
                <div class="book-card-body">
                    <div class="book-author-section">
                        <span class="book-label-small">AUTOR</span>
                        <span class="book-author-name">{{ $libro->autor->nombre ?? 'Sin autor' }}</span>
                    </div>
                    <div class="book-info-row">
                        <div class="book-info-box">
                            <div class="book-label-small">Año</div>
                            <div class="book-info-value">{{ $libro->año_publicacion ?? 'N/A' }}</div>
                        </div>
                        <div class="book-info-box">
                            <div class="book-label-small">Estado</div>
                            <div class="book-info-value">{{ $estaPrestado ? 'No disponible' : 'Disponible' }}</div>
                        </div>
                    </div>
                    <div class="book-info-box">
                        <div class="book-label-small">Ubicación / Consulta</div>
                        <div class="book-info-value">Sin información registrada</div>
                    </div>
                    <div class="book-actions">
                        <button type="button" class="book-edit edit-book-trigger" data-edit-modal="edit-book-modal-{{ $libro->idlibro }}">Editar</button>
                        <form action="{{ route('libros.destroy', $libro) }}" method="POST" onsubmit="return confirm('¿Eliminar este libro?')" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="book-delete">Eliminar</button>
                        </form>
                    </div>
                </div>
            </article>

            <!-- Edit Modal -->
            <div class="book-modal" id="edit-book-modal-{{ $libro->idlibro }}" role="dialog" aria-modal="true" aria-labelledby="edit-book-title-{{ $libro->idlibro }}">
                <div class="book-modal-content">
                    <header class="book-modal-header">
                        <h2 id="edit-book-title-{{ $libro->idlibro }}">Editar Libro</h2>
                    </header>
                    <div class="book-modal-body">
                        <form action="{{ route('libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="book-modal-grid">
                                <div class="book-modal-field-full">
                                    <label for="edit-title-{{ $libro->idlibro }}">Título</label>
                                    <input type="text" id="edit-title-{{ $libro->idlibro }}" name="titulo" value="{{ $libro->titulo }}" required>
                                </div>
                                <div>
                                    <label for="edit-category-{{ $libro->idlibro }}">Categoría</label>
                                    <input type="text" id="edit-category-{{ $libro->idlibro }}" name="categoria" value="{{ $libro->categoria }}" required>
                                </div>
                                <div>
                                    <label for="edit-year-{{ $libro->idlibro }}">Año publicación</label>
                                    <input type="number" id="edit-year-{{ $libro->idlibro }}" name="año_publicacion" value="{{ $libro->año_publicacion }}" min="1000" max="2100">
                                </div>
                                <div class="book-modal-field-full">
                                    <label for="edit-author-{{ $libro->idlibro }}">Autor</label>
                                    <select id="edit-author-{{ $libro->idlibro }}" name="idautor" required>
                                        @foreach($autores as $autor)
                                            <option value="{{ $autor->idautor }}" @selected($libro->idautor == $autor->idautor)>{{ $autor->idautor }} - {{ $autor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="book-modal-field-full">
                                    <label for="edit-image-{{ $libro->idlibro }}">Cambiar imagen de portada</label>
                                    <input type="file" id="edit-image-{{ $libro->idlibro }}" name="imagen" accept="image/jpeg,image/png,image/webp">
                                </div>
                            </div>
                            <div class="book-modal-actions">
                                <button type="button" class="book-modal-cancel close-edit-book-modal">Cancelar</button>
                                <button type="submit" class="book-modal-save">Actualizar Libro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; padding: 40px; background: #fff; border-radius: 20px; text-align: center; color: #75859a;">
                No hay libros registrados en el catálogo.
            </div>
        @endforelse
    </div>

    @if($libros->hasPages())
        <div class="book-pagination">
            <nav aria-label="Paginación de libros">
                @if($libros->onFirstPage())
                    <span class="disabled">«</span>
                    <span class="disabled">‹ Anterior</span>
                @else
                    <a href="{{ $libros->url(1) }}">«</a>
                    <a href="{{ $libros->previousPageUrl() }}">‹ Anterior</a>
                @endif

                @for($pagina = 1; $pagina <= $libros->lastPage(); $pagina++)
                    @if($pagina === $libros->currentPage())
                        <span class="active-page">{{ $pagina }}</span>
                    @else
                        <a href="{{ $libros->url($pagina) }}">{{ $pagina }}</a>
                    @endif
                @endfor

                @if($libros->hasMorePages())
                    <a href="{{ $libros->nextPageUrl() }}">Siguiente ›</a>
                    <a href="{{ $libros->url($libros->lastPage()) }}">»</a>
                @else
                    <span class="disabled">Siguiente ›</span>
                    <span class="disabled">»</span>
                @endif
            </nav>
        </div>
    @endif
</div>

<!-- Add Book Modal -->
<div class="book-modal{{ $errors->any() ? ' is-open' : '' }}" id="book-modal" role="dialog" aria-modal="true" aria-labelledby="book-modal-title">
    <div class="book-modal-content">
        <header class="book-modal-header">
            <h2 id="book-modal-title">Agregar Nuevo Libro</h2>
        </header>
        <div class="book-modal-body">
            @if($errors->any())
                <div class="book-modal-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="book-modal-grid">
                    <div class="book-modal-field-full">
                        <label for="new-book-title">Título</label>
                        <input type="text" id="new-book-title" name="titulo" value="{{ old('titulo') }}" required>
                    </div>
                    <div class="book-modal-field-full">
                        <label for="new-book-image">Imagen de portada</label>
                        <input type="file" id="new-book-image" name="imagen" accept="image/jpeg,image/png,image/webp">
                    </div>
                    <div>
                        <label for="new-book-category">Categoría</label>
                        <input type="text" id="new-book-category" name="categoria" value="{{ old('categoria') }}" required>
                    </div>
                    <div>
                        <label for="new-book-year">Año publicación</label>
                        <input type="number" id="new-book-year" name="año_publicacion" value="{{ old('año_publicacion') }}" min="1000" max="2100">
                    </div>
                    <div class="book-modal-field-full">
                        <label for="new-book-author">Autor</label>
                        <select id="new-book-author" name="idautor" required>
                            <option value="">Seleccione un autor</option>
                            @foreach($autores as $autor)
                                <option value="{{ $autor->idautor }}" @selected(old('idautor') == $autor->idautor)>{{ $autor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="book-modal-actions">
                    <button type="button" class="book-modal-cancel" id="close-book-modal">Cancelar</button>
                    <button type="submit" class="book-modal-save">Guardar Libro</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const bookModal = document.getElementById('book-modal');
    const openBookModal = document.getElementById('open-book-modal');
    const closeBookModal = document.getElementById('close-book-modal');
    if (openBookModal) {
        openBookModal.addEventListener('click', () => {
            bookModal.classList.add('is-open');
            document.getElementById('new-book-title').focus();
        });
    }
    if (closeBookModal) {
        closeBookModal.addEventListener('click', () => bookModal.classList.remove('is-open'));
    }
    if (bookModal) {
        bookModal.addEventListener('click', (event) => {
            if (event.target === bookModal) bookModal.classList.remove('is-open');
        });
    }

    document.querySelectorAll('.edit-book-trigger').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            document.getElementById(trigger.dataset.editModal).classList.add('is-open');
        });
    });

    document.querySelectorAll('.close-edit-book-modal').forEach((button) => {
        button.addEventListener('click', () => button.closest('.book-modal').classList.remove('is-open'));
    });

    document.querySelectorAll('.book-modal').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.classList.remove('is-open');
        });
    });
</script>
