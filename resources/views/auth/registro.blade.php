@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')

<div class="register-viewport">
    <div class="register-card">
        
        <h1 class="register-title">Crear cuenta</h1>
        <p class="register-subtitle">completa el formulario para registrarte</p>

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registro.store') }}" method="POST">
            @csrf

            <div class="register-form-group">
                <label for="nombre">Nombre completo</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    placeholder="Tu nombre"
                    required
                    autofocus
                >
            </div>

            <div class="register-form-group">
                <label for="documento">Documento</label>
                <input
                    type="text"
                    id="documento"
                    name="documento"
                    value="{{ old('documento') }}"
                    placeholder="Numero de documento"
                    required
                >
            </div>

            <div class="register-form-group">
                <label for="telefono">Telefono</label>
                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value="{{ old('telefono') }}"
                    placeholder="3000000000"
                >
            </div>

            <div class="register-form-group">
                <label for="correo">Correo electronico</label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old('correo') }}"
                    placeholder="correo@gmail.com"
                    required
                >
            </div>

            <div class="register-form-group">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimo 6 caracteres"
                    required
                >
            </div>

            <div class="register-form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repite tu contraseña"
                    required
                >
            </div>

            <div class="register-checkbox-group">
                <input
                    type="checkbox"
                    id="terminos"
                    name="terminos"
                    value="1"
                    required
                >
                <label for="terminos">Acepto terminos y condiciones</label>
            </div>

            <button type="submit" class="register-btn-submit">
                Registrarme
            </button>
        </form>

        <div class="register-footer">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="register-link">Iniciar Sesion</a>
        </div>

    </div>
</div>

@endsection