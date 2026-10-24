/**
 * ==========================================================================
 * anexos.js — PESTAÑAS DE LA PÁGINA "ANEXOS"
 * funcionalidad de las pestañas de la página "Anexos"
 * ==========================================================================
 */
(function () {
  /** Muestra el panel del anexo indicado y marca su pestaña. */
  function showSede(name) {
    var panel = document.getElementById('sede-' + name);
    if (!panel) return;
    document.querySelectorAll('.sede-panel').forEach(function (p) { p.classList.remove('active'); });
    document.querySelectorAll('.tab-btn').forEach(function (b) {
      b.classList.toggle('active', b.getAttribute('data-sede') === name);
    });
    panel.classList.add('active');
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
      btn.addEventListener('click', function () { showSede(btn.getAttribute('data-sede')); });
    });
    if (location.hash) showSede(location.hash.replace('#', ''));
  });
})();