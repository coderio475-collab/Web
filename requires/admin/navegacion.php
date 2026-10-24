<?php
/**
 * ============================================================================
 * navegacion.php — MENÚ DE PESTAÑAS DEL PANEL crud
 * ============================================================================
 */
declare(strict_types=1);

// Muestra los enlaces para cambiar entre las tablas y las secciones administrativas.
?>
<nav class="nav nav-pills flex-wrap gap-2 mb-4" aria-label="Administración">
            <?php /* Pestañas de las tablas de la base (TABLAS_ADMIN, definidas en configuracion.php) */ ?>
            <?php foreach (TABLAS_ADMIN as $nombreTabla): ?>
                <a class="nav-link <?= $tabla === $nombreTabla ? 'active' : '' ?>" href="admin.php?tabla=<?= escapar($nombreTabla) ?>">
                    <?= escapar($nombreTabla === 'cupo_estudiantes' ? NOMBRES_TABLAS[$nombreTabla] : ucfirst($nombreTabla)) ?>
                </a>
            <?php endforeach; ?>
            <?php /* Pestañas de las secciones especiales: agenda, modificaciones de exámenes/horarios e imágenes */ ?>
            <a class="nav-link <?= $seccion === 'agenda' ? 'active' : '' ?>" href="admin.php?seccion=agenda">Agenda</a>
            <a class="nav-link <?= $seccion === 'modificaciones' ? 'active' : '' ?>" href="admin.php?seccion=modificaciones">Mod. exámenes y horarios</a>
            <a class="nav-link <?= $seccion === 'imagenes' ? 'active' : '' ?>" href="admin.php?seccion=imagenes">Imágenes de la página</a>
        </nav>
