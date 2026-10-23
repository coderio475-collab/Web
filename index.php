<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<!-- Tipografias  para títulos, Inter para texto general -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5.3 (grid + componentes) + Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<!-- Estilos del sitio -->
<link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
    <!-- NAVBAR barra de navegación y logo -->
<nav class="navbar navbar-expand-lg navbar-custom" aria-label="Navegación principal">
  <div class="container">
         <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
             <img src="assets/img/logo-utu-transparent.png" alt="Escudo Escuela Técnica N.º 1" class="brand-crest-img">
             <span class="brand-text">
                <h1>Escuela Técnica N.º 1</h1>
               <span class="brand-sub">"Mtro. Téc. Sergio G. Olaizola" · Bella Unión</span>
            </span>
         </a>
         <!-- Boton para el menú en pantallas movil,tablet (Bootstrap) -->
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
          </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      
        <!-- buscador de la web  -->
      <div class="navbar-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Buscar..." aria-label="Buscar">
      </div>

      <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Institución</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="seconds_index/noticias.html">Noticias</a></li>
                <li><a class="dropdown-item" href="seconds_index/contacto.html">Contacto</a></li>
                </ul>
            </li>
        
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Estudiantes</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="seconds_index/cursos.html">Cursos</a></li>
                    <li><a class="dropdown-item" href="seconds_index/horarios.html">Horarios</a></li>
                </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="seconds_index/anexos.html">Anexos</a></li>
             <li class="nav-item"><a class="nav-link" href="seconds_index/registro.html">Registro</a></li>
     </ul>
    </div>
  </div>
</nav>

<!-- HERO, Bloque principal de la institucion -->
<header class="hero hero-photo" style="background-image:url('assets/img/hero-institucion.jpg');">
  <div class="container">
    <div class="hero-content">
      <span class="hero-eyebrow">Bella Unión</span>
      <h2>Formación técnica para tu futuro</h2>
      <p class="lead-text">La Escuela Técnica N.º 1 de Bella Unión brinda educación técnica y tecnológica a estudiantes de la región.</p>
      <p class="lead-text">Actualmente contamos con 62 grupos distribuidos en cinco turnos: matutino, intermedio, vespertino, turno cuatro y nocturno.</p>
      <a href="seconds_index/cursos.html" class="btn btn-gold mt-2"><i class="bi bi-mortarboard"></i> Conocé más</a>
      <div class="hero-stats">
        <div><div class="stat-num">62</div><div class="stat-label">Grupos activos</div></div>
        <div><div class="stat-num">5</div><div class="stat-label">Turnos disponibles</div></div>
        <div><div class="stat-num">3</div><div class="stat-label">Anexos regionales</div></div>
      </div>
    </div>
  </div>
</header>

