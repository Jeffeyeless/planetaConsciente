<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Planeta Consciente')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --primary: #1a3a2f;
        --primary-light: #2d5e4a;
        --secondary: #e8f4ea;
        --accent: #4caf7d;
        --accent-dark: #3a8d66;
        --text: #333333;
        --text-light: #6d7c85;
        --white: #ffffff;
        --transition: all 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 20px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--secondary);
        color: var(--text);
        line-height: 1.7;
        overflow-x: hidden;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Preloader */
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--white);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    .preloader.fade-out {
        opacity: 0;
    }

    .loader {
        width: 60px;
        height: 60px;
        border: 5px solid var(--secondary);
        border-top: 5px solid var(--accent);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Navbar */
    .navbar {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 0;
        box-shadow: var(--shadow-lg);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        transition: all 0.5s ease;
    }

    .navbar.scrolled {
        padding: 5px 0;
        box-shadow: var(--shadow-md);
    }

    .navbar-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 80px;
        transition: height 0.5s ease;
    }

    .navbar.scrolled .navbar-container {
        height: 70px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
    }

    .logo img {
        height: 50px;
        width: auto;
        transition: var(--transition);
    }

    .logo:hover img {
        transform: scale(1.1);
    }

    .logo-text {
        font-family: 'Playfair Display', serif;
        color: var(--white);
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .nav-buttons {
        display: flex;
        gap: 10px;
    }

    .nav-button {
        position: relative;
        padding: 12px 20px;
        background: transparent;
        color: var(--white);
        border: none;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
        border-radius: 4px;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-button::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--accent);
        transition: var(--transition);
    }

    .nav-button:hover {
        color: var(--accent);
    }

    .nav-button:hover::before {
        width: 100%;
    }

    .nav-button i {
        font-size: 0.9rem;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        position: relative;
        margin-top: 80px;
        min-height: calc(100vh - 80px - 250px);
        padding-bottom: 40px;
    }

    .navbar.scrolled ~ .main-content {
        margin-top: 70px;
    }

    /* Centered containers */
    .auth-container, .calculator-container {
        max-width: 600px;
        margin: 60px auto 40px;
        padding: 40px;
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        animation: fadeIn 0.8s ease-out;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 30px;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .content {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        z-index: 1;
    }

    .content:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-5px);
    }

    /* Footer */
    footer {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: var(--white);
        padding: 60px 0 30px;
        position: relative;
        margin-top: auto;
        width: 100%;
    }

    footer::before {
        content: '';
        position: absolute;
        top: -50px;
        left: 0;
        width: 100%;
        height: 50px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23e8f4ea' fill-opacity='1' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat;
        background-size: cover;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 30px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
    }

    .footer-col {
        display: flex;
        flex-direction: column;
    }

    .footer-logo {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .footer-logo img {
        height: 50px;
        width: auto;
        filter: brightness(0) invert(1);
    }

    .footer-logo p {
        font-size: 0.95rem;
        opacity: 0.9;
        line-height: 1.6;
    }

    .footer-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--accent);
    }

    .footer-links {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .footer-link {
        color: var(--white);
        text-decoration: none;
        opacity: 0.9;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .footer-link:hover {
        opacity: 1;
        color: var(--accent);
        transform: translateX(5px);
    }

    .footer-link i {
        font-size: 0.9rem;
        width: 20px;
        text-align: center;
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        transition: var(--transition);
        font-size: 1.1rem;
    }

    .social-link:hover {
        background: var(--accent);
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .copyright {
        text-align: center;
        padding-top: 30px;
        margin-top: 50px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* WhatsApp button */
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: #25D366;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.8rem;
        box-shadow: 0 5px 20px rgba(37, 211, 102, 0.3);
        z-index: 100;
        transition: var(--transition);
        animation: pulse 2s infinite;
    }

    .whatsapp-float:hover {
        transform: scale(1.1) translateY(-5px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }

    /* Particles effect */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        background: rgba(76, 175, 125, 0.3);
        border-radius: 50%;
        animation: float linear infinite;
    }

    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); opacity: 1; }
        100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
    }

    /* Responsive design */
    @media (max-width: 992px) {
        .navbar-container {
            height: auto;
            padding: 15px 20px;
            flex-direction: column;
            gap: 15px;
        }

        .nav-buttons {
            flex-wrap: wrap;
            justify-content: center;
        }

        .navbar.scrolled .navbar-container {
            height: auto;
        }

        .main-content {
            margin-top: 140px;
        }
        
        .navbar.scrolled ~ .main-content {
            margin-top: 130px;
        }
    }

    @media (max-width: 768px) {
        .container, .auth-container, .calculator-container {
            margin: 30px auto;
            padding: 0 20px;
        }

        .auth-container, .calculator-container {
            padding: 30px 20px;
            margin: 40px auto 30px;
            width: 90%;
        }

        .footer-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-col {
            align-items: center;
            text-align: center;
        }

        .footer-title::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .footer-links {
            align-items: center;
        }

        .whatsapp-float {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            bottom: 20px;
            right: 20px;
        }
    }

    @media (max-width: 576px) {
        .auth-container, .calculator-container {
            width: 95%;
            padding: 25px 15px;
            margin: 30px auto;
        }
        
        .main-content {
            margin-top: 160px;
        }
        
        .navbar.scrolled ~ .main-content {
            margin-top: 150px;
        }
    }

    /* Auth forms */
    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        
    }

    .auth-form .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .auth-form label {
        font-weight: 500;
        color: var(--primary);
    }

    .auth-form input {
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: var(--transition);
    }

    .auth-form input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(76, 175, 125, 0.2);
    }

    .auth-form button {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        border: none;
        padding: 14px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 10px;
    }

    .auth-form button:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .auth-links {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }

    .auth-links a {
        color: var(--accent);
        text-decoration: none;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .auth-links a:hover {
        text-decoration: underline;
    }
    .calculator {
    padding: 40px;
    text-align: center;
    background: linear-gradient(135deg,rgb(255, 255, 255) 0%, #111 100%); /* Mantén el fondo oscuro para resaltar los elementos */
    border-radius: 20px;
    box-shadow: 0 10px 30px rgb(255, 255, 255);
    max-width: 800px;
    margin: 80px auto 20px; /* Mayor separación del navbar */
}

/* ✨ Estilo del título */
.calculator h2 {
    color: #34d399; /* Verde brillante */
    font-size: 2.5rem;
    font-weight: 700;
    position: relative;
    display: inline-block;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 30px; /* Espacio debajo del título */
}

.calculator h2::after {
    content: '';
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: #10b981; /* Verde más oscuro */
    border-radius: 2px;
}

/* 📝 Estilo del texto de la pregunta */
.calculator .question {
    color: #10b981 !important; /* Verde para la pregunta */
    font-size: 20rem; /* Tamaño más grande */
    font-weight: 600;
    margin-bottom: 30px; /* Más espacio debajo de la pregunta */
    text-shadow: 2px 2px 8px rgba(255, 255, 255, 0.3);
}

/* 📜 Estilo del formulario */
.calculator input,
.calculator select {
    width: 100%;
    padding: 15px;
    font-size: 1.2rem;
    border-radius: 10px;
    border: 2px solid #333;
    background: #fff; /* Fondo blanco para los campos de entrada */
    color: #333 !important; /* Color del texto negro */
    outline: none;
    transition: all 0.3s ease-in-out;
    margin-bottom: 30px; /* Espacio debajo de los campos de entrada */
}

.calculator input:focus,
.calculator select:focus {
    border-color: #34d399; /* Verde claro al hacer foco */
    box-shadow: 0 0 15px rgba(52, 211, 153, 0.5); /* Sombra verde */
}

/* 🔘 Botón con efectos dinámicos */
.calculator button {
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%); /* Gradiente verde */
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    padding: 15px 40px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(52, 211, 153, 0.5);
    margin-top: 30px; /* Espacio arriba del botón */
}

/* 🌟 Efecto de brillo al pasar el mouse */
.calculator button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: 0.5s;
}

