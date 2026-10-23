<?php
/**
 * footer y carga ordenada de scripts globales y específicos de página.
 */
// ---------- Valores por defecto de las variables opcionales ----------
$assetBase = $assetBase ?? '';
$footerScriptBefore = $footerScriptBefore ?? '';
$footerScriptAfter = $footerScriptAfter ?? '';
$footerScriptAfter2 = $footerScriptAfter2 ?? '';
?>
 
 <!-- ============ PIE DE PÁGINA (footer) ============ -->
 <footer class="main-footer">
      <div class="container">
         
        <!-- logo y nombre de la escuela -->
        <div class="footer-school">
          <img
              src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/img/logo-utu-transparent.png"
              alt="Escudo Escuela Técnica N.º 1"
              class="brand-crest-img">
          <div>
            <span class="school-name" data-i18n="common.brand.name">Escuela Técnica N.º 1</span>
            <span class="brand-sub" data-i18n="common.brand.sub">"Mtro. Téc. Sergio G. Olaizola" · Bella Unión</span>
          </div>
        </div>
        <div class="footer-layout">
           
          <!-- Columna 1: logo ANEP/UTU, texto institucional y redes sociales -->
          <div>
            <div class="footer-anep" aria-label="ANEP UTU Educación Técnico Profesional">
              <span class="anep">ANEP</span>
              <span class="sep"></span>
              <span class="utu">UTU</span>
              <span class="tagline" data-i18n="common.footer.tagline" data-i18n-html>Educación<br>Técnico<br>Profesional</span>
            </div>
            <p class="footer-about" data-i18n="common.footer.anepText">La Dirección General de Educación Técnico Profesional – UTU integra la Administración Nacional de Educación Pública (ANEP), ofreciendo educación técnica y tecnológica de nivel medio y terciario, y formación profesional básica y superior en todo el territorio del Uruguay, sobre la base de los principios de gratuidad, laicidad e igualdad.</p>
            <div class="footer-social" aria-hidden="true">
              <span><i class="bi bi-facebook"></i></span>
              <span><i class="bi bi-linkedin"></i></span>
              <span><i class="bi bi-instagram"></i></span>
              <span><i class="bi bi-youtube"></i></span>
              <span><i class="bi bi-twitter-x"></i></span>
            </div>
          </div>
           
          <!-- Columna 2: contactos (dirección, teléfono y correo) -->
          <div>
            <h3 data-i18n="common.footer.contactTitle">Contactos</h3>
            <p><i class="bi bi-geo-alt me-1"></i> <span data-i18n="common.footer.address">Pedro Acosta y Avenida Artigas, Bella Unión</span></p>
            <p><i class="bi bi-telephone me-1"></i> 4779 2025</p>
            <p><i class="bi bi-envelope me-1"></i> info@utu.edu.uy</p>
          </div>
           
          <!-- Columna 3: horario de atención y correo de secretaría -->
          <div>
            <h3 data-i18n="common.footer.attentionTitle">Atención</h3>
            <p><i class="bi bi-clock me-1"></i> <span data-i18n="common.footer.hours">Lunes a Viernes de 08:00 a 20:00 hs</span></p>
            <p><i class="bi bi-envelope me-1"></i> secretaria@utu.edu.uy</p>
          </div>
        </div>
         
        <!-- Franja inferior: derechos reservados y enlaces (privacidad, presentación) -->
        <div class="footer-bottom">
          <p data-i18n="common.footer.rights">© 2026 Escuela Técnica N.º 1 "Mtro. Téc. Sergio G. Olaizola" — Bella Unión. Todos los derechos reservados.</p>
          <div class="footer-links">
            <a
                href="https://www.utu.edu.uy/wp-content/themes/balpadraUTU/src/documents/politica%20de%20privacidad.pdf"
                target="_blank"
                rel="noopener"
                data-i18n="common.footer.privacy">Política de privacidad</a>
            <a
                href="https://www.utu.edu.uy/wp-content/themes/balpadraUTU/src/documents/encuentros/23oct25-litoralnorte/Escuela%20T%C3%A9cnica%20%C2%ABMtro%20Sergio%20Gonz%C3%A1lez%20Olaizola%C2%BB%20%E2%80%93%20Bella%20Uni%C3%B3n.pdf?_t=1761659170"
                target="_blank"
                rel="noopener"
                data-i18n="common.footer.presentation">Presentación</a>
          </div>
        </div>
      </div>
    </footer>
     
    <!-- ============ SCRIPTS ============
         Bootstrap 
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php /* Script opcional que debe cargar antes de las traducciones */ ?>
<?php if ($footerScriptBefore !== ''): ?>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?><?= htmlspecialchars($footerScriptBefore, ENT_QUOTES, 'UTF-8') ?>"></script>
<?php endif; ?>
    <?php /* Traducciones ES/PT (el ?v= usa la fecha del archivo para evitar caché vieja), motor i18n, buscador y funciones generales */ ?>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/js/translations.js?v=<?= (int) filemtime(__DIR__ . '/../assets/js/translations.js') ?>"></script>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/js/i18n.js"></script>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/js/buscador.js"></script>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/js/main.js"></script>
<?php /* Scripts opcionales propios de la página */ ?>
<?php if ($footerScriptAfter !== ''): ?>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?><?= htmlspecialchars($footerScriptAfter, ENT_QUOTES, 'UTF-8') ?>"></script>
<?php endif; ?>
<?php if ($footerScriptAfter2 !== ''): ?>
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?><?= htmlspecialchars($footerScriptAfter2, ENT_QUOTES, 'UTF-8') ?>"></script>
<?php endif; ?>
  </body>
</html>
