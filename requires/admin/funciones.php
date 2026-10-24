<?php
/**
 * ============================================================================
 * funciones.php — FUNCIONES COMPARTIDAS DEL PANEL CRUD
 * Agrupa:
 *   1. Seguridad y lectura de formularios: escapar(), csrf_token(), campo()
 *   2. Redirecciones con mensaje de aviso: redirigir_admin/modificaciones/imagenes/agenda()
 *   3. Ayudas para dibujar formularios: campo_texto(), selects de cursos y tutores
 * ============================================================================
 */
declare(strict_types=1);

// Funciones compartidas para validar

// ---------- 1. Seguridad y lectura de formularios ----------
/**
 * Convierte cualquier valor en texto seguro para mostrarlo en HTML mediante entidades.
 */
function escapar(mixed $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Obtiene el token CSRF de la sesion o crea uno aleatorio para proteger formularios.
 */
function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Lee un campo enviado por formulario y lo limpia con las validaciones compartidas.
 */
function campo(string $nombre): string
{
    return limpiar_texto($_POST[$nombre] ?? '');
}

// ---------- 2. Redirecciones con aviso  ----------
/**
 * Guarda un aviso de resultado y vuelve a la tabla de administracion indicada.
 */
function redirigir_admin(string $tabla, string $mensaje): never
{
    $_SESSION['admin_mensaje'] = $mensaje;
    header('Location: admin.php?tabla=' . urlencode($tabla));
    exit;
}

/**
 * Guarda un aviso y vuelve a la seccion de horarios y examenes.
 */
function redirigir_modificaciones(string $mensaje): never
{
    $_SESSION['admin_mensaje'] = $mensaje;
    header('Location: admin.php?seccion=modificaciones');
    exit;
}

/**
 * Guarda un aviso y vuelve a la seccion de imagenes del sitio.
 */
function redirigir_imagenes(string $mensaje): never
{
    $_SESSION['admin_mensaje'] = $mensaje;
    header('Location: admin.php?seccion=imagenes');
    exit;
}

/**
 * Muestra el resultado y vuelve a la sección CRUD de enlaces externos.
 */
function redirigir_enlaces(string $mensaje): void
{
    $_SESSION['admin_mensaje'] = $mensaje;
    header('Location: admin.php?seccion=enlaces');
    exit;
}

/**
 * Guarda un aviso y vuelve a la agenda despues de una operacion.
 */
function redirigir_agenda(string $mensaje): void
{
    $_SESSION['admin_mensaje'] = $mensaje;
    header('Location: admin.php?seccion=agenda');
    exit;
}

// ---------- 3. Ayudas para dibujar formularios HTML ----------
/**
 * Imprime un campo de texto HTML con etiqueta, valor escapado y opciones de validacion.
 */
function campo_texto(string $nombre, string $etiqueta, string $valor = '', array $opciones = []): void
{
    $tipo = $opciones['type'] ?? 'text';
    $maximo = $opciones['maxlength'] ?? 150;
    $requerido = $opciones['required'] ?? true;
    $atributoRequerido = $requerido ? ' required' : '';
    $valorHtml = escapar($valor);

    echo '<div class="col-md-6"><label class="form-label" for="' . escapar($nombre) . '">' . escapar($etiqueta) . '</label>';
    echo '<input class="form-control" type="' . escapar($tipo) . '" id="' . escapar($nombre) . '" name="' . escapar($nombre) . '" maxlength="' . (int) $maximo . '" value="' . $valorHtml . '"' . $atributoRequerido . '></div>';
}

/**
 * Devuelve el atributo HTML que marca una opcion como seleccionada si coincide.
 */
function seleccionar_opcion(string $actual, string $valor): string
{
    return $actual === $valor ? ' selected' : '';
}

/**
 * Imprime las opciones de cursos y senala el curso elegido en el formulario.
 */
function mostrar_curso_options(array $cursos, string $seleccionado): void
{
    echo '<option value="">Seleccioná un curso</option>';
    foreach ($cursos as $curso) {
        $id = (string) $curso['id'];
        $estado = (int) $curso['activo'] === 1 ? '' : ' (inactivo)';
        echo '<option value="' . escapar($id) . '"' . seleccionar_opcion($seleccionado, $id) . '>'
            . escapar($curso['tipo'] . ' · ' . $curso['nombre'] . $estado) . '</option>';
    }
}

/**
 * Imprime las opciones de tutores y señala el tutor elegido en el formulario.
 */
function mostrar_tutor_options(array $tutores, string $seleccionado): void
{
    echo '<option value="">Sin tutor</option>';
    foreach ($tutores as $tutor) {
        $id = (string) $tutor['id'];
        echo '<option value="' . escapar($id) . '"' . seleccionar_opcion($seleccionado, $id) . '>'
            . escapar($tutor['nombre_completo'] . ' · #' . $id) . '</option>';
    }
}
