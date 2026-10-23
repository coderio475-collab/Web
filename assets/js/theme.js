(function () {
  var root = document.documentElement;
  var themeKey = 'theme';
  var initialTheme = null;

  try {
    initialTheme = window.localStorage.getItem(themeKey);
  } catch (error) {
    console.error('No se pudo leer el tema guardado.', error);
  }

  if (initialTheme === 'dark') {
    root.classList.add('dark-mode');
  }

  root.classList.add('ready');

  document.addEventListener('DOMContentLoaded', function () {
    var themeButton = document.getElementById('theme-btn');

    if (!themeButton) {
      return;
    }

    themeButton.addEventListener('click', function () {
      var isDarkMode = root.classList.toggle('dark-mode');

      try {
        window.localStorage.setItem(themeKey, isDarkMode ? 'dark' : 'light');
      } catch (error) {
        console.error('No se pudo guardar el tema seleccionado.', error);
      }
    });
  });
})();
