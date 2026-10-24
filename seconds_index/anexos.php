<?php
/**
 * Página de anexos: presenta las sedes y sus datos de ubicación.
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Anexos - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Anexos de la Escuela Técnica N.º 1 de Bella Unión: noticias, horarios de atención y ubicación.';
$assetBase = '../';
// ---------- Inicio  ----------
require_once __DIR__ . '/../requires/head.php';
?>
<body data-i18n-title="anexos.title" data-root="../">
    <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>


    


<?php /* Pie de página y scripts  (footer_scripts.php) */ ?>
<?php
$footerScriptBefore = 'assets/js/imagenes.js';
$footerScriptAfter = 'assets/js/anexos.js';
require_once __DIR__ . '/../requires/footer_scripts.php';
?>
