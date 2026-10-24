<?php
/**
 * ============================================================================
 * controlador.php — CONTROLADOR DEL PANEL DE ADMIN
 * Orden de ejecución (lo incluye admin.php):
 *   1. Carga configuración y funciones
 *   2. Valida la tabla / sección pedida en la URL
 *   3. Lee las credenciales del administrador (variables de entorno de Apache)
 *   4. Atiende el LOGIN y el LOGOUT (con token CSRF)
 *   5. Incluye acciones.php (datos y operaciones) y pagina.php (HTML)
 * ============================================================================
 */
declare(strict_types=1);

// Coordina la seleccion de seccion, el acceso y la carga de las vistas del panel.

// ---------- 1. Dependencias ----------
require_once __DIR__ . '/configuracion.php';
require_once __DIR__ . '/funciones.php';

// ---------- 2. Tabla y sección elegidas  ----------
// Limita la seleccion a tablas y secciones conocidas antes de usarla en consultas o vistas.
$tabla = (string) ($_GET['tabla'] ?? $_POST['tabla'] ?? 'cupo_estudiantes');
if (!in_array($tabla, TABLAS_ADMIN, true)) {
    $tabla = 'cupo_estudiantes';
}
$seccion = (string) ($_GET['seccion'] ?? '');
// ---------- Enlaces externos: permite seleccionar su sección del CRUD ----------
if (!in_array($seccion, ['modificaciones', 'imagenes', 'agenda', 'enlaces'], true)) {
    $seccion = '';
}

// ---------- 3. Estado inicial: mensajes y credenciales del administrador ----------
// $mensaje viene de la sesión
$error = '';
$mensaje = (string) ($_SESSION['admin_mensaje'] ?? '');
unset($_SESSION['admin_mensaje']);
$nombreUsuario = getenv('CRUD_ADMIN_USER');
$hashContrasena = getenv('CRUD_ADMIN_PASSWORD_HASH');
$credencialesConfiguradas = is_string($nombreUsuario) && $nombreUsuario !== ''
    && is_string($hashContrasena) && password_get_info($hashContrasena)['algo'] !== null;

// ---------- 4a. LOGIN: valida el token CSRF y el usuario/contraseña (hash con password_verify) ----------
// Comprueba el token y las credenciales antes de crear una sesion autenticada nueva.
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && ($_POST['accion'] ?? '') === 'login') {
    if (!hash_equals(csrf_token(), (string) ($_POST['csrf_token'] ?? ''))) {
        $error = 'La sesión del formulario venció. Actualizá la página e intentá nuevamente.';
    } elseif (!$credencialesConfiguradas) {
        $error = 'El acceso administrativo no está configurado. Seguí las instrucciones de main/database/CRUD.md.';
    } elseif (
        hash_equals((string) $nombreUsuario, campo('usuario'))
        && password_verify((string) ($_POST['contrasena'] ?? ''), (string) $hashContrasena)
    ) {
        session_regenerate_id(true);
        $_SESSION['admin_autenticado'] = true;
        unset($_SESSION['csrf_token']);
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos.';
    }
}

// ---------- 4b. LOGOUT: destruye la sesión y borra la cookie ----------
// Cierra la sesion y elimina su cookie solo si el formulario conserva un token valido.
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && ($_POST['accion'] ?? '') === 'logout') {
    if (hash_equals(csrf_token(), (string) ($_POST['csrf_token'] ?? ''))) {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $cookie = session_get_cookie_params();
            setcookie(session_name(), '', [
                'expires' => time() - 42000,
                'path' => $cookie['path'],
                'domain' => $cookie['domain'],
                'secure' => $cookie['secure'],
                'httponly' => $cookie['httponly'],
                'samesite' => $cookie['samesite'] ?? 'Strict',
            ]);
        }
        session_destroy();
        header('Location: admin.php');
        exit;
    }
    $error = 'La sesión del formulario venció. Actualizá la página e intentá nuevamente.';
}

// ---------- 5. Ejecutar operaciones y mostrar la página ----------
require __DIR__ . '/acciones.php';
require __DIR__ . '/pagina.php';