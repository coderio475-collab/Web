<?php
/**
 * Catálogo de cursos y carreras: organiza la oferta por nivel y sector.

 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Cursos y Carreras - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Cursos y carreras de la Escuela Técnica N.º 1 de Bella Unión, ordenados por tipo de curso y sector.';
$assetBase = '../';
// ---------- Inicio  ----------
require_once __DIR__ . '/../requires/head.php';
?>
<body data-i18n-title="cursos.title" data-root="../">
    <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>

    <!-- ======================= HERO (título de la página) ======================= -->
    <section class="hero hero-simple">
      <div class="container hero-inner text-center">
        <span class="hero-eyebrow" data-i18n="cursos.hero.eyebrow">Oferta educativa</span>
        <div class="hero-title-row">
          <span class="hero-icon" aria-hidden="true"><i class="bi bi-mortarboard"></i></span>
          <h1 data-i18n="cursos.hero.title">Cursos y Carreras</h1>
        </div>
        <p class="lead-text mx-auto" data-i18n="cursos.hero.lead">Oferta educativa de la Escuela Técnica N.º 1 y sus anexos, ordenada por tipo de curso y sector de estudio.</p>
      </div>
    </section>

    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container section-pad">

      <!-- ======================= INFORMACIÓN Y ACCESO A INSCRIPCIONES ======================= -->
      
      <div class="page-actions mb-3">
        <div class="note-box">
          <i class="bi bi-info-circle me-1"></i>
          <span data-i18n="cursos.areas.note">Consultá el listado completo y actualizado de cursos por orientación en el sitio oficial de UTU.</span>
          <a
              href="https://www.utu.edu.uy/estudia/"
              target="_blank"
              rel="noopener"
              class="terms-link ms-1"
              data-i18n="cursos.areas.link">Ver Estudiá en UTU</a>
        </div>
        <a href="inscripciones.php" class="btn btn-gold"><i class="bi bi-pencil-square"></i> <span data-i18n="cursos.cta">Quiero inscribirme</span></a>
      </div>
      <div class="note-box mb-5">
        <i class="bi bi-info-circle me-1" aria-hidden="true"></i>
        <span data-i18n="common.plans.note">Para consultar las materias y planes de estudio de los cursos de la UTU</span>
        <a href="https://planeamientoeducativo.utu.edu.uy/tablaplanesprogrmasnueva" target="_blank" rel="noopener" class="terms-link ms-1" data-i18n="common.plans.link">Ver materias y planes de estudio</a>
      </div>

      <!-- ======================= FILTROS POR SECTOR ======================= -->
     
      <section class="mb-5" aria-label="Sectores de estudio">
        <span class="section-kicker" data-i18n="cursos.areas.kicker">Orientaciones</span>
        <h2 class="section-title" data-i18n="cursos.areas.title">Sectores de estudio</h2>
        <!-- Botones de filtro por sector  -->
        <div class="sector-filter">
          <button type="button" class="sector-chip active" data-sector="todos"><i class="bi bi-grid" aria-hidden="true"></i> <span data-i18n="cursos.filter.all">Todos</span></button>
          <button type="button" class="sector-chip" data-sector="agro"><i class="bi bi-flower2" aria-hidden="true"></i> <span data-i18n="cursos.s.agro">Agropecuario</span></button>
          <button type="button" class="sector-chip" data-sector="comer"><i class="bi bi-briefcase" aria-hidden="true"></i> <span data-i18n="cursos.s.comer">Comercio Y Administración</span></button>
          <button type="button" class="sector-chip" data-sector="constr"><i class="bi bi-bricks" aria-hidden="true"></i> <span data-i18n="cursos.s.constr">Construcción Y Arquitectura</span></button>
          <button type="button" class="sector-chip" data-sector="deporte"><i class="bi bi-trophy" aria-hidden="true"></i> <span data-i18n="cursos.s.deporte">Deporte Y Afines</span></button>
          <button type="button" class="sector-chip" data-sector="diseno"><i class="bi bi-palette" aria-hidden="true"></i> <span data-i18n="cursos.s.diseno">Diseño Gráfico</span></button>
          <button type="button" class="sector-chip" data-sector="electr"><i class="bi bi-lightning-charge" aria-hidden="true"></i> <span data-i18n="cursos.s.electr">Electricidad Y Electrónica</span></button>
          <button type="button" class="sector-chip" data-sector="gastro"><i class="bi bi-cup-hot" aria-hidden="true"></i> <span data-i18n="cursos.s.gastro">Gastronomía</span></button>
          <button type="button" class="sector-chip" data-sector="inform"><i class="bi bi-pc-display" aria-hidden="true"></i> <span data-i18n="cursos.s.inform">Informática</span></button>
          <button type="button" class="sector-chip" data-sector="madera"><i class="bi bi-hammer" aria-hidden="true"></i> <span data-i18n="cursos.s.madera">Madera Y Muebles</span></button>
          <button type="button" class="sector-chip" data-sector="metal"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i> <span data-i18n="cursos.s.metal">Metal-Mecánica</span></button>
          <button type="button" class="sector-chip" data-sector="emb"><i class="bi bi-journal-bookmark" aria-hidden="true"></i> <span data-i18n="cursos.s.emb">Programa Educación Media Básica</span></button>
          <button type="button" class="sector-chip" data-sector="servic"><i class="bi bi-heart-pulse" aria-hidden="true"></i> <span data-i18n="cursos.s.servic">Servicios Personales</span></button>
          <button type="button" class="sector-chip" data-sector="textil"><i class="bi bi-scissors" aria-hidden="true"></i> <span data-i18n="cursos.s.textil">Textil Y Confección De Vestimenta</span></button>
        </div>
      </section>

      <!-- ======================= CICLO BÁSICO ======================= -->
      <section class="level-block" id="cb">
        <div class="level-head">
          <div class="card-icon"><i class="bi bi-journal-bookmark" aria-hidden="true"></i></div>
          <div>
            <h2 data-i18n="cursos.n.cb">Ciclo Básico</h2>
            <p data-i18n="cursos.nd.cb">Ciclo básico de 7º a 9º año (Educación Básica Integrada): formación general y talleres introductorios para iniciar el trayecto en la educación técnica.</p>
          </div>
        </div>
        <div class="course-full-grid">
          <!-- Tarjetas de cursos -->
          <article class="course-full" data-sector="emb">
            <span class="course-icon"><i class="bi bi-7-square" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.ebi7">EBI 7º</h3>
              <span class="sector-tag"><i class="bi bi-journal-bookmark" aria-hidden="true"></i> <span data-i18n="cursos.s.emb">Programa Educación Media Básica</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="emb">
            <span class="course-icon"><i class="bi bi-8-square" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.ebi8">EBI 8º</h3>
              <span class="sector-tag"><i class="bi bi-journal-bookmark" aria-hidden="true"></i> <span data-i18n="cursos.s.emb">Programa Educación Media Básica</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="emb">
            <span class="course-icon"><i class="bi bi-9-square" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.ebi9">EBI 9º</h3>
              <span class="sector-tag"><i class="bi bi-journal-bookmark" aria-hidden="true"></i> <span data-i18n="cursos.s.emb">Programa Educación Media Básica</span></span>
            </div>
          </article>
        </div>
      </section>
       
      <!-- ======================= BACHILLERATO TECNOLÓGICO ======================= -->
      <section class="level-block" id="bt">
        <div class="level-head">
          <div class="card-icon"><i class="bi bi-laptop" aria-hidden="true"></i></div>
          <div>
            <h2 data-i18n="cursos.n.bt">Bachillerato Tecnológico (BT)</h2>
            <p data-i18n="cursos.nd.bt">Segundo ciclo con orientación tecnológica, que habilita la continuidad educativa terciaria y la inserción laboral.</p>
          </div>
        </div>
        <div class="course-full-grid">
          <article class="course-full" data-sector="agro">
            <span class="course-icon"><i class="bi bi-flower2" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.agrario">Agrario</h3>
              <span class="sector-tag"><i class="bi bi-flower2" aria-hidden="true"></i> <span data-i18n="cursos.s.agro">Agropecuario</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="deporte">
            <span class="course-icon"><i class="bi bi-trophy" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.deporte">Deporte, Ed. Física Y Recreación</h3>
              <span class="sector-tag"><i class="bi bi-trophy" aria-hidden="true"></i> <span data-i18n="cursos.s.deporte">Deporte Y Afines</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="comer">
            <span class="course-icon"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.gestion">Gestión Y Administración</h3>
              <span class="sector-tag"><i class="bi bi-briefcase" aria-hidden="true"></i> <span data-i18n="cursos.s.comer">Comercio Y Administración</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="inform">
            <span class="course-icon"><i class="bi bi-pc-display" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.tic">Informática - Tecnologías De La Información</h3>
              <span class="sector-tag"><i class="bi bi-pc-display" aria-hidden="true"></i> <span data-i18n="cursos.s.inform">Informática</span></span>
            </div>
          </article>
        </div>
      </section>
       
      <!-- ======================= BACHILLERATO TÉCNICO PROFESIONAL ======================= -->
      <section class="level-block" id="btp">
        <div class="level-head">
          <div class="card-icon"><i class="bi bi-tools" aria-hidden="true"></i></div>
          <div>
            <h2 data-i18n="cursos.n.btp">Bachillerato Técnico Profesional (BTP)</h2>
            <p data-i18n="cursos.nd.btp">Formación de nivel medio superior con especialización técnica y prácticas profesionales vinculadas al sector productivo.</p>
          </div>
        </div>
        <div class="course-full-grid">
          <article class="course-full" data-sector="electr">
            <span class="course-icon"><i class="bi bi-lightning-charge" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.instel">Instalaciones Eléctricas</h3>
              <span class="sector-tag"><i class="bi bi-lightning-charge" aria-hidden="true"></i> <span data-i18n="cursos.s.electr">Electricidad Y Electrónica</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="gastro">
            <span class="course-icon"><i class="bi bi-cup-hot" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.cocina">Cocina</h3>
              <span class="sector-tag"><i class="bi bi-cup-hot" aria-hidden="true"></i> <span data-i18n="cursos.s.gastro">Gastronomía</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="servic">
            <span class="course-icon"><i class="bi bi-stars" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.estpers">Estética Personal</h3>
              <span class="sector-tag"><i class="bi bi-heart-pulse" aria-hidden="true"></i> <span data-i18n="cursos.s.servic">Servicios Personales</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="constr">
            <span class="course-icon"><i class="bi bi-bricks" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.edif">Edificaciones De Obra Civil</h3>
              <span class="sector-tag"><i class="bi bi-bricks" aria-hidden="true"></i> <span data-i18n="cursos.s.constr">Construcción Y Arquitectura</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="gastro">
            <span class="course-icon"><i class="bi bi-egg-fried" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.gastro">Gastronomía</h3>
              <span class="sector-tag"><i class="bi bi-cup-hot" aria-hidden="true"></i> <span data-i18n="cursos.s.gastro">Gastronomía</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="servic">
            <span class="course-icon"><i class="bi bi-heart-pulse" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.bienest">Bienestar Y Salud</h3>
              <span class="sector-tag"><i class="bi bi-heart-pulse" aria-hidden="true"></i> <span data-i18n="cursos.s.servic">Servicios Personales</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="textil">
            <span class="course-icon"><i class="bi bi-scissors" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.indum">Indumentaria Textil</h3>
              <span class="sector-tag"><i class="bi bi-scissors" aria-hidden="true"></i> <span data-i18n="cursos.s.textil">Textil Y Confección De Vestimenta</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="metal">
            <span class="course-icon"><i class="bi bi-wrench-adjustable" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.mantind">Mantenimiento Industrial</h3>
              <span class="sector-tag"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i> <span data-i18n="cursos.s.metal">Metal-Mecánica</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="comer">
            <span class="course-icon"><i class="bi bi-cart3" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.comercio">Comercio Y Ventas</h3>
              <span class="sector-tag"><i class="bi bi-briefcase" aria-hidden="true"></i> <span data-i18n="cursos.s.comer">Comercio Y Administración</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="madera">
            <span class="course-icon"><i class="bi bi-hammer" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.muebdis">Mueble Por Diseño</h3>
              <span class="sector-tag"><i class="bi bi-hammer" aria-hidden="true"></i> <span data-i18n="cursos.s.madera">Madera Y Muebles</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="metal">
            <span class="course-icon"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.mecind">Mecánica Industrial</h3>
              <span class="sector-tag"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i> <span data-i18n="cursos.s.metal">Metal-Mecánica</span></span>
            </div>
          </article>
        </div>
      </section>
       
      <!-- ======================= FORMACIÓN PROFESIONAL BÁSICA ======================= -->
      <section class="level-block" id="fpb">
        <div class="level-head">
          <div class="card-icon"><i class="bi bi-briefcase" aria-hidden="true"></i></div>
          <div>
            <h2 data-i18n="cursos.n.fpb">Formación Profesional Básica (FPB)</h2>
            <p data-i18n="cursos.nd.fpb">Trayectos orientados a una salida laboral concreta, con fuerte carga práctica en taller y oficios técnicos.</p>
          </div>
        </div>
        <div class="course-full-grid">
          <article class="course-full" data-sector="servic">
            <span class="course-icon"><i class="bi bi-scissors" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.estcap">Estética Capilar</h3>
              <span class="sector-tag"><i class="bi bi-heart-pulse" aria-hidden="true"></i> <span data-i18n="cursos.s.servic">Servicios Personales</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="gastro">
            <span class="course-icon"><i class="bi bi-basket" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.alimen">Alimentación</h3>
              <span class="sector-tag"><i class="bi bi-cup-hot" aria-hidden="true"></i> <span data-i18n="cursos.s.gastro">Gastronomía</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="metal">
            <span class="course-icon"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.mecfpb">Mecánica</h3>
              <span class="sector-tag"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i> <span data-i18n="cursos.s.metal">Metal-Mecánica</span></span>
            </div>
          </article>
        </div>
      </section>
       
      <!-- ======================= CURSOS TÉCNICOS TERCIARIOS ======================= -->
      <section class="level-block" id="ctt">
        <div class="level-head">
          <div class="card-icon"><i class="bi bi-gear" aria-hidden="true"></i></div>
          <div>
            <h2 data-i18n="cursos.n.ctt">Curso Técnico Terciario (CTT)</h2>
            <p data-i18n="cursos.nd.ctt">Carreras terciarias cortas con foco en competencias técnicas específicas y alta empleabilidad.</p>
          </div>
        </div>
        <div class="course-full-grid">
          <article class="course-full" data-sector="diseno">
            <span class="course-icon"><i class="bi bi-palette" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.dgrafico">Diseño Gráfico</h3>
              <span class="sector-tag"><i class="bi bi-palette" aria-hidden="true"></i> <span data-i18n="cursos.s.diseno">Diseño Gráfico</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="comer">
            <span class="course-icon"><i class="bi bi-clipboard-data" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.admin">Administración</h3>
              <span class="sector-tag"><i class="bi bi-briefcase" aria-hidden="true"></i> <span data-i18n="cursos.s.comer">Comercio Y Administración</span></span>
            </div>
          </article>
          <article class="course-full" data-sector="inform">
            <span class="course-icon"><i class="bi bi-hdd-network" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.redes">Redes Y Software</h3>
              <span class="sector-tag"><i class="bi bi-pc-display" aria-hidden="true"></i> <span data-i18n="cursos.s.inform">Informática</span></span>
            </div>
          </article>
        </div>
      </section>
       
      <!-- ======================= TECNÓLOGO ======================= -->
      <section class="level-block" id="tec">
        <div class="level-head">
          <div class="card-icon"><i class="bi bi-flower1" aria-hidden="true"></i></div>
          <div>
            <h2 data-i18n="cursos.n.tec">Tecnólogo</h2>
            <p data-i18n="cursos.nd.tec">Propuesta terciaria orientada al desarrollo de la producción familiar y agroindustrial de la región.</p>
          </div>
        </div>
        <div class="course-full-grid">
          <article class="course-full" data-sector="agro">
            <span class="course-icon"><i class="bi bi-flower1" aria-hidden="true"></i></span>
            <div>
              <h3 data-i18n="cursos.c.sistagro">Sistemas Agropecuarios Familiares</h3>
              <span class="sector-tag"><i class="bi bi-flower2" aria-hidden="true"></i> <span data-i18n="cursos.s.agro">Agropecuario</span></span>
            </div>
          </article>
        </div>
      </section>
    </main>
    $footerScriptAfter = 'assets/js/cursos.js';
    require_once __DIR__ . '/../requires/footer_scripts.php';
    ?>