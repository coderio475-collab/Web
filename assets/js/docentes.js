/**
 * docentes.js — Comportamiento del formulario de solicitudes docentes.
 * Administra la validación en pantalla, los campos condicionales y el envío;
 * el servidor vuelve a validar los datos antes de guardarlos.
 */
(function () {
  'use strict';

  //Se ejecuta cuando el HTML terminó de cargar
  document.addEventListener('DOMContentLoaded', function () {
    // --- 1. Referencias a los elementos: interruptor de modo, los dos paneles y el formulario de docentes ---
    var toggle = document.getElementById('modo-docente');
    var panelEstudiantes = document.getElementById('panel-estudiantes');
    var panelDocentes = document.getElementById('panel-docentes');
    var form = document.getElementById('docente-form');
    var intentoEnviar = false;

    // Si falta algún elemento (otra página), el script no hace nada
    if (!toggle || !panelEstudiantes || !panelDocentes || !form) return;

    // --- 2. Alternar entre formulario de estudiantes y de docentes ---
    // setPanel muestra/oculta un panel y deshabilita sus campos mientras está oculto,
    // para que el navegador no los envíe ni los valide
    function setPanel(panel, visible) {
      panel.querySelectorAll('input, select, textarea, button').forEach(function (control) {
        if (visible) {
          var estabaDeshabilitado = control.getAttribute('data-panel-disabled');
          if (estabaDeshabilitado !== null) {
            control.disabled = estabaDeshabilitado === 'true';
            control.removeAttribute('data-panel-disabled');
          }
        } else {
          control.setAttribute('data-panel-disabled', String(control.disabled));
          control.disabled = true;
        }
      });
      panel.hidden = !visible;
    }

    // showMode muestra el panel que corresponde al estado del interruptor
    function showMode() {
      setPanel(panelEstudiantes, !toggle.checked);
      setPanel(panelDocentes, toggle.checked);
    }

    toggle.addEventListener('change', showMode);

    // Si la URL trae ?formulario=docentes (al volver del servidor), arranca en modo docentes
    var query = new URLSearchParams(window.location.search);
    if (query.get('formulario') === 'docentes') toggle.checked = true;
    showMode();

    // --- 3. Límites de la fecha de nacimiento: no puede ser futura ni anterior a 1900 ---
    var fecha = document.getElementById('d_fecha_nacimiento');
    var hoy = new Date();
    fecha.max = hoy.getFullYear() + '-' + String(hoy.getMonth() + 1).padStart(2, '0') + '-' + String(hoy.getDate()).padStart(2, '0');
    fecha.min = '1900-01-01';

    // --- 4. Cédula (solo numeros) y teléfono (solo numeros, máx. 9) ---
    var cedula = document.getElementById('d_cedula');
    var telefono = document.getElementById('d_telefono');
    cedula.addEventListener('input', function () {
      cedula.value = cedula.value.replace(/\D/g, '');
    });
    telefono.addEventListener('input', function () {
      telefono.value = telefono.value.replace(/\D/g, '').slice(0, 9);
    });

    // --- 5. Tipo de solicitud: "otro" exige detalle; "especialización" muestra una explicación ---
    var solicitud = document.getElementById('d_solicitud');
    var detalleBox = document.getElementById('d_detalle-solicitud');
    var detalle = document.getElementById('d_detalle');
    var infoEspecializacion = document.getElementById('d_info-especializacion');
    function actualizarSolicitud() {
      detalleBox.hidden = solicitud.value === '';
      detalle.required = solicitud.value === 'otro';
      infoEspecializacion.hidden = solicitud.value !== 'especializacion';
    }
    solicitud.addEventListener('change', actualizarSolicitud);
    actualizarSolicitud();

    // --- 6. Contadores de caracteres: cada [data-counter-for] muestra cuántos caracteres lleva su campo ---
    form.querySelectorAll('[data-counter-for]').forEach(function (contador) {
      var campo = document.getElementById(contador.getAttribute('data-counter-for'));
      var numero = contador.querySelector('span');
      function actualizarContador() {
        numero.textContent = campo.value.length;
      }
      campo.addEventListener('input', actualizarContador);
      actualizarContador();
    });

    // --- 7. Validación en pantalla ---
    // comprobar marca el campo en rojo y muestra su mensaje de error cuando es inválido
    function comprobar(campo, idError, invalido) {
      var mensaje = document.getElementById(idError);
      campo.classList.toggle('is-invalid', invalido);
      if (mensaje) mensaje.classList.toggle('show', invalido);
      return !invalido;
    }

    // fechaValida: formato AAAA-MM-DD, fecha real, desde 1900 y no futura
    function fechaValida(valor) {
      if (!/^\d{4}-\d{2}-\d{2}$/.test(valor)) return false;
      var partes = valor.split('-').map(Number);
      var fechaUTC = new Date(Date.UTC(partes[0], partes[1] - 1, partes[2]));
      var hoy = new Date();
      var hoyUTC = Date.UTC(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());
      return fechaUTC.getUTCFullYear() === partes[0]
        && fechaUTC.getUTCMonth() === partes[1] - 1
        && fechaUTC.getUTCDate() === partes[2]
        && partes[0] >= 1900
        && fechaUTC.getTime() <= hoyUTC;
    }

    // validarFormulario revisa todos los campos y devuelve true solo si todos son válidos
    function validarFormulario() {
      var detalleObligatorio = solicitud.value === 'otro';
      var resultados = [
        comprobar(document.getElementById('d_nombre_completo'), 'error-d_nombre', document.getElementById('d_nombre_completo').value.trim().length < 3),
        comprobar(cedula, 'error-d_cedula', !/^\d{8}$/.test(cedula.value)),
        comprobar(document.getElementById('d_email'), 'error-d_email', !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(document.getElementById('d_email').value.trim()) || document.getElementById('d_email').value.trim().length > 150),
        comprobar(telefono, 'error-d_telefono', !/^[0-9]{9}$/.test(telefono.value)),
        comprobar(fecha, 'error-d_fecha', !fechaValida(fecha.value)),
        comprobar(document.getElementById('d_formacion'), 'error-d_formacion', document.getElementById('d_formacion').value.trim().length < 2 || document.getElementById('d_formacion').value.trim().length > 100),
        comprobar(solicitud, 'error-d_solicitud', solicitud.value !== 'especializacion' && solicitud.value !== 'otro'),
        comprobar(detalle, 'error-d_detalle', detalleObligatorio && detalle.value.trim() === ''),
        comprobar(document.getElementById('d_mensaje'), 'error-d_mensaje', document.getElementById('d_mensaje').value.length > 330),
        comprobar(document.getElementById('d_acepta_terminos'), 'error-d_terminos', !document.getElementById('d_acepta_terminos').checked)
      ];
      return resultados.every(function (valido) { return valido; });
    }

    // --- 8. Envío: si hay errores se cancela el envío y se enfoca el primer campo inválido ---
    form.addEventListener('submit', function (evento) {
      intentoEnviar = true;
      if (validarFormulario()) return;
      evento.preventDefault();
      var primerInvalido = form.querySelector('.is-invalid');
      if (primerInvalido) primerInvalido.focus();
    });

    // Después del primer intento de envío, se revalida mientras se corrige
    form.querySelectorAll('input, select, textarea').forEach(function (campo) {
      campo.addEventListener('input', function () {
        if (intentoEnviar) validarFormulario();
      });
      campo.addEventListener('change', function () {
        if (intentoEnviar) validarFormulario();
      });
    });

    // --- 9. Resultado del servidor (?estado=ok|duplicado|invalido|error): muestra el aviso y limpia la URL ---
    var estado = query.get('estado');
    if (query.get('formulario') === 'docentes' && estado) {
      var aviso = document.getElementById('msg-d-' + estado);
      if (aviso) {
        aviso.classList.add('show');
        aviso.scrollIntoView({ behavior: 'smooth', block: 'center' });
        window.history.replaceState({}, document.title, window.location.pathname);
      }
    }
  });
})();
