<?php
/**
 * Noticias institucionales: muestra las novedades recientes y la agenda.
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Noticias - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Noticias y eventos de la Escuela Técnica N.º 1 de Bella Unión.';
$assetBase = '../';
require_once __DIR__ . '/../assets/php/contenido_publico.php';
$agendaEventos = obtener_eventos_agenda();
$titulosImagenes = obtener_titulos_imagenes();
// ---------- Inicio  ----------
require_once __DIR__ . '/../requires/head.php';
?>
<body data-i18n-title="noticias.title" data-root="../">
    
    <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>

     <!-- ======================= HERO (título de la página) ======================= -->
    <section class="hero hero-simple">
      <div class="container hero-inner text-center">
        <span class="hero-eyebrow" data-i18n="noticias.hero.eyebrow">Comunidad educativa</span>
        <div class="hero-title-row">
          <span class="hero-icon" aria-hidden="true"><i class="bi bi-newspaper"></i></span>
          <h1 data-i18n="noticias.hero.title">Noticias y Eventos</h1>
        </div>
        <p class="lead-text mx-auto" data-i18n="noticias.hero.lead">Actualidad institucional, agenda de actividades y galería de la comunidad educativa.</p>
      </div>
    </section>

    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container section-pad">
      <!-- ======================= NOTICIAS Y AGENDA ======================= -->
      <!-- Dos columnas: noticias (izquierda) y agenda de eventos (derecha) -->
      <div class="row g-4 g-lg-5">

        <div class="col-lg-7">
          <span class="section-kicker" data-i18n="noticias.newsKicker">Informativas</span>
          <h2 class="section-title" data-i18n="noticias.newsTitle">Noticias</h2>
          <!-- Cada tarjeta conserva su clave de traducción y ubicación de imagen. -->
          <article class="news-card">
            <div class="news-media img-placeholder">
              <img class="managed-image" src="../assets/php/imagen.php?ubicacion=noticia_1" alt="Imagen de noticia 1">
              <i class="bi bi-camera"></i>
              <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
            </div>
            <div class="news-card-body">
              <span class="status-pill status-media mb-2 d-inline-block" data-i18n="noticias.filter.acad">Académicas</span>
              <h3 class="h6"<?= atributo_i18n_titulo_destacado('noticia_1', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('noticia_1', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
              <p class="small text-muted mb-2" data-i18n="noticias.n1.date">📅 Publicado el 15 de Junio, 2026</p>
              <p class="small mb-0" data-i18n="noticias.n1.text">Un espacio equipado con estaciones de robótica y realidad virtual para proyectos de fin de curso.</p>
            </div>
          </article>
          <article class="news-card">
            <div class="news-media img-placeholder">
              <img class="managed-image" src="../assets/php/imagen.php?ubicacion=noticia_2" alt="Imagen de noticia 2">
              <i class="bi bi-camera"></i>
              <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
            </div>
            <div class="news-card-body">
              <span class="status-pill status-media mb-2 d-inline-block" data-i18n="noticias.filter.inv">Investigación</span>
              <h3 class="h6"<?= atributo_i18n_titulo_destacado('noticia_2', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('noticia_2', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
              <p class="small text-muted mb-2" data-i18n="noticias.n2.date">📅 Publicado el 10 de Junio, 2026</p>
              <p class="small mb-0" data-i18n="noticias.n2.text">El sistema de paneles móviles del taller de electrónica obtuvo el primer puesto en el certamen anual.</p>
            </div>
          </article>
          <article class="news-card">
            <div class="news-media img-placeholder">
              <img class="managed-image" src="../assets/php/imagen.php?ubicacion=noticia_3" alt="Imagen de noticia 3">
              <i class="bi bi-camera"></i>
              <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
            </div>
            <div class="news-card-body">
              <span class="status-pill status-media mb-2 d-inline-block" data-i18n="noticias.filter.inst">Institucionales</span>
              <h3 class="h6"<?= atributo_i18n_titulo_destacado('noticia_3', $titulosImagenes) ?>><?= htmlspecialchars(titulo_destacado('noticia_3', $titulosImagenes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
              <p class="small text-muted mb-2" data-i18n="noticias.n3.date">📅 Publicado el 3 de Junio, 2026</p>
              <p class="small mb-0" data-i18n="noticias.n3.text">Nueva alianza estratégica para becas de movilidad estudiantil durante el próximo semestre.</p>
            </div>
          </article>
        </div>

        <!-- Columna derecha: agenda  -->
        <div class="col-lg-5">
          <span class="section-kicker" data-i18n="noticias.eventsKicker">Agenda</span>
          <h2 class="section-title" data-i18n="noticias.eventsTitle">Eventos</h2>
          <div class="agenda-card h-auto">
            <div class="agenda-list">
              <?php /* Una fila por cada evento de la agenda */ ?>
              <?php foreach ($agendaEventos as $evento): ?>
                <div class="agenda-row">
                  <span class="agenda-date"><?= htmlspecialchars(date('d/m', strtotime($evento['fecha'])), ENT_QUOTES, 'UTF-8') ?></span>
                  <p<?= atributo_i18n_agenda($evento) ?>><?= htmlspecialchars($evento['titulo'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- ======================= EVENTOS PRÓXIMOS ======================= -->
      <!-- Eventos próximos . -->
      <section class="mt-5">
        <h2 class="section-title" data-i18n="noticias.galleryTitle">Galería de la Institución</h2>
        <!-- ======================= GALERÍA DE IMÁGENES ======================= -->
        <!-- Galería de 3 imágenes (galeria_1 a galeria_3,) -->
        <div class="gallery-grid">
          <div class="img-placeholder">
            <img class="managed-image" src="../assets/php/imagen.php?ubicacion=galeria_1" alt="Galería institucional, imagen 1">
            <i class="bi bi-image"></i>
            <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
          </div>
          <div class="img-placeholder">
            <img class="managed-image" src="../assets/php/imagen.php?ubicacion=galeria_2" alt="Galería institucional, imagen 2">
            <i class="bi bi-image"></i>
            <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
          </div>
          <div class="img-placeholder">
            <img class="managed-image" src="../assets/php/imagen.php?ubicacion=galeria_3" alt="Galería institucional, imagen 3">
            <i class="bi bi-image"></i>
            <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
          </div>
        </div>
      </section>
    </main>

 <?php /* Pie de página y scripts  (footer_scripts.php) */ ?>
<?php
$footerScriptAfter = 'assets/js/imagenes.js';
require_once __DIR__ . '/../requires/footer_scripts.php';
?>