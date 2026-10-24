<?php
/** PAGINA PRINCIPAL DEL SITIO (index.php)
 */
// ---------- Datos de la página: título, descripción y scripts extra que cargará el pie (footer_scripts.php) ----------
$pageTitle = 'Inicio - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = "Escuela Técnica N.º 1 'Mtro. Téc. Sergio G. Olaizola' — Bella Unión. Formación técnica para tu futuro.";
$assetBase = '';
$footerScriptBefore = 'assets/js/imagenes.js';
// ---------- Datos dinamicos de la base: eventos de la agenda y títulos de imágenes destacadas (contenido_publico.php) ----------
require_once __DIR__ . '/assets/php/contenido_publico.php';
$agendaEventos = obtener_eventos_agenda();
// $titulosImagenes también contiene los destinos externos guardados en el CRUD.
$titulosImagenes = obtener_titulos_imagenes();

require_once __DIR__ . "/requires/head.php";
?>
  <body data-i18n-title="home.title" data-root="">

    <!-- ======================= Encabezado ======================= -->
    <header class="site-header">
       
      
      <div class="container header-top">
        <a class="brand" href="index.php">
          <img
              src="assets/img/logo-utu-transparent.png"
              alt="Escudo Escuela Técnica N.º 1"
              class="brand-crest-img">
          <div class="brand-text">
            <span class="brand-name" data-i18n="common.brand.name">Escuela Técnica N.º 1</span>
            <span class="brand-sub" data-i18n="common.brand.sub">"Mtro. Téc. Sergio G. Olaizola" · Bella Unión</span>
          </div>
        </a>
        <!-- Buscador lo controla assets/js/buscador.js) -->
        <form class="header-search" id="search-form" role="search" autocomplete="off">
          <div class="search-field">
            <i class="bi bi-search" aria-hidden="true"></i>
            <label for="search-input" class="visually-hidden" data-i18n="common.nav.searchLabel">Buscar en el sitio</label>
            <input
                type="search"
                id="search-input"
                class="search-input"
                data-i18n="common.nav.searchPlaceholder"
                data-i18n-attr="placeholder"
                placeholder="Buscar en el sitio...">
            <button
                class="search-submit"
                type="submit"
                data-i18n="common.nav.searchBtn"
                data-i18n-attr="aria-label"
                aria-label="Buscar"><i class="bi bi-arrow-right"></i></button>
          </div>
          <ul class="search-results" id="search-results"></ul>
        </form>
        <!--Botones de idioma y de tema claro/oscuro  ES/PT (i18n.js) y (theme.js) -->
        <div class="header-tools">
          <button class="tool-btn" id="lang-btn" type="button" aria-label="Cambiar idioma / Mudar idioma"><span class="flag-icon" aria-hidden="true"></span></button>
          <button
              class="tool-btn"
              id="theme-btn"
              type="button"
              data-i18n="common.theme.toggle"
              data-i18n-attr="aria-label"
              aria-label="Cambiar entre modo claro y oscuro"><i class="bi bi-moon-stars" aria-hidden="true"></i></button>
        </div>
      </div>
       
      <!-- Menú de navegación: Institución, Estudiantes, Anexos e Inscripciones -->
      <nav class="navbar navbar-expand-lg navbar-custom" aria-label="Navegación principal">
        <div class="container">
          <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#mainNavbar"
              aria-controls="mainNavbar"
              aria-expanded="false"
              data-i18n="common.nav.menuToggle"
              data-i18n-attr="aria-label"
              aria-label="Abrir menú"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data-i18n="common.nav.institucion">Institución</a>
                <ul class="dropdown-menu">
                  <li>
                    <a
                        class="dropdown-item"
                        href="seconds_index/noticias.php"
                        data-i18n="common.nav.noticias">Noticias</a>
                  </li>
                  <li>
                    <a
                        class="dropdown-item"
                        href="seconds_index/normativa.php"
                        data-i18n="common.nav.normativa">Normativa</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data-i18n="common.nav.estudiantes">Estudiantes</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="seconds_index/cursos.php" data-i18n="common.nav.cursos">Cursos y Carreras</a>
                  </li>
                  <li>
                    <a
                        class="dropdown-item"
                        href="seconds_index/horarios.php"
                        data-i18n="common.nav.horarios">Horarios y Exámenes</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="seconds_index/anexos.php" data-i18n="common.nav.anexos">Anexos</a>
              </li>
              <li class="nav-item">
                <a
                    class="nav-link"
                    href="seconds_index/inscripciones.php"
                    data-i18n="common.nav.inscripciones">Inscripciones</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

   
    <!-- ======================= HERO (foto de la institución) =======================
     assets/css/styles.css (.hero-photo). -->
    <header class="hero hero-photo">
      <img class="managed-image" src="assets/php/imagen.php?ubicacion=hero_institucion" alt="">
      <div class="container">
        <div class="hero-inner">
          <div class="hero-content">
            <span class="hero-eyebrow" data-i18n="home.hero.eyebrow">Bella Unión</span>
            <h1 data-i18n="home.hero.title">Formación técnica para tu futuro</h1>
            <p class="lead-text" data-i18n="home.hero.lead">La Escuela Técnica N.º 1 de Bella Unión brinda educación técnica y tecnológica a estudiantes de la región.</p>
            <p class="lead-text" data-i18n="home.hero.stats">Actualmente contamos con 62 grupos distribuidos en cinco turnos: matutino, intermedio, vespertino, turno cuatro y nocturno.</p>
            <a href="seconds_index/cursos.php" class="btn btn-gold mt-2"><i class="bi bi-mortarboard"></i> <span data-i18n="home.hero.cta">Conocé más</span></a>
            <!-- Cifras de la portada -->
            <div class="hero-stats">
              <div>
                <div class="stat-num">83</div>
                <div class="stat-label" data-i18n="home.hero.stat0">Cursos</div>
              </div>
              <div>
                <div class="stat-num">62</div>
                <div class="stat-label" data-i18n="home.hero.stat1">Grupos activos</div>
              </div>
              <div>
                <div class="stat-num">5</div>
                <div class="stat-label" data-i18n="home.hero.stat2">Turnos disponibles</div>
              </div>
              <div>
                <div class="stat-num">3</div>
                <div class="stat-label" data-i18n="home.hero.stat3">Anexos regionales</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
      
    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container">

      <!-- ======================= PANELES: CURSOS Y CARRERAS + BECAS ======================= -->
  
      <section class="pt-5" aria-label="Accesos principales">
        <div class="row g-4">
          <div class="col-lg-7">
            <div class="promo-panel">
              <span class="promo-kicker" data-i18n="home.promo.cursos.kicker">¡Estudiá en UTU!</span>
              <h2 class="promo-title" data-i18n="home.promo.cursos.title" data-i18n-html>Descubrí los <span class="hl-gold">cursos y carreras</span> que <span class="hl-green">UTU</span> tiene para vos</h2>
              <p class="promo-text" data-i18n="home.promo.cursos.text" data-i18n-html>Visitá <strong>Estudiá en UTU</strong> para conocer toda nuestra oferta educativa por orientaciones, departamento en donde vivís y grado de estudio.</p>
              <a href="seconds_index/cursos.php" class="btn btn-gold"><i class="bi bi-hand-index-thumb"></i> <span data-i18n="home.promo.cursos.btn">Ingresá y descubrí más</span></a>
            </div>
          </div>
          <div class="col-lg-5">
             <!-- Panel de becas -->
            <div class="promo-panel promo-panel--becas">
              <span class="promo-kicker" data-i18n="home.promo.becas.kicker">¡Apoyo estudiantil!</span>
              <h2 class="promo-title" data-i18n="home.promo.becas.title" data-i18n-html>Conocé las <span class="hl-green">becas</span> disponibles</h2>
              <p class="promo-text" data-i18n="home.promo.becas.text">Informate sobre las becas y apoyos económicos para estudiantes.</p>
              
              <a href="<?= url_externo('becas', $enlacesExternos) ?>" class="btn btn-gold"><i class="bi bi-award"></i> <span data-i18n="home.promo.becas.btn">Ver becas</span></a>
            </div>
          </div>
        </div>
      </section>

      <!-- ======================= PANEL: INSCRIBITE POR UN CUPO ======================= -->
      <section class="pt-4" aria-label="Inscripciones">
        <div class="promo-wide">
          <div class="d-flex align-items-center gap-3">
            <div class="promo-wide-icon"><i class="bi bi-pencil-square" aria-hidden="true"></i></div>
            <div>
              <h2 data-i18n="home.inscribite.title">Inscribite por un cupo en nuestros cursos</h2>
              <p data-i18n="home.inscribite.text">Reservá tu lugar completando el formulario en línea.</p>
            </div>
          </div>
          <a href="seconds_index/inscripciones.php" class="btn btn-gold"><span data-i18n="home.inscribite.btn">Quiero inscribirme</span></a>
        </div>
      </section>

      <!-- ======================= AGENDA + PANEL DE IMAGENES ======================= -->
      <section class="pt-5" aria-label="Agenda">
        <div class="row g-4 align-items-stretch">
          <div class="col-lg-7">
            <div class="agenda-card">
              <div class="agenda-heading">
                <i class="bi bi-calendar-event" aria-hidden="true"></i>
                <span data-i18n="home.agenda.title">Agenda</span>
              </div>
               <!-- Eventos DE AGENDA -->
              <div class="agenda-list">
                <?php /* Una fila por cada evento de la agenda  */ ?>
                <?php foreach ($agendaEventos as $evento): ?>
                  <div class="agenda-row">
                    <span class="agenda-date"><?= htmlspecialchars(date('d/m', strtotime($evento['fecha'])), ENT_QUOTES, 'UTF-8') ?></span>
                    <p<?= atributo_i18n_agenda($evento) ?>><?= htmlspecialchars($evento['titulo'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
             
            <!-- PANEL DE IMAGENES Q SE MUEVUEN (Bootstrap Carrousel) -->
            <div class="agenda-carousel">
              <div
                  id="homeCarousel"
                  class="carousel slide"
                  data-bs-ride="carousel"
                  data-bs-interval="3500"
                  data-bs-pause="false">
                <div class="carousel-indicators">
                  <button
                      type="button"
                      data-bs-target="#homeCarousel"
                      data-bs-slide-to="0"
                      class="active"
                      aria-current="true"
                      aria-label="1"></button>
                  <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="2"></button>
                  <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="img-placeholder">
                      <img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_agenda_1" alt="Imagen institucional">
                      <i class="bi bi-images"></i>
                      <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="img-placeholder">
                      <img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_agenda_2" alt="Imagen institucional">
                      <i class="bi bi-images"></i>
                      <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="img-placeholder">
                      <img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_agenda_3" alt="Imagen institucional">
                      <i class="bi bi-images"></i>
                      <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ======================= DESTACADOS + NOTICIAS RECIENTES ======================= -->
      <section class="pt-5" aria-label="Noticias destacadas">
        <span class="section-kicker" data-i18n="home.news.kicker">Destacados</span>
        <h2 class="section-title" data-i18n="home.news.title">Noticias recientes</h2>
         
        <!-- apartado noticia principal destacada -->
        <div class="featured-news">
          <a href="seconds_index/noticias.php" class="featured-item featured-item--big">
            <div class="img-placeholder">
              <img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_noticia_principal" alt="Noticia destacada">
              <i class="bi bi-camera"></i>
              <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
            </div>

            <div class="featured-caption">
              <span class="featured-tag" data-i18n="home.news.tag">Noticias</span>
              <h3<?= atributo_i18n_titulo_destacado('portada_noticia_principal', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('portada_noticia_principal', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
            </div>
          </a>
          <!-- apartado noticia destacada 1, 2 y 3 mas chicas -->
          <a href="seconds_index/noticias.php" class="featured-item">
            <div class="img-placeholder"><img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_noticia_1" alt="Noticia destacada 1"><i class="bi bi-camera"></i></div>
            <div class="featured-caption">
              <h3<?= atributo_i18n_titulo_destacado('portada_noticia_1', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('portada_noticia_1', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
            </div>
          </a>
          <a href="seconds_index/noticias.php" class="featured-item">
            <div class="img-placeholder"><img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_noticia_2" alt="Noticia destacada 2"><i class="bi bi-camera"></i></div>
            <div class="featured-caption">
              <h3<?= atributo_i18n_titulo_destacado('portada_noticia_2', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('portada_noticia_2', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
            </div>
          </a>
          <a href="seconds_index/noticias.php" class="featured-item">
            <div class="img-placeholder"><img class="managed-image" src="assets/php/imagen.php?ubicacion=portada_noticia_3" alt="Noticia destacada 3"><i class="bi bi-camera"></i></div>
            <div class="featured-caption">
              <h3<?= atributo_i18n_titulo_destacado('portada_noticia_3', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('portada_noticia_3', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
            </div>
          </a>
        </div>
      </section>

      <!-- =======================APARTADO DE INTERÉS ======================= -->
      <section class="pt-5" aria-label="De interés">
        <div class="interest-box">
          <h2 class="section-title" data-i18n="home.interes.title">De interés</h2>
          <!-- enlaces de interes: cursos, inscripciones, horarios, becas, anexos, noticias, normativa, estudiá en UTU, política de privacidad y presentación -->
          <div class="interest-grid">
            <a href="seconds_index/cursos.php" class="interest-tile"><i class="bi bi-mortarboard" aria-hidden="true"></i><span data-i18n="home.interes.cursos">Cursos y Carreras</span></a>
            <a href="seconds_index/inscripciones.php" class="interest-tile"><i class="bi bi-pencil-square" aria-hidden="true"></i><span data-i18n="home.interes.inscrip">Inscripciones</span></a>
            <a href="seconds_index/horarios.php" class="interest-tile"><i class="bi bi-clock" aria-hidden="true"></i><span data-i18n="home.interes.horarios">Horarios</span></a>
            <a href="<?= url_externo('becas', $enlacesExternos) ?>" class="interest-tile"><i class="bi bi-award" aria-hidden="true"></i><span data-i18n="home.interes.becas">Becas</span></a>
            <a href="seconds_index/horarios.php#examenes" class="interest-tile"><i class="bi bi-file-earmark-text" aria-hidden="true"></i><span data-i18n="home.interes.examenes">Exámenes</span></a>
            <a href="seconds_index/anexos.php" class="interest-tile"><i class="bi bi-geo-alt" aria-hidden="true"></i><span data-i18n="home.interes.anexos">Anexos</span></a>
            <a href="seconds_index/noticias.php" class="interest-tile"><i class="bi bi-newspaper" aria-hidden="true"></i><span data-i18n="home.interes.noticias">Noticias</span></a>
            <a href="seconds_index/normativa.php" class="interest-tile"><i class="bi bi-journal-text" aria-hidden="true"></i><span data-i18n="home.interes.normativa">Normativa</span></a>
            <a href="<?= url_externo('utu_estudia', $enlacesExternos) ?>" class="interest-tile" target="_blank" rel="noopener"><i class="bi bi-search" aria-hidden="true"></i><span data-i18n="home.interes.estudia">Estudiá en UTU</span></a>
            <a
                href="<?= url_externo('privacidad', $enlacesExternos) ?>"
                class="interest-tile"
                target="_blank"
                rel="noopener"><i class="bi bi-shield-check" aria-hidden="true"></i><span data-i18n="home.interes.privacidad">Política de privacidad</span></a>
            <a
                href="<?= url_externo('presentacion', $enlacesExternos) ?>"
                class="interest-tile"
                target="_blank"
                rel="noopener"><i class="bi bi-file-earmark-slides" aria-hidden="true"></i><span data-i18n="home.interes.presentacion">Presentación</span></a>
          </div>
        </div>
      </section>

      <!-- ======================= NUESTRAS CIFRAS  ======================= -->
      <section class="section-pad" aria-label="Nuestras cifras">
        <div class="stats-band">
          <h2 class="section-title" data-i18n="home.stats.title">Nuestras cifras</h2>
          <div class="stats-grid">
            <div class="stat-item">
              <i class="bi bi-journal-bookmark" aria-hidden="true"></i>
              <div class="stat-value">83</div>
              <div class="stat-name" data-i18n="home.stats.cursos">Cursos</div>
            </div>
            <div class="stat-item">
              <i class="bi bi-collection" aria-hidden="true"></i>
              <div class="stat-value">62</div>
              <div class="stat-name" data-i18n="home.stats.grupos">Grupos activos</div>
            </div>
            <div class="stat-item">
              <i class="bi bi-people" aria-hidden="true"></i>
              <div class="stat-value">1215</div>
              <div class="stat-name" data-i18n="home.stats.estudiantes">Estudiantes de la institución</div>
            </div>
            <div class="stat-item">
              <i class="bi bi-geo-alt" aria-hidden="true"></i>
              <div class="stat-value">3</div>
              <div class="stat-name" data-i18n="home.stats.anexos">Anexos</div>
            </div>
            <div class="stat-item">
              <i class="bi bi-person-workspace" aria-hidden="true"></i>
              <div class="stat-value">120</div>
              <div class="stat-name" data-i18n="home.stats.docentes">Funcionarios docentes</div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php /* require de footer y scripts  */ ?>
<?php require_once __DIR__ . "/requires/footer_scripts.php"; ?>