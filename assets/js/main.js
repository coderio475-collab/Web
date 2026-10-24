/**
 * ==========================================================================
 * main.js — INICIALIZACIÓN GENERAL 
 * ==========================================================================
 */
document.addEventListener('DOMContentLoaded', function () {

  // 1) inicializacion de tema e idioma
  if (window.SiteTheme) window.SiteTheme.init();
  if (window.SiteI18n) window.SiteI18n.init();

  // 2) Enlace activo del menú 
  var current = location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.navbar-custom .nav-link, .navbar-custom .dropdown-item').forEach(function (link) {
    if (link.getAttribute('href').split('#')[0].split('/').pop() === current) {
      link.classList.add('active');
      var parent = link.closest('.dropdown');
      var toggle = parent ? parent.querySelector('.dropdown-toggle') : null;
      if (toggle) toggle.classList.add('active');
    }
  });

  // 3) Menú móvil: se cierra al tocar una opción 
  var navCollapse = document.getElementById('mainNavbar');
  if (navCollapse && window.bootstrap) {
    navCollapse.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item').forEach(function (link) {
      link.addEventListener('click', function () {
        if (navCollapse.classList.contains('show')) {
          bootstrap.Collapse.getOrCreateInstance(navCollapse).hide();
        }
      });
    });
  }

  // 4) Revelar la página
  requestAnimationFrame(function () {
    document.documentElement.classList.add('ready');
  });
});

//delay: si algo tarda, se muestra igual a los 700 ms
setTimeout(function () {
  document.documentElement.classList.add('ready');
}, 700);
