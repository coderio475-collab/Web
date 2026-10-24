<?php
/**
 * Entrega al navegador la última versión de un PDF de horarios o exámenes.
 */
declare(strict_types=1);

require_once __DIR__ . '/conexion.php';

// ---------- 1. Validar el tipo pedido (?tipo=horarios | examenes) y el id opcional ----------
$tipo = (string) ($_GET['tipo'] ?? '');
if (!in_array($tipo, ['horarios', 'examenes'], true)) {
    http_response_code(400);
    exit('Tipo de archivo no válido.');
}

$idArchivo = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

// ---------- 2. Buscar en la base el PDF más reciente (o el id solicitado) ----------
try {
    $pdo = obtener_conexion();
    $sql = 'SELECT nombre_original, mime_type, contenido
            FROM archivos
            WHERE tipo = :tipo';
    $params = ['tipo' => $tipo];

    if ($idArchivo !== false) {
        $sql .= ' AND id = :id';
        $params['id'] = $idArchivo;
    }

    $sql .= ' ORDER BY id DESC LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $archivo = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('[riobase archivos] Error al consultar el PDF: ' . $e->getMessage());
    http_response_code(503);
    exit('No se pudo obtener el PDF en este momento.');
}

// ---------- 3. Si no hay PDF: horarios usa el PDF de respaldo, exámenes responde 404 ----------
if ($archivo === false) {
    if ($tipo === 'horarios') {
        header('Location: ../otros/Horarios%20de%20Escuela.pdf');
        exit;
    }
    http_response_code(404);
    exit('Todavía no hay un PDF de exámenes publicado.');
}

// ---------- 4. Enviar el PDF al navegador (se muestra en pantalla) ----------
$nombreSeguro = rawurlencode((string) $archivo['nombre_original']);
$contenido = $archivo['contenido'];
if (preg_match('/\A\d\.\d(?:\r?\n)%/', $contenido) === 1) {
    $contenido = '%PDF-' . $contenido;
}
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="documento.pdf"; filename*=UTF-8\'\'' . $nombreSeguro);
header('Content-Length: ' . strlen($contenido));
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('X-Content-Type-Options: nosniff');
echo $contenido;