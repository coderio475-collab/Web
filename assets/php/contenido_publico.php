<?php
/**
 * Funciones de lectura para datos  compartidos por la portada y Noticias:
 * a.
 */
declare(strict_types=1);

require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/imagenes_config.php';

// ---------- Agenda: modificaciones a los eventos ----------
// Si falla la base devuelve 4 eventos de ejemplo para que la página siga funcionando
function obtener_eventos_agenda(): array
{
    try {
        return obtener_conexion()
            ->query('SELECT id, fecha, titulo FROM agenda_eventos ORDER BY fecha, id')
            ->fetchAll();
    } catch (PDOException $e) {
        error_log('[riobase agenda] Error al consultar la agenda: ' . $e->getMessage());
        return [
            ['id' => 1, 'fecha' => '2026-10-15', 'titulo' => 'Semana de la Ciencia y Tecnología'],
            ['id' => 2, 'fecha' => '2026-10-22', 'titulo' => 'Talleres de orientación para nuevas inscripciones'],
            ['id' => 3, 'fecha' => '2026-11-05', 'titulo' => 'Feria abierta de orientación vocacional'],
            ['id' => 4, 'fecha' => '2026-11-19', 'titulo' => 'Muestra de talleres y proyectos estudiantiles'],
        ];
    }
}

// ---------- Títulos editables de las imágenes destacadas ----------
// Devuelve [ubicación => título] con los títulos guardados desde el panel
function obtener_titulos_imagenes(): array
{
    try {
        $titulos = obtener_conexion()
            ->query('SELECT ubicacion, titulo FROM titulos_imagenes')
            ->fetchAll();
        $resultado = [];
        foreach ($titulos as $titulo) {
            $resultado[$titulo['ubicacion']] = $titulo['titulo'];
        }
        return $resultado;
    } catch (PDOException $e) {
        error_log('[riobase imágenes] Error al consultar los títulos: ' . $e->getMessage());
        return [];
    }
}

// ---------- Traducción (i18n): marca el evento con data-i18n solo si conserva el texto original; ----------
// si el administrador lo editó, ya no se traduce
function atributo_i18n_agenda(array $evento): string
{
    $predeterminados = [
        '1' => ['Semana de la Ciencia y Tecnología', 'home.agenda.ev1'],
        '2' => ['Talleres de orientación para nuevas inscripciones', 'home.agenda.ev2'],
        '3' => ['Feria abierta de orientación vocacional', 'home.agenda.ev3'],
        '4' => ['Muestra de talleres y proyectos estudiantiles', 'home.agenda.ev4'],
    ];
    $id = (string) ($evento['id'] ?? '');
    if (isset($predeterminados[$id]) && ($evento['titulo'] ?? '') === $predeterminados[$id][0]) {
        return ' data-i18n="' . htmlspecialchars($predeterminados[$id][1], ENT_QUOTES, 'UTF-8') . '"';
    }
    return '';
}

// ---------- Título de una imagen destacada: el guardado en la base o, si no hay, el predeterminado ----------
function titulo_destacado(string $ubicacion, array $titulos): string
{
    return $titulos[$ubicacion]
        ?? UBICACIONES_IMAGENES[$ubicacion]['titulo_default']
        ?? '';
}

// ---------- data-i18n del título destacado  ----------
function atributo_i18n_titulo_destacado(string $ubicacion, array $titulos): string
{
    $clave = UBICACIONES_IMAGENES[$ubicacion]['i18n'] ?? '';
    if ($clave !== '' && !isset($titulos[$ubicacion])) {
        return ' data-i18n="' . htmlspecialchars($clave, ENT_QUOTES, 'UTF-8') . '"';
    }
    return '';
}
