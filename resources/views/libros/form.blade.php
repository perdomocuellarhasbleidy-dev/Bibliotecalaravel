<div class="card">

    <label>
        Autor
    </label>

    <input
        type="text"
        id="autor_nombre"
        name="autor_nombre"
        placeholder="Escribe el nombre del autor..."
        autocomplete="off"
        required
        value="{{ old('autor_nombre', $libro->autor->nombre ?? '') }}"
        style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #d4dbe5; border-radius: 10px;"
    >


    <label>
        Título
    </label>

    <input
        type="text"
        name="titulo"
        value="{{ old('titulo', $libro->titulo ?? '') }}"
        required
    >


    <label>
        Categoría
    </label>

    <input
        type="text"
        name="categoria"
        value="{{ old('categoria', $libro->categoria ?? '') }}"
        required
    >


    <label>
        Año de publicación
    </label>

    <input
        type="number"
        name="año_publicacion"
        value="{{ old('año_publicacion', $libro->año_publicacion ?? '') }}"
    >

    <label>
        Imagen de portada
    </label>

    <input
        type="file"
        name="imagen"
        accept="image/jpeg,image/png,image/webp"
    >

    @if(!empty($libro?->imagen))
        <img
            src="{{ asset('storage/' . $libro->imagen) }}"
            alt="Portada de {{ $libro->titulo }}"
            style="width: 84px; height: 118px; object-fit: cover; margin: 8px 0 15px; border-radius: 8px;"
        >
    @endif


    <br>

    <button
        type="submit"
        class="btn btn-success">
        {{ $boton }}
    </button>

    <a
        href="{{ route('libros.index') }}"
        class="btn btn-secondary">
        Cancelar
    </a>

</div>