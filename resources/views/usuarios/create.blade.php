@extends('layouts.app')

@section('title', 'Nuevo beneficiario')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar beneficiario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #f5efe6; color: #684321; font-family: "Segoe UI", Arial, sans-serif; }
        .form-header { height: 98px; padding: 27px 37px; border-bottom: 1px solid #c8c0b6; }
        .form-header h1 { margin: 0; color: #8a633d; font-size: 30px; font-weight: 400; }
        .form-header strong { color: #3f2919; font-weight: 700; }
        .form-content { width: min(870px, calc(100% - 74px)); margin: 36px auto 0; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; column-gap: 60px; row-gap: 26px; }
        .field { min-width: 0; }
        .field-full { grid-column: 1 / -1; }
        label { display: block; margin-bottom: 10px; color: #704723; font-size: 14px; font-weight: 700; }
        input { width: 100%; height: 52px; padding: 0 14px; border: 1px solid #cbd2da; border-radius: 2px; background: #fff; color: #333; font: inherit; outline: none; }
        input:focus { border-color: #81522d; box-shadow: 0 0 0 2px rgba(129, 82, 45, .12); }
        .password-field { position: relative; }
        .password-field input { padding-right: 48px; }
        .toggle-password { position: absolute; top: 50%; right: 14px; width: 24px; height: 24px; padding: 0; transform: translateY(-50%); border: 0; background: transparent; color: #566170; cursor: pointer; font-size: 18px; }
        .alert { margin-bottom: 22px; padding: 12px 16px; border: 1px solid #e2b8b8; border-radius: 2px; background: #fff0f0; color: #8c2929; }
        .alert ul { margin: 0; padding-left: 20px; }
        .form-actions { display: flex; justify-content: flex-end; gap: 25px; margin-top: 99px; }
        .button { height: 40px; padding: 0 26px; border: 0; border-radius: 2px; font: 700 14px "Segoe UI", Arial, sans-serif; cursor: pointer; text-decoration: none; }
        .button-cancel { min-width: 110px; background: #fff; color: #7b5837; }
        .button-save { min-width: 226px; background: #653a1e; color: #fff; }
        @media (max-width: 650px) {
            .form-header { padding-left: 22px; }
            .form-header h1 { font-size: 25px; }
            .form-content { width: calc(100% - 44px); margin-top: 28px; }
            .form-grid { grid-template-columns: 1fr; row-gap: 20px; }
            .field-full { grid-column: auto; }
            .form-actions { margin-top: 55px; gap: 12px; }
            .button { padding: 0 15px; }
        }
    </style>
</head>
<body>
    <header class="form-header">
        <h1>Agregar <strong>Beneficiario</strong></h1>
    </header>
    <main class="form-content">
        @if($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="field field-full">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required autofocus>
                </div>
                <div class="field">
                    <label for="documento">Documento</label>
                    <input type="text" id="documento" name="documento" value="{{ old('documento') }}" required>
                </div>
                <div class="field">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}">
                </div>
                <div class="field field-full">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
                </div>
                <div class="field field-full">
                    <label for="password">Contraseña</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password" aria-label="Mostrar contraseña" aria-pressed="false"><i class="fa-solid fa-eye"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('usuarios.index') }}" class="button button-cancel">Cancelar</a>
                <button type="submit" class="button button-save">Guardar Beneficiario</button>
            </div>
        </form>
    </main>
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.querySelector('.toggle-password');
        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            togglePassword.setAttribute('aria-label', isPassword ? 'Ocultar contraseña' : 'Mostrar contraseña');
            togglePassword.setAttribute('aria-pressed', String(isPassword));
            togglePassword.innerHTML = `<i class="fa-solid fa-eye${isPassword ? '-slash' : ''}"></i>`;
        });
    </script>
</body>
</html>