<style>
    .dashboard-books { color: #3d2617; }
    .dashboard-books .book-success { margin-bottom: 25px; padding: 20px; border: 1px solid #a6f0bd; border-radius: 18px; background: #effff3; color: #087d35; font-size: 15px; }
    .dashboard-books .book-error { margin-bottom: 25px; padding: 20px; border: 1px solid #f2aaaa; border-radius: 18px; background: #fff0f0; color: #a12626; font-size: 15px; }
    .dashboard-books .books-hero { display: flex; align-items: center; justify-content: space-between; min-height: 118px; margin-bottom: 25px; padding: 25px 34px; border-radius: 23px; background: linear-gradient(110deg, #5d351b, #3d2110); box-shadow: 0 8px 14px rgba(62,36,19,.14); }
    .dashboard-books .books-hero h2 { margin: 0; color: #fff; font-size: 31px; }
    .dashboard-books .add-book-button { padding: 16px 25px; border-radius: 16px; background: #fff; color: #3d2617; font-weight: 700; text-decoration: none; }
    .dashboard-books .add-book-button { border: 0; font: 700 14px 'Plus Jakarta Sans', sans-serif; cursor: pointer; }
    .dashboard-books .book-filters { display: grid; grid-template-columns: 1.4fr .8fr .68fr; gap: 17px; align-items: center; margin-bottom: 25px; padding: 20px; border-radius: 16px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.08); }
    .dashboard-books .book-filters input, .dashboard-books .book-filters select { width: 100%; height: 53px; margin: 0; padding: 0 17px; border: 1px solid #d9dfe6; border-radius: 12px; background: #fff; font: inherit; }
    .dashboard-books .book-search-button { height: 53px; border: 0; border-radius: 12px; background: #3d2110; color: #fff; font-weight: 700; cursor: pointer; }
    .dashboard-books .book-count { grid-column: 1 / -1; color: #75859a; font-size: 13px; }
    .dashboard-books .book-grid { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 26px; }
    .dashboard-books .book-card { overflow: hidden; border-radius: 22px 22px 0 0; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    .dashboard-books .book-visual { position: relative; display: flex; align-items: center; justify-content: center; height: 167px; background: linear-gradient(125deg,#633717,#b37c47); }
    .dashboard-books .book-cover { width: 84px; height: 118px; border: 4px solid #fff; border-radius: 12px; background: rgba(255,255,255,.12); object-fit: cover; }
    .dashboard-books .book-category, .dashboard-books .book-status { position: absolute; top: 16px; padding: 6px 13px; border-radius: 18px; background: #fff; font-size: 11px; font-weight: 700; }
    .dashboard-books .book-category { left: 16px; }
    .dashboard-books .book-status { right: 16px; background: #ffe1e1; color: #c52f2f; }
    .dashboard-books .book-status.available { background: #dcf7e4; color: #18743b; }
    .dashboard-books .book-details { min-height: 260px; padding: 22px 21px 18px; }
    .dashboard-books .book-details h3 { min-height: 48px; margin: 0 0 9px; color: #28180d; font-size: 19px; line-height: 1.25; }
    .dashboard-books .book-details p { margin: 7px 0; color: #657185; font-size: 13px; }
    .dashboard-books .book-details p strong { color: #1e2b3c; }
    .dashboard-books .book-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; margin-top: 24px; }
    .dashboard-books .book-actions a, .dashboard-books .book-actions button { height: 38px; border: 0; border-radius: 12px; font-weight: 700; text-align: center; text-decoration: none; cursor: pointer; }
    .dashboard-books .book-edit { display: flex; align-items: center; justify-content: center; background: #3d2110; color: #fff; }
    .dashboard-books .edit-book-trigger { width: 100%; }
    .dashboard-books .book-availability { background: #e5e8ed; color: #7b8797; }
    .dashboard-books .book-delete { width: 100%; height: 45px; margin-top: 15px; border: 0; border-radius: 14px; background: #fff0f0; color: #e52d2d; font: inherit; cursor: pointer; }
    .dashboard-books .book-delete:hover { background: #ffe0e0; }
    .dashboard-books .book-pagination { display: flex; justify-content: center; margin-top: 32px; }
    .dashboard-books .book-pagination nav { display: flex; align-items: center; gap: 8px; }
    .dashboard-books .book-pagination a, .dashboard-books .book-pagination span { display: flex; align-items: center; justify-content: center; min-width: 38px; height: 45px; padding: 0 12px; color: #6e4b30; font-size: 14px; text-decoration: none; }
    .dashboard-books .book-pagination a:hover { color: #3d2110; }
    .dashboard-books .book-pagination .active-page { border: 2px solid #75461f; border-radius: 8px; color: #3d2110; font-weight: 700; }
    .dashboard-books .book-pagination .disabled { color: #b8b2ac; }
    .book-modal { position: fixed; inset: 0; z-index: 20; display: none; align-items: center; justify-content: center; padding: 20px; background: rgba(0,0,0,.48); }
    .book-modal.is-open { display: flex; }
    .book-modal-content { width: min(990px, 100%); background: #f5efe6; border-top: 2px solid #236078; box-shadow: 0 20px 45px rgba(0,0,0,.3); }
    .book-modal-header { padding: 40px; border-bottom: 1px solid #aaa197; }
    .book-modal-header h2 { margin: 0; color: #8a633d; font: 400 31px Georgia, serif; }
    .book-modal-header strong { color: #332012; font-weight: 700; }
    .book-modal-body { padding: 38px 40px 30px; }
    .book-modal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 26px 62px; }
    .book-modal-field-full { grid-column: 1 / -1; }
    .book-modal-body label { display: block; margin-bottom: 10px; color: #684321; font: 700 14px Georgia, serif; }
    .book-modal-body input, .book-modal-body select { width: 100%; height: 38px; margin: 0; padding: 0 14px; border: 1px solid #c9c5c0; border-radius: 2px; background: #fff; font: 15px 'Segoe UI', sans-serif; }
    .book-modal-actions { display: flex; justify-content: flex-end; gap: 30px; margin-top: 47px; }
    .book-modal-actions button { height: 36px; padding: 0 23px; border: 0; border-radius: 3px; font: 700 14px Georgia, serif; cursor: pointer; }
    .book-modal-cancel { background: #fff; color: #7b5837; }
    .book-modal-save { min-width: 150px; background: #653a1e; color: #fff; }
    .book-modal-error { margin-bottom: 20px; padding: 12px 16px; background: #fff0f0; color: #9a2525; }
    .book-modal-error ul { margin: 0; padding-left: 20px; }
    @media (max-width: 1050px) { .dashboard-books .book-grid { grid-template-columns: repeat(3,minmax(0,1fr)); } }
    @media (max-width: 760px) { .dashboard-books .books-hero { align-items: flex-start; flex-direction: column; gap: 18px; } .dashboard-books .book-filters { grid-template-columns: 1fr; } .dashboard-books .book-count { grid-column: auto; } .dashboard-books .book-grid { grid-template-columns: repeat(2,minmax(0,1fr)); } }
    @media (max-width: 500px) { .dashboard-books .book-grid { grid-template-columns: 1fr; } }
</style>

<div class="dashboard-books">
    <div class="books-hero">
        <h2>Catálogo de libros</h2>
        <button type="button" class="add-book-button" id="open-book-modal">+ Añadir libro</button>
    </div>

    @if(session('success') || request('mensaje') === 'eliminado')
        <div class="book-success">{{ session('success') ?? 'Libro eliminado exitosamente.' }}</div>
    @endif

    @if(session('error'))
        <div class="book-error">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('dashboard') }}" class="book-filters">
        <input type="hidden" name="modulo" value="libros">
        <input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar por título, autor, categoría o año...">
        <select name="categoria">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat }}" @selected($categoria === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        <button type="submit" class="book-search-button">Buscar</button>
        <div class="book-count">Se encontraron {{ $libros->total() }} libro(s) en el catálogo.</div>
    </form>

    <div class="book-grid">
        @forelse($libros as $libro)
            @php($estaPrestado = $libro->prestamos_activos_count > 0)
            <article class="book-card">
                <div class="book-visual">
                    <span class="book-category">{{ $libro->categoria }}</span>
                    <span class="book-status{{ $estaPrestado ? '' : ' available' }}">{{ $estaPrestado ? 'Prestado' : 'Disponible' }}</span>
                    @if($libro->imagen)
                        <img src="{{ asset('storage/' . $libro->imagen) }}" alt="Portada de {{ $libro->titulo }}" class="book-cover">
                    @else
                        <div class="book-cover" aria-hidden="true"></div>
                    @endif
                </div>
                <div class="book-details">
                    <h3>{{ $libro->titulo }}</h3>
                    <p><strong>Autor:</strong> {{ $libro->autor->nombre ?? 'Sin autor' }}</p>
                    <p><strong>Id autor:</strong> {{ $libro->idautor }}</p>
                    <p><strong>Nacionalidad:</strong> {{ $libro->autor->nacionalidad ?? 'No registrada' }}</p>
                    <p><strong>Año:</strong> {{ $libro->año_publicacion ?? 'No registrado' }}</p>
                    <p><strong>Código:</strong> LIB-{{ $libro->idlibro }}</p>
                    <div class="book-actions">
                        <button type="button" class="book-edit edit-book-trigger" data-edit-modal="edit-book-modal-{{ $libro->idlibro }}">Editar</button>
                        <button type="button" class="book-availability" disabled>{{ $estaPrestado ? 'Ocupado' : 'Disponible' }}</button>
                    </div>
                    <form action="{{ route('libros.destroy', $libro) }}" method="POST" onsubmit="return confirm('¿Eliminar este libro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="book-delete">Eliminar</button>
                    </form>
                </div>
            </article>

            <div class="book-modal" id="edit-book-modal-{{ $libro->idlibro }}" role="dialog" aria-modal="true" aria-labelledby="edit-book-title-{{ $libro->idlibro }}">
                <div class="book-modal-content">
                    <header class="book-modal-header">
                        <h2 id="edit-book-title-{{ $libro->idlibro }}">Editar <strong>Libro</strong></h2>
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
                                    <label for="edit-author-{{ $libro->idlibro }}">Id autor</label>
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
            <p>No hay libros registrados.</p>
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

<div class="book-modal{{ $errors->any() ? ' is-open' : '' }}" id="book-modal" role="dialog" aria-modal="true" aria-labelledby="book-modal-title">
    <div class="book-modal-content">
        <header class="book-modal-header">
            <h2 id="book-modal-title">Agregar <strong>Libro</strong></h2>
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
                        <label for="new-book-author">Id autor</label>
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
    openBookModal.addEventListener('click', () => {
        bookModal.classList.add('is-open');
        document.getElementById('new-book-title').focus();
    });
    closeBookModal.addEventListener('click', () => bookModal.classList.remove('is-open'));
    bookModal.addEventListener('click', (event) => {
        if (event.target === bookModal) bookModal.classList.remove('is-open');
    });

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
