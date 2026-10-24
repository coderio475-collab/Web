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

// Campos editables de vestimenta: ubicación de imagen y tipo de texto.
const TEXTOS_VESTIMENTA = [
    'vestimenta_basico_remera' => ['vestimenta_basico', 'remera'],
    'vestimenta_basico_jean' => ['vestimenta_basico', 'jean'],
    'vestimenta_media_remera' => ['vestimenta_media', 'remera'],
    'vestimenta_media_jean' => ['vestimenta_media', 'jean'],
];

const CAMPOS_TEXTO_VESTIMENTA = [
    'remera' => ['Texto de la remera', 'Remera (camiseta) de color a definir, con el logo de la institución.', 'normativa.dress.top'],
    'jean' => ['Texto del jean', 'Jean (vaquero) azul oscuro.', 'normativa.dress.bottom'],
];

// ---------- Enlaces externos: catálogo editable desde el CRUD (clave, etiqueta y URL predeterminada) ----------
const ENLACES_EXTERNOS = [
    'becas' => ['Becas', 'https://becas.edu.uy/'],
    'utu_estudia' => ['Oferta educativa UTU', 'https://www.utu.edu.uy/estudia/'],
    'planes' => ['Materias y planes de estudio', 'https://planeamientoeducativo.utu.edu.uy/tablaplanesprogrmasnueva'],
    'normativas' => ['Normativas UTU', 'https://www.utu.edu.uy/normativas/'],
    'privacidad' => ['Política de privacidad', 'https://www.utu.edu.uy/wp-content/themes/balpadraUTU/src/documents/politica%20de%20privacidad.pdf'],
    'presentacion' => ['Presentación de la escuela', 'https://www.utu.edu.uy/wp-content/themes/balpadraUTU/src/documents/encuentros/23oct25-litoralnorte/Escuela%20T%C3%A9cnica%20%C2%ABMtro%20Sergio%20Gonz%C3%A1lez%20Olaizola%C2%BB%20%E2%80%93%20Bella%20Uni%C3%B3n.pdf?_t=1761659170'],
];
