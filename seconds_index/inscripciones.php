<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registro - Escuela Técnica N.º 1 Bella Unión</title>
        <meta name="description" content="Formulario de registro para estudiantes y docentes de la Escuela Técnica N.º 1 de Bella Unión.">
        <!-- Tipografías  para títulos, Inter para texto general -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Bootstrap 5.3 (grid + componentes) + Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <!-- Estilos del sitio -->
        <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
         /* Formularios  */
        .form-shell { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); box-shadow: var(--shadow-soft); padding: 2rem; max-width: 720px; margin-inline: auto; }
        .form-control, .form-select { border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: .55rem .85rem; }
        .form-control:focus, .form-select:focus { border-color: var(--color-gold); box-shadow: 0 0 0 3px rgba(198,154,63,.18); }
        .form-label { font-weight: 600; font-size: .9rem; color: var(--color-primary); }
       
        /* Mensaje de exito tras "enviar" */
        .success-message { display: none; background: rgba(75,107,70,.12); border-left: 4px solid var(--color-green); color: #37502f; padding: .9rem 1.1rem; border-radius: var(--radius-sm); margin-bottom: 1.2rem; }
        .success-message.show { display: block; }

        .nav-pills-gold .nav-link { color: var(--color-primary); border: 1px solid var(--color-border); border-radius: var(--radius-sm); margin-right: .5rem; margin-bottom: .5rem; font-weight: 600; font-size: .9rem; }
        .nav-pills-gold .nav-link.active { background-color: var(--color-gold); color: var(--color-primary); border-color: var(--color-gold); }
        .btn-gold { background-color: var(--color-gold); color: var(--color-primary); border: 1px solid var(--color-gold); font-weight: 600; }
        .btn-gold:hover, .btn-gold:focus { background-color: var(--color-primary); color: var(--color-surface); border-color: var(--color-primary); }

    </style>
    
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
            
            <!-- Botón para el menú en pantallas moviles,tablet (Bootstrap) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
            
                <!-- buscador de la web -->
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
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Estudiantes</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="cursos.html">Carreras</a></li>
                    <li><a class="dropdown-item" href="horarios.html">Horarios</a></li>
                </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="anexos.html">Anexos</a></li>
                <li class="nav-item"><a class="nav-link active" href="registro.html">Registro</a></li>
            </ul>
            </div>
        </div>
        </nav>

         <!-- Hero bloque principal -->
        <section class="hero">
        <div class="container hero-inner text-center">
            <span class="hero-eyebrow justify-content-center">Sumate a la institución</span>
            <h2 class="mx-auto">Formulario de registro</h2>
            <p class="lead-text mx-auto">Completá el formulario correspondiente para registrarte como estudiante o como docente.</p>
        </div>
        </section>

        <main class="container section-pad">

  <!--Pestalas de form estudiante y el de docente -->
  <ul class="nav nav-pills nav-pills-gold justify-content-center mb-4" id="registroTab" role="tablist">
    <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#panel-estudiante" type="button" role="tab">Estudiante</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#panel-docente" type="button" role="tab">Docente</button></li>
  </ul>

  <div class="tab-content">

    <!-- Form Estudiante  -->
    <div class="tab-pane fade show active" id="panel-estudiante" role="tabpanel">
      <div class="form-shell">
        <h3 class="h4 mb-1 text-gold">Registro de Estudiante</h3>
        <p class="text-muted small mb-4">Completá tus datos para inscribirte en la institución.</p>
        
        <!-- Mensaje de exito -->
        <div id="estudiante-success" class="success-message">¡Registro enviado! Nos pondremos en contacto para confirmar tu inscripción.</div>

        <form action="../public/index.php" method="post" data-demo-form="#estudiante-success">
          <input type="hidden" name="tipo" value="estudiante">
          <div class="row">
            <div class="col-md-6 mb-3"><label for="est-name" class="form-label">Nombre *</label><input type="text" id="est-name" name="nombre" class="form-control" placeholder="Ej.: María" required></div>
            <div class="col-md-6 mb-3"><label for="est-last-name" class="form-label">Apellido *</label><input type="text" id="est-last-name" name="apellido" class="form-control" placeholder="Ej.: González" required></div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label for="est-ci" class="form-label">Cédula de identidad *</label><input type="text" id="est-ci" name="cedula" class="form-control" placeholder="Ej.: 45678901" required></div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label for="est-email" class="form-label">Correo electrónico *</label><input type="email" id="est-email" name="correo" class="form-control" placeholder="Ej.: maria@correo.com" required></div>
            <div class="col-md-6 mb-3"><label for="est-phone" class="form-label">Teléfono *</label><input type="tel" id="est-phone" name="telefono" class="form-control" placeholder="Ej.: 099 123 456" required></div>
          </div>
          <div class="mb-3">
            <label for="est-course" class="form-label">Curso al que desea inscribirse</label>
            <select id="est-course" name="curso" class="form-select" required>
              <option value="" disabled selected>Ej.: Seleccioná un curso</option>
              <option>EBI · Educación Básica Integrada</option>
              <option>FPB · Formación Profesional Básica</option>
              <option>BT · Bachillerato Tecnológico</option>
              <option>BTP · Bachillerato Técnico Profesional</option>
              <option>CTT · Cursos Técnicos Terciarios</option>
            </select>
          </div>
          <button type="submit" class="btn btn-gold">Enviar registro</button>
        </form>
      </div>
    </div>
    <!-- Form Docente  -->
    <div class="tab-pane fade" id="panel-docente" role="tabpanel">
      <div class="form-shell">
        <h3 class="h4 mb-1 text-gold">Registro de Docente</h3>
        <p class="text-muted small mb-4">Completá tus datos para postularte como docente en la institución.</p>
        <div id="docente-success" class="success-message">¡Postulación enviada! El equipo se pondrá en contacto.</div>
        <form action="../public/index.php" method="post" data-demo-form="#docente-success">
          <input type="hidden" name="tipo" value="docente">
          <div class="row">
            <div class="col-md-6 mb-3"><label for="doc-name" class="form-label">Nombre *</label><input type="text" id="doc-name" name="nombre" class="form-control" placeholder="Ej.: Juan" required></div>
            <div class="col-md-6 mb-3"><label for="doc-last-name" class="form-label">Apellido *</label><input type="text" id="doc-last-name" name="apellido" class="form-control" placeholder="Ej.: Rodríguez" required></div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label for="doc-title" class="form-label">Título / Especialidad *</label><input type="text" id="doc-title" name="titulo" class="form-control" placeholder="Ej.: Profesor de Matemática" required></div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label for="doc-email" class="form-label">Correo electrónico *</label><input type="email" id="doc-email" name="correo" class="form-control" placeholder="Ej.: juan@correo.com" required></div>
            <div class="col-md-6 mb-3"><label for="doc-phone" class="form-label">Teléfono *</label><input type="tel" id="doc-phone" name="telefono" class="form-control" placeholder="Ej.: 099 123 456" required></div>
          </div>
          <div class="mb-3">
            <label for="doc-area" class="form-label">Área de interés</label>
            <select id="doc-area" name="area" class="form-select" required>
              <option value="" disabled selected>Ej.: Seleccioná un área</option>
              <option>Matemática</option>
              <option>Idioma Español</option>
              <option>Ciencias Físicas</option>
              <option>Informática</option>
              <option>Talleres y Oficios</option>
            </select>
          </div>
          <button type="submit" class="btn btn-gold">Enviar postulación</button>
        </form>
      </div>
    </div>

  </div>
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

    <!-- Bootstrap (menú , dropdowns, pestañas) + script  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>

</body>
</html>