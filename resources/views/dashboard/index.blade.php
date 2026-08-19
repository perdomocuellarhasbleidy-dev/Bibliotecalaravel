@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 style="margin-bottom: 25px;">
    Dashboard del Bibliotecario
</h1>

<p style="margin-bottom: 25px;">
    Bienvenido,
    <strong>
        {{ session('usuario.nombre') }}
    </strong>
</p>

<div class="grid">

    <div class="stat">
        <h3>Libros</h3>
        <p>{{ $totalLibros }}</p>
    </div>

    <div class="stat">
        <h3>Autores</h3>
        <p>{{ $totalAutores }}</p>
    </div>

    <div class="stat">
        <h3>Usuarios</h3>
        <p>{{ $totalUsuarios }}</p>
    </div>

    <div class="stat">
        <h3>Préstamos activos</h3>
        <p>{{ $prestamosActivos }}</p>
    </div>

    <div class="stat">
        <h3>Devoluciones</h3>
        <p>{{ $devoluciones }}</p>
    </div>

    <div class="stat">
        <h3>Multas</h3>
        <p>{{ $multas }}</p>
    </div>

</div>

<br>

<div class="card">

    <h2>Administración</h2>

    <br>

    <div class="actions">

        <a href="{{ route('libros.index') }}"
           class="btn">
            📚 Libros
        </a>

        <a href="{{ route('usuarios.index') }}"
           class="btn">
            👥 Usuarios
        </a>

        <a href="{{ route('prestamos.index') }}"
           class="btn">
            📖 Préstamos
        </a>

        <a href="{{ route('devoluciones.index') }}"
           class="btn">
            🔄 Devoluciones
        </a>

        <a href="{{ route('multas.index') }}"
           class="btn">
            💰 Multas
        </a>

    </div>

</div>

@endsection