<main class="container">

  <!-- Seccion de redireccionamiento a la pagina de Registro  -->
  <section class="section-pad">
    <div class="card-tech d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 p-4">
      <div>
        <h3 class="h4 mb-1">¿Querés sumarte a la institución?</h3>
        <p class="mb-0 text-muted">Registrate como estudiante o docente en pocos minutos.</p>
      </div>
      <a href="seconds_index/registro.html" class="btn btn-gold flex-shrink-0">Registrarme</a>
    </div>
  </section>

  <!-- Seccion de oferta educativa + Proximos eventos  -->
  <section class="section-pad">
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="feature-square">
          <div class="feature-square-header">
            <div><span class="section-kicker">Oferta educativa</span><h3>Cursos y Carreras</h3></div>
            <i class="bi bi-mortarboard fs-3 text-gold"></i>
          </div>
          <div class="cursos-chip-grid">
            <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-journal-bookmark"></i></div><div class="chip-label">EBI · Educación Básica Integrada</div></div>
            <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-briefcase"></i></div><div class="chip-label">FPB · Formación Profesional Básica</div></div>
            <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-laptop"></i></div><div class="chip-label">BT · Bachillerato Tecnológico</div></div>
            <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-tools"></i></div><div class="chip-label">BTP · Bachillerato Técnico Profesional</div></div>
            <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-gear"></i></div><div class="chip-label">CTT · Cursos Técnicos Terciarios</div></div>
            <div class="cursos-chip"><div class="chip-icon"><i class="bi bi-people"></i></div><div class="chip-label">Capacitaciones</div></div>
          </div>
          <div class="text-center mt-3"><a href="seconds_index/cursos.html" class="btn btn-outline-gold btn-sm">Ver toda la oferta educativa <i class="bi bi-arrow-right"></i></a></div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="feature-square">
          <div class="feature-square-header">
            <div><span class="section-kicker">Agenda</span><h3>Próximos Eventos</h3></div>
            <i class="bi bi-calendar-event fs-3 text-gold"></i>
          </div>
          <div class="agenda-list">
            <div class="agenda-row"><div class="agenda-date"><span class="day">12</span><span class="mon">Ago</span></div><div><h4>Charla de orientación vocacional</h4><p class="small text-muted mb-0">Salón de actos · 18:00 hs</p></div></div>
            <div class="agenda-row"><div class="agenda-date"><span class="day">20</span><span class="mon">Ago</span></div><div><h4>Feria de talleres y oficios</h4><p class="small text-muted mb-0">Patio central · 09:00 hs</p></div></div>
            <div class="agenda-row"><div class="agenda-date"><span class="day">02</span><span class="mon">Sep</span></div><div><h4>Cierre de inscripciones EBI</h4><p class="small text-muted mb-0">Bedelía · Todo el día</p></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seccion noticias recientes -->
  <section class="section-pad">
    <span class="section-kicker">Novedades</span>
    <h2 class="section-title">Noticias Recientes</h2>
    <div class="section-title-rule"></div>
    <div class="row g-3">
      <div class="col-md-6">
        <div class="card-tech h-100 d-flex flex-column gap-3">
          <div class="img-placeholder"><i class="bi bi-image"></i><span>Imagen — próximamente</span></div>
          <div>
            <span class="status-pill status-abierto mb-2 d-inline-block">Institucional</span>
            <h4>Comienzan las inscripciones para el ciclo 2027</h4>
            <p class="small text-muted mb-0">📅 Publicado el 18 de Julio, 2026</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-tech h-100 d-flex flex-column gap-3">
          <div class="img-placeholder"><i class="bi bi-image"></i><span>Imagen — próximamente</span></div>
          <div>
            <span class="status-pill status-media mb-2 d-inline-block">Investigación</span>
            <h4>Proyecto estudiantil de energía solar recibe apoyo regional</h4>
            <p class="small text-muted mb-0">📅 Publicado el 10 de Junio, 2026</p>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-4"><a href="seconds_index/noticias.html" class="btn btn-outline-gold">Ver todas las noticias <i class="bi bi-arrow-right"></i></a></div>
  </section>



  <!-- Seccion  quienes somos texto + misión/visión  -->
  <section class="section-pad">
    <div class="row g-5 align-items-start">
      <div class="col-lg-6">
        <span class="section-kicker">Quiénes somos</span>
        <h2 class="section-title">Sobre Nuestra Escuela</h2>
        <div class="section-title-rule"></div>
        <p>Brindamos educación pública de calidad, comprometida con el desarrollo personal y profesional de nuestros estudiantes.</p>
        <ul class="list-unstyled mt-3">
          <li class="mb-2"><i class="bi bi-check-circle-fill text-gold me-2"></i>62 grupos distribuidos en cinco turnos.</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill text-gold me-2"></i>Propuesta educativa diversa y actualizada.</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill text-gold me-2"></i>Docentes comprometidos con tu formación.</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill text-gold me-2"></i>Vínculo permanente con la comunidad y el entorno productivo.</li>
        </ul>
        <div class="card-tech d-flex align-items-center gap-3 mt-4">
          <div class="card-icon mb-0"><i class="bi bi-telephone"></i></div>
          <div><p class="small text-muted mb-0">Por consultas comunicate con nosotros</p><p class="h5 mb-0 text-gold">4779 2025</p></div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="about-box"><h3 class="h5">Misión</h3><p class="mb-0">Formar profesionales líderes mediante una educación de calidad basada en la innovación tecnológica, el rigor técnico y un fuerte compromiso ético con el desarrollo de la comunidad.</p></div>
        <div class="about-box mb-0"><h3 class="h5">Visión</h3><p class="mb-0">Ser referentes regionales en formación técnica, destacando por la excelencia de nuestros egresados y el vínculo con el entorno productivo local.</p></div>
      </div>
    </div>
  </section>

  <!-- Seccion de los 3 anexos   -->
  <section class="section-pad">
    <span class="section-kicker">Presencia regional</span>
    <h2 class="section-title">Nuestros Anexos</h2>
    <div class="section-title-rule"></div>
    <div class="row g-3">
      <div class="col-md-4"><div class="card-tech h-100"><div class="card-icon"><i class="bi bi-geo-alt"></i></div><h4 class="h6">Anexo Polideportivo Bella Unión</h4><p class="small text-muted mb-0">Ubicado en Avenida Artigas y Martín Dermit.</p></div></div>
      <div class="col-md-4"><div class="card-tech h-100"><div class="card-icon"><i class="bi bi-geo-alt"></i></div><h4 class="h6">Anexo Baltasar Brum</h4><p class="small text-muted mb-0">Ubicado en José Batlle y Ordóñez, entre 25 de Agosto y Sixto Fleitas.</p></div></div>
      <div class="col-md-4"><div class="card-tech h-100"><div class="card-icon"><i class="bi bi-geo-alt"></i></div><h4 class="h6">Anexo Tomás Gomensoro</h4><p class="small text-muted mb-0">Ubicado en 25 de Agosto y Manuel Jesús González.</p></div></div>
    </div>
    <div class="text-center mt-4"><a href="seconds_index/anexos.html" class="btn btn-outline-gold">Ver todas las sedes <i class="bi bi-arrow-right"></i></a></div>
  </section>

</main>


<!--  FOOTER  -->
<footer class="main-footer">
  <div class="container">
    <div class="footer-brand">
      <img src="assets/img/logo-utu-transparent.png" alt="Escudo Escuela Técnica N.º 1" class="brand-crest-img">
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


<!-- Bootstrap  (menú , dropdowns, pestañas) + script  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>




</body>
</html>