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
?>    <body data-i18n-title="inscripciones.title" data-root="../">
      <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>

    <!-- ======================= HERO (título de la página) ======================= -->
    <section class="hero hero-simple">
      <div class="container hero-inner text-center">
        <span class="hero-eyebrow" data-i18n="inscripciones.hero.eyebrow">Admisiones</span>
        <div class="hero-title-row">
          <span class="hero-icon" aria-hidden="true"><i class="bi bi-pencil-square"></i></span>
          <h1 data-i18n="inscripciones.hero.title">Inscripciones</h1>
        </div>
        <p class="lead-text mx-auto" data-i18n="inscripciones.hero.lead">Reservá tu cupo en nuestros cursos.</p>
      </div>
    </section>

    <!-- ======================= CONTENIDO PRINCIPAL ======================= -->
    <main class="container section-pad">
      <!-- ======================= FORMULARIOS DE ESTUDIANTES Y DOCENTES ======================= -->
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="form-shell">
            <!-- Interruptor para alternar entre los dos formularios -->
            <div class="form-check form-switch form-mode-switch mb-4">
              <input class="form-check-input" type="checkbox" role="switch" id="modo-docente">
              <label class="form-check-label" for="modo-docente">Cambiar al formulario de docentes</label>
            </div>
            <!-- ======================= RESERVA DE CUPO PARA ESTUDIANTES ======================= -->
            
            <section id="panel-estudiantes">
            <h2 class="h4 mb-3 text-gold" data-i18n="inscripciones.formTitle">Formulario de Inscripción de estudiantes para reservar cupos</h2>
             
            <div class="form-intro">
              <i class="bi bi-info-circle" aria-hidden="true"></i>
              <p class="mb-0" data-i18n="inscripciones.intro">Este formulario tiene el fin de reservar cupos para la inscripción. Al reservar tu cupo, para inscribirte definitivamente tenés que concurrir de forma presencial a la institución para confirmar todos los datos.</p>
            </div>
             
            <!-- Mensajes de resultado: inscripciones.js muestra solo uno según ?estado=ok|duplicado|invalido|error que devuelve guardar_inscripcion.php -->
            <div id="msg-ok" class="alert-box is-success" role="status" data-i18n="inscripciones.msg.ok">
              ¡Tu cupo fue reservado! Recordá concurrir de forma presencial a la institución para confirmar la inscripción.
            </div>
            <div
                id="msg-duplicado"
                class="alert-box is-error"
                role="alert"
                data-i18n="inscripciones.msg.duplicado">
              Ya existe una reserva con esa cédula de identidad.
            </div>
            <div
                id="msg-invalido"
                class="alert-box is-error"
                role="alert"
                data-i18n="inscripciones.msg.invalido">
              Algunos datos no son válidos. Revisalos e intentá nuevamente.
            </div>
            <div id="msg-error" class="alert-box is-error" role="alert" data-i18n="inscripciones.msg.error">
              No pudimos guardar tu reserva en este momento. Intentá nuevamente más tarde.
            </div>
             
            <!-- FORMULARIO DE ESTUDIANTES →  
            -->
            <form
                id="inscripcion-form"
                action="../assets/php/guardar_inscripcion.php"
                method="post"
                novalidate>
               
              <!-- Campo  anti-spam -->
              <div class="visually-hidden" aria-hidden="true">
                <label for="sitio_web">No completar</label>
                <input type="text" id="sitio_web" name="sitio_web" tabindex="-1" autocomplete="off">
              </div>
              <!-- Datos personales: nombre, cédula, correo, teléfono y fecha de nacimiento -->
              <div class="mb-3">
                <label for="nombre_completo" class="form-label" data-i18n="inscripciones.nameLabel">Nombre completo</label>
                <input
                    type="text"
                    id="nombre_completo"
                    name="nombre_completo"
                    class="form-control"
                    maxlength="120"
                    autocomplete="name"
                    data-i18n="inscripciones.namePlaceholder"
                    data-i18n-attr="placeholder"
                    placeholder="Nombre completo"
                    required>
                <span class="error-message" id="error-nombre" data-i18n="inscripciones.nameError">El nombre completo es requerido.</span>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cedula" class="form-label" data-i18n="inscripciones.docLabel">Cédula de identidad</label>
                   
                  <input
                      type="text"
                      id="cedula"
                      name="cedula"
                      class="form-control"
                      inputmode="numeric"
                      pattern="[0-9]*"
                      minlength="8"
                      maxlength="8"
                      autocomplete="off"
                      data-i18n="inscripciones.docPlaceholder"
                      data-i18n-attr="placeholder"
                      placeholder="Ej. 45678901"
                      required>
                  <span class="error-message" id="error-cedula" data-i18n="inscripciones.docError">Ingresá 8 números, sin puntos ni guiones.</span>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label" data-i18n="inscripciones.emailLabel">Correo electrónico</label>
                  <input
                      type="email"
                      id="email"
                      name="email"
                      class="form-control"
                      maxlength="150"
                      autocomplete="email"
                      placeholder="nombre@email.com"
                      required>
                  <span class="error-message" id="error-email" data-i18n="inscripciones.emailError">Introducí un formato de email válido.</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="telefono" class="form-label" data-i18n="inscripciones.phoneLabel">Teléfono de contacto</label>
                  <input
                      type="tel"
                      id="telefono"
                      name="telefono"
                      class="form-control"
                      inputmode="numeric"
                      pattern="[0-9]{9}"
                      minlength="9"
                      maxlength="9"
                      autocomplete="tel"
                      data-i18n="inscripciones.phonePlaceholder"
                      data-i18n-attr="placeholder"
                      placeholder="Ej. 099123456"
                      required>
                  <span class="error-message" id="error-telefono" data-i18n="inscripciones.phoneError">Ingresá 9 números, sin puntos ni guiones.</span>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="fecha_nacimiento" class="form-label" data-i18n="inscripciones.birthLabel">Fecha de nacimiento</label>
                  <input
                      type="date"
                      id="fecha_nacimiento"
                      name="fecha_nacimiento"
                      class="form-control"
                      required>
                   
                  <div class="form-text-note" data-i18n="inscripciones.birthNote">
                    Recordá: si sos menor de 18 años, necesitás ir con un tutor a la hora de confirmar la inscripción de forma presencial.
                  </div>
                  <span class="error-message" id="error-fecha" data-i18n="inscripciones.birthError">Ingresá una fecha de nacimiento válida.</span>
                </div>
              </div>
               
              <!-- Campo oculto: inscripciones.js lo pone en 1 si la edad calculada es menor de 18  -->
              <input type="hidden" id="es_menor" name="es_menor" value="0">
              <div class="minor-banner" id="minor-banner">
                <i class="bi bi-person-check me-1"></i>
                <span data-i18n="inscripciones.minorBanner">Datos del tutor cargados. Podés modificarlos si lo necesitás.</span>
                <button
                    type="button"
                    class="btn btn-link btn-sm p-0 ms-1 terms-link"
                    id="edit-tutor-btn"
                    data-i18n="inscripciones.editTutor">Editar datos del tutor</button>
              </div>

              <!-- Tipo de curso y cursos -->
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="tipo_curso" class="form-label" data-i18n="inscripciones.typeLabel">Tipo de curso</label>
                  <select id="tipo_curso" name="tipo_curso" class="form-select" required>
                    <option value="" data-i18n="inscripciones.typePlaceholder">Seleccioná un tipo de curso</option>
                    <option value="Ciclo Básico" data-i18n="cursos.n.cb">Ciclo Básico</option>
                    <option value="Bachillerato Tecnológico (BT)" data-i18n="cursos.n.bt">Bachillerato Tecnológico (BT)</option>
                    <option value="Bachillerato Técnico Profesional (BTP)" data-i18n="cursos.n.btp">Bachillerato Técnico Profesional (BTP)</option>
                    <option value="Formación Profesional Básica (FPB)" data-i18n="cursos.n.fpb">Formación Profesional Básica (FPB)</option>
                    <option value="Curso Técnico Terciario (CTT)" data-i18n="cursos.n.ctt">Curso Técnico Terciario (CTT)</option>
                    <option value="Tecnólogo" data-i18n="cursos.n.tec">Tecnólogo</option>
                  </select>
                  <span class="error-message" id="error-tipo" data-i18n="inscripciones.typeError">Seleccioná un tipo de curso.</span>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="curso" class="form-label" data-i18n="inscripciones.courseLabel">Curso</label>
                  <select id="curso" name="curso" class="form-select" required disabled>
                    <option value="" data-i18n="inscripciones.coursePlaceholder">Primero elegí el tipo de curso</option>
                    <option value="EBI 7º" data-tipo="Ciclo Básico" data-i18n="cursos.c.ebi7">EBI 7º</option>
                    <option value="EBI 8º" data-tipo="Ciclo Básico" data-i18n="cursos.c.ebi8">EBI 8º</option>
                    <option value="EBI 9º" data-tipo="Ciclo Básico" data-i18n="cursos.c.ebi9">EBI 9º</option>
                    <option
                        value="Agrario"
                        data-tipo="Bachillerato Tecnológico (BT)"
                        data-i18n="cursos.c.agrario">Agrario</option>
                    <option
                        value="Deporte, Ed. Física Y Recreación"
                        data-tipo="Bachillerato Tecnológico (BT)"
                        data-i18n="cursos.c.deporte">Deporte, Ed. Física Y Recreación</option>
                    <option
                        value="Gestión Y Administración"
                        data-tipo="Bachillerato Tecnológico (BT)"
                        data-i18n="cursos.c.gestion">Gestión Y Administración</option>
                    <option
                        value="Informática - Tecnologías De La Información"
                        data-tipo="Bachillerato Tecnológico (BT)"
                        data-i18n="cursos.c.tic">Informática - Tecnologías De La Información</option>
                    <option
                        value="Instalaciones Eléctricas"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.instel">Instalaciones Eléctricas</option>
                    <option
                        value="Cocina"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.cocina">Cocina</option>
                    <option
                        value="Estética Personal"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.estpers">Estética Personal</option>
                    <option
                        value="Edificaciones De Obra Civil"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.edif">Edificaciones De Obra Civil</option>
                    <option
                        value="Gastronomía"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.gastro">Gastronomía</option>
                    <option
                        value="Bienestar Y Salud"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.bienest">Bienestar Y Salud</option>
                    <option
                        value="Indumentaria Textil"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.indum">Indumentaria Textil</option>
                    <option
                        value="Mantenimiento Industrial"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.mantind">Mantenimiento Industrial</option>
                    <option
                        value="Comercio Y Ventas"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.comercio">Comercio Y Ventas</option>
                    <option
                        value="Mueble Por Diseño"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.muebdis">Mueble Por Diseño</option>
                    <option
                        value="Mecánica Industrial"
                        data-tipo="Bachillerato Técnico Profesional (BTP)"
                        data-i18n="cursos.c.mecind">Mecánica Industrial</option>
                    <option
                        value="Estética Capilar"
                        data-tipo="Formación Profesional Básica (FPB)"
                        data-i18n="cursos.c.estcap">Estética Capilar</option>
                    <option
                        value="Alimentación"
                        data-tipo="Formación Profesional Básica (FPB)"
                        data-i18n="cursos.c.alimen">Alimentación</option>
                    <option
                        value="Mecánica"
                        data-tipo="Formación Profesional Básica (FPB)"
                        data-i18n="cursos.c.mecfpb">Mecánica</option>
                    <option
                        value="Diseño Gráfico"
                        data-tipo="Curso Técnico Terciario (CTT)"
                        data-i18n="cursos.c.dgrafico">Diseño Gráfico</option>
                    <option
                        value="Administración"
                        data-tipo="Curso Técnico Terciario (CTT)"
                        data-i18n="cursos.c.admin">Administración</option>
                    <option
                        value="Redes Y Software"
                        data-tipo="Curso Técnico Terciario (CTT)"
                        data-i18n="cursos.c.redes">Redes Y Software</option>
                    <option
                        value="Sistemas Agropecuarios Familiares"
                        data-tipo="Tecnólogo"
                        data-i18n="cursos.c.sistagro">Sistemas Agropecuarios Familiares</option>
                  </select>
                  <span class="error-message" id="error-curso" data-i18n="inscripciones.courseError">Seleccioná un curso.</span>
                </div>
              </div>
               <div class="mb-3">
                  <label for="d_mensaje" class="form-label" data-i18n="inscripciones.noteLabel">Algo que quieras decirnos</label>
                  <textarea id="d_mensaje" name="mensaje" class="form-control" rows="4" maxlength="330" aria-describedby="error-d_mensaje"></textarea>
                  <div class="char-counter" data-counter-for="d_mensaje" data-max="330" aria-live="polite"><span>0</span> / 330</div>
                  <span class="error-message" id="error-d_mensaje" data-i18n="docentes.mensajeError">El mensaje admite hasta 330 caracteres.</span>
                </div>
               
              <!-- Aceptación de términos  y botón de envío -->
              <div class="form-check mt-4">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="acepta_terminos"
                    name="acepta_terminos"
                    value="1"
                    required>
                <label
                    class="form-check-label"
                    for="acepta_terminos"
                    data-i18n="inscripciones.terms"
                    data-i18n-html>He leído y aceptado los siguientes términos: <a class="terms-link" href="https://www.utu.edu.uy/wp-content/themes/balpadraUTU/src/documents/politica%20de%20privacidad.pdf" target="_blank" rel="noopener">política de privacidad</a></label>
                <div>
                  <span class="error-message" id="error-terminos" data-i18n="inscripciones.termsError">Tenés que aceptar los términos y condiciones para continuar.</span>
                </div>
              </div>
              <button type="submit" class="btn btn-gold w-100 mt-4"><i class="bi bi-send"></i> <span data-i18n="inscripciones.submitBtn">Reservar mi cupo</span></button>

              <!-- ======================= VENTANA DEL TUTOR ======================= -->
              
              <div
                  class="modal fade"
                  id="tutorModal"
                  tabindex="-1"
                  data-bs-backdrop="static"
                  data-bs-keyboard="false"
                  aria-labelledby="tutorModalTitle"
                  aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="tutorModalTitle" data-i18n="inscripciones.tutorTitle">Datos del tutor (obligatorio)</h3>
                    </div>
                    <div class="modal-body">
                      <p class="small text-muted" data-i18n="inscripciones.tutorIntro">Como sos menor de 18 años, necesitamos los datos de un tutor. Recordá que deberá acompañarte cuando concurras a confirmar la inscripción de forma presencial.</p>
                      <div class="mb-3">
                        <label for="tutor_nombre" class="form-label" data-i18n="inscripciones.tutorNameLabel">Nombre completo del tutor</label>
                        <input
                            type="text"
                            id="tutor_nombre"
                            name="tutor_nombre"
                            class="form-control"
                            maxlength="120"
                            data-i18n="inscripciones.tutorNamePlaceholder"
                            data-i18n-attr="placeholder"
                            placeholder="Ej. Carlos Pérez">
                        <span
                            class="error-message"
                            id="error-tutor-nombre"
                            data-i18n="inscripciones.tutorNameError">El nombre del tutor es obligatorio.</span>
                      </div>
                      <div class="mb-3">
                        <label
                            for="tutor_telefono"
                            class="form-label"
                            data-i18n="inscripciones.tutorPhoneLabel">Teléfono del tutor</label>
                        <input
                            type="tel"
                            id="tutor_telefono"
                            name="tutor_telefono"
                            class="form-control"
                            inputmode="numeric"
                            pattern="[0-9]{9}"
                            minlength="9"
                            maxlength="9"
                            data-i18n="inscripciones.tutorPhonePlaceholder"
                            data-i18n-attr="placeholder"
                            placeholder="Ej. 099654321">
                        <span
                            class="error-message"
                            id="error-tutor-telefono"
                            data-i18n="inscripciones.phoneError">Ingresá 9 números, sin puntos ni guiones.</span>
                      </div>
                      <div class="mb-1">
                        <label for="tutor_email" class="form-label" data-i18n="inscripciones.tutorEmailLabel">Email del tutor</label>
                        <input
                            type="email"
                            id="tutor_email"
                            name="tutor_email"
                            class="form-control"
                            maxlength="150"
                            placeholder="tutor@email.com">
                        <span
                            class="error-message"
                            id="error-tutor-email"
                            data-i18n="inscripciones.tutorEmailError">Introducí un email válido para el tutor.</span>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button
                          type="button"
                          class="btn btn-link terms-link p-0"
                          id="fix-birth-btn"
                          data-i18n="inscripciones.fixBirth">Corregir fecha de nacimiento</button>
                      <button
                          type="button"
                          class="btn btn-gold"
                          id="save-tutor-btn"
                          data-i18n="inscripciones.tutorSave">Guardar datos del tutor</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            </section>

            <!-- ======================= SOLICITUD PARA DOCENTES ======================= -->
            
            <section id="panel-docentes" hidden>
              <h2 class="h4 mb-3 text-gold" data-i18n="docentes.formTitle">Formulario de registro para docentes</h2>
              <div class="form-intro">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                <p class="mb-0" data-i18n="docentes.intro">Dejanos tus datos y qué te gustaría solicitar a la institución. Nos pondremos en contacto con vos.</p>
              </div>
              <!-- Mensajes de resultado del formulario de docentes  -->
              <div id="msg-d-ok" class="alert-box is-success" role="status" data-i18n="docentes.msg.ok">¡Recibimos tus datos! Nos pondremos en contacto con vos.</div>
              <div id="msg-d-duplicado" class="alert-box is-error" role="alert" data-i18n="docentes.msg.duplicado">Ya existe un registro con esa cédula de identidad.</div>
              <div id="msg-d-invalido" class="alert-box is-error" role="alert" data-i18n="docentes.msg.invalido">Algunos datos no son válidos. Revisalos e intentá nuevamente.</div>
              <div id="msg-d-error" class="alert-box is-error" role="alert" data-i18n="docentes.msg.error">No pudimos guardar tus datos en este momento. Intentá nuevamente más tarde.</div>

              <!-- FORMULARIO DE DOCENTES → envía por POST a assets/php/guardar_docente.php -->
              <form id="docente-form" action="../assets/php/guardar_docente.php" method="post" novalidate>
                <!-- Campo anti-spam  -->
                <div class="visually-hidden" aria-hidden="true">
                  <label for="d_sitio_web">No completar</label>
                  <input type="text" id="d_sitio_web" name="sitio_web" tabindex="-1" autocomplete="off">
                </div>
                <!-- Datos personales: nombre, cédula, correo, teléfono y fecha de nacimiento -->
                <div class="mb-3">
                  <label for="d_nombre_completo" class="form-label" data-i18n="inscripciones.nameLabel">Nombre completo</label>
                  <input type="text" id="d_nombre_completo" name="nombre_completo" class="form-control" minlength="3" maxlength="120" autocomplete="name" data-i18n="inscripciones.namePlaceholder" data-i18n-attr="placeholder" placeholder="Nombre completo" aria-describedby="error-d_nombre" required>
                  <span class="error-message" id="error-d_nombre" data-i18n="inscripciones.nameError">El nombre completo es requerido.</span>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="d_cedula" class="form-label" data-i18n="inscripciones.docLabel">Cédula de identidad</label>
                    <input type="text" id="d_cedula" name="cedula" class="form-control" inputmode="numeric" pattern="[0-9]{8}" minlength="8" maxlength="8" autocomplete="off" data-i18n="inscripciones.docPlaceholder" data-i18n-attr="placeholder" placeholder="Ej. 45678901" aria-describedby="error-d_cedula" required>
                    <span class="error-message" id="error-d_cedula" data-i18n="inscripciones.docError">Ingresá 8 números, sin puntos ni guiones.</span>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="d_email" class="form-label" data-i18n="inscripciones.emailLabel">Correo electrónico</label>
                    <input type="email" id="d_email" name="email" class="form-control" maxlength="150" autocomplete="email" placeholder="nombre@email.com" aria-describedby="error-d_email" required>
                    <span class="error-message" id="error-d_email" data-i18n="inscripciones.emailError">Introducí un formato de email válido.</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="d_telefono" class="form-label" data-i18n="inscripciones.phoneLabel">Teléfono de contacto</label>
                    <input type="tel" id="d_telefono" name="telefono" class="form-control" inputmode="numeric" pattern="[0-9]{9}" minlength="9" maxlength="9" autocomplete="tel" data-i18n="inscripciones.phonePlaceholder" data-i18n-attr="placeholder" placeholder="Ej. 099123456" aria-describedby="error-d_telefono" required>
                    <span class="error-message" id="error-d_telefono" data-i18n="inscripciones.phoneError">Ingresá 9 números, sin puntos ni guiones.</span>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="d_fecha_nacimiento" class="form-label" data-i18n="inscripciones.birthLabel">Fecha de nacimiento</label>
                    <input type="date" id="d_fecha_nacimiento" name="fecha_nacimiento" class="form-control" aria-describedby="error-d_fecha" required>
                    <span class="error-message" id="error-d_fecha" data-i18n="inscripciones.birthError">Ingresá una fecha de nacimiento válida.</span>
                  </div>
                </div>
                <!-- Formación académica  -->
                <div class="mb-3">
                  <label for="d_formacion" class="form-label" data-i18n="docentes.formacionLabel">Formación académica</label>
                  <input type="text" id="d_formacion" name="formacion_academica" class="form-control" minlength="2" maxlength="100" data-i18n="docentes.formacionPlaceholder" data-i18n-attr="placeholder" placeholder="Ej. Profesorado, Licenciatura, Bachillerato" aria-describedby="error-d_formacion" required>
                  <span class="error-message" id="error-d_formacion" data-i18n="docentes.formacionError">La formación académica debe tener entre 2 y 100 caracteres.</span>
                  <div class="char-counter" data-counter-for="d_formacion" data-max="100" aria-live="polite"><span>0</span> / 100</div>
                </div>
                <!-- Tipo de solicitud: especialización u otro -->
                <div class="mb-3">
                  <label for="d_solicitud" class="form-label" data-i18n="docentes.requestLabel">¿Qué te gustaría solicitar a la institución?</label>
                  <select id="d_solicitud" name="solicitud" class="form-select" aria-describedby="error-d_solicitud" required>
                    <option value="" data-i18n="docentes.requestPlaceholder">Seleccioná una opción</option>
                    <option value="especializacion" data-i18n="docentes.requestSpec">Especialización</option>
                    <option value="otro" data-i18n="docentes.requestOther">Otro</option>
                  </select>
                  <span class="error-message" id="error-d_solicitud" data-i18n="docentes.requestError">Seleccioná una opción.</span>
                </div>
                <div class="form-intro" id="d_info-especializacion" hidden>
                  <i class="bi bi-mortarboard" aria-hidden="true"></i>
                  <p class="mb-0" data-i18n="docentes.specInfo">Una especialización es una formación complementaria para profundizar en un área concreta de tu disciplina o de la enseñanza técnica. Podés escribir cuál te interesa.</p>
                </div>
                <div id="d_detalle-solicitud" hidden>
                  <div class="mb-3">
                    <label for="d_detalle" class="form-label" data-i18n="docentes.detailLabel">Escribí cuál (opcional)</label>
                    <input type="text" id="d_detalle" name="solicitud_detalle" class="form-control" maxlength="30" data-i18n="docentes.detailPlaceholder" data-i18n-attr="placeholder" placeholder="Ej. Robótica educativa" aria-describedby="error-d_detalle">
                    <span class="error-message" id="error-d_detalle" data-i18n="docentes.detailError">Escribí el detalle de la solicitud (máximo 30 caracteres).</span>
                    <div class="char-counter" data-counter-for="d_detalle" data-max="30" aria-live="polite"><span>0</span> / 30</div>
                  </div>
                </div>
                <!-- Mensaje opcional  -->
                <div class="mb-3">
                  <label for="d_mensaje" class="form-label" data-i18n="inscripciones.noteLabel">Algo que quieras decirnos</label>
                  <textarea id="d_mensaje" name="mensaje" class="form-control" rows="4" maxlength="330" aria-describedby="error-d_mensaje"></textarea>
                  <div class="char-counter" data-counter-for="d_mensaje" data-max="330" aria-live="polite"><span>0</span> / 330</div>
                  <span class="error-message" id="error-d_mensaje" data-i18n="docentes.mensajeError">El mensaje admite hasta 330 caracteres.</span>
                </div>
                <!-- Aceptación de términos y botón de envío -->
                <div class="form-check mt-4">
                  <input class="form-check-input" type="checkbox" id="d_acepta_terminos" name="acepta_terminos" value="1" required>
                  <label class="form-check-label" for="d_acepta_terminos" data-i18n="inscripciones.terms" data-i18n-html>He leído y aceptado los siguientes términos: <a class="terms-link" href="https://www.utu.edu.uy/wp-content/themes/balpadraUTU/src/documents/politica%20de%20privacidad.pdf" target="_blank" rel="noopener">política de privacidad</a></label>
                  <div><span class="error-message" id="error-d_terminos" data-i18n="inscripciones.termsError">Tenés que aceptar los términos y condiciones para continuar.</span></div>
                </div>
                <button type="submit" class="btn btn-gold w-100 mt-4"><i class="bi bi-send"></i> <span data-i18n="docentes.submitBtn">Enviar mis datos</span></button>
              </form>
            </section>
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