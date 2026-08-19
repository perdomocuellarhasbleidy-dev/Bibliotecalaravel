<div class="card">

    <label>
        Autor
    </label>

    <select
        name="idautor"
        required
    >

        <option value="">
            Selecciona un autor
        </option>

        @foreach($autores as $autor)

            <option
                value="{{ $autor->idautor }}"
                @selected(
                    old(
                        'idautor',
                        $libro->idautor ?? ''
                    ) == $autor->idautor
                )
            >
                {{ $autor->nombre }}
            </option>

        @endforeach

    </select>


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