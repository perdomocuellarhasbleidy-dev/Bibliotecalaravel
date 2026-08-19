<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Biblioteca')
    </title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f0ede9;
            color: #333;
            min-height: 100vh;
        }

        nav {
            background: #1f2937;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav .logo {
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        nav .links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        nav a:hover {
            color: #60a5fa;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(200px, 1fr)
            );
            gap: 20px;
        }

        .stat {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }

        .stat h3 {
            color: #6b7280;
            margin-bottom: 10px;
        }

        .stat p {
            font-size: 30px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #1f2937;
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 9px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            background: #2563eb;
            color: white;
            font-family: inherit;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-success {
            background: #16a34a;
        }

        .btn-secondary {
            background: #6b7280;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
            margin-bottom: 15px;
            font-family: inherit;
        }

        label {
            font-weight: bold;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        form {
            display: inline;
        }

        /* ------------------------------------
         * LOGIN AUTH SPLIT DESIGN
         * ------------------------------------ */
        .auth-viewport {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            background: #f0ede9;
        }

        .auth-card {
            width: 100%;
            max-width: 920px;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12), 0 10px 25px -5px rgba(0, 0, 0, 0.06);
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            min-height: 540px;
        }

        /* Left Banner Panel */
        .auth-banner {
            background-color: #5c381e;
            padding: 50px 42px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #ffffff;
            position: relative;
            background-image: radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        }

        .auth-banner-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 28px;
            font-weight: 700;
            line-height: 1.18;
            letter-spacing: -0.3px;
            margin-bottom: 24px;
            color: #ffffff;
        }

        .auth-banner-subtitle {
            font-size: 14px;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 400;
            max-width: 340px;
        }

        .auth-banner-badge {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 40px;
        }

        .auth-badge-icon {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.22);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff;
        }

        .auth-badge-text {
            font-size: 13.5px;
            font-style: italic;
            color: rgba(255, 255, 255, 0.92);
            line-height: 1.4;
            font-weight: 400;
        }

        /* Right Form Panel */
        .auth-form-container {
            padding: 50px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .auth-form-header {
            margin-bottom: 28px;
        }

        .auth-form-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 34px;
            font-weight: 700;
            color: #18181b;
            margin-bottom: 6px;
        }

        .auth-form-subtitle {
            font-size: 14.5px;
            color: #71717a;
            font-weight: 400;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
        }

        .auth-form-group {
            margin-bottom: 20px;
        }

        .auth-form-group label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #52525b;
            margin-bottom: 8px;
        }

        .auth-form-group input {
            width: 100%;
            height: 46px;
            padding: 0 16px;
            border: 1px solid #d4d4d8;
            border-radius: 8px;
            font-size: 15px;
            color: #18181b;
            background-color: #ffffff;
            margin-top: 0;
            margin-bottom: 0;
            transition: all 0.2s ease;
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
        }

        .auth-form-group input:focus {
            outline: none;
            border-color: #5c381e;
            box-shadow: 0 0 0 3px rgba(92, 56, 30, 0.15);
        }

        .auth-btn-submit {
            width: 100%;
            height: 48px;
            background: #3b2213;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s ease, transform 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-family: inherit;
        }

        .auth-btn-submit:hover {
            background: #28160b;
        }

        .auth-btn-submit:active {
            transform: scale(0.99);
        }

        .auth-footer {
            margin-top: 26px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }

        .auth-link {
            color: #5c381e;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        /* ------------------------------------
         * REGISTRATION CARD STYLING (MATCHING SCREENSHOT)
         * ------------------------------------ */
        .register-viewport {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: #f0ede9;
        }

        .register-card {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border-radius: 20px;
            padding: 42px 38px;
            box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.08), 0 8px 20px -6px rgba(0, 0, 0, 0.04);
        }

        .register-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 30px;
            font-weight: 700;
            color: #54341c;
            text-align: center;
            margin-bottom: 4px;
        }

        .register-subtitle {
            font-size: 14px;
            color: #5a4b3f;
            text-align: center;
            margin-bottom: 26px;
        }

        .register-form-group {
            margin-bottom: 16px;
        }

        .register-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #54341c;
            margin-bottom: 6px;
        }

        .register-form-group input[type="text"],
        .register-form-group input[type="email"],
        .register-form-group input[type="password"] {
            width: 100%;
            height: 46px;
            padding: 0 16px;
            border: 1px solid #d4d4d8;
            border-radius: 8px;
            font-size: 14px;
            color: #18181b;
            background-color: #ffffff;
            margin-top: 0;
            margin-bottom: 0;
            transition: all 0.2s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .register-form-group input::placeholder {
            color: #9ca3af;
        }

        .register-form-group input:focus {
            outline: none;
            border-color: #54341c;
            box-shadow: 0 0 0 3px rgba(84, 52, 28, 0.12);
        }

        .register-checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            margin-bottom: 22px;
        }

        .register-checkbox-group input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: #54341c;
            cursor: pointer;
            margin: 0;
        }

        .register-checkbox-group label {
            font-size: 14px;
            font-weight: 500;
            color: #54341c;
            cursor: pointer;
            margin: 0;
        }

        .register-btn-submit {
            width: 100%;
            height: 48px;
            background: #54341c;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: inherit;
        }

        .register-btn-submit:hover {
            background: #3e2513;
        }

        .register-btn-submit:active {
            transform: scale(0.99);
        }

        .register-footer {
            margin-top: 22px;
            text-align: center;
            font-size: 14px;
            color: #5a4b3f;
        }

        .register-link {
            color: #54341c;
            font-weight: 700;
            text-decoration: underline;
        }

        .register-link:hover {
            color: #382110;
        }

        @media (max-width: 768px) {
            .auth-card {
                grid-template-columns: 1fr;
                max-width: 480px;
            }
            .auth-banner {
                padding: 35px 28px;
            }
            .auth-banner-title {
                font-size: 28px;
            }
            .auth-form-container {
                padding: 35px 28px;
            }
            .register-card {
                padding: 30px 24px;
            }
        }
    </style>
</head>

<body>

@if(session('usuario'))


<div class="container">

    @if(!request()->routeIs('login') && !request()->routeIs('registro'))
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    @yield('content')

</div>

@else

    @yield('content')

@endif

</body>
</html>