<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferta educativa | Escuela Técnica N.º 1</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- NAVBAR barra de navegación y logo -->
    <nav class="navbar navbar-expand-lg navbar-custom" aria-label="Navegación principal">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="../index.html">
                <img src="../assets/img/logo-utu-transparent.png" alt="Escudo Escuela Técnica N.º 1" class="brand-crest-img">
                <span class="brand-text">
                    <h1>Escuela Técnica N.º 1</h1>
                    <span class="brand-sub">"Mtro. Téc. Sergio G. Olaizola" · Bella Unión</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Buscar..." aria-label="Buscar">
                </div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Institución</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="noticias.html">Noticias</a></li>
                            <li><a class="dropdown-item" href="contacto.html">Contacto</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Estudiantes</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cursos.html">Cursos</a></li>
                            <li><a class="dropdown-item" href="horarios.html">Horarios</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="anexos.html">Anexos</a></li>
                    <li class="nav-item"><a class="nav-link" href="registro.html">Registro</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="cursos-page">
        <header class="hero">
            <div class="container">
                <span class="hero-eyebrow">Propuesta académica</span>
                <h2>Oferta educativa</h2>
                <p class="lead-text">Encontrá el trayecto formativo que acompaña tus intereses, tu edad y tus próximos proyectos.</p>
            </div>
        </header>
          
        <!-- Sección de cursos y carreras -->
        <section class="section-pad container" aria-labelledby="education-title">
            <div class="feature-square">
                <div class="feature-square-header">
                    <div>
                        <span class="section-kicker">Formación para cada etapa</span>
                        <h2 id="education-title" class="section-title">Cursos y carreras</h2>
                    </div>
                    <i class="bi bi-mortarboard fs-1 text-gold" aria-hidden="true"></i>
                </div>

                <div class="cursos-chip-grid">
                    <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-journal-bookmark"></i></div><div class="chip-label"><strong>EBI</strong><span>Educación Básica Integrada</span></div></div>
                    <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-briefcase"></i></div><div class="chip-label"><strong>FPB</strong><span>Formación Profesional Básica</span></div></div>
                    <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-laptop"></i></div><div class="chip-label"><strong>BT</strong><span>Bachillerato Tecnológico</span></div></div>
                    <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-tools"></i></div><div class="chip-label"><strong>BTP</strong><span>Bachillerato Técnico Profesional</span></div></div>
                    <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-gear"></i></div><div class="chip-label"><strong>CTT</strong><span>Cursos Técnicos Terciarios</span></div></div>
                    <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-people"></i></div><div class="chip-label"><strong>Capacitaciones</strong><span>Actualización y oficios</span></div></div>
                </div>

                <div class="card-tech cursos-contact">
                    <div class="card-icon mb-0"><i class="bi bi-chat-dots"></i></div>
                    <div>
                        <h3 class="h5">¿Necesitás orientación?</h3>
                        <p class="mb-0 text-muted">Comunicate con la institución para conocer requisitos, horarios y disponibilidad.</p>
                    </div>
                    <a href="contacto.html" class="btn btn-gold">Contactar</a>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-brand">
                <img src="../assets/img/logo-utu-transparent.png" alt="Escudo Escuela Técnica N.º 1" class="brand-crest-img">
                <div><h2>Escuela Técnica N.º 1</h2><span class="brand-sub">"Mtro. Téc. Sergio G. Olaizola" · Bella Unión</span></div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <h3>Contacto Sede</h3>
                    <p><i class="bi bi-geo-alt me-1"></i> Pedro Acosta y Avenida Artigas, Bella Unión</p>
                    <p><i class="bi bi-telephone me-1"></i> 4779 2025</p>
                    <p><i class="bi bi-envelope me-1"></i> info@utu.edu.uy</p>
                </div>
                <div class="col-md-4">
                    <h3>Atención al Estudiante</h3>
                    <p><i class="bi bi-clock me-1"></i> Lunes a Viernes de 08:00 a 20:00 hs</p>
                    <p><i class="bi bi-envelope me-1"></i> secretaria@utu.edu.uy</p>
                </div>
                <div class="col-md-4">
                    <h3>Seguinos en nuestras redes</h3>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom"><p class="mb-0">&copy; 2026 Escuela Técnica N.º 1 "Mtro. Téc. Sergio G. Olaizola" — Bella Unión. Todos los derechos reservados.</p></div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>