<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <link rel="icon" href="{{ asset('images/logo-libro.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    * { box-sizing: border-box; }
    body { margin: 0; background: #f7f4f1; color: #333; font-family: "Segoe UI", Arial, sans-serif; }
    .app { display: flex; min-height: 100vh; }
    .sidebar { position: fixed; inset: 0 auto 0 0; z-index: 2; width: 234px; background: #2d1a0e; color: #fff; }
    .logo { height: 103px; padding: 27px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,.12); }
    .logo-icon { color: #d7b786; font-size: 25px; }
    .logo-text span { display: block; color: #d7b786; font-size: 12px; letter-spacing: 1px; }
    .logo-text strong { display: block; color: #fff; font: bold 20px Georgia, serif; }
    .menu { padding-top: 16px; }
    .menu a { height: 44px; padding: 0 21px; display: flex; align-items: center; gap: 14px; color: #f1e7dc; text-decoration: none; font-size: 14px; }
    .menu a i { width: 18px; text-align: center; color: #d7c5b1; }
    .menu a:hover, .menu a.active { background: #432713; }
    .main { width: calc(100% - 234px); min-height: 100vh; margin-left: 234px; }
    .topbar { height: 72px; padding: 0 34px; display: flex; align-items: center; justify-content: space-between; background: #75461f; color: #fff; }
    .topbar h1 { margin: 0; font: bold 21px Georgia, serif; }
    .user { display: flex; align-items: center; gap: 10px; text-align: right; }
    .user strong, .user span { display: block; }
    .user span { color: #f0e0ce; font-size: 12px; }
    .user-icon { width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #96724c; }
    .content { padding: 58px 58px 40px; }
    .books-page {
        color: #3d2617;
    }

    .books-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 118px;
        margin-bottom: 25px;
        padding: 25px 34px;
        border-radius: 23px;
        background: linear-gradient(110deg, #5d351b, #3d2110);
        box-shadow: 0 8px 14px rgba(62, 36, 19, .14);
    }

    .books-hero h1 {
        margin: 0;
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 31px;
        font-weight: 700;
    }

    .add-book-button {
        padding: 16px 25px;
        border-radius: 16px;
        background: #fff;
        color: #3d2617;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .book-filters {
        display: grid;
        grid-template-columns: 1.4fr .8fr .68fr;
        gap: 17px;
        align-items: center;
        margin-bottom: 25px;
        padding: 20px;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
    }

    .book-filters input,
    .book-filters select {
        width: 100%;
        height: 53px;
        margin: 0;
        padding: 0 17px;
        border: 1px solid #d9dfe6;
        border-radius: 12px;
        background: #fff;
        color: #352417;
        font: inherit;
    }

    .book-filters input::placeholder {
        color: #a3afc0;
    }

    .book-search-button {
        height: 53px;
        border: 0;
        border-radius: 12px;
        background: #3d2110;
        color: #fff;
        font: 700 14px 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
    }

    .book-count {
        grid-column: 1 / -1;
        color: #75859a;
        font-size: 13px;
    }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
    }

    .book-card {
        overflow: hidden;
        border-radius: 22px 22px 0 0;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
    }

    .book-visual {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 167px;
        background: linear-gradient(125deg, #633717, #b37c47);
    }

    .book-cover {
        width: 84px;
        height: 118px;
        border: 4px solid #fff;
        border-radius: 12px;
        background: rgba(255, 255, 255, .12);
    }

    .book-category,
    .book-status {
        position: absolute;
        top: 16px;
        padding: 6px 13px;
        border-radius: 18px;
        background: #fff;
        font-size: 11px;
        font-weight: 700;
    }

    .book-category {
        left: 16px;
        color: #26180e;
    }

    .book-status {
        right: 16px;
        background: #ffe1e1;
        color: #c52f2f;
    }

    .book-status.available {
        background: #dcf7e4;
        color: #18743b;
    }

    .book-details {
        min-height: 260px;
        padding: 22px 21px 18px;
    }

    .book-details h2 {
        min-height: 48px;
        margin: 0 0 9px;
        color: #28180d;
        font-size: 19px;
        line-height: 1.25;
    }

    .book-details p {
        margin: 7px 0;
        color: #657185;
        font-size: 13px;
    }

    .book-details p strong {
        color: #1e2b3c;
    }

    .book-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
        margin-top: 24px;
    }

    .book-actions a,
    .book-actions button {
        height: 38px;
        border: 0;
        border-radius: 12px;
        font: 700 13px 'Plus Jakarta Sans', sans-serif;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
    }

    .book-edit {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #3d2110;
        color: #fff;
    }

    .book-availability {
        background: #e5e8ed;
        color: #7b8797;
    }

    .book-empty {
        grid-column: 1 / -1;
        padding: 40px;
        border-radius: 16px;
        background: #fff;
        color: #75859a;
        text-align: center;
    }

    @media (max-width: 1050px) {
        .sidebar { width: 70px; }
        .logo { justify-content: center; padding: 20px 8px; }
        .logo-text, .menu a span { display: none; }
        .menu a { justify-content: center; padding: 0; }
        .main { width: calc(100% - 70px); margin-left: 70px; }
        .topbar { padding: 0 15px; }
        .topbar h1 { font-size: 17px; }
        .user-info { display: none; }
        .content { padding: 25px 15px; }
        .book-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }

    @media (max-width: 760px) {
        .books-hero { align-items: flex-start; flex-direction: column; gap: 18px; }
<body>
<div class="app">
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo-libro.png') }}" alt="Logo" class="logo-icon" style="width: 45px; height: auto; background: transparent;">
            <div class="logo-text"><span>Biblioteca</span><strong>HMS</strong></div>
        </div>
        <nav class="menu">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i><span>Inicio</span></a>
            <a href="{{ route('usuarios.index') }}"><i class="fa-solid fa-users"></i><span>Beneficiarios</span></a>
            <a href="{{ route('catalogo') }}" class="active"><i class="fa-solid fa-book"></i><span>Libros</span></a>
            <a href="{{ route('prestamos.index') }}"><i class="fa-solid fa-hand-holding-heart"></i><span>Préstamos</span></a>
            <a href="{{ route('devoluciones.index') }}"><i class="fa-solid fa-rotate-left"></i><span>Devolución</span></a>
            <a href="{{ route('multas.index') }}"><i class="fa-solid fa-file-invoice-dollar"></i><span>Multa</span></a>
            <a href="#"><i class="fa-solid fa-chart-line"></i><span>Reporte</span></a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-power-off"></i><span>Cerrar Sesión</span></a>
        </nav>
    </aside>
    <main class="main">
        <header class="topbar">
            <h1>Libros</h1>
            <div class="user">
                <div class="user-info"><strong>Bibliotecario</strong><span>{{ session('usuario.nombre', 'Michi') }}</span></div>
                <div class="user-icon"><i class="fa-solid fa-user"></i></div>
            </div>
        </header>
        <section class="content">
            @if(session('success'))
                <div class="alert-success" style="margin-bottom: 20px;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error" style="margin-bottom: 20px;">{{ session('error') }}</div>
            @endif
        .book-filters { grid-template-columns: 1fr; }
        .book-count { grid-column: auto; }
        .book-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 500px) {
        .books-hero h1 { font-size: 25px; }
        .book-grid { grid-template-columns: 1fr; }
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

    .book-delete-modal {
        position: fixed;
        inset: 0;
        z-index: 30;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(0, 0, 0, .48);
    }

    .book-delete-modal.is-open {
        display: flex;
    }

    .book-delete-box {
        width: min(520px, 100%);
        padding: 40px 32px 27px;
        border-radius: 5px;
        background: #f5efe6;
        text-align: center;
        box-shadow: 0 18px 45px rgba(0, 0, 0, .28);
    }

    .book-warning {
        width: 88px;
        height: 88px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 34px;
        border: 4px solid #ffc080;
        border-radius: 50%;
        color: #ffbd7c;
        font-size: 46px;
    }

    .book-delete-box h2 {
        margin: 0 0 20px;
        color: #3e2618;
        font-size: 29px;
    }

    .book-delete-box p {
        margin: 0 0 30px;
        color: #654b39;
        font-size: 17px;
    }

    .book-delete-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .book-delete-actions button {
        height: 46px;
        padding: 0 20px;
        border: 0;
        border-radius: 4px;
        color: white;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
    }

    .confirm-book-delete {
        background: #75461f;
    }

    .cancel-book-delete {
        background: #aeb8c7;
    }
</style>

<div class="books-page">
    <div class="books-hero">
        <h1>Catálogo de libros</h1>
        <a href="{{ route('libros.create') }}" class="add-book-button">+ Añadir libro</a>
    </div>

    <form method="GET" action="{{ route('libros.index') }}" class="book-filters">
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
                    <span class="book-status{{ $estaPrestado ? '' : ' available' }}">
                        {{ $estaPrestado ? 'Prestado' : 'Disponible' }}
                    </span>
                    @if($libro->imagen)
                        <img src="{{ asset('storage/' . $libro->imagen) }}" alt="Portada de {{ $libro->titulo }}" class="book-cover" style="object-fit: cover;">
                    @else
                        <div class="book-cover" aria-hidden="true"></div>
                    @endif
                </div>

                <div class="book-details">
                    <h2>{{ $libro->titulo }}</h2>
                    <p><strong>Autor:</strong> {{ $libro->autor->nombre ?? 'Sin autor' }}</p>
                    <p><strong>Id autor:</strong> {{ $libro->idautor }}</p>
                    <p><strong>Nacionalidad:</strong> {{ $libro->autor->nacionalidad ?? 'No registrada' }}</p>
                    <p><strong>Año:</strong> {{ $libro->año_publicacion ?? 'No registrado' }}</p>
                    <p><strong>Código:</strong> LIB-{{ $libro->idlibro }}</p>

                    <div class="book-actions">
                        <a href="{{ route('libros.edit', $libro) }}" class="book-edit">Editar</a>
                        <button type="button" class="book-availability" disabled>
                            {{ $estaPrestado ? 'Ocupado' : 'Disponible' }}
                        </button>
                    </div>

                    <button type="button" class="open-book-delete" data-delete-book="delete-book-{{ $libro->idlibro }}" style="margin-top: 10px; border: 0; background: transparent; color: #b33; cursor: pointer;">Eliminar</button>
                </div>
            </article>

            <!-- Modal de Eliminación -->
            <div class="book-delete-modal" id="delete-book-{{ $libro->idlibro }}" role="dialog" aria-modal="true" aria-labelledby="delete-book-title-{{ $libro->idlibro }}">
                <div class="book-delete-box">
                    <div class="book-warning">!</div>
                    <h2 id="delete-book-title-{{ $libro->idlibro }}">¿Eliminar libro?</h2>
                    <p>Esta acción eliminará el libro del sistema.</p>
                    <div class="book-delete-actions">
                        <form action="{{ route('libros.destroy', $libro) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="confirm-book-delete">Sí, eliminar</button>
                            <button type="button" class="cancel-book-delete">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="book-empty">No hay libros registrados.</div>
        @endforelse
    </div>

    @if($libros->hasPages())
    <div class="pagination-wrapper">
        <nav>
            {{-- Primera página --}}
            @if($libros->onFirstPage())
                <span class="disabled">&laquo;</span>
            @else
                <a href="{{ $libros->url(1) }}">&laquo;</a>
            @endif

            {{-- Anterior --}}
            @if($libros->onFirstPage())
                <span class="disabled">&lsaquo; Anterior</span>
            @else
                <a href="{{ $libros->previousPageUrl() }}">&lsaquo; Anterior</a>
            @endif

            {{-- Números de página --}}
            @for($i = 1; $i <= $libros->lastPage(); $i++)
                @if($i == $libros->currentPage())
                    <span class="active-page">{{ $i }}</span>
                @else
                    <a href="{{ $libros->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            {{-- Siguiente --}}
            @if($libros->hasMorePages())
                <a href="{{ $libros->nextPageUrl() }}">Siguiente &rsaquo;</a>
            @else
                <span class="disabled">Siguiente &rsaquo;</span>
            @endif

            {{-- Última página --}}
            @if($libros->hasMorePages())
                <a href="{{ $libros->url($libros->lastPage()) }}">&raquo;</a>
            @else
                <span class="disabled">&raquo;</span>
            @endif
        </nav>
    </div>
    @endif
</div>
</section>
</main>
</div>

<script>
    document.querySelectorAll('.open-book-delete').forEach((button) => {
        button.addEventListener('click', () => {
            document.getElementById(button.dataset.deleteBook).classList.add('is-open');
        });
    });

    document.querySelectorAll('.cancel-book-delete').forEach((button) => {
        button.addEventListener('click', () => button.closest('.book-delete-modal').classList.remove('is-open'));
    });

    document.querySelectorAll('.book-delete-modal').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.classList.remove('is-open');
        });
    });
</script>

</body>
</html>