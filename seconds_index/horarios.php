<?php
/**
 * Consulta de horarios y exámenes publicados por la institución.
 */
// ---------- Datos de la página (título y descripción para el <head>) y ruta base de los recursos ----------
$pageTitle = 'Horarios y Exámenes - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = 'Horarios por materias, exámenes y turnos de la Escuela Técnica N.º 1 de Bella Unión.';
$assetBase = '../';
// ---------- Inicio ----------
require_once __DIR__ . '/../requires/head.php';
?>
    <body data-i18n-title="horarios.title" data-root="../">
      <!-- ======================= Encabezado ======================= -->
    <?php  require_once __DIR__ . '/../requires/header.php'; ?>


   <?php require_once __DIR__ . '/../requires/footer_scripts.php'; ?>