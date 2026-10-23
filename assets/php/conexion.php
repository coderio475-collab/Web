<?php
declare(strict_types=1);

// Impide abrir este archivo directamente desde el navegador
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(403);
    exit('Acceso no permitido.');
}

// ---------- Datos de conexión ----------
const DB_HOST    = 'localhost:3306';
const DB_NAME    = 'riobase';
const DB_USER    = 'root';
const DB_PASS    = '';
const DB_CHARSET = 'utf8mb4';

/**
 * Devuelve la conexión PDO a la base de datos.
 *
 * @throws PDOException si no se puede conectar 
 */
function obtener_conexion(): PDO
{
    static $pdo = null;   // se reutiliza la misma conexión si se llama varias veces

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   // los errores lanzan excepciones
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,         // filas como arreglos asociativos
            PDO::ATTR_EMULATE_PREPARES   => false,                    
        ]);
    }

    return $pdo;
}
?>