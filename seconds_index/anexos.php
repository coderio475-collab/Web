<?php
/**
 * Página de anexos: presenta las sedes y sus datos de ubicación.
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Anexos - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Anexos de la Escuela Técnica N.º 1 de Bella Unión: noticias, horarios de atención y ubicación.';
$assetBase = '../';
// ---------- Inicio  ----------
require_once __DIR__ . '/../requires/head.php';
?>
<body data-i18n-title="anexos.title" data-root="../">
    <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>

    <!-- ======================= HERO (título de la página) ======================= -->
    <section class="hero hero-simple">
      <div class="container hero-inner text-center">
        <span class="hero-eyebrow" data-i18n="anexos.hero.eyebrow">Presencia regional</span>
        <div class="hero-title-row">
          <span class="hero-icon" aria-hidden="true"><i class="bi bi-buildings"></i></span>
          <h1 data-i18n="anexos.hero.title">Anexos</h1>
        </div>
        <p class="lead-text mx-auto" data-i18n="anexos.hero.lead">Noticias, horarios de atención y ubicación de cada uno de nuestros anexos.</p>
      </div>
    </section>

    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container section-pad">
      <!-- ======================= SELECCIÓN DE SEDE ======================= -->
      
      <div class="tabs-container" role="tablist">
        <button class="tab-btn active" type="button" data-sede="polideportivo" data-i18n="anexos.tab1">Anexo Polideportivo</button>
        <button class="tab-btn" type="button" data-sede="baltasar" data-i18n="anexos.tab2">Anexo Baltasar Brum</button>
        <button class="tab-btn" type="button" data-sede="gomensoro" data-i18n="anexos.tab3">Anexo T. Gomensoro</button>
      </div>

      <!-- ============ SEDE 1: ANEXO POLIDEPORTIVO ============ -->
      <div id="sede-polideportivo" class="sede-panel active">
        <h2 class="section-title" data-i18n="anexos.pol.title">Anexo Polideportivo Bella Unión</h2>
        <p class="text-muted" data-i18n="anexos.pol.desc">Anexo dedicado a la Educación Básica Integrada y actividades extracurriculares deportivas, ubicado en Avenida Artigas y Martín Dermit.</p>
        <div class="row g-4 mt-1">
          <div class="col-lg-7">
            <h3 class="h6 mb-3" data-i18n="anexos.localNewsTitle">Noticias Locales</h3>
            <div class="info-card">
              <h4 class="h6" data-i18n="anexos.pol.n1.title">Nuevo equipamiento para el gimnasio cubierto</h4>
              <p class="small text-muted mb-1" data-i18n="anexos.pol.n1.date">Anexo Polideportivo · Publicado hace 4 días</p>
              <p class="mb-0" data-i18n="anexos.pol.n1.text">Se incorporó equipamiento deportivo para las actividades curriculares y extracurriculares del turno matutino.</p>
            </div>
            <div class="info-card mt-3">
              <h4 class="h6" data-i18n="anexos.pol.n2.title">Inscripciones abiertas para EBI 2027</h4>
              <p class="small text-muted mb-1" data-i18n="anexos.pol.n2.date">Anexo Polideportivo · Publicado hace 1 semana</p>
              <p class="mb-0" data-i18n="anexos.pol.n2.text">Bedelía informa el inicio del período de preinscripción para primer año de Educación Básica Integrada.</p>
            </div>
          </div>
          <div class="col-lg-5">
            <!-- Imágenes de la sede  -->
            <div class="side-images">
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_polideportivo_1" alt="Anexo Polideportivo, imagen 1">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_polideportivo_2" alt="Anexo Polideportivo, imagen 2">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_polideportivo_3" alt="Anexo Polideportivo, imagen 3">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
            </div>
          </div>
        </div>
         
        <!-- Horarios de atención de la sede -->
        <div class="info-card hours-card">
          <h3 class="h6" data-i18n="anexos.hoursTitle">Horarios de Atención</h3>
          <p class="mb-1"><strong data-i18n="sedes.bedeliaLabel">Bedelía general:</strong> 08:00 a 14:00 hs</p>
          <p class="mb-1"><strong data-i18n="sedes.secretariaLabel">Secretaría:</strong> 14:00 a 18:00 hs</p>
        </div>
         
        <!-- Mapa provisional compartido con los demás anexos hasta recibir sus ubicaciones. -->
        <div class="map-embed">
          <iframe src="<?= url_externo('anexos_maps', $enlacesExternos) ?>" title="Ubicación en Google Maps" allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
      </div>

      <!-- ============ SEDE 2: ANEXO BALTASAR BRUM ============ -->
      <div id="sede-baltasar" class="sede-panel">
        <h2 class="section-title" data-i18n="anexos.brum.title">Anexo Baltasar Brum</h2>
        <p class="text-muted" data-i18n="anexos.brum.desc">Ubicado en José Batlle y Ordóñez, entre 25 de Agosto y Sixto Fleitas.</p>
        <div class="row g-4 mt-1">
          <div class="col-lg-7">
            <h3 class="h6 mb-3" data-i18n="anexos.localNewsTitle">Noticias Locales</h3>
            <div class="info-card">
              <h4 class="h6" data-i18n="anexos.brum.n1.title">Mantenimiento programado de red interna</h4>
              <p class="small text-muted mb-1" data-i18n="anexos.brum.n1.date">Anexo Brum · Publicado hoy</p>
              <p class="mb-0" data-i18n="anexos.brum.n1.text">Este sábado se realizarán actualizaciones de conectividad de fibra óptica en el bloque B.</p>
            </div>
            <div class="info-card mt-3">
              <h4 class="h6" data-i18n="anexos.brum.n2.title">Talleres de Robótica Inicial los días viernes</h4>
              <p class="small text-muted mb-1" data-i18n="anexos.brum.n2.date">Anexo Brum · Publicado hace 3 días</p>
              <p class="mb-0" data-i18n="anexos.brum.n2.text">Comienzan las inscripciones presenciales en bedelía local para los cursos extracurriculares del mes.</p>
            </div>
          </div>
          <div class="col-lg-5">
            <!-- Imágenes de la sede  -->
            <div class="side-images">
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_baltasar_1" alt="Anexo Baltasar Brum, imagen 1">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_baltasar_2" alt="Anexo Baltasar Brum, imagen 2">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_baltasar_3" alt="Anexo Baltasar Brum, imagen 3">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
            </div>
          </div>
        </div>
         
        <!-- Horarios de atención de la sede -->
        <div class="info-card hours-card">
          <h3 class="h6" data-i18n="anexos.hoursTitle">Horarios de Atención</h3>
          <p class="mb-1"><strong data-i18n="sedes.bedeliaLabel">Bedelía general:</strong> 08:00 a 14:00 hs</p>
          <p class="mb-1"><strong data-i18n="sedes.libraryLabel">Biblioteca:</strong> 09:00 a 18:00 hs</p>
        </div>
         
        <!-- Mapa provisional compartido con los demás anexos hasta recibir sus ubicaciones. -->
        <div class="map-embed">
          <iframe src="<?= url_externo('anexo_baltasar_maps', $enlacesExternos) ?>" title="Ubicación del Anexo Baltasar Brum en Google Maps" allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
      </div>

      <!-- ============ SEDE 3: ANEXO TOMÁS GOMENSORO ============ -->
      <div id="sede-gomensoro" class="sede-panel">
        <h2 class="section-title" data-i18n="anexos.gomen.title">Anexo Tomás Gomensoro</h2>
        <p class="text-muted" data-i18n="anexos.gomen.desc">Sede especializada en ciencias agrarias, ubicada en 25 de Agosto y Manuel Jesús González.</p>
        <div class="row g-4 mt-1">
          <div class="col-lg-7">
            <h3 class="h6 mb-3" data-i18n="anexos.localNewsTitle">Noticias Locales</h3>
            <div class="info-card">
              <h4 class="h6" data-i18n="anexos.gomen.n1.title">Adquisición de maquinaria de ensayo agroindustrial</h4>
              <p class="small text-muted mb-1" data-i18n="anexos.gomen.n1.date">Anexo Gomensoro · Publicado hace 1 semana</p>
              <p class="mb-0" data-i18n="anexos.gomen.n1.text">Se integraron nuevas herramientas al taller de campo para mediciones automatizadas.</p>
            </div>
          </div>
          <div class="col-lg-5">
            <!-- Imágenes de la sede  -->
            <div class="side-images">
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_gomensoro_1" alt="Anexo Tomás Gomensoro, imagen 1">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_gomensoro_2" alt="Anexo Tomás Gomensoro, imagen 2">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
              <div class="img-placeholder">
                <img class="managed-image" src="../assets/php/imagen.php?ubicacion=anexo_gomensoro_3" alt="Anexo Tomás Gomensoro, imagen 3">
                <i class="bi bi-image"></i>
                <span data-i18n="common.imgPlaceholder">Imagen institucional — próximamente</span>
              </div>
            </div>
          </div>
        </div>
         
        <!-- Horarios de atención de la sede -->
        <div class="info-card hours-card">
          <h3 class="h6" data-i18n="anexos.hoursTitle">Horarios de Atención</h3>
          <p class="mb-1"><strong data-i18n="sedes.adminLabel">Administración local:</strong> 13:00 a 19:00 hs</p>
          <p class="mb-1"><strong data-i18n="sedes.workshopsLabel">Talleres e infraestructura:</strong> 07:00 a 17:00 hs</p>
        </div>
         
        <!-- Mapa provisional compartido con los demás anexos hasta recibir sus ubicaciones. -->
        <div class="map-embed">
          <iframe src="<?= url_externo('anexo_gomensoro_maps', $enlacesExternos) ?>" title="Ubicación del Anexo Tomás Gomensoro en Google Maps" allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
      </div>
    </main>

    


<?php /* Pie de página y scripts  (footer_scripts.php) */ ?>
<?php
$footerScriptBefore = 'assets/js/imagenes.js';
$footerScriptAfter = 'assets/js/anexos.js';
require_once __DIR__ . '/../requires/footer_scripts.php';
?>
