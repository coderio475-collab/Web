<?php
/**
 * ============================================================================
 * validaciones.php — FUNCIONES DE VALIDACIÓN Y LIMPIEZA DE DATOS
 * ----------------------------------------------------------------------------
 * Este archivo contiene funciones para validar y limpiar datos de formularios,
 *  guardar_inscripcion.php
 * ============================================================================
 */

declare(strict_types=1);

// ---------- Protección: este archivo no se puede abrir directamente desde el navegador ----------
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(403);
    exit('Acceso no permitido.');
}

// ---------- Constantes ----------
/** Edad mínima para inscribirse sin tutor. */
const EDAD_MAYORIA = 18;

// ---------- Limpieza de texto ----------
/**
 * Limpia un texto recibido por POST: lo convierte a string, quita espacios
 * sobrantes y colapsa espacios repetidos. */
function limpiar_texto(mixed $valor): string
{
    $texto = trim((string) $valor);
    return preg_replace('/\s+/u', ' ', $texto) ?? '';
}

// ---------- Validaciones de campos: nombre, cédula, email y teléfono ----------
/** Nombre: entre 3 y 120 caracteres. */
function es_nombre_valido(string $nombre): bool
{
    $largo = mb_strlen($nombre);
    return $largo >= 3 && $largo <= 120;
}

/** Cédula: SOLO números, exactamente 8 dígitos  */
function es_cedula_valida(string $cedula): bool
{
    return (bool) preg_match('/^\d{8}$/', $cedula);
}

/** Email con formato válido y hasta 150 caracteres. */
function es_email_valido(string $email): bool
{
    return mb_strlen($email) <= 150 && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Teléfono: exactamente 9 dígitos.
 * Devuelve el teléfono normalizado (solo dígitos) o null si no es válido.
 */
function normalizar_telefono(string $telefono): ?string
{
    return preg_match('/^[0-9]{9}$/D', $telefono) ? $telefono : null;
}

// ---------- Fechas: cálculo de edad (para saber si es menor de edad) ----------
/**
 * Calcula la edad en años cumplidos a partir de "AAAA-MM-DD".
 * Devuelve null si la fecha es inválida, futura o anterior a 1900.
 */
function calcular_edad(string $fecha_nacimiento): ?int
{
    $fecha = DateTimeImmutable::createFromFormat('!Y-m-d', $fecha_nacimiento);
    $errores = DateTimeImmutable::getLastErrors();
    $hay_errores = $errores && ($errores['warning_count'] > 0 || $errores['error_count'] > 0);

    if ($fecha === false || $hay_errores || $fecha > new DateTimeImmutable('today') || (int) $fecha->format('Y') < 1900) {
        return null;
    }
    return $fecha->diff(new DateTimeImmutable('today'))->y;
}
