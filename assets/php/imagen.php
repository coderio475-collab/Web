<?php
/**
 * hace que el navegador muestre la imagen de la ubicación  (?ubicacion=) o un 404 si no existe.
 */
declare(strict_types=1);

require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/imagenes_config.php';

// ---------- 1. Validar la ubicación  (?ubicacion=) contra el catálogo de imag----------
$ubicacion = (string) ($_GET['ubicacion'] ?? '');
if (!isset(UBICACIONES_IMAGENES[$ubicacion])) {
    http_response_code(400);
    exit('Ubicación de imagen no válida.');
}

// ---------- 2. Buscar la imagen en la base de datos ----------
try {
    $pdo = obtener_conexion();
    $stmt = $pdo->prepare(
        'SELECT mime_type, contenido
         FROM imagenes_sitio
         WHERE ubicacion = :ubicacion
         LIMIT 1'
    );
    $stmt->execute([':ubicacion' => $ubicacion]);
    $imagen = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('[riobase imágenes] Error al consultar la imagen: ' . $e->getMessage());
    http_response_code(503);
    exit('No se pudo obtener la imagen en este momento.');
}

// ---------- 3. Si no existe, responder 404 ----------
if ($imagen === false) {
    http_response_code(404);
    exit;
}

// ---------- 4. Enviar la imagen al navegador con sus cabeceras (tipo, tamaño, sin caché) ----------
header('Content-Type: ' . $imagen['mime_type']);
header('Content-Length: ' . strlen($imagen['contenido']));
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('X-Content-Type-Options: nosniff');
echo $imagen['contenido'];
