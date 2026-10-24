<?php
/**
 * Formularios  para reservar cupos estudiantiles o enviar solicitudes docentes
 * 
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Inscripciones - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Formulario de inscripción para reservar cupos en la Escuela Técnica N.º 1 de Bella Unión.';
$assetBase = '../';
// ---------- Inicio ----------
require_once __DIR__ . '/../requires/head.php';
?>    <body >
      <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>


      

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
 
  
   
   <?php /* Pie de página y scripts  (footer_scripts.php) */ ?>
  <?php
$footerScriptAfter = 'assets/js/inscripciones.js';
$footerScriptAfter2 = 'assets/js/docentes.js';
require_once __DIR__ . '/../requires/footer_scripts.php';
?>