.calculator button:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(52, 211, 153, 0.7); /* Sombra verde al pasar el mouse */
}

.calculator button:hover::before {
    left: 100%;
}

/* 📱 Diseño responsivo */
@media (max-width: 768px) {
    .calculator {
        padding: 30px;
        margin: 60px auto 20px; /* Ajuste para móviles */
    }

    .calculator h2 {
        color: #34d399; /* Verde para el título */
        font-size: 2rem;
        margin-bottom: 20px;
        text-align: center;
    }

    .calculator h4 {
        color: #34d399; /* Verde para el título */
        font-size: 2rem;
        margin-bottom: 20px;
        text-align: center;
    }

    .calculator .question {
        color: #10b981 !important; /* Cambiar el color de la pregunta a verde */
        font-size: 200rem;
        font-weight: 600;
        margin-bottom: 30px;
        text-shadow: 2px 2px 8px rgba(0, 255, 0, 0.3);
    }

    .calculator input,
    .calculator select {
        font-size: 1rem;
        margin-bottom: 25px; /* Menos espacio en móviles */
    }

    .calculator button {
        font-size: 1rem;
        padding: 12px 30px;
        margin-top: 20px; /* Menos espacio arriba del botón */
    }
}

</style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <!-- Efecto partículas -->
    <div class="particles" id="particles"></div>

    <!-- Navbar premium - FIXED POSITION -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="/" class="logo">
                <img src="{{ asset('images/1.jpg') }}" alt="Planeta Consciente">
                <span class="logo-text">PLANETA CONSCIENTE</span>
            </a>
            
            <div class="nav-buttons">
                <button class="nav-button" onclick="location.href='/'">
                    <i class="fas fa-home"></i> INICIO
                </button>
                <button class="nav-button" onclick="location.href='/herramientas'">
                    <i class="fas fa-tools"></i> HERRAMIENTAS
                </button>
                <button class="nav-button" onclick="location.href='/ambiente'">
                    <i class="fas fa-leaf"></i> MEDIO AMBIENTE
                </button>
                <button class="nav-button" onclick="location.href='/eventos'">
                    <i class="fas fa-calendar-alt"></i> EVENTOS
                </button>
                <button class="nav-button" onclick="location.href='/noticias'">
                    <i class="fas fa-newspaper"></i> NOTICIAS
                </button>
                <button class="nav-button" onclick="location.href='/formulario'">
                    <i class="fas fa-edit"></i> FORMULARIO
                </button>
                <button class="nav-button" onclick="location.href='/login'">
                    <i class="fas fa-user"></i> USUARIO
                </button>
                <button class="nav-button" onclick="location.href='/admin'">
                    <i class="fas fa-lock"></i> ADMIN
                </button>
                <button class="nav-button" onclick="location.href='/calculadora'">
                    <i class="fas fa-calculator"></i> CALCULADORA
                </button>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer premium -->
    <footer>
        <div class="footer-container">
            <div class="footer-col footer-logo">
                <img src="{{ asset('images/1.jpg') }}" alt="Planeta Consciente">
                <p>Comprometidos con la sostenibilidad ambiental y el futuro de nuestro planeta.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-col">
                <h3 class="footer-title">Enlaces rápidos</h3>
                <ul class="footer-links">
                    <li><a href="/" class="footer-link"><i class="fas fa-chevron-right"></i> Inicio</a></li>
                    <li><a href="/ambiente" class="footer-link"><i class="fas fa-chevron-right"></i> Medio Ambiente</a></li>
                    <li><a href="/eventos" class="footer-link"><i class="fas fa-chevron-right"></i> Próximos Eventos</a></li>
                    <li><a href="/noticias" class="footer-link"><i class="fas fa-chevron-right"></i> Noticias</a></li>
                    <li><a href="/calculadora" class="footer-link"><i class="fas fa-chevron-right"></i> Calculadora Ecológica</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h3 class="footer-title">Contacto</h3>
                <ul class="footer-links">
                    <li><a href="#" class="footer-link"><i class="fas fa-map-marker-alt"></i> SENA Calle 13 # 65-10, Bogotá</a></li>
                    <li><a href="tel:+021234567890" class="footer-link"><i class="fas fa-phone"></i> +02 1234567890</a></li>
                    <li><a href="mailto:Planetaconsciente@gmail.com" class="footer-link"><i class="fas fa-envelope"></i> Planetaconsciente@gmail.com</a></li>
                    <li><a href="#" class="footer-link"><i class="fas fa-clock"></i> Lunes-Viernes: 8AM - 6PM</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            &copy; 2025 Planeta Consciente. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Botón flotante WhatsApp -->
    <a href="https://wa.me/573144358851" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            setTimeout(() => {
                preloader.classList.add('fade-out');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 800);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Efecto de partículas
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Tamaño aleatorio entre 5px y 15px
                const size = Math.random() * 10 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Posición aleatoria
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.bottom = `-${size}px`;
                
                // Duración de animación aleatoria
                const duration = Math.random() * 20 + 10;
                particle.style.animationDuration = `${duration}s`;
                
                // Retraso aleatorio
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                particlesContainer.appendChild(particle);
            }
        });

        // Smooth scroll para enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>