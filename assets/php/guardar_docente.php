<?php
/**
 * validacion de campos y guardado de docentes en la base de datos
 * Recibe la solicitud de un docente, valida sus campos en el servidor y la
 * registra en la tabla docentes.
 */
declare(strict_types=1);

// ---------- Zona horaria ----------
date_default_timezone_set('America/Montevideo');

// ---------- Utilidades: página a la que se vuelve (inscripciones.php) y función para redirigir con un estado ----------
$paginaFormulario = '../../seconds_index/inscripciones.php';
$volver = static function (string $estado) use ($paginaFormulario): never {
    header('Location: ' . $paginaFormulario . '?formulario=docentes&estado=' . urlencode($estado));
    exit;
};

// ---------- Solo se aceptan envíos POST; si entran por URL se los devuelve al formulario ----------
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . $paginaFormulario . '?formulario=docentes');
    exit;
}

// ---------- Limpieza de texto: quita espacios sobrantes ----------
$limpiarTexto = static function (mixed $valor): string {
    return preg_replace('/\s+/u', ' ', trim((string) $valor)) ?? '';
};

// ---------- Anti-spam ----------
if ($limpiarTexto($_POST['sitio_web'] ?? '') !== '') {
    $volver('ok');
}

// ---------- Lectura de los campos enviados por el formulario de docentes ----------
$nombre = $limpiarTexto($_POST['nombre_completo'] ?? '');
$cedula = $limpiarTexto($_POST['cedula'] ?? '');
$email = $limpiarTexto($_POST['email'] ?? '');
$telefonoRecibido = $_POST['telefono'] ?? '';
$telefono = is_string($telefonoRecibido) ? $telefonoRecibido : '';
$fecha = $limpiarTexto($_POST['fecha_nacimiento'] ?? '');
$formacion = $limpiarTexto($_POST['formacion_academica'] ?? '');
$solicitud = $limpiarTexto($_POST['solicitud'] ?? '');
$detalle = $limpiarTexto($_POST['solicitud_detalle'] ?? '');
$mensaje = trim(str_replace(["\r\n", "\r"], "\n", (string) ($_POST['mensaje'] ?? '')));
$acepta = ($_POST['acepta_terminos'] ?? '') === '1';
// ---------- Validación de la fecha de nacimiento (formato válido, no futura, no anterior a 1900) ----------
$fechaNacimiento = DateTimeImmutable::createFromFormat('!Y-m-d', $fecha);
$erroresFecha = DateTimeImmutable::getLastErrors();
$fechaInvalida = $fechaNacimiento === false
    || ($erroresFecha !== false && ($erroresFecha['warning_count'] > 0 || $erroresFecha['error_count'] > 0))
    || ($fechaNacimiento !== false && ($fechaNacimiento > new DateTimeImmutable('today') || (int) $fechaNacimiento->format('Y') < 1900));

// ---------- Validación en el servidor de todos los campos: cualquier error vuelve con estado "invalido" ----------
if (
    mb_strlen($nombre) < 3 || mb_strlen($nombre) > 120
    || !preg_match('/^\d{8}$/', $cedula)
    || mb_strlen($email) > 150 || filter_var($email, FILTER_VALIDATE_EMAIL) === false
    || !preg_match('/^[0-9]{9}$/D', $telefono)
    || $fechaInvalida
    || mb_strlen($formacion) < 2 || mb_strlen($formacion) > 100
    || !in_array($solicitud, ['especializacion', 'otro'], true)
    || mb_strlen($detalle) > 30
    || ($solicitud === 'otro' && $detalle === '')
    || mb_strlen($mensaje) > 330
    || !$acepta
) {
    $volver('invalido');
}

// ---------- Guardado en la tabla docentes con sentencia preparada ----------
try {
    $conexion = new PDO(
        'mysql:host=localhost:3306;dbname=riobase;charset=utf8mb4',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    $consulta = $conexion->prepare(
        'INSERT INTO docentes
            (nombre_completo, cedula, email, telefono, fecha_nacimiento, formacion_academica,
             solicitud, solicitud_detalle, mensaje, acepta_terminos, ip_registro)
         VALUES
            (:nombre, :cedula, :email, :telefono, :fecha, :formacion,
             :solicitud, :detalle, :mensaje, 1, :ip)'
    );
    $consulta->execute([
        ':nombre' => $nombre,
        ':cedula' => $cedula,
        ':email' => $email,
        ':telefono' => $telefono,
        ':fecha' => $fecha,
        ':formacion' => $formacion,
        ':solicitud' => $solicitud,
        ':detalle' => $detalle === '' ? null : $detalle,
        ':mensaje' => $mensaje === '' ? null : $mensaje,
        ':ip' => $_SERVER['REMOTE_ADDR'] ?? null,
    ]);
    $volver('ok');
// ---------- Errores: 1062 = cédula repetida (duplicado); cualquier otro se registra en el log del servidor ----------
} catch (PDOException $error) {
    if (($error->errorInfo[1] ?? 0) === 1062) {
        $volver('duplicado');
    }
    error_log('[riobase] Error al guardar docente: ' . $error->getMessage());
    $volver('error');
}
