<?php
/**
 * ============================================================================
 * configuracion.php — CONFIGURACIÓN BASE DEL PANEL crud
 * Carga las dependencias, fija la zona horaria, protege la sesión y define
 * qué tablas puede administrar el panel.
 * ============================================================================
 */
declare(strict_types=1);

// Carga las dependencias comunes y prepara la sesion segura del crud.

// ---------- Dependencias: conexión a la base, validaciones y catálogo de imágenes ----------
// Reutiliza la conexion, las validaciones y la lista de ubicaciones de imagenes del sitio.
require_once __DIR__ . '/../../assets/php/conexion.php';
require_once __DIR__ . '/../../assets/php/validaciones.php';
require_once __DIR__ . '/../../assets/php/imagenes_config.php';

// ---------- Zona horaria del sistema (Uruguay) ----------
date_default_timezone_set('America/Montevideo');

// ---------- Sesión segura: cookie httponly + SameSite Strict y sin caché en el navegador ----------
// Protege la cookie de sesion y evita que el navegador almacene respuestas privadas del panel.
$secureCookie = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
ini_set('session.use_strict_mode', '1');
session_set_cookie_params([
    'httponly' => true,
    'secure' => $secureCookie,
    'samesite' => 'Strict',
]);
session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

// ---------- Tablas administrables y el nombre que se muestra al usuario en cada una ----------
const TABLAS_ADMIN = ['cupo_estudiantes', 'cursos', 'tutores', 'docentes'];
const NOMBRES_TABLAS = [
    'cupo_estudiantes' => 'Cupo de estudiante',
    'cursos' => 'curso',
    'tutores' => 'tutor',
    'docentes' => 'docente',
];
