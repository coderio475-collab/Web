<?php
/**
 * Catálogo de ubicaciones de imágenes que puede administrar el panel crud
 * 
 */
declare(strict_types=1);

// ---------- Catálogo de ubicaciones de imágenes ----------
// Clave = ubicación interna (se guarda en la tabla imagenes_sitio).
// grupo = agrupa en el panel · etiqueta = nombre visible · titulo_default/i18n = título por defecto y su clave de traducción
const UBICACIONES_IMAGENES = [
    'hero_institucion' => ['grupo' => 'Portada principal', 'etiqueta' => 'Foto principal de la institución'],
    'portada_agenda_1' => ['grupo' => 'Agenda y carrusel de portada', 'etiqueta' => 'Carrusel de portada · imagen 1'],
    'portada_agenda_2' => ['grupo' => 'Agenda y carrusel de portada', 'etiqueta' => 'Carrusel de portada · imagen 2'],
    'portada_agenda_3' => ['grupo' => 'Agenda y carrusel de portada', 'etiqueta' => 'Carrusel de portada · imagen 3'],
    // Portada: noticias destacadas
    'portada_noticia_principal' => ['grupo' => 'Noticias recientes de portada', 'etiqueta' => 'Noticia destacada principal', 'titulo_default' => 'Título de la noticia destacada', 'i18n' => 'home.news.big'],
    'portada_noticia_1' => ['grupo' => 'Noticias recientes de portada', 'etiqueta' => 'Noticia destacada 1', 'titulo_default' => 'Título de la noticia 1', 'i18n' => 'home.news.s1'],
    'portada_noticia_2' => ['grupo' => 'Noticias recientes de portada', 'etiqueta' => 'Noticia destacada 2', 'titulo_default' => 'Título de la noticia 2', 'i18n' => 'home.news.s2'],
    'portada_noticia_3' => ['grupo' => 'Noticias recientes de portada', 'etiqueta' => 'Noticia destacada 3', 'titulo_default' => 'Título de la noticia 3', 'i18n' => 'home.news.s3'],
    // Página de noticias
    'noticia_1' => ['grupo' => 'Noticias', 'etiqueta' => 'Imagen de noticia 1', 'titulo_default' => 'Apertura del Centro de Simulación Tecnológica', 'i18n' => 'noticias.n1.title'],
    'noticia_2' => ['grupo' => 'Noticias', 'etiqueta' => 'Imagen de noticia 2', 'titulo_default' => 'Proyecto estudiantil de energía solar recibe apoyo regional', 'i18n' => 'noticias.n2.title'],
    'noticia_3' => ['grupo' => 'Noticias', 'etiqueta' => 'Imagen de noticia 3', 'titulo_default' => 'Convenio de intercambio con instituciones técnicas', 'i18n' => 'noticias.n3.title'],
    // Galería institucional
    'galeria_1' => ['grupo' => 'Galería institucional', 'etiqueta' => 'Galería · imagen 1'],
    'galeria_2' => ['grupo' => 'Galería institucional', 'etiqueta' => 'Galería · imagen 2'],
    'galeria_3' => ['grupo' => 'Galería institucional', 'etiqueta' => 'Galería · imagen 3'],
    // Vestimenta (uniformes)
    'vestimenta_basico' => ['grupo' => 'Vestimenta', 'etiqueta' => 'Uniforme · Ciclo Básico'],
    'vestimenta_media' => ['grupo' => 'Vestimenta', 'etiqueta' => 'Uniforme · Educación Media'],
    // Anexos: 3 imágenes por cada anexo (Polideportivo, Baltasar Brum, Tomás Gomensoro)
    'anexo_polideportivo_1' => ['grupo' => 'Anexo Polideportivo', 'etiqueta' => 'Anexo Polideportivo · imagen 1'],
    'anexo_polideportivo_2' => ['grupo' => 'Anexo Polideportivo', 'etiqueta' => 'Anexo Polideportivo · imagen 2'],
    'anexo_polideportivo_3' => ['grupo' => 'Anexo Polideportivo', 'etiqueta' => 'Anexo Polideportivo · imagen 3'],
    'anexo_baltasar_1' => ['grupo' => 'Anexo Baltasar Brum', 'etiqueta' => 'Anexo Baltasar Brum · imagen 1'],
    'anexo_baltasar_2' => ['grupo' => 'Anexo Baltasar Brum', 'etiqueta' => 'Anexo Baltasar Brum · imagen 2'],
    'anexo_baltasar_3' => ['grupo' => 'Anexo Baltasar Brum', 'etiqueta' => 'Anexo Baltasar Brum · imagen 3'],
    'anexo_gomensoro_1' => ['grupo' => 'Anexo Tomás Gomensoro', 'etiqueta' => 'Anexo Tomás Gomensoro · imagen 1'],
    'anexo_gomensoro_2' => ['grupo' => 'Anexo Tomás Gomensoro', 'etiqueta' => 'Anexo Tomás Gomensoro · imagen 2'],
    'anexo_gomensoro_3' => ['grupo' => 'Anexo Tomás Gomensoro', 'etiqueta' => 'Anexo Tomás Gomensoro · imagen 3'],
];
