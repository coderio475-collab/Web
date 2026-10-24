-- ============================================================================
-- — BASE DE DATOS 
-- ----------------------------------------------------------------------------
-- FORMULARIO DE INSCRIPCIONES Y ADMINISTRACIÓN DEL SITIO
-- ----------------------------------------------------------------------------
-- Tablas:
--   tutores        Datos del tutor.
--   cursos         Oferta educativa (tipo de curso + curso).
--   cupo_estudiantes Reservas de cupo completas. Una cédula solo puede reservar una vez.
--   docentes       Registros del formulario de docentes.
--   archivos       Versiones de los PDF de horarios y exámenes.
--   imagenes_sitio Imágenes reemplazables de cada ubicación visual de la página.
--   agenda_eventos Eventos públicos editables desde el panel administrativo.
--   titulos_imagenes Títulos editables asociados a ubicaciones de imágenes.
-- ============================================================================


SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS riobase
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE riobase;

-- ----------------------------------------------------------------------------
-- TUTORES: 
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tutores (
  id              INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  nombre_completo VARCHAR(120)  NOT NULL,
  telefono        VARCHAR(15)   NOT NULL COMMENT 'Solo dígitos (9)',
  email           VARCHAR(150)  NOT NULL,
  fecha_registro  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Tutores de estudiantes menores de 18 años';

-- ----------------------------------------------------------------------------
-- CURSOS: oferta educativa (tipo de curso + curso)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS cursos (
  id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
  tipo    VARCHAR(80)  NOT NULL COMMENT 'Ej. Bachillerato Tecnológico',
  nombre  VARCHAR(100) NOT NULL COMMENT 'Ej. Gestión Y Administración',
  sector  VARCHAR(80)  NOT NULL COMMENT 'Sector general de estudio',
  activo  TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = se ofrece actualmente (los cursos dados de baja se conservan por los cupos registrados)',
  PRIMARY KEY (id),
  UNIQUE KEY uq_cursos_tipo_nombre (tipo, nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Oferta educativa (tipo de curso y curso)';

-- Datos de la oferta vigente en el formulario de inccripciones
UPDATE cursos SET activo = 0;   -- primero se desactivan todos; los vigentes se reactivan abajo
INSERT INTO cursos (tipo, nombre, sector) VALUES
  ('Ciclo Básico', 'EBI 7º', 'Programa Educación Media Básica'),
  ('Ciclo Básico', 'EBI 8º', 'Programa Educación Media Básica'),
  ('Ciclo Básico', 'EBI 9º', 'Programa Educación Media Básica'),
  ('Bachillerato Tecnológico (BT)', 'Agrario', 'Agropecuario'),
  ('Bachillerato Tecnológico (BT)', 'Deporte, Ed. Física Y Recreación', 'Deporte Y Afines'),
  ('Bachillerato Tecnológico (BT)', 'Gestión Y Administración', 'Comercio Y Administración'),
  ('Bachillerato Tecnológico (BT)', 'Informática - Tecnologías De La Información', 'Informática'),
  ('Bachillerato Técnico Profesional (BTP)', 'Instalaciones Eléctricas', 'Electricidad Y Electrónica'),
  ('Bachillerato Técnico Profesional (BTP)', 'Cocina', 'Gastronomía'),
  ('Bachillerato Técnico Profesional (BTP)', 'Estética Personal', 'Servicios Personales'),
  ('Bachillerato Técnico Profesional (BTP)', 'Edificaciones De Obra Civil', 'Construcción Y Arquitectura'),
  ('Bachillerato Técnico Profesional (BTP)', 'Gastronomía', 'Gastronomía'),
  ('Bachillerato Técnico Profesional (BTP)', 'Bienestar Y Salud', 'Servicios Personales'),
  ('Bachillerato Técnico Profesional (BTP)', 'Indumentaria Textil', 'Textil Y Confección De Vestimenta'),
  ('Bachillerato Técnico Profesional (BTP)', 'Mantenimiento Industrial', 'Metal-Mecánica'),
  ('Bachillerato Técnico Profesional (BTP)', 'Comercio Y Ventas', 'Comercio Y Administración'),
  ('Bachillerato Técnico Profesional (BTP)', 'Mueble Por Diseño', 'Madera Y Muebles'),
  ('Bachillerato Técnico Profesional (BTP)', 'Mecánica Industrial', 'Metal-Mecánica'),
  ('Formación Profesional Básica (FPB)', 'Estética Capilar', 'Servicios Personales'),
  ('Formación Profesional Básica (FPB)', 'Alimentación', 'Gastronomía'),
  ('Formación Profesional Básica (FPB)', 'Mecánica', 'Metal-Mecánica'),
  ('Curso Técnico Terciario (CTT)', 'Diseño Gráfico', 'Diseño Gráfico'),
  ('Curso Técnico Terciario (CTT)', 'Administración', 'Comercio Y Administración'),
  ('Curso Técnico Terciario (CTT)', 'Redes Y Software', 'Informática'),
  ('Tecnólogo', 'Sistemas Agropecuarios Familiares', 'Agropecuario')
ON DUPLICATE KEY UPDATE sector = VALUES(sector), activo = 1;

-- ----------------------------------------------------------------------------
-- CUPO_ESTUDIANTES: datos completos del formulario de cupo de estudiantes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS cupo_estudiantes (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre_completo  VARCHAR(120) NOT NULL,
  cedula           VARCHAR(8) NOT NULL COMMENT 'Solo números, 8 dígitos',
  email            VARCHAR(150) NOT NULL,
  telefono         VARCHAR(15) NOT NULL COMMENT 'Teléfono de contacto normalizado al guardar',
  fecha_nacimiento DATE NOT NULL,
  es_menor         TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 = menor de 18 años al reservar',
  curso_id         INT UNSIGNED NULL DEFAULT NULL COMMENT 'Curso elegido (tabla cursos)',
  tutor_id         INT UNSIGNED NULL DEFAULT NULL COMMENT 'Datos asociados en tutores; obligatorio para menores',
  mensaje          VARCHAR(330) NULL DEFAULT NULL COMMENT 'Campo opcional: Algo que quieras decirnos',
  acepta_terminos  TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Términos y política de privacidad aceptados',
  estado           ENUM('reservado','confirmado','cancelado') NOT NULL DEFAULT 'reservado',
  ip_registro      VARCHAR(45) NULL DEFAULT NULL,
  fecha_registro   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_cupo_estudiantes_cedula (cedula),
  KEY idx_cupo_estudiantes_estado (estado),
  KEY idx_cupo_estudiantes_fecha (fecha_registro),
  KEY idx_cupo_estudiantes_tutor (tutor_id),
  KEY idx_cupo_estudiantes_curso (curso_id),
  CONSTRAINT fk_cupo_estudiantes_curso FOREIGN KEY (curso_id)
    REFERENCES cursos (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT fk_cupo_estudiantes_tutor FOREIGN KEY (tutor_id)
    REFERENCES tutores (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT chk_cupo_estudiantes_menor_con_tutor CHECK (es_menor = 0 OR tutor_id IS NOT NULL),
  CONSTRAINT chk_cupo_estudiantes_terminos CHECK (acepta_terminos = 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Datos del formulario público de reserva de cupo para estudiantes';

-- ----------------------------------------------------------------------------
-- DOCENTES: registros del formulario de docentes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS docentes (
  id                  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre_completo     VARCHAR(120) NOT NULL,
  cedula              VARCHAR(8) NOT NULL COMMENT 'Solo números, 8 dígitos',
  email               VARCHAR(150) NOT NULL,
  telefono            VARCHAR(9) NOT NULL COMMENT 'Solo dígitos, 9',
  fecha_nacimiento    DATE NOT NULL,
  formacion_academica VARCHAR(100) NOT NULL,
  solicitud           ENUM('especializacion','otro') NOT NULL,
  solicitud_detalle   VARCHAR(30) NULL DEFAULT NULL,
  mensaje             VARCHAR(330) NULL DEFAULT NULL,
  acepta_terminos     TINYINT(1) NOT NULL DEFAULT 0,
  estado              ENUM('recibido','contactado','descartado','cancelado') NOT NULL DEFAULT 'recibido',
  ip_registro         VARCHAR(45) NULL DEFAULT NULL,
  fecha_registro      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_docentes_cedula (cedula),
  KEY idx_docentes_estado (estado),
  KEY idx_docentes_fecha (fecha_registro),
  CONSTRAINT chk_docentes_terminos CHECK (acepta_terminos = 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Registros del formulario de docentes';

-- ----------------------------------------------------------------------------
-- ARCHIVOS: versiones de los PDF públicos de horarios y exámenes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS archivos (
  id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  tipo            ENUM('horarios','examenes') NOT NULL COMMENT 'Apartado público al que pertenece el PDF',
  nombre_original VARCHAR(255) NOT NULL,
  mime_type       VARCHAR(50) NOT NULL DEFAULT 'application/pdf',
  contenido       LONGBLOB NOT NULL COMMENT 'Contenido binario del PDF',
  fecha_subida    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_archivos_tipo_id (tipo, id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Versiones de los PDF publicados de horarios y exámenes';

-- ----------------------------------------------------------------------------
-- IMÁGENES DEL SITIO: 
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS imagenes_sitio (
  id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  ubicacion       VARCHAR(80) NOT NULL COMMENT 'Clave de ubicación configurada por la aplicación',
  nombre_original VARCHAR(255) NOT NULL,
  mime_type       VARCHAR(50) NOT NULL,
  contenido       LONGBLOB NOT NULL COMMENT 'Contenido binario de la imagen',
  fecha_subida    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_imagenes_sitio_ubicacion (ubicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Imágenes públicas reemplazables por ubicación del sitio';

-- ----------------------------------------------------------------------------
-- AGENDA: eventos de la pag para editar desde el panel admin
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS agenda_eventos (
  id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  fecha    DATE NOT NULL,
  titulo   VARCHAR(180) NOT NULL,
  PRIMARY KEY (id),
  KEY idx_agenda_eventos_fecha (fecha, id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Eventos públicos editables desde el panel administrativo';

INSERT INTO agenda_eventos (fecha, titulo)
SELECT eventos.fecha, eventos.titulo
FROM (
  SELECT '2026-10-15' AS fecha, 'Semana de la Ciencia y Tecnología' AS titulo
  UNION ALL SELECT '2026-10-22', 'Talleres de orientación para nuevas inscripciones'
  UNION ALL SELECT '2026-11-05', 'Feria abierta de orientación vocacional'
  UNION ALL SELECT '2026-11-19', 'Muestra de talleres y proyectos estudiantiles'
) AS eventos
WHERE NOT EXISTS (SELECT 1 FROM agenda_eventos);

-- ----------------------------------------------------------------------------
-- TÍTULOS DESTACADOS: textos editables de las noticias destacadas   de imágenes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS titulos_imagenes (
  ubicacion VARCHAR(80) NOT NULL,
  titulo    VARCHAR(180) NOT NULL,
  PRIMARY KEY (ubicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Títulos públicos editables asociados a ubicaciones de imágenes';
