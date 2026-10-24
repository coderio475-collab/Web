<?php
/**
 * Consulta de horarios y exámenes publicados por la institución.
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Horarios y Exámenes - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Horarios por materias, exámenes y turnos de la Escuela Técnica N.º 1 de Bella Unión.';
$assetBase = '../';
// ---------- Inicio ----------
require_once __DIR__ . '/../requires/head.php';
?>
    <body data-i18n-title="horarios.title" data-root="../">
      <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>

     <!-- ======================= HERO (título de la página) ======================= -->
    <section class="hero hero-simple">
      <div class="container hero-inner text-center">
        <span class="hero-eyebrow" data-i18n="horarios.hero.eyebrow">Vida académica</span>
        <div class="hero-title-row">
          <span class="hero-icon" aria-hidden="true"><i class="bi bi-clock-history"></i></span>
          <h1 data-i18n="horarios.hero.title">Horarios y Exámenes</h1>
        </div>
        <p class="lead-text mx-auto" data-i18n="horarios.hero.lead">Horarios por materias, calendario de exámenes y turnos disponibles.</p>
      </div>
    </section>

    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container section-pad">

      <!-- ======================= HORARIOS POR MATERIA ======================= -->
      
      <section class="mb-5" id="horarios-materias">
        <h2 class="section-title" data-i18n="horarios.subjectsTitle">Horarios por materias</h2>
        <a
            class="pdf-panel"
            href="../assets/php/archivo.php?tipo=horarios"
            target="_blank"
            rel="noopener">
          <span class="card-icon"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i></span>
          <h3 data-i18n="horarios.subjectsPanel">Horarios de clases por materia</h3>
          <i class="bi bi-box-arrow-up-right pdf-panel-go" aria-hidden="true"></i>
        </a>
      </section>

      <!-- ======================= FECHAS DE EXÁMENES ======================= -->
    
      <section class="mb-5" id="examenes">
        <span class="section-kicker" data-i18n="horarios.examsKicker">Calendario</span>
        <h2 class="section-title" data-i18n="horarios.examsTitle">Fechas de Exámenes</h2>
        <a class="pdf-panel" href="../assets/php/archivo.php?tipo=examenes" target="_blank" rel="noopener">
          <span class="card-icon"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i></span>
          <h3 data-i18n="horarios.examsPanel">Calendario de exámenes</h3>
          <i class="bi bi-box-arrow-up-right pdf-panel-go" aria-hidden="true"></i>
        </a>
      </section>

      <!-- ======================= TURNOS ======================= -->
      
      <section id="turnos">
        <span class="section-kicker" data-i18n="horarios.turnsKicker">Ingreso y salida</span>
        <h2 class="section-title" data-i18n="horarios.turnsTitle">Turnos Disponibles</h2>
        <p class="small text-muted mb-3" data-i18n="horarios.turnsNote">Horarios de referencia.</p>
        <!-- Una tarjeta por turno: matutino, intermedio, vespertino, cuatro y nocturno -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-3">
          <div class="col">
            <div class="card-tech">
              <h3 class="text-gold" data-i18n="horarios.turn1.title">🌅 Turno Matutino</h3>
              <p class="mb-1"><strong data-i18n="horarios.entryLabel">Ingreso:</strong> 07:00 hs</p>
              <p class="mb-0"><strong data-i18n="horarios.exitLabel">Salida:</strong> 13:20 hs</p>
            </div>
          </div>
          <div class="col">
            <div class="card-tech">
              <h3 class="text-gold" data-i18n="horarios.turn2.title">🌤️ Turno Intermedio</h3>
              <p class="mb-1"><strong data-i18n="horarios.entryLabel">Ingreso:</strong> 09:20 hs</p>
              <p class="mb-0"><strong data-i18n="horarios.exitLabel">Salida:</strong> 15:40 hs</p>
            </div>
          </div>
          <div class="col">
            <div class="card-tech">
              <h3 class="text-gold" data-i18n="horarios.turn3.title">☀️ Turno Vespertino</h3>
              <p class="mb-1"><strong data-i18n="horarios.entryLabel">Ingreso:</strong> 12:35 hs</p>
              <p class="mb-0"><strong data-i18n="horarios.exitLabel">Salida:</strong> 18:50 hs</p>
            </div>
          </div>
          <div class="col">
            <div class="card-tech">
              <h3 class="text-gold" data-i18n="horarios.turn4.title">🌇 Turno Cuatro</h3>
              <p class="mb-1"><strong data-i18n="horarios.entryLabel">Ingreso:</strong> 15:40 hs</p>
              <p class="mb-0"><strong data-i18n="horarios.exitLabel">Salida:</strong> 21:45 hs</p>
            </div>
          </div>
          <div class="col">
            <div class="card-tech">
              <h3 class="text-gold" data-i18n="horarios.turn5.title">🌙 Turno Nocturno</h3>
              <p class="mb-1"><strong data-i18n="horarios.entryLabel">Ingreso:</strong> 18:10 hs</p>
              <p class="mb-0"><strong data-i18n="horarios.exitLabel">Salida:</strong> 23:55 hs</p>
            </div>
          </div>
        </div>
      </section>
    </main>



   <?php require_once __DIR__ . '/../requires/footer_scripts.php'; ?>