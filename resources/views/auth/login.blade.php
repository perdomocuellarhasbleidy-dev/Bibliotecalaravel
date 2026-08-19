@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')

<div class="auth-viewport">
    <div class="auth-card">
        
        <!-- Sección Izquierda (Banner Café) -->
        <div class="auth-banner">
            <div class="auth-banner-content">
                <h1 class="auth-banner-title">
                    Biblioteca<br>
                    Humberto<br>
                    Montealegre<br>
                    Sanchez
                </h1>
                
                <p class="auth-banner-subtitle">
                    En esta biblioteca, cada libro es una puerta y cada página un viaje sin límites.
                </p>
            </div>

            <div class="auth-banner-badge">
                <div class="auth-badge-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <span class="auth-badge-text">
                    Acceso seguro con cifrado de datos institucionales.
                </span>
            </div>
        </div>

        <!-- Sección Derecha (Formulario de Login) -->
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h2 class="auth-form-title">Bienvenido</h2>
                <p class="auth-form-subtitle">Ingresa tus credenciales para continuar.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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

            <form action="{{ route('login.store') }}" method="POST" class="auth-form">
                @csrf

                <div class="auth-form-group">
                    <label for="documento">DOCUMENTO</label>
                    <input
                        type="text"
                        id="documento"
                        name="documento"
                        value="{{ old('documento') }}"
                        placeholder="1080182566"
                        required
                        autofocus
                    >
                </div>

                <div class="auth-form-group">
                    <label for="password">CONTRASEÑA</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••"
                        required
                    >
                </div>

                <button type="submit" class="auth-btn-submit">
                    Iniciar Sesión
                </button>
            </form>

            <div class="auth-footer">
                ¿No tienes cuenta? <a href="{{ route('registro') }}" class="auth-link">Regístrate aquí</a>
            </div>
        </div>

    </div>
</div>

@if(session('account_created') || session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('account_created'))
            Swal.fire({
                icon: 'success',
                title: '¡Cuenta creada!',
                text: 'Tu cuenta fue creada exitosamente. Inicia sesión.',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#8a481eff'
            });
            @endif

            @if(session('error'))
                @if(session('error') == 'El documento no está registrado.')
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario no encontrado',
                    text: 'El documento ingresado no está registrado',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#5c3a21'
                });
                @else
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session("error") }}',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#5c3a21'
                });
                @endif
            @endif
        });
    </script>
@endif

@endsection