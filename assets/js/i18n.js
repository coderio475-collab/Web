/**
 * ==========================================================================
 * i18n.js — MOTOR DE TRADUCCIÓN (Español ⇄ Português)
 * --------------------------------------------------------------------------
 *   - Los textos viven en assets/js/translations.js (window.SiteTranslations).
 *   - Cada elemento HTML traducible tiene  data-i18n="clave".
 *       · data-i18n-attr="placeholder"  → traduce un atributo en vez del texto.
 *       · data-i18n-html                → el texto traducido html.
 * ==========================================================================
 */

/* Banderas paises SVG  */
var SVG_FLAG_BR = '<svg viewBox="0 0 640 480" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Português"><rect width="640" height="480" fill="#009739"/><polygon points="320,55 585,240 320,425 55,240" fill="#FEDD00"/><circle cx="320" cy="240" r="103" fill="#012169"/></svg>';
var SVG_FLAG_UY = '<svg viewBox="0 0 640 480" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Español"><rect width="640" height="480" fill="#fff"/><rect y="53.33" width="640" height="53.33" fill="#0038A8"/><rect y="160" width="640" height="53.33" fill="#0038A8"/><rect y="266.67" width="640" height="53.33" fill="#0038A8"/><rect y="373.33" width="640" height="53.33" fill="#0038A8"/><rect width="213.33" height="213.33" fill="#fff"/><g fill="#FCD116"><circle cx="106.67" cy="106.67" r="34"/><polygon points="106.7,44.7 122.0,69.7 150.5,62.8 143.6,91.4 168.7,106.7 143.6,122.0 150.5,150.5 122.0,143.6 106.7,168.7 91.4,143.6 62.8,150.5 69.7,122.0 44.7,106.7 69.7,91.4 62.8,62.8 91.4,69.7"/></g></svg>';

(function () {
  // Fijar el idioma guardado antes de que se pinte la página
  var saved = localStorage.getItem('site-lang') || 'es';
  document.documentElement.setAttribute('lang', saved === 'pt' ? 'pt' : 'es');

  window.SiteI18n = {
    /** Idioma actual: 'es' o 'pt'. */
    currentLang: function () {
      return document.documentElement.getAttribute('lang') === 'pt' ? 'pt' : 'es';
    },

    /** Devuelve el texto de una clave (si falta en pt usa es; si falta en ambos, la clave). */
    t: function (key) {
      var all = window.SiteTranslations || {};
      var dict = all[this.currentLang()] || {};
      var fallback = all.es || {};
      if (dict[key] !== undefined) return dict[key];
      if (fallback[key] !== undefined) return fallback[key];
      return key;
    },

    /** Recorre la página y reemplaza todos los textos marcados con data-i18n. */
    applyAll: function () {
      var self = this;
      document.querySelectorAll('[data-i18n]').forEach(function (el) {
        var text = self.t(el.getAttribute('data-i18n'));
        var attrs = el.getAttribute('data-i18n-attr');
        if (attrs) {
          attrs.split(',').forEach(function (a) { el.setAttribute(a.trim(), text); });
        } else if (el.hasAttribute('data-i18n-html')) {
          el.innerHTML = text;
        } else {
          el.textContent = text;
        }
      });
      // Título de la pestaña del navegador
      var titleKey = document.body.getAttribute('data-i18n-title');
      if (titleKey) document.title = this.t(titleKey);
      this.updateLangButton();
      // Avisar a otros scripts (p. ej. el buscador) que cambió el idioma
      document.dispatchEvent(new CustomEvent('site-lang-changed'));
    },

    /** muestra en el botón la bandera del idioma al que se va a cambiar. */
    updateLangButton: function () {
      var box = document.querySelector('#lang-btn .flag-icon');
      if (box) box.innerHTML = this.currentLang() === 'pt' ? SVG_FLAG_UY : SVG_FLAG_BR;
    },

    /** Cambia a un idioma concreto y lo recuerda. */
    setLang: function (lang) {
      document.documentElement.setAttribute('lang', lang);
      localStorage.setItem('site-lang', lang);
      this.applyAll();
    },

    /** Alterna entre español y portugués. */
    toggle: function () {
      this.setLang(this.currentLang() === 'pt' ? 'es' : 'pt');
    },

    /** Traduce la página y conecta el botón. */
    init: function () {
      this.applyAll();
      var btn = document.getElementById('lang-btn');
      if (btn) btn.addEventListener('click', function () { window.SiteI18n.toggle(); });
    }
  };
})();

window.SiteI18n.init();
