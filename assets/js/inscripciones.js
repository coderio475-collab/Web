/**
 * ==========================================================================
 * inscripciones.js — FUNCIONALIDADES DEL FORMULARIO DE INSCRIPCIONES
 * ==========================================================================
 */
(function () {
  var ADULT_AGE = 18;
  var form, modal;
  var el = {};            //referencias a los elementos del formulario
  var allCourses = [];    //copia de todas las opciones de "Curso"

  /* ------------------------------------------------------------------ *
   * Utilidades
   * ------------------------------------------------------------------ */

  /** Muestra u oculta el mensaje de error de un campo y marca el campo en rojo. */
  function setError(input, errorId, hasError) {
    var msg = document.getElementById(errorId);
    if (msg) msg.classList.toggle('show', hasError);
    if (input) input.classList.toggle('is-invalid', hasError);
    return !hasError;
  }

  function isEmail(value) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value); }

  /** Un teléfono válido contiene exactamente 9 dígitos, sin separadores. */
  function isPhone(value) {
    return /^[0-9]{9}$/.test(value);
  }

  /** Deja solo los primeros 9 dígitos en un campo telefónico. */
  function restrictToDigits(input, limit) {
    input.addEventListener('input', function () {
      input.value = input.value.replace(/\D/g, '').slice(0, limit || 9);
    });
  }

  /** Edad en años cumplidos a partir de "AAAA-MM-DD". Devuelve null si la fecha no es válida. */
  function calcAge(dateString) {
    if (!/^\d{4}-\d{2}-\d{2}$/.test(dateString)) return null;
    var parts = dateString.split('-').map(Number);
    var birth = new Date(parts[0], parts[1] - 1, parts[2]);
    var today = new Date();
    if (isNaN(birth.getTime()) || birth > today || parts[0] < 1900) return null;
    var age = today.getFullYear() - birth.getFullYear();
    var hadBirthday = today.getMonth() > birth.getMonth() ||
      (today.getMonth() === birth.getMonth() && today.getDate() >= birth.getDate());
    return hadBirthday ? age : age - 1;
  }

  function isMinor() { return el.esMenor.value === '1'; }

  /* ------------------------------------------------------------------ *
   * Menor de edad: apartado automática + ventana del tutor
   * ------------------------------------------------------------------ */

  /** Valida los 3 campos del tutor. */
  function validateTutor() {
    var ok = true;
    ok = setError(el.tutorNombre, 'error-tutor-nombre', el.tutorNombre.value.trim().length < 3) && ok;
    ok = setError(el.tutorTelefono, 'error-tutor-telefono', !isPhone(el.tutorTelefono.value)) && ok;
    ok = setError(el.tutorEmail, 'error-tutor-email', !isEmail(el.tutorEmail.value.trim())) && ok;
    return ok;
  }

  /** Recalcula si la persona es menor según la fecha de nacimiento. */
  function syncMinorState() {
    var age = calcAge(el.fecha.value);
    var minor = age !== null && age < ADULT_AGE;

    el.esMenor.value = minor ? '1' : '0';   //valor que viaja a PHP

    if (minor) {
      if (!validateTutorSilently()) {
        el.banner.classList.remove('show');
        modal.show();                       //ventana obligatoria
      } else {
        el.banner.classList.add('show');
      }
    } else {
      //Mayor de edad (o fecha incompleta): se descartan los datos del tutor
      el.banner.classList.remove('show');
      [el.tutorNombre, el.tutorTelefono, el.tutorEmail].forEach(function (i) { i.value = ''; });
      modal.hide();
    }
  }

  /** valida los datos del tutor */
  function validateTutorSilently() {
    return el.tutorNombre.value.trim().length >= 3 && isPhone(el.tutorTelefono.value) && isEmail(el.tutorEmail.value.trim());
  }

  /* ------------------------------------------------------------------ *
   * Tipo de curso → lista de cursos
   * ------------------------------------------------------------------ */

  /** Carga en el selector "Curso" solo las opciones del tipo elegido. */
  function fillCourses() {
    var placeholder = el.curso.options[0];
    while (el.curso.options.length > 1) el.curso.remove(1);

    var matches = allCourses.filter(function (o) { return o.getAttribute('data-tipo') === el.tipo.value; });
    matches.forEach(function (o) { el.curso.add(o.cloneNode(true)); });

    el.curso.disabled = matches.length === 0;
    placeholder.setAttribute('data-i18n', matches.length ? 'inscripciones.courseChoose' : 'inscripciones.coursePlaceholder');
    if (matches.length === 1) el.curso.selectedIndex = 1;   // un solo curso: se elige solo
    if (window.SiteI18n) window.SiteI18n.applyAll();        // traduce las opciones recién agregadas
  }

  /* ------------------------------------------------------------------ *
   * Valida los campos al enviar
   * ------------------------------------------------------------------ */
  function validateForm() {
    var checks = [
      [el.nombre,   'error-nombre',   el.nombre.value.trim().length < 3],
      [el.cedula,   'error-cedula',   !/^\d{8}$/.test(el.cedula.value)],
      [el.email,    'error-email',    !isEmail(el.email.value.trim())],
      [el.telefono, 'error-telefono', !isPhone(el.telefono.value)],
      [el.fecha,    'error-fecha',    calcAge(el.fecha.value) === null],
      [el.tipo,     'error-tipo',     el.tipo.value === ''],
      [el.curso,    'error-curso',    el.curso.value === ''],
      [el.terminos, 'error-terminos', !el.terminos.checked]
    ];
    var firstInvalid = null;
    checks.forEach(function (c) {
      var ok = setError(c[0], c[1], c[2]);
      if (!ok && !firstInvalid) firstInvalid = c[0];
    });
    return firstInvalid;
  }

  /* ------------------------------------------------------------------ *
   * Mensajes que vuelve a mostrar la página después del envío a PHP
   * ------------------------------------------------------------------ */
  function showServerResult() {
     var query = new URLSearchParams(window.location.search);
     if (query.get('formulario') === 'docentes') return;
     var estado = query.get('estado');
    var box = estado ? document.getElementById('msg-' + estado) : null;
    if (!box) return;
    box.classList.add('show');
    box.scrollIntoView({ behavior: 'smooth', block: 'center' });
    // Limpia ?estado= de la barra de direcciones (evita repetir el aviso al recargar)
    window.history.replaceState({}, document.title, window.location.pathname);
  }

  /* ------------------------------------------------------------------ *
   * Inicio 
   * ------------------------------------------------------------------ */
  document.addEventListener('DOMContentLoaded', function () {
    form = document.getElementById('inscripcion-form');
    if (!form) return;

    el = {
      nombre: document.getElementById('nombre_completo'),
      cedula: document.getElementById('cedula'),
      email: document.getElementById('email'),
      telefono: document.getElementById('telefono'),
      fecha: document.getElementById('fecha_nacimiento'),
      tipo: document.getElementById('tipo_curso'),
      curso: document.getElementById('curso'),
      esMenor: document.getElementById('es_menor'),
      banner: document.getElementById('minor-banner'),
      terminos: document.getElementById('acepta_terminos'),
      tutorNombre: document.getElementById('tutor_nombre'),
      tutorTelefono: document.getElementById('tutor_telefono'),
      tutorEmail: document.getElementById('tutor_email')
    };

    // Ventana del tutor: no se cierra con clic afuera ni con Esc
    modal = new bootstrap.Modal(document.getElementById('tutorModal'), { backdrop: 'static', keyboard: false });

    // 0) Cursos: se guardan todas las opciones y el selector queda vacío hasta elegir un tipo
    allCourses = Array.prototype.slice.call(el.curso.querySelectorAll('option[data-tipo]'));
    allCourses.forEach(function (o) { o.parentNode.removeChild(o); });
    el.tipo.addEventListener('change', fillCourses);

    // 1) restringe cedula y telefono a un limite de digitos y solo numeros
    restrictToDigits(el.cedula, 8);
    restrictToDigits(el.telefono, 9);
    restrictToDigits(el.tutorTelefono, 9);

    // 2) Fecha de nacimiento: no se puede elegir el futuro
    var today = new Date();
    el.fecha.max = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');
    el.fecha.min = '1900-01-01';
    el.fecha.addEventListener('change', syncMinorState);
    el.fecha.addEventListener('input', syncMinorState);

    // 3) Botones de la ventana del tutor
    document.getElementById('save-tutor-btn').addEventListener('click', function () {
      if (validateTutor()) {
        modal.hide();
        el.banner.classList.add('show');
      }
    });
    document.getElementById('fix-birth-btn').addEventListener('click', function () {
      modal.hide();
      el.fecha.focus();
    });
    document.getElementById('edit-tutor-btn').addEventListener('click', function () { modal.show(); });
    // Enter dentro de la ventana guarda al tutor (no envía el formulario completo)
    document.getElementById('tutorModal').addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && e.target.tagName === 'INPUT') {
        e.preventDefault();
        document.getElementById('save-tutor-btn').click();
      }
    });

    // 4) Envío: si hay errores se detiene; si no, el navegador envía el POST a PHP
    form.addEventListener('submit', function (e) {
      var firstInvalid = validateForm();
      if (firstInvalid) {
        e.preventDefault();
        firstInvalid.focus();
        return;
      }
      if (isMinor() && !validateTutorSilently()) {
        e.preventDefault();
        modal.show();
      }
    });

    // 5) Quitar el error de un campo apenas se corrige
    form.querySelectorAll('input, select').forEach(function (field) {
      field.addEventListener('input', function () { field.classList.remove('is-invalid'); });
    });

    showServerResult();
  });
})();
