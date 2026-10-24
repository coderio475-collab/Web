<?php
/**
 * Página de consulta de normas y vestimenta institucional.
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Normativa - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Vestimenta y normativa de la Escuela Técnica N.º 1 de Bella Unión.';
$assetBase = '../';
require_once __DIR__ . '/../assets/php/contenido_publico.php';
$textosVestimenta = obtener_titulos_imagenes();
// ---------- Inicio ----------
require_once __DIR__ . '/../requires/head.php';
?>
<body data-i18n-title="normativa.title" data-root="../">

    <!-- ======================= Encabezado ======================= -->
    <?php require_once __DIR__ . '/../requires/header.php'; ?>
    <!-- ======================= HERO (título de la página) ======================= -->
    <section class="hero hero-simple">
      <div class="container hero-inner text-center">
        <span class="hero-eyebrow" data-i18n="normativa.hero.eyebrow">Institución</span>
        <div class="hero-title-row">
          <span class="hero-icon" aria-hidden="true"><i class="bi bi-journal-text"></i></span>
          <h1 data-i18n="normativa.hero.title">Normativa</h1>
        </div>
        <p class="lead-text mx-auto" data-i18n="normativa.hero.lead">Vestimenta del año y documentos normativos que rigen la educación técnico profesional.</p>
      </div>
    </section>

    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container section-pad">

      <!-- ======================= VESTIMENTA ======================= -->
      <!-- Uniformes del año  -->
      <section class="mb-5">
        <h2 class="section-title" data-i18n="normativa.dress.title">Vestimenta de este año</h2>
        <div class="d-grid gap-4">
          <!-- Uniforme de Ciclo Básico -->
          <div class="dress-card">
            <div class="img-placeholder">
              <img class="managed-image" src="../assets/php/imagen.php?ubicacion=vestimenta_basico" alt="Uniforme estudiantil de Ciclo Básico">
              <i class="bi bi-person-standing"></i>
              <span data-i18n="normativa.dress.img">Foto o dibujo — próximamente</span>
            </div>
            <div>
              <h3 data-i18n="normativa.dress.cb">Uniforme estudiantil · Ciclo Básico</h3>
              <ul class="dress-list">
                <li>
                  <i class="bi bi-check2-circle" aria-hidden="true"></i>
                  <span<?= atributo_i18n_texto_vestimenta('vestimenta_basico_remera', $textosVestimenta) ?>><?= htmlspecialchars(texto_vestimenta('vestimenta_basico_remera', $textosVestimenta), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                </li>
                <li>
                  <i class="bi bi-check2-circle" aria-hidden="true"></i>
                  <span<?= atributo_i18n_texto_vestimenta('vestimenta_basico_jean', $textosVestimenta) ?>><?= htmlspecialchars(texto_vestimenta('vestimenta_basico_jean', $textosVestimenta), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                </li>
              </ul>
            </div>
          </div>
          <!-- Uniforme de Educación Media -->
          <div class="dress-card">
            <div class="img-placeholder">
              <img class="managed-image" src="../assets/php/imagen.php?ubicacion=vestimenta_media" alt="Uniforme estudiantil de Educación Media">
              <i class="bi bi-person-standing"></i>
              <span data-i18n="normativa.dress.img">Foto o dibujo — próximamente</span>
            </div>
            <div>
              <h3 data-i18n="normativa.dress.em">Uniforme estudiantil · Educación Media</h3>
              <ul class="dress-list">
                <li>
                  <i class="bi bi-check2-circle" aria-hidden="true"></i>
                  <span<?= atributo_i18n_texto_vestimenta('vestimenta_media_remera', $textosVestimenta) ?>><?= htmlspecialchars(texto_vestimenta('vestimenta_media_remera', $textosVestimenta), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                </li>
                <li>
                  <i class="bi bi-check2-circle" aria-hidden="true"></i>
                  <span<?= atributo_i18n_texto_vestimenta('vestimenta_media_jean', $textosVestimenta) ?>><?= htmlspecialchars(texto_vestimenta('vestimenta_media_jean', $textosVestimenta), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <!-- ======================= NORMATIVA ======================= -->
      <!-- Enlaces a los documentos oficiales de UTU -->
      <section>
        <h2 class="section-title" data-i18n="normativa.list.title">Normativa</h2>
        <ul class="norm-list">
          <li>
            <a href="https://www.utu.edu.uy/normativas/" target="_blank" rel="noopener"><i class="bi bi-file-earmark-text norm-icon" aria-hidden="true"></i><span data-i18n="normativa.link">Las normativas de la institución</span><i class="bi bi-arrow-right norm-arrow" aria-hidden="true"></i></a>
          </li>
        </ul>
      </section>
    </main>

<?php /* Pie de página y scripts (footer_scripts.php) */ ?>
<?php
$footerScriptAfter = 'assets/js/imagenes.js';
require_once __DIR__ . '/../requires/footer_scripts.php';
?>
