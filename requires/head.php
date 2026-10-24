<?php
/**
 * Inicio  (<head>, estilos y tema) para todas las páginas del sitio.
 */
// ---------- Valores por defecto título/descripción ----------
$pageTitle = $pageTitle ?? 'Inicio - Escuela Técnica N.º 1 Bella Unión';
$pageDescription = $pageDescription ?? "Escuela Técnica N.º 1 'Mtro. Téc. Sergio G. Olaizola' — Bella Unión. Formación técnica para tu futuro.";
$assetBase = $assetBase ?? '';
require_once __DIR__ . '/../assets/php/contenido_publico.php';
// ---------- Enlaces externos: carga los destinos guardados para que los use la página ----------
$enlacesExternos = $titulosImagenes ?? $textosVestimenta ?? obtener_titulos_imagenes();
?>
<!-- Inicio del documento HTML -->
<!DOCTYPE html>
<html lang="es">
  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <!-- Tipografías de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5.3 (estilos) e iconos Bootstrap Icons desde CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Hoja de estilos del sitio -->
    <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/css/styles.css?v=<?= (int) filemtime(__DIR__ . '/../assets/css/styles.css') ?>">
    <!-- Motor de tema claro/oscuro: -->
    <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>assets/js/theme.js"></script>
  </head>
