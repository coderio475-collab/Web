/**
 * imagenes.js — Evita mostrar espacios vacíos cuando falta una imagen .
 */
//Al cargar la página revisa cada imagen administrable (.managed-image)
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.managed-image').forEach(function (image) {
    //Si la imagen carga bien: activa su contenedor (oculta el texto de "proximamente")
    function showImage() {
      image.parentElement.classList.add('managed-image-active');
    }
    // Si falla o no existe en la base: la quita para no mostrar un icono roto
    function hideImage() {
      image.remove();
    }

    // Reacciona a la carga o al error; si ya terminó de cargar, decide de inmediato
    image.addEventListener('load', showImage);
    image.addEventListener('error', hideImage);
    if (image.complete) {
      image.naturalWidth > 0 ? showImage() : hideImage();
    }
  });
});
