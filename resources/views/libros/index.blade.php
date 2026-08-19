@extends('layouts.app')

@section('title', 'Libros')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center;">

    <h1>📚 Libros</h1>

    <a href="{{ route('libros.create') }}"
       class="btn btn-success">
        + Registrar libro
    </a>

</div>

<br>

<div class="card">

    <form method="GET"
          action="{{ route('libros.index') }}">

        <label>
            Buscar
        </label>

        <input
            type="text"
            name="buscar"
            value="{{ $buscar }}"
            placeholder="Título, categoría o autor"
        >

        <label>
            Categoría
        </label>

        <select name="categoria">

            <option value="">
                Todas
            </option>

            @foreach($categorias as $cat)

                <option
                    value="{{ $cat }}"
                    @selected($categoria === $cat)
                >
                    {{ $cat }}
                </option>

            @endforeach

        </select>

        <button
            type="submit"
            class="btn">
            Buscar
        </button>

        <a
            href="{{ route('libros.index') }}"
            class="btn btn-secondary">
            Limpiar
        </a>

    </form>

</div>

<div class="card">

<table>

    <thead>

    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoría</th>
        <th>Año</th>
        <th>Acciones</th>
    </tr>

    </thead>

    <tbody>

    @forelse($libros as $libro)

        <tr>

            <td>
                {{ $libro->idlibro }}
            </td>

            <td>
                {{ $libro->titulo }}
            </td>

            <td>
                {{ $libro->autor->nombre ?? 'Sin autor' }}
            </td>

            <td>
                {{ $libro->categoria }}
            </td>

            <td>
                {{ $libro->año_publicacion }}
            </td>

            <td>

                <div class="actions">

                    <a
                        href="{{ route('libros.edit', $libro) }}"
                        class="btn">
                        Editar
                    </a>

                    <form
                        action="{{ route('libros.destroy', $libro) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('¿Eliminar este libro?')">
                            Eliminar
                        </button>

                    </form>

                </div>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6">
                No hay libros registrados.
            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</div>

@endsection