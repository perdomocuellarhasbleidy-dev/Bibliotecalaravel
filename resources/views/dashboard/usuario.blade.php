@extends('layouts.app')

@section('title', 'Mi biblioteca')

@section('content')

<h1>
    Bienvenido,
    {{ session('usuario.nombre') }}
</h1>

<br>

<div class="grid">

    <div class="stat">

        <h3>Mis préstamos</h3>

        <p>
            {{ $prestamos->count() }}
        </p>

    </div>

    <div class="stat">

        <h3>Mis multas</h3>

        <p>
            {{ $multas }}
        </p>

    </div>

</div>

<br>

<div class="card">

    <h2>Mis préstamos</h2>

    <br>

    <table>

        <thead>

        <tr>
            <th>Libro</th>
            <th>Autor</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>

        </thead>

        <tbody>

        @forelse($prestamos as $prestamo)

            <tr>

                <td>
                    {{ $prestamo->libro->titulo ?? 'Sin libro' }}
                </td>

                <td>
                    {{ $prestamo->libro->autor->nombre ?? 'Sin autor' }}
                </td>

                <td>
                    {{ $prestamo->fecha_prestamo }}
                </td>

                <td>
                    {{ $prestamo->estado }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4">
                    No tienes préstamos registrados.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection