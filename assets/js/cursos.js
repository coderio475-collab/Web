/**
 * ==========================================================================
 * cursos.js — FILTRO POR SECTOR DE ESTUDIO (página Cursos y Carreras)
 * controla el filtro de cursos por sector de estudio
 * Elegir un sector oculta los cursos de otros sectores
 * ==========================================================================
 */
(function () {
  /** Muestra solo los cursos del sector indicado y oculta los bloques vacíos. */
  function filterBySector(sector) {
    document.querySelectorAll('.course-full').forEach(function (card) {
      card.hidden = sector !== 'todos' && card.getAttribute('data-sector') !== sector;
    });
    document.querySelectorAll('.level-block').forEach(function (block) {
      block.hidden = !block.querySelector('.course-full:not([hidden])');
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    var chips = document.querySelectorAll('.sector-chip');
    chips.forEach(function (chip) {
      chip.addEventListener('click', function () {
        chips.forEach(function (c) { c.classList.toggle('active', c === chip); });
        filterBySector(chip.getAttribute('data-sector'));
      });
    });
  });
})();
