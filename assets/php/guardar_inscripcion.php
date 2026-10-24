<?php
/**
 * ============================================================================
 * — RECIBE Y GUARDA EL FORMULARIO DE INSCRIPCIONES
 * ----------------------------------------------------------------------------
 *   Recibe los datos del formulario de inscripción, valida y guarda en la base.
 * ============================================================================
 */

declare(strict_types=1);

// ---------- Dependencias: conexión a la base y validaciones ----------
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/validaciones.php';

date_default_timezone_set('America/Montevideo');

// ---------- Constante de la página del formulario y función para volver con un estado ----------
/** Página del formulario  */
const PAGINA_FORMULARIO = '../../seconds_index/inscripciones.php';

/** Vuelve al formulario mostrando el resultado indicado. */
function volver_al_formulario(string $estado): never
{
    header('Location: ' . PAGINA_FORMULARIO . '?estado=' . urlencode($estado));
    exit;
}

// ---------- 1. Solo se acepta el método POST ----------
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . PAGINA_FORMULARIO);
    exit;
}

// ---------- 2.  campo anti-spam: ----------
if (limpiar_texto($_POST['sitio_web'] ?? '') !== '') {
    volver_al_formulario('ok');
}

// ---------- 3. Lectura y limpieza de los datos ----------
$nombre   = limpiar_texto($_POST['nombre_completo'] ?? '');
$cedula   = limpiar_texto($_POST['cedula'] ?? '');
$email    = limpiar_texto($_POST['email'] ?? '');
$telefono = normalizar_telefono(limpiar_texto($_POST['telefono'] ?? ''));
$fecha    = limpiar_texto($_POST['fecha_nacimiento'] ?? '');
$mensajeRaw = $_POST['mensaje'] ?? '';
$mensaje = is_string($mensajeRaw) ? trim($mensajeRaw) : '';
$acepta   = isset($_POST['acepta_terminos']) && $_POST['acepta_terminos'] === '1';

// ---------- 4. Validación del estudiante ----------
$edad = calcular_edad($fecha);
if (
    !es_nombre_valido($nombre)
    || !es_cedula_valida($cedula)
    || !es_email_valido($email)
    || $telefono === null
    || $edad === null
    || !is_string($mensajeRaw)
    || mb_strlen($mensaje) > 330
    || !$acepta                      // los términos y condiciones son obligatorios
) {
    volver_al_formulario('invalido');
}

// ---------- 5. Tipo de curso y curso: deben existir en la tabla "cursos" ----------
$tipo_curso = limpiar_texto($_POST['tipo_curso'] ?? '');
$curso      = limpiar_texto($_POST['curso'] ?? '');

try {
    $pdo = obtener_conexion();
    $stmt = $pdo->prepare('SELECT id FROM cursos WHERE tipo = :tipo AND nombre = :nombre AND activo = 1');
    $stmt->execute([':tipo' => $tipo_curso, ':nombre' => $curso]);
    $curso_id = $stmt->fetchColumn();
} catch (PDOException $e) {
    error_log('[riobase] Error al buscar el curso: ' . $e->getMessage());
    volver_al_formulario('error');
}
if ($curso_id === false) {
    volver_al_formulario('invalido');
}

// ---------- 6. Menores de 18 años: el tutor es obligatorio ----------
$es_menor = $edad < EDAD_MAYORIA;
$tutor = null;

if ($es_menor) {
    $tutor_nombre   = limpiar_texto($_POST['tutor_nombre'] ?? '');
    $tutor_telefono = normalizar_telefono(limpiar_texto($_POST['tutor_telefono'] ?? ''));
    $tutor_email    = limpiar_texto($_POST['tutor_email'] ?? '');

    if (!es_nombre_valido($tutor_nombre) || $tutor_telefono === null || !es_email_valido($tutor_email)) {
        volver_al_formulario('invalido');
    }
    $tutor = ['nombre' => $tutor_nombre, 'telefono' => $tutor_telefono, 'email' => $tutor_email];
}

// ---------- 7. Guardado en la base de datos  ----------
try {
    $pdo->beginTransaction();

    $tutor_id = null;
    if ($tutor !== null) {
        $stmt = $pdo->prepare('INSERT INTO tutores (nombre_completo, telefono, email) VALUES (:nombre, :telefono, :email)');
        $stmt->execute([
            ':nombre'   => $tutor['nombre'],
            ':telefono' => $tutor['telefono'],
            ':email'    => $tutor['email'],
        ]);
        $tutor_id = (int) $pdo->lastInsertId();
    }

    $stmt = $pdo->prepare(
        'INSERT INTO cupo_estudiantes
            (nombre_completo, cedula, email, telefono, fecha_nacimiento, es_menor, curso_id, tutor_id, mensaje, acepta_terminos, ip_registro)
         VALUES
            (:nombre, :cedula, :email, :telefono, :fecha, :es_menor, :curso_id, :tutor_id, :mensaje, 1, :ip)'
    );
    $stmt->execute([
        ':nombre'   => $nombre,
        ':cedula'   => $cedula,
        ':email'    => $email,
        ':telefono' => $telefono,
        ':fecha'    => $fecha,
        ':es_menor' => $es_menor ? 1 : 0,
        ':curso_id' => (int) $curso_id,
        ':tutor_id' => $tutor_id,
        ':mensaje'  => $mensaje === '' ? null : $mensaje,
        ':ip'       => $_SERVER['REMOTE_ADDR'] ?? null,
    ]);

    $pdo->commit();
    volver_al_formulario('ok');

} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();   // se deshace todo si algo falló
    }
    // 1062 = clave duplicada (la cédula ya tiene una reserva)
    if (($e->errorInfo[1] ?? 0) === 1062) {
        volver_al_formulario('duplicado');
    }
    error_log('[riobase] Error al guardar inscripción: ' . $e->getMessage());
    volver_al_formulario('error');
}