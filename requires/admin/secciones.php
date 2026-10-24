<?php
/**
 * ============================================================================
 * secciones.php — SELECTOR DE VISTA DEL PANEL
 * Se incluye desde pagina.php cuando el admin ya inició sesión.
 * Según ?seccion= de la URL carga una de estas vistas:
 *   imagenes       → imagenes.php        (cambiar imágenes del sitio)
 *   agenda         → agenda.php          (eventos de la agenda)
 *   modificaciones → modificaciones.php  (PDF de horarios y exámenes)
 *   (otro valor)   → registros.php       (tablas: cupo, cursos, tutores, docentes)
 * ============================================================================
 */
declare(strict_types=1);

// Elige que vista administrativa mostrar segun la seccion solicitada.
?><?php if ($seccion === 'imagenes'): ?>
<?php require __DIR__ . '/imagenes.php'; ?>
<?php elseif ($seccion === 'agenda'): ?>
<?php require __DIR__ . '/agenda.php'; ?>
<?php elseif ($seccion === 'modificaciones'): ?>
<?php require __DIR__ . '/modificaciones.php'; ?>
<?php else: ?>
<?php require __DIR__ . '/registros.php'; ?>
<?php endif; ?>
