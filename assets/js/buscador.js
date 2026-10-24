/**
 * ==========================================================================
 * buscador.js — BUSCADOR DEL ENCABEZADO 
 * ==========================================================================
 */
(function () {
  var SEARCH_INDEX = [
    { path: 'seconds_index/cursos.php',        key: 'common.nav.cursos',        words: 'cursos carreras oferta sectores bachillerato fpb ebi bt btp ctt capacitacion tecnologo' },
    { path: 'seconds_index/inscripciones.php', key: 'common.nav.inscripciones', words: 'inscripcion inscribirse cupo reservar formulario registro' },
    { path: 'seconds_index/horarios.php',      key: 'common.nav.horarios',      words: 'horarios examenes materias turnos clases pdf' },
    { path: 'seconds_index/horarios.php#examenes', key: 'home.interes.examenes', words: 'examenes calendario pruebas' },
    { path: 'seconds_index/anexos.php',        key: 'common.nav.anexos',        words: 'anexos sedes polideportivo baltasar brum gomensoro ubicacion mapa' },
    { path: 'seconds_index/noticias.php',      key: 'common.nav.noticias',      words: 'noticias eventos novedades galeria' },
    { path: 'seconds_index/normativa.php',     key: 'common.nav.normativa',     words: 'normativa vestimenta uniforme leyes reglamento estatuto ordenanza' }
  ];

  var form, input, list;

  /** Pasa a minúsculas y quita tildes para comparar sin importar acentos. */
  function normalize(text) {
    return (text || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
  }

  /** Devuelve las entradas que coinciden con lo escrito. */
  function find(query) {
    var q = normalize(query.trim());
    if (!q) return [];
    return SEARCH_INDEX.filter(function (item) {
      var label = normalize(window.SiteI18n ? window.SiteI18n.t(item.key) : item.key);
      return label.indexOf(q) !== -1 || normalize(item.words).indexOf(q) !== -1;
    });
  }

  /** Ruta absoluta respecto a la página actual (data-root es "" o "../"). */
  function href(item) {
    return (document.body.getAttribute('data-root') || '') + item.path;
  }

  /** Dibuja la lista de sugerencias. */
  function render() {
    var results = find(input.value);
    list.innerHTML = '';
    if (!input.value.trim()) { list.classList.remove('show'); return; }
    if (!results.length) {
      var empty = document.createElement('li');
      empty.className = 'search-empty';
      empty.textContent = window.SiteI18n.t('common.nav.searchEmpty');
      list.appendChild(empty);
    } else {
      results.forEach(function (item) {
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.href = href(item);
        a.innerHTML = '<i class="bi bi-arrow-return-right" aria-hidden="true"></i>';
        a.appendChild(document.createTextNode(window.SiteI18n.t(item.key)));
        li.appendChild(a);
        list.appendChild(li);
      });
    }
    list.classList.add('show');
  }

  document.addEventListener('DOMContentLoaded', function () {
    form = document.getElementById('search-form');
    input = document.getElementById('search-input');
    list = document.getElementById('search-results');
    if (!form || !input || !list) return;

    input.addEventListener('input', render);
    input.addEventListener('focus', render);
    document.addEventListener('site-lang-changed', render);

    // Enter / botón: abre la primera coincidencia
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var results = find(input.value);
      if (results.length) window.location.href = href(results[0]);
      else render();
    });

    // Cerrar sugerencias al hacer clic fuera o con Escape
    document.addEventListener('click', function (e) { if (!form.contains(e.target)) list.classList.remove('show'); });
    input.addEventListener('keydown', function (e) { if (e.key === 'Escape') list.classList.remove('show'); });
  });
})();
