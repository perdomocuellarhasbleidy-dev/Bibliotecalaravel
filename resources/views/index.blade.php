<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Humberto Montealegre Sanchez</title>
    <link rel="icon" href="{{ asset('images/logo-libro.png') }}" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap');

        :root {
            --primary-color: #5c3c24; /* Marrón oscuro / bronce */
            --secondary-color: #f2eadf; /* Beige claro */
            --text-color: #333333;
            --white: #ffffff;
            --accent: #b08169;
            --footer-bg: #523a28;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--white);
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background-color: var(--white);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--white);
            font-size: 18px;
        }

        .logo-text-group {
            display: flex;
            flex-direction: column;
        }

        .logo-text {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-color);
            line-height: 1.1;
        }

        .logo-subtext {
            font-size: 0.7rem;
            font-family: var(--font-body);
            color: #888;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        /* Hero Section */
        .hero {
            height: 90vh; /* Ligeramente más pequeño */
            /* Fondo con imagen local de la biblioteca y overlay oscuro */
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 100%), url('{{ asset("images/biblioteca.jpg") }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            padding: 0 5%;
            margin-top: 0; 
        }

        .hero-content {
            max-width: 750px;
            color: var(--white);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-content h1 {
            font-family: var(--font-heading);
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero-content p {
            font-size: 1.05rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 550px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .btn {
            display: inline-block;
            padding: 0.7rem 2.5rem;
            border: 2px solid var(--white);
            background-color: transparent;
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn:hover {
            background-color: var(--white);
            color: var(--primary-color);
        }

        /* About Section */
        .about {
            padding: 4rem 5%;
            text-align: center;
            background-color: var(--white);
        }

        .about-subtitle {
            color: var(--accent);
            font-style: italic;
            font-family: var(--font-heading);
            margin-bottom: 0.3rem;
            font-size: 1rem;
        }

        .about-title {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .about-text {
            color: #666;
            max-width: 650px;
            margin: 0 auto 3rem;
            font-size: 1rem;
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .card {
            background-color: var(--secondary-color);
            padding: 2.5rem;
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(92, 60, 36, 0.1);
        }

        .card-icon {
            width: 45px;
            height: 45px;
            background-color: #8f5c44; /* Color icono */
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--white);
            font-size: 20px;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-family: var(--font-heading);
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .card-desc {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg);
            color: rgba(255,255,255,0.85);
            padding: 4rem 5% 1.5rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-col h3 {
            font-family: var(--font-heading);
            color: var(--white);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .footer-col p {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 0.8rem;
        }

        .footer-col ul a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }

        .footer-col ul a:hover {
            color: var(--white);
        }

        .footer-col ul li i {
            width: 18px;
            text-align: center;
            margin-right: 10px;
            color: var(--accent);
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1.2rem;
        }

        .social-icons a {
            width: 35px;
            height: 35px;
            background-color: rgba(255,255,255,0.08);
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--white);
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
        }

        /* Floating Chat Button */
        .chat-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
            background-color: #6d4b35; /* Slightly lighter than footer */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--white);
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            cursor: pointer;
            z-index: 1000;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .chat-btn:hover {
            transform: scale(1.05);
            background-color: #7f583e;
        }

        /* Chat Window */
        .chat-window {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 350px;
            background-color: #f6f4ee;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            display: none; /* Hidden by default */
            flex-direction: column;
            overflow: hidden;
            z-index: 1001;
            transform-origin: bottom right;
            animation: scaleIn 0.3s ease;
        }

        .chat-window.active {
            display: flex;
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

        .chat-header {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 1.2rem;
            position: relative;
        }

        .chat-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
            font-family: var(--font-heading);
        }

        .chat-subtitle {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .chat-close {
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            font-size: 1.2rem;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .chat-close:hover {
            opacity: 1;
        }

        .chat-body {
            padding: 1.2rem;
            height: 300px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .chat-message {
            background-color: var(--white);
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid #e2dcd2;
            font-size: 0.9rem;
            color: var(--text-color);
            line-height: 1.5;
            align-self: flex-start;
            max-width: 90%;
        }

        .chat-options {
            padding: 1rem 1.2rem;
            background-color: var(--white);
            border-top: 1px solid #e2dcd2;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .chat-option-btn {
            background-color: #ebe6df;
            border: none;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            text-align: left;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-color);
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .chat-option-btn:hover {
            background-color: #dfd7cc;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 3rem;
            }
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .nav-links {
                display: none;
            }
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .chat-btn {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="logo-container">
            <div class="logo-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="logo-text-group">
                <span class="logo-text">Biblioteca</span>
                <span class="logo-subtext">HMS</span>
            </div>
        </div>
        <ul class="nav-links">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </nav>

    <!-- Hero -->
    <section id="inicio" class="hero">
        <div class="hero-content">
            <h1>Biblioteca Humberto Montealegre Sanchez</h1>
            <p>Administra libros, beneficiarios, préstamos, reservas y devoluciones desde una sola plataforma.</p>
            <a href="{{ route('login') }}" class="btn">Ingresar</a>
        </div>
    </section>

    <!-- Nosotros -->
    <section id="nosotros" class="about">
        <div class="about-subtitle">Nosotros</div>
        <h2 class="about-title">Biblioteca con organización y estilo</h2>
        <p class="about-text">Creamos una experiencia para facilitar el acceso al conocimiento y mejorar la administración de todos los procesos bibliotecarios.</p>
        
        <div class="cards-container">
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="card-title">Nuestra Misión</h3>
                <p class="card-desc">Facilitar la gestión bibliotecaria mediante una plataforma tecnológica intuitiva, segura y eficiente para toda la comunidad.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 class="card-title">Nuestra Visión</h3>
                <p class="card-desc">Ser una biblioteca renovadora, reconocida por integrar tecnología, organización y servicio de calidad para impulsar la lectura.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contacto">
        <div class="footer-content">
            <div class="footer-col">
                <h3>Biblioteca Humberto Montealegre Sanchez</h3>
                <p>Tecnología, organización y conocimiento reunidos para una mejor gestión bibliotecaria.</p>
            </div>
            <div class="footer-col">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contacto</h3>
                <ul>
                    <li><i class="fa-solid fa-envelope"></i> bibliotecaHumbertoM@gmail.com</li>
                    <li><i class="fa-solid fa-phone"></i> +57 3124225678</li>
                </ul>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 Sistema de Biblioteca. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Chat Button -->
    <div class="chat-btn" id="openChatBtn">
        <i class="fa-regular fa-comments"></i>
    </div>

    <!-- Chat Window -->
    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <div class="chat-title">Asistente IA Biblioteca</div>
            <div class="chat-subtitle">Powered by Ollama · Biblioteca Humberto Montealegre</div>
            <div class="chat-close" id="closeChatBtn"><i class="fa-solid fa-xmark"></i></div>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="chat-message">
                👋 Hola, soy el asistente virtual de la Biblioteca Humberto Montealegre Sanchez. ¿En qué puedo ayudarte hoy?
            </div>
        </div>
        <div class="chat-options" id="chatOptions">
            <button class="chat-option-btn" onclick="sendOllamaMessage('¿Cómo ingreso al sistema?')">¿Cómo ingreso al sistema?</button>
            <button class="chat-option-btn" onclick="sendOllamaMessage('¿Qué puedo hacer en la biblioteca?')">¿Qué puedo hacer en la biblioteca?</button>
            <button class="chat-option-btn" onclick="sendOllamaMessage('¿Cómo consulto libros?')">¿Cómo consulto libros?</button>
            <button class="chat-option-btn" onclick="sendOllamaMessage('¿Qué hago si tengo una multa?')">¿Qué hago si tengo una multa?</button>
        </div>
        <div style="display: flex; gap: 8px; padding: 10px 12px; border-top: 1px solid #e5ddd3; background: #fff;">
            <input
                type="text"
                id="chatInput"
                placeholder="Escribe tu pregunta..."
                style="flex: 1; height: 38px; padding: 0 12px; border: 1px solid #c9b89e; border-radius: 20px; font-size: 13px; outline: none; font-family: inherit;"
                onkeydown="if(event.key==='Enter') enviarChat()"
            >
            <button
                onclick="enviarChat()"
                style="height: 38px; padding: 0 14px; border: none; border-radius: 20px; background: #5c2e0e; color: #fff; font-weight: 700; font-size: 13px; cursor: pointer;"
            >Enviar</button>
        </div>
    </div>

    <script>
        const chatWindow = document.getElementById('chatWindow');
        const openChatBtn = document.getElementById('openChatBtn');
        const closeChatBtn = document.getElementById('closeChatBtn');
        const chatBody = document.getElementById('chatBody');
        const chatOptions = document.getElementById('chatOptions');

        openChatBtn.addEventListener('click', () => {
            chatWindow.classList.add('active');
            openChatBtn.style.display = 'none';
        });

        closeChatBtn.addEventListener('click', () => {
            chatWindow.classList.remove('active');
            openChatBtn.style.display = 'flex';
        });

        function appendMessage(text, isUser = false) {
            const msg = document.createElement('div');
            msg.className = 'chat-message';
            if (isUser) {
                msg.style.alignSelf = 'flex-end';
                msg.style.backgroundColor = '#5c2e0e';
                msg.style.color = 'white';
                msg.style.border = 'none';
            }
            msg.innerHTML = text;
            chatBody.appendChild(msg);
            chatBody.scrollTop = chatBody.scrollHeight;
            return msg;
        }

        function enviarChat() {
            const input = document.getElementById('chatInput');
            const texto = input.value.trim();
            if (!texto) return;
            input.value = '';
            sendOllamaMessage(texto);
        }

        function sendOllamaMessage(mensaje) {
            // Hide quick options after first interaction
            if (chatOptions) chatOptions.style.display = 'none';

            // Show user message
            appendMessage(mensaje, true);

            // Show typing indicator
            const typing = appendMessage('⏳ Pensando...');

            fetch('{{ route("chat.responder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ mensaje: mensaje }),
            })
            .then(res => res.json())
            .then(data => {
                typing.remove();
                appendMessage(data.respuesta || 'Sin respuesta.');
            })
            .catch(() => {
                typing.remove();
                appendMessage('❌ No se pudo conectar con el asistente. Verifica que Ollama esté activo.');
            });
        }

        // Legacy function for backward compat
        function sendChatReply(question, answer) {
            sendOllamaMessage(question);
        }
    </script>

</body>
</html>
