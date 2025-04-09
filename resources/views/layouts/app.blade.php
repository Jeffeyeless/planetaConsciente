<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Planeta Consciente')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- CSS específicos para cada página -->
    @if(Request::is('/'))
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    @endif

    @if(Request::is('home'))
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endif
    
    @if(Request::is('login') || Request::is('register'))
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endif
    
    @if(Request::is('calculadora*'))
    <link rel="stylesheet" href="{{ asset('css/calculadora.css') }}">
    @endif
    
    @if(Request::is('noticia*'))
    <link rel="stylesheet" href="{{ asset('css/noticia.css') }}">
    @endif
    
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <button class="nav-button" onclick="location.href='/calculadora'">
                    <i class="fas fa-calculator"></i> CALCULADORA
                </button>
                <button class="nav-button" onclick="location.href='/medio_ambiente'">
                    <i class="fas fa-leaf"></i> MEDIO AMBIENTE
                </button>
                <button class="nav-button" onclick="location.href='/eventos'">
                    <i class="fas fa-calendar-alt"></i> EVENTOS
                </button>
                <button class="nav-button" onclick="location.href='/noticia'">
                    <i class="fas fa-newspaper"></i> NOTICIAS
                </button>
                
                <!-- Authentication Links -->
                @guest
                    <button class="nav-button" onclick="location.href='{{ route('login') }}'">
                        <i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN
                    </button>
                    @if (Route::has('register'))
                        <button class="nav-button" onclick="location.href='{{ route('register') }}'">
                            <i class="fas fa-user-plus"></i> REGISTRARSE
                        </button>
                    @endif
                @else
                    <div class="user-dropdown">
                        <button class="dropdown-toggle nav-button" type="button" aria-expanded="false">
                            <!-- Mostrar inicial del usuario -->
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </button>

                        <div class="dropdown-menu">                          
                            <!-- Botón de cerrar sesión -->
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </a>

                            <!-- Formulario para cerrar sesión -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
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
                    <li><a href="/inicio" class="footer-link"><i class="fas fa-chevron-right"></i> Inicio</a></li>
                    <li><a href="/medio_ambiente" class="footer-link"><i class="fas fa-chevron-right"></i> Medio Ambiente</a></li>
                    <li><a href="/retos-eventos" class="footer-link"><i class="fas fa-chevron-right"></i> Próximos Eventos</a></li>
                    <li><a href="/noticia" class="footer-link"><i class="fas fa-chevron-right"></i> Noticias</a></li>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
                
                const size = Math.random() * 10 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.bottom = `-${size}px`;
                
                const duration = Math.random() * 20 + 10;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                particlesContainer.appendChild(particle);
            }
        });

        // User dropdown toggle
        document.querySelector('.dropdown-toggle')?.addEventListener('click', function() {
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown-toggle')) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(dropdown => {
                    if (dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>