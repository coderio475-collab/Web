<?php
/**
 * ============================================================================
 * pagina.php — ESTRUCTURA HTML DEL PANEL crud  
 * Arma la página completa: cabecera, avisos (error / éxito) y el contenido.
 *   - Sin sesión → muestra acceso.php (login)
 *   - Con sesión → muestra navegacion.php + secciones.php
 * Variables que recibe de controlador.php: $autenticado, $error, $mensaje.
 * ============================================================================
 */
declare(strict_types=1);

// Presenta la estructura de la pagina y carga el acceso o las secciones correspondientes.
?><!doctype html>
<html lang="es" class="ready">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administración · Escuela Técnica N.º 1</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Estilos propios del panel (tarjetas, tabla, acciones) -->
    <style>
        .admin-shell { max-width: 1240px; }
        .admin-card { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); box-shadow: var(--shadow-soft); }
        .admin-table th { white-space: nowrap; }
        .admin-actions { display: flex; gap: .5rem; align-items: center; }
        .pdf-upload { max-width: 760px; }
    </style>
</head>
<body>
<!-- Cabecera: enlace para volver al sitio, título y botón "Cerrar sesión" (solo si hay sesión) -->
<main class="container admin-shell py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <a href="index.php" class="text-decoration-none small">&larr; Volver al sitio</a>
            <h1 class="h2 mt-2 mb-0">Administración de la base de datos</h1>
        </div>
        <?php if ($autenticado): ?>
            <form method="post">
                <input type="hidden" name="accion" value="logout">
                <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                <button class="btn btn-outline-secondary" type="submit">Cerrar sesión</button>
            </form>
        <?php endif; ?>
    </div>

    <?php /* Avisos: mensaje de error (rojo) y de éxito (verde) */ ?>
    <?php if ($error !== ''): ?><div class="alert alert-danger" role="alert"><?= escapar($error) ?></div><?php endif; ?>
    <?php if ($mensaje !== ''): ?><div class="alert alert-success" role="status"><?= escapar($mensaje) ?></div><?php endif; ?>

    <?php /* Contenido: login si no hay sesión; si hay sesión, pestañas + la vista elegida */ ?>
    <?php if (!$autenticado): ?>
<?php require __DIR__ . '/acceso.php'; ?>
    <?php else: ?>
<?php require __DIR__ . '/navegacion.php'; ?>
<?php require __DIR__ . '/secciones.php'; ?>
    <?php endif; ?>
</main>
</body>
</html>