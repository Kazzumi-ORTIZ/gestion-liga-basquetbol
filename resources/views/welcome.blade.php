<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Liga de Básquetbol | Sistema de Gestión Deportiva</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header class="header">
    <div class="nav-container">
        <div class="logo">
            <img src="{{ asset('imagenes/logo_equipo') }}" alt="Logo Liga Basket" class="logo-img">
        </div>
        <button class="mobile-toggle" id="mobileToggle">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="nav-menu" id="navMenu">
            <li><a href="/" class="active">Inicio</a></li>
            <li><a href="{{ route('teams.index') }}">Equipos</a></li>
            <li><a href="{{ route('teams.index') }}">Jugadores</a></li>
            <li><a href="{{ route('games.index') }}">Partidos</a></li>
            <li><a href="{{ route('statistics') }}">Estadísticas</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="login-btn" style="background:transparent; border:none; color:white; cursor:pointer;">Cerrar sesión</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
            @endauth
        </ul>
    </div>
</header>

<main>
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-badge">TEMPORADA 2026</div>
            <h1>Sistema de Gestión de <span>Liga de Basquetbol</span></h1>
            <p>Administra equipos, jugadores, partidos y estadisticas en una sola plataforma profesional.</p>
            <div class="hero-buttons">
                <a href="{{ route('teams.create') }}" class="btn-primary">
                    <i class="fas fa-plus-circle"></i> Registrar Equipo
                </a>
                <a href="{{ route('games.index') }}" class="btn-secondary">
                    <i class="fas fa-calendar-alt"></i> Ver Partidos
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.pexels.com/photos/1700512/pexels-photo-1700512.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                 alt="Cancha de baloncesto"
                 onerror="this.src='https://placehold.co/1200x600/FFF0F5/FF69B4?text=LIGA+BASKET'">
        </div>
    </section>

    <section class="features-dashboard">
        <div class="section-header">
            <h2>Gestión Integral de la Liga</h2>
            <p>Módulos profesionales para control total de tu competición</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h3>Gestión de Equipos</h3>
                <p>Registro, edición y eliminación de equipos. Control de roster, entrenadores y estadísticas colectivas.</p>
                <span class="feature-tag">+12 equipos activos</span>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-user-astronaut"></i></div>
                <h3>Gestión de Jugadores</h3>
                <p>Registro individual, posiciones, estadísticas por partido y rendimiento personal.</p>
                <span class="feature-tag">+150 jugadores</span>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <h3>Control de Partidos</h3>
                <p>Calendario interactivo, resultados en vivo, marcadores automáticos y reportes de incidencias.</p>
                <span class="feature-tag">Próxima jornada</span>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Estadísticas Avanzadas</h3>
                <p>Tabla de posiciones, puntos por jugador, eficiencia, rebotes, asistencias y ranking MVP.</p>
                <span class="feature-tag">Actualizado en tiempo real</span>
            </div>
        </div>
    </section>

    <section class="stats-preview">
        <div class="stats-container">
            <div class="stats-card standings">
                <h3><i class="fas fa-trophy"></i> Tabla de Posiciones</h3>
                <div class="standings-table">
                    <div class="standings-row header">
                        <span>Pos</span><span>Equipo</span><span>PJ</span><span>PG</span><span>PP</span><span>Pts</span>
                    </div>
                    <div class="standings-row"><span>1</span><span>Lakers Elite</span><span>8</span><span>7</span><span>1</span><span>15</span></div>
                    <div class="standings-row"><span>2</span><span>Heat Warriors</span><span>8</span><span>6</span><span>2</span><span>14</span></div>
                    <div class="standings-row"><span>3</span><span>Bulls City</span><span>8</span><span>5</span><span>3</span><span>13</span></div>
                    <div class="standings-row"><span>4</span><span>Phoenix Suns</span><span>8</span><span>4</span><span>4</span><span>12</span></div>
                    <div class="standings-row"><span>5</span><span>Thunder Squad</span><span>8</span><span>3</span><span>5</span><span>11</span></div>
                </div>
                <button class="more-btn" onclick="location.href='{{ route('statistics') }}'">Ver clasificación completa <i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="stats-card top-player">
                <h3><i class="fas fa-star"></i> Máximo Anotador</h3>
                <div class="player-highlight">
                    <img src="{{ asset('imagenes/maximo_anotador.webp') }}" alt="Jugador destacado" onerror="this.src='https://placehold.co/70x70/FFB6C1/FF69B4?text=No+Image'">
                    <div class="player-info">
                        <h4>Michael Torres</h4>
                        <p>Base | Lakers Elite</p>
                        <div class="player-stats">
                            <span><i class="fas fa-basketball-ball"></i> 28.4 PPG</span>
                            <span><i class="fas fa-chart-simple"></i> 7.2 AST</span>
                        </div>
                    </div>
                </div>
                <div class="quick-stats">
                    <div><i class="fas fa-chart-bar"></i> Eficiencia: 32.1</div>
                    <div><i class="fas fa-medal"></i> 3 Triple-Dobles</div>
                </div>
            </div>
            <div class="stats-card next-matches">
                <h3><i class="fas fa-calendar-week"></i> Próximos Partidos</h3>
                <ul class="match-list">
                    <li><span>Lakers Elite vs Bulls City</span><span>20:00 Hrs</span></li>
                    <li><span>Heat Warriors vs Phoenix Suns</span><span>18:30 Hrs</span></li>
                    <li><span>Thunder Squad vs Celtics</span><span>21:15 Hrs</span></li>
                    <li><span>Bulls City vs Heat Warriors</span><span>19:45 Hrs</span></li>
                </ul>
                <button class="more-btn" onclick="location.href='{{ route('games.index') }}'"><i class="fas fa-calendar"></i> Calendario completo</button>
            </div>
        </div>
    </section>

    <section class="features-secondary">
        <div class="section-header">
            <h2>Funcionalidades del Sistema</h2>
            <p>Todo lo que necesitas para administrar tu liga profesional</p>
        </div>
        <div class="secondary-grid">
            <div class="secondary-card"><i class="fas fa-database"></i><h4>Base de Datos Centralizada</h4><p>Equipos, jugadores, partidos y estadísticas unificadas.</p></div>
            <div class="secondary-card"><i class="fas fa-chart-pie"></i><h4>Reportes Dinámicos</h4><p>Genera informes de rendimiento y análisis táctico.</p></div>
            <div class="secondary-card"><i class="fas fa-mobile-alt"></i><h4>Diseño Responsive</h4><p>Acceso desde cualquier dispositivo, gestión móvil optimizada.</p></div>
            <div class="secondary-card"><i class="fas fa-shield-alt"></i><h4>Autenticación Segura</h4><p>Roles administrador, entrenador, jugador con permisos específicos.</p></div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-col">
            <div class="footer-logo"><i class="fas fa-basketball-ball"></i><span>Liga<span>Basket</span></span></div>
            <p>Sistema profesional de gestión para ligas de baloncesto. Control total de competiciones, estadísticas y rendimiento.</p>
        </div>
        <div class="footer-col">
            <h4>Enlaces Rápidos</h4>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="{{ route('teams.index') }}">Equipos</a></li>
                <li><a href="{{ route('teams.index') }}">Jugadores</a></li>
                <li><a href="{{ route('games.index') }}">Partidos</a></li>
                <li><a href="{{ route('statistics') }}">Estadísticas</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Soporte</h4>
            <ul>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Ayuda</a></li>
                <li><a href="#">Documentación Técnica</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Redes Sociales</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="contact-info">
                <p><i class="fas fa-envelope"></i> liga@basketadmin.com</p>
                <p><i class="fas fa-phone-alt"></i> +51 928767960</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Liga de Básquetbol - Sistema de Gestión Deportiva.</p>
    </div>
</footer>

<script>
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');
    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('show');
        });
    }
</script>
</body>
</html>