<?php
/**
 * ============================================================================
 * acciones.php — DATOS Y OPERACIONES DEL PANEL crud (leer, crear, editar, eliminar)
 * Lo incluye controlador.php después del login. Se organiza en secciones:
 *
 *   1. Variables iniciales y chequeo de subidas que superan el límite de PHP
 *   2. Carga de datos comunes (cursos, tutores, PDF, imágenes, títulos, agenda)
 *   3. Acciones POST:
 *        3.1  cancelar_cupo / cancelar_docente      → marcan estado "cancelado"
 *        3.2  guardar_titulo_imagen                  → título de imágenes destacadas
 *        3.3  guardar_evento_agenda / eliminar_evento_agenda → agenda
 *        3.4  guardar_imagen / eliminar_imagen       → imágenes del sitio
 *        3.5  subir_archivo                          → PDF de horarios/exámenes 
 *        3.6  eliminar                               → borra un registro de la tabla elegida
 *        3.7  crear / actualizar                     → según la tablas
 *   4. Lectura del registro a editar (?editar=ID)
 *   5. Manejo de errores (validación, base de datos y errores inesperados)
 * ============================================================================
 */
declare(strict_types=1);

// Procesa formularios administrativos, consulta los datos necesarios y comunica errores al panel.

// ---------- 1. Variables iniciales ----------
// $autenticado indica si hay sesión de administrador
$autenticado = ($_SESSION['admin_autenticado'] ?? false) === true;
$pdo = null;
$cursos = [];
$tutores = [];
$registro = [];
$archivos = [];
$imagenes = [];
$titulosImagenes = [];
$agendaEventos = [];
$busqueda = limpiar_texto($_GET['buscar'] ?? '');
$editId = filter_var($_GET['editar'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

// ---------- 1b. Detecta formularios que superan post_max_size  ----------
// Detecta formularios multipart que PHP rechazo por superar su limite de recepcion.
if (
    $autenticado
    && ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST'
    && str_starts_with((string) ($_SERVER['CONTENT_TYPE'] ?? ''), 'multipart/form-data')
    && $_POST === []
    && $_FILES === []
    && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0
) {
    $error = 'La carga supera el límite de recepción de PHP. Aumentá post_max_size en php.ini y reiniciá Apache.';
}

// ---------- 2. Con sesión iniciada: se consulta la base y se procesan las acciones ----------
if ($autenticado) {
    try {
        // ---------- 2a. Carga de datos que usan varias vistas (cursos, tutores, PDF, imágenes, títulos y agenda) ----------
        // Carga los datos que se comparten entre los formularios y las secciones del panel.
        $pdo = obtener_conexion();
        $cursos = $pdo->query('SELECT id, tipo, nombre, sector, activo FROM cursos ORDER BY tipo, nombre')->fetchAll();
        $tutores = $pdo->query('SELECT id, nombre_completo, telefono, email FROM tutores ORDER BY nombre_completo')->fetchAll();
        $archivos = $pdo->query(
            'SELECT id, tipo, nombre_original, fecha_subida
             FROM archivos
             ORDER BY tipo, id DESC'
        )->fetchAll();
        $imagenes = $pdo->query(
            'SELECT ubicacion, nombre_original, mime_type, fecha_subida
             FROM imagenes_sitio
             ORDER BY ubicacion'
        )->fetchAll();
        $titulosImagenes = $pdo->query(
            'SELECT ubicacion, titulo
             FROM titulos_imagenes
             ORDER BY ubicacion'
        )->fetchAll(PDO::FETCH_KEY_PAIR);
        $agendaEventos = $pdo->query(
            'SELECT id, fecha, titulo
             FROM agenda_eventos
             ORDER BY fecha, id'
        )->fetchAll();

        // ---------- 3. Acciones POST: solo se aceptan con token CSRF válido ----------
        // Solo acepta cambios enviados por POST con un token CSRF valido.
        if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['accion']) && $_POST['accion'] !== 'logout') {
            if (!hash_equals(csrf_token(), (string) ($_POST['csrf_token'] ?? ''))) {
                throw new RuntimeException('La sesión del formulario venció. Actualizá la página e intentá nuevamente.');
            }

            $accion = (string) $_POST['accion'];
            // ---------- 3.1 Cancelar un cupo de estudiante (cambia el estado, no borra el registro) ----------
            // Cambia el estado de una inscripcion sin borrar el registro ni su historial.
            if ($accion === 'cancelar_cupo') {
                $idCupo = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                if ($idCupo === false) {
                    throw new RuntimeException('El cupo seleccionado no es válido.');
                }
                $stmt = $pdo->prepare("UPDATE cupo_estudiantes SET estado = 'cancelado' WHERE id = :id AND estado <> 'cancelado'");
                $stmt->execute([':id' => $idCupo]);
                if ($stmt->rowCount() === 0) {
                    $stmt = $pdo->prepare('SELECT estado FROM cupo_estudiantes WHERE id = :id');
                    $stmt->execute([':id' => $idCupo]);
                    if ($stmt->fetchColumn() === false) {
                        throw new RuntimeException('No se encontró el cupo seleccionado.');
                    }
                    redirigir_admin('cupo_estudiantes', 'El cupo ya estaba cancelado.');
                }
                redirigir_admin('cupo_estudiantes', 'Cupo cancelado.');
            }

            // ---------- 3.1b Cancelar una solicitud docente (igual que el cupo: solo cambia el estado) ----------
            if ($accion === 'cancelar_docente') {
                $idDocente = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                if ($idDocente === false) {
                    throw new RuntimeException('La solicitud seleccionada no es válida.');
                }
                $stmt = $pdo->prepare("UPDATE docentes SET estado = 'cancelado' WHERE id = :id AND estado <> 'cancelado'");
                $stmt->execute([':id' => $idDocente]);
                if ($stmt->rowCount() === 0) {
                    $stmt = $pdo->prepare('SELECT estado FROM docentes WHERE id = :id');
                    $stmt->execute([':id' => $idDocente]);
                    if ($stmt->fetchColumn() === false) {
                        throw new RuntimeException('No se encontró la solicitud seleccionada.');
                    }
                    redirigir_admin('docentes', 'La solicitud ya estaba cancelada.');
                }
                redirigir_admin('docentes', 'Solicitud docente cancelada.');
            }

            // ---------- 3.2 Guardar el título destacado de una imagen (inserta o actualiza) ----------
            if ($accion === 'guardar_titulo_imagen') {
                $ubicacion = (string) ($_POST['ubicacion'] ?? '');
                $titulo = campo('titulo');
                if (
                    !isset(UBICACIONES_IMAGENES[$ubicacion]['titulo_default'])
                    || $titulo === ''
                    || mb_strlen($titulo) > 180
                ) {
                    throw new RuntimeException('Ingresá un título válido para esta imagen (hasta 180 caracteres).');
                }

                $stmt = $pdo->prepare(
                    'INSERT INTO titulos_imagenes (ubicacion, titulo)
                     VALUES (:ubicacion, :titulo)
                     ON DUPLICATE KEY UPDATE titulo = VALUES(titulo)'
                );
                $stmt->execute([':ubicacion' => $ubicacion, ':titulo' => $titulo]);
                redirigir_imagenes('Título destacado guardado.');
            }

            // ---------- 3.3 Agenda: agregar un evento nuevo (sin id) o modificar uno existente (con id) ----------
            if ($accion === 'guardar_evento_agenda') {
                $idRaw = trim((string) ($_POST['id'] ?? ''));
                $fecha = trim((string) ($_POST['fecha'] ?? ''));
                $titulo = campo('titulo');
                $fechaValidada = DateTimeImmutable::createFromFormat('!Y-m-d', $fecha);
                $erroresFecha = DateTimeImmutable::getLastErrors();
                $fechaInvalida = $fechaValidada === false
                    || ($erroresFecha !== false && ($erroresFecha['warning_count'] > 0 || $erroresFecha['error_count'] > 0))
                    || $fechaValidada->format('Y-m-d') !== $fecha;
                if ($fechaInvalida || $titulo === '' || mb_strlen($titulo) > 180) {
                    throw new RuntimeException('Ingresá una fecha válida y un nombre de hasta 180 caracteres.');
                }

                if ($idRaw === '') {
                    $stmt = $pdo->prepare('INSERT INTO agenda_eventos (fecha, titulo) VALUES (:fecha, :titulo)');
                    $stmt->execute([':fecha' => $fecha, ':titulo' => $titulo]);
                    redirigir_agenda('Evento agregado a la agenda.');
                }

                $idEvento = filter_var($idRaw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                if ($idEvento === false) {
                    throw new RuntimeException('El evento seleccionado no es válido.');
                }
                $stmt = $pdo->prepare('UPDATE agenda_eventos SET fecha = :fecha, titulo = :titulo WHERE id = :id');
                $stmt->execute([':fecha' => $fecha, ':titulo' => $titulo, ':id' => $idEvento]);
                if ($stmt->rowCount() === 0) {
                    $stmt = $pdo->prepare('SELECT COUNT(*) FROM agenda_eventos WHERE id = :id');
                    $stmt->execute([':id' => $idEvento]);
                    if ((int) $stmt->fetchColumn() === 0) {
                        throw new RuntimeException('No se encontró el evento de agenda.');
                    }
                }
                redirigir_agenda('Cambios guardados en la agenda.');
            }

            // ---------- 3.3b Agenda: eliminar un evento ----------
            if ($accion === 'eliminar_evento_agenda') {
                $idEvento = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                if ($idEvento === false) {
                    throw new RuntimeException('El evento seleccionado no es válido.');
                }
                $stmt = $pdo->prepare('DELETE FROM agenda_eventos WHERE id = :id');
                $stmt->execute([':id' => $idEvento]);
                redirigir_agenda($stmt->rowCount() ? 'Evento eliminado de la agenda.' : 'No se encontró el evento.');
            }

            // ---------- 3.4 Imágenes del sitio: validar archivo (tamaño, tipo real JPG/PNG/WEBP/GIF) y guardarlo; si la ubicación ya tenía imagen, la reemplaza ----------
            if ($accion === 'guardar_imagen') {
                $ubicacion = (string) ($_POST['ubicacion'] ?? '');
                if (!isset(UBICACIONES_IMAGENES[$ubicacion])) {
                    throw new RuntimeException('Seleccioná una ubicación válida para la imagen.');
                }

                $imagenSubida = $_FILES['imagen'] ?? null;
                if (!is_array($imagenSubida) || !isset($imagenSubida['error'])) {
                    throw new RuntimeException('Seleccioná una imagen para subir.');
                }
                if ($imagenSubida['error'] !== UPLOAD_ERR_OK) {
                    $mensajeError = match ($imagenSubida['error']) {
                        UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'La imagen supera el límite de carga del servidor. Revisá upload_max_filesize y post_max_size en php.ini.',
                        UPLOAD_ERR_NO_FILE => 'Seleccioná una imagen para subir.',
                        default => 'No se pudo recibir la imagen. Intentá nuevamente.',
                    };
                    throw new RuntimeException($mensajeError);
                }

                $limiteBytes = 10 * 1024 * 1024;
                $rutaTemporal = (string) ($imagenSubida['tmp_name'] ?? '');
                $nombreOriginal = basename((string) ($imagenSubida['name'] ?? ''));
                if (
                    !is_uploaded_file($rutaTemporal)
                    || (int) ($imagenSubida['size'] ?? 0) < 1
                    || (int) $imagenSubida['size'] > $limiteBytes
                ) {
                    throw new RuntimeException('La imagen debe pesar hasta 10 MB.');
                }

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($rutaTemporal);
                $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                $datosImagen = getimagesize($rutaTemporal);
                if (
                    !in_array($mime, $tiposPermitidos, true)
                    || $datosImagen === false
                    || $datosImagen['mime'] !== $mime
                ) {
                    throw new RuntimeException('El archivo debe ser una imagen JPG, PNG, WEBP o GIF válida.');
                }

                $archivoImagen = fopen($rutaTemporal, 'rb');
                if ($archivoImagen === false) {
                    throw new RuntimeException('No se pudo leer la imagen.');
                }
                $nombreOriginal = mb_substr($nombreOriginal, 0, 255);
                $stmt = $pdo->prepare(
                    'INSERT INTO imagenes_sitio (ubicacion, nombre_original, mime_type, contenido)
                     VALUES (:ubicacion, :nombre, :mime, :contenido)
                     ON DUPLICATE KEY UPDATE
                       nombre_original = VALUES(nombre_original),
                       mime_type = VALUES(mime_type),
                       contenido = VALUES(contenido),
                       fecha_subida = CURRENT_TIMESTAMP'
                );
                $stmt->bindValue(':ubicacion', $ubicacion, PDO::PARAM_STR);
                $stmt->bindValue(':nombre', $nombreOriginal, PDO::PARAM_STR);
                $stmt->bindValue(':mime', $mime, PDO::PARAM_STR);
                $stmt->bindValue(':contenido', $archivoImagen, PDO::PARAM_LOB);
                try {
                    $stmt->execute();
                } finally {
                    fclose($archivoImagen);
                }
                redirigir_imagenes('Imagen guardada. La página pública ya muestra la imagen actualizada.');
            }

            // ---------- 3.4b Imágenes del sitio: eliminar la imagen de una ubicación ----------
            if ($accion === 'eliminar_imagen') {
                $ubicacion = (string) ($_POST['ubicacion'] ?? '');
                if (!isset(UBICACIONES_IMAGENES[$ubicacion])) {
                    throw new RuntimeException('Seleccioná una ubicación válida para la imagen.');
                }
                $stmt = $pdo->prepare('DELETE FROM imagenes_sitio WHERE ubicacion = :ubicacion');
                $stmt->execute([':ubicacion' => $ubicacion]);
                redirigir_imagenes($stmt->rowCount() ? 'Imagen eliminada de la página.' : 'No había una imagen cargada en esa ubicación.');
            }

            // ---------- 3.5 PDF de horarios / exámenes: validar (extensión, tipo, firma %PDF-) y guardar una versión nueva (se conserva el historial) ----------
            if ($accion === 'subir_archivo') {
                $tipoArchivo = (string) ($_POST['tipo_archivo'] ?? '');
                if (!in_array($tipoArchivo, ['horarios', 'examenes'], true)) {
                    throw new RuntimeException('Seleccioná si el PDF corresponde a horarios o exámenes.');
                }

                $archivoSubido = $_FILES['archivo_pdf'] ?? null;
                if (!is_array($archivoSubido) || !isset($archivoSubido['error'])) {
                    throw new RuntimeException('Seleccioná un archivo PDF para subir.');
                }
                if ($archivoSubido['error'] !== UPLOAD_ERR_OK) {
                    $mensajeError = match ($archivoSubido['error']) {
                        UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'El PDF supera el límite de carga del servidor. Revisá upload_max_filesize y post_max_size en php.ini.',
                        UPLOAD_ERR_NO_FILE => 'Seleccioná un archivo PDF para subir.',
                        default => 'No se pudo recibir el archivo PDF. Intentá nuevamente.',
                    };
                    throw new RuntimeException($mensajeError);
                }

                $limiteBytes = 50 * 1024 * 1024;
                $rutaTemporal = (string) ($archivoSubido['tmp_name'] ?? '');
                $nombreOriginal = basename((string) ($archivoSubido['name'] ?? ''));
                if (
                    !is_uploaded_file($rutaTemporal)
                    || (int) ($archivoSubido['size'] ?? 0) < 1
                    || (int) $archivoSubido['size'] > $limiteBytes
                    || strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION)) !== 'pdf'
                ) {
                    throw new RuntimeException('El archivo debe ser un PDF válido de hasta 50 MB.');
                }

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if ($finfo->file($rutaTemporal) !== 'application/pdf') {
                    throw new RuntimeException('El archivo seleccionado no tiene formato PDF.');
                }
                $archivoPdf = fopen($rutaTemporal, 'rb');
                if ($archivoPdf === false) {
                    throw new RuntimeException('No se pudo leer el archivo PDF.');
                }
                $firmaPdf = fread($archivoPdf, 5);
                if ($firmaPdf !== '%PDF-') {
                    fclose($archivoPdf);
                    throw new RuntimeException('No se pudo validar el contenido del PDF.');
                }
                if (!rewind($archivoPdf)) {
                    fclose($archivoPdf);
                    throw new RuntimeException('No se pudo leer el archivo PDF desde el inicio.');
                }
                $nombreOriginal = mb_substr($nombreOriginal, 0, 255);
                $stmt = $pdo->prepare(
                    'INSERT INTO archivos (tipo, nombre_original, mime_type, contenido)
                     VALUES (:tipo, :nombre, :mime, :contenido)'
                );
                $stmt->bindValue(':tipo', $tipoArchivo, PDO::PARAM_STR);
                $stmt->bindValue(':nombre', $nombreOriginal, PDO::PARAM_STR);
                $stmt->bindValue(':mime', 'application/pdf', PDO::PARAM_STR);
                $stmt->bindValue(':contenido', $archivoPdf, PDO::PARAM_LOB);
                try {
                    $stmt->execute();
                } finally {
                    fclose($archivoPdf);
                }
                redirigir_modificaciones('PDF subido. La página pública ya muestra la versión más reciente.');
            }

            // ---------- 3.6 Validación común de la operación: crear, actualizar o eliminar  ----------
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if (!in_array($accion, ['crear', 'actualizar', 'eliminar'], true) || ($accion !== 'crear' && $id === false)) {
                throw new RuntimeException('La operación solicitada no es válida.');
            }

            // ---------- 3.6b ELIMINAR: el nombre de la tabla sale de una lista fija ----------
            if ($accion === 'eliminar') {
                $tablaSql = [
                    'cupo_estudiantes' => 'cupo_estudiantes',
                    'cursos' => 'cursos',
                    'tutores' => 'tutores',
                    'docentes' => 'docentes',
                ][$tabla];
                $stmt = $pdo->prepare('DELETE FROM ' . $tablaSql . ' WHERE id = :id');
                $stmt->execute([':id' => $id]);
                redirigir_admin($tabla, $stmt->rowCount() ? 'Registro eliminado.' : 'No se encontró el registro.');
            }

            // ---------- 3.7 CREAR / ACTUALIZAR según la tabla elegida ----------
            // — cursos: tipo, nombre, sector y si está activo
            if ($tabla === 'cursos') {
                $datos = [
                    'tipo' => campo('tipo'),
                    'nombre' => campo('nombre'),
                    'sector' => campo('sector'),
                ];
                $activo = filter_var($_POST['activo'] ?? null, FILTER_VALIDATE_INT);
                if (
                    $datos['tipo'] === '' || mb_strlen($datos['tipo']) > 80
                    || $datos['nombre'] === '' || mb_strlen($datos['nombre']) > 100
                    || $datos['sector'] === '' || mb_strlen($datos['sector']) > 80
                    || !in_array($activo, [0, 1], true)
                ) {
                    throw new RuntimeException('Completá los campos del curso con valores válidos.');
                }
                $datos['activo'] = $activo;
                if ($accion === 'crear') {
                    $stmt = $pdo->prepare('INSERT INTO cursos (tipo, nombre, sector, activo) VALUES (:tipo, :nombre, :sector, :activo)');
                } else {
                    $stmt = $pdo->prepare('UPDATE cursos SET tipo = :tipo, nombre = :nombre, sector = :sector, activo = :activo WHERE id = :id');
                    $datos['id'] = $id;
                }
                $stmt->execute($datos);
            // ---------- — tutores: nombre, teléfono y correo ----------
            } elseif ($tabla === 'tutores') {
                $datos = [
                    'nombre' => campo('nombre_completo'),
                    'telefono' => normalizar_telefono(campo('telefono')),
                    'email' => campo('email'),
                ];
                if (!es_nombre_valido($datos['nombre']) || $datos['telefono'] === null || !es_email_valido($datos['email'])) {
                    throw new RuntimeException('Verificá el nombre, teléfono y correo del tutor.');
                }
                if ($accion === 'crear') {
                    $stmt = $pdo->prepare('INSERT INTO tutores (nombre_completo, telefono, email) VALUES (:nombre, :telefono, :email)');
                } else {
                    $stmt = $pdo->prepare('UPDATE tutores SET nombre_completo = :nombre, telefono = :telefono, email = :email WHERE id = :id');
                    $datos['id'] = $id;
                }
                $stmt->execute($datos);
            // ---------- — docentes: datos personales, formación, solicitud, mensaje y estado ----------
            } elseif ($tabla === 'docentes') {
                $nombre = campo('nombre_completo');
                $cedula = campo('cedula');
                $email = campo('email');
                $telefono = normalizar_telefono(campo('telefono'));
                $fecha = campo('fecha_nacimiento');
                $formacion = campo('formacion_academica');
                $solicitud = campo('solicitud');
                $detalle = campo('solicitud_detalle');
                $mensajeDocenteRaw = $_POST['mensaje'] ?? '';
                $mensajeDocente = is_string($mensajeDocenteRaw) ? trim($mensajeDocenteRaw) : '';
                $estadoDocente = campo('estado');
                if (
                    !es_nombre_valido($nombre)
                    || !es_cedula_valida($cedula)
                    || !es_email_valido($email)
                    || $telefono === null
                    || calcular_edad($fecha) === null
                    || $formacion === ''
                    || mb_strlen($formacion) > 100
                    || !in_array($solicitud, ['especializacion', 'otro'], true)
                    || ($solicitud === 'otro' && ($detalle === '' || mb_strlen($detalle) > 30))
                    || ($solicitud === 'especializacion' && $detalle !== '' && mb_strlen($detalle) > 30)
                    || !is_string($mensajeDocenteRaw)
                    || mb_strlen($mensajeDocente) > 330
                    || !in_array($estadoDocente, ['recibido', 'contactado', 'descartado', 'cancelado'], true)
                    || !isset($_POST['acepta_terminos'])
                ) {
                    throw new RuntimeException('Verificá los datos del docente y la aceptación de términos.');
                }

                $datos = [
                    ':nombre' => $nombre,
                    ':cedula' => $cedula,
                    ':email' => $email,
                    ':telefono' => $telefono,
                    ':fecha' => $fecha,
                    ':formacion' => $formacion,
                    ':solicitud' => $solicitud,
                    ':detalle' => $detalle === '' ? null : $detalle,
                    ':mensaje' => $mensajeDocente === '' ? null : $mensajeDocente,
                    ':estado' => $estadoDocente,
                ];
                if ($accion === 'crear') {
                    $datos[':ip'] = $_SERVER['REMOTE_ADDR'] ?? null;
                    $stmt = $pdo->prepare(
                        'INSERT INTO docentes
                            (nombre_completo, cedula, email, telefono, fecha_nacimiento, formacion_academica, solicitud, solicitud_detalle, mensaje, acepta_terminos, estado, ip_registro)
                         VALUES
                            (:nombre, :cedula, :email, :telefono, :fecha, :formacion, :solicitud, :detalle, :mensaje, 1, :estado, :ip)'
                    );
                } else {
                    $datos[':id'] = $id;
                    $stmt = $pdo->prepare(
                        'UPDATE docentes
                         SET nombre_completo = :nombre, cedula = :cedula, email = :email, telefono = :telefono,
                             fecha_nacimiento = :fecha, formacion_academica = :formacion, solicitud = :solicitud,
                             solicitud_detalle = :detalle, mensaje = :mensaje, acepta_terminos = 1, estado = :estado
                         WHERE id = :id'
                    );
                }
                $stmt->execute($datos);
            // ---------- — cupo_estudiantes: datos del estudiante, curso, tutor  ----------
            } else {
                $nombre = campo('nombre_completo');
                $cedula = campo('cedula');
                $email = campo('email');
                $telefono = normalizar_telefono(campo('telefono'));
                $fecha = campo('fecha_nacimiento');
                $mensajeCupoRaw = $_POST['mensaje'] ?? '';
                $mensajeCupo = is_string($mensajeCupoRaw) ? trim($mensajeCupoRaw) : '';
                $cursoId = filter_var($_POST['curso_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                $tutorRaw = campo('tutor_id');
                $tutorId = $tutorRaw === '' ? null : filter_var($tutorRaw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                $estado = campo('estado');
                $edad = calcular_edad($fecha);

                if (
                    !es_nombre_valido($nombre) || !es_cedula_valida($cedula)
                    || !es_email_valido($email) || $telefono === null || $edad === null
                    || $cursoId === false || $tutorId === false
                    || !is_string($mensajeCupoRaw)
                    || mb_strlen($mensajeCupo) > 330
                    || !in_array($estado, ['reservado', 'confirmado', 'cancelado'], true)
                    || !isset($_POST['acepta_terminos'])
                ) {
                    throw new RuntimeException('Verificá los datos de la inscripción y la aceptación de términos.');
                }
                if ($edad < EDAD_MAYORIA && $tutorId === null) {
                    throw new RuntimeException('Las personas menores de 18 años deben tener un tutor asociado.');
                }
                $stmt = $pdo->prepare('SELECT COUNT(*) FROM cursos WHERE id = :id');
                $stmt->execute([':id' => $cursoId]);
                if ((int) $stmt->fetchColumn() !== 1) {
                    throw new RuntimeException('El curso seleccionado no existe.');
                }
                if ($tutorId !== null) {
                    $stmt = $pdo->prepare('SELECT COUNT(*) FROM tutores WHERE id = :id');
                    $stmt->execute([':id' => $tutorId]);
                    if ((int) $stmt->fetchColumn() !== 1) {
                        throw new RuntimeException('El tutor seleccionado no existe.');
                    }
                }

                $datos = [
                    ':nombre' => $nombre,
                    ':cedula' => $cedula,
                    ':email' => $email,
                    ':telefono' => $telefono,
                    ':fecha' => $fecha,
                    ':es_menor' => $edad < EDAD_MAYORIA ? 1 : 0,
                    ':curso_id' => $cursoId,
                    ':tutor_id' => $tutorId,
                    ':estado' => $estado,
                    ':mensaje' => $mensajeCupo === '' ? null : $mensajeCupo,
                ];
                if ($accion === 'crear') {
                    $datos[':ip'] = $_SERVER['REMOTE_ADDR'] ?? null;
                    $stmt = $pdo->prepare(
                        'INSERT INTO cupo_estudiantes
                            (nombre_completo, cedula, email, telefono, fecha_nacimiento, es_menor, curso_id, tutor_id, mensaje, acepta_terminos, estado, ip_registro)
                         VALUES
                            (:nombre, :cedula, :email, :telefono, :fecha, :es_menor, :curso_id, :tutor_id, :mensaje, 1, :estado, :ip)'
                    );
                } else {
                    $datos[':id'] = $id;
                    $stmt = $pdo->prepare(
                        'UPDATE cupo_estudiantes
                         SET nombre_completo = :nombre, cedula = :cedula, email = :email, telefono = :telefono,
                             fecha_nacimiento = :fecha, es_menor = :es_menor, curso_id = :curso_id,
                             tutor_id = :tutor_id, mensaje = :mensaje, acepta_terminos = 1, estado = :estado
                         WHERE id = :id'
                    );
                }
                $stmt->execute($datos);
            }

            // ---------- 3.8 Fin de la operación: vuelve a la tabla con un mensaje de éxito ----------
            redirigir_admin($tabla, $accion === 'crear' ? 'Registro creado.' : 'Cambios guardados.');
        }

        // ---------- 4. Edición: lee el registro elegido (?editar=ID) para rellenar el formulario ----------
        // Lee el registro seleccionado para rellenar el formulario de edicion.
        if ($editId !== false && $editId !== null) {
            if ($tabla === 'cursos') {
                $stmt = $pdo->prepare('SELECT id, tipo, nombre, sector, activo FROM cursos WHERE id = :id');
            } elseif ($tabla === 'tutores') {
                $stmt = $pdo->prepare('SELECT id, nombre_completo, telefono, email FROM tutores WHERE id = :id');
            } elseif ($tabla === 'docentes') {
                $stmt = $pdo->prepare('SELECT id, nombre_completo, cedula, email, telefono, fecha_nacimiento, formacion_academica, solicitud, solicitud_detalle, mensaje, acepta_terminos, estado FROM docentes WHERE id = :id');
            } else {
                $stmt = $pdo->prepare('SELECT id, nombre_completo, cedula, email, telefono, fecha_nacimiento, curso_id, tutor_id, mensaje, estado FROM cupo_estudiantes WHERE id = :id');
            }
            $stmt->execute([':id' => $editId]);
            $registro = $stmt->fetch() ?: [];
            if ($registro === []) {
                $error = 'No se encontró el registro solicitado.';
            }
        }
    // ---------- 5. Manejo de errores ----------
    // RuntimeException = error de validación  PDOException = error de base (1062 = dato repetido); Throwable = error inesperado (se registra en el log)
    } catch (RuntimeException $e) {
        $error = $e->getMessage();
    } catch (PDOException $e) {
        error_log('[riobase admin] Error de base de datos: ' . $e->getMessage());
        $error = ($e->errorInfo[1] ?? null) === 1062
            ? 'Ya existe un registro con esos datos únicos (por ejemplo, esa cédula o curso).'
            : 'No se pudo completar la operación. El registro podría estar relacionado con otros datos.';
    } catch (Throwable $e) {
        error_log('[riobase admin] Error inesperado: ' . $e->getMessage());
        $error = 'Ocurrió un error inesperado al procesar la solicitud.';
    }
}