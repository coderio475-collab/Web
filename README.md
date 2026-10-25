# Sitio web institucional -

Sitio web institucional de la escuela, con **portada**, páginas informativas, **formularios de inscripción** (estudiantes y docentes) y un **panel de administración (CRUD)** para gestionar los registros y el contenido del sitio sin tocar el código.

El sitio está disponible en **español y portugués**, tiene **modo claro / oscuro** y se adapta a celulares, tablets y computadoras.


## ✨ Qué incluye

**Sitio público**

- **Inicio** (`index.php`): foto principal, carrusel, agenda de eventos, noticias destacadas y accesos rápidos.
- **Noticias**: novedades, agenda y galería institucional.
- **Normativa**: vestimenta (uniformes) y enlaces a la normativa de UTU.
- **Cursos y Carreras**: oferta educativa filtrable por sector de estudio.
- **Horarios y Exámenes**: PDF publicados por la institución.
- **Anexos**: sedes (Polideportivo, Baltasar Brum, Tomás Gomensoro) con pestañas e imágenes.
- **Inscripciones**: formulario de **reserva de cupo para estudiantes** (con datos del tutor si es menor de 18 años) y formulario de **solicitud para docentes**.
- **Buscador** en el encabezado, **cambio de idioma** (ES ⇄ PT) y **tema claro/oscuro**.

**Panel de administración** (`admin.php`) — ver la guía completa en [`crud.md`](crud.md)

- Altas, consultas, ediciones y bajas de **cupos de estudiantes, cursos, tutores y docentes**.
- Gestión de la **agenda** de eventos.
- Publicación de los **PDF de horarios y exámenes**.
- Cambio de las **imágenes** de la página y de los títulos destacados.
- Edición de los **enlaces a otros sitios** (becas, normativas, etc.).


## 🛠️ Tecnologías

- HTML5 + CSS3
- [Bootstrap 5.3](https://getbootstrap.com/) (grid y componentes, vía CDN)
- [Bootstrap Icons](https://icons.getbootstrap.com/) (CDN)
- Google Fonts: **Fraunces** (títulos), **Inter** (texto general) y **JetBrains Mono**
- JavaScript para el buscador, el idioma, el tema, los filtros y la validación en pantalla de los formularios (`assets/js/`)
- **PHP ** con **PDO** para acceder a la base de datos
- **MySQL / MariaDB** como base de datos (`database/riobase.sql`)
- **Apache** como servidor web


## 📁 Estructura del proyecto

```text
Carpeta principal/
├── index.php                  # Página de inicio
├── admin.php                  # Entrada del panel de administración (CRUD)
├── seconds_index/             # Páginas secundarias del sitio
│   ├── anexos.php
│   ├── cursos.php
│   ├── horarios.php
│   ├── inscripciones.php      
│   ├── noticias.php
│   └── normativa.php
├── requires/                  # Piezas reutilizables
│   ├── head.php               # <head>, estilos y tema
│   ├── header.php             # Encabezado y menú
│   ├── footer_scripts.php     # Pie de página y scripts
│   └── admin/                 # Módulos del panel (controlador, acciones, vistas)
├── assets/
│   ├── css/styles.css         # Estilos del sitio
│   ├── js/                    # Scripts (idioma, tema, buscador, form)
│   ├── img/                   # Logo e imagen de portada
│   └── php/                   # Conexión, validaciones, guardado form
│                              # entrega  imágenes y PDF desde la base
└── database/
    └── riobase.sql            # Estructura, datos iniciales de la base
```


## ▶️ Cómo verlo

El sitio necesita un **servidor Apache con PHP** y una base de datos **MySQL/MariaDB** llamada `riobase`.

### 1. Requisitos

- Servidor **Apache** con PHP.
- Servidor **MySQL** o **MariaDB**.

### 2. Colocar el proyecto

1. Descargar o clonar la carpeta.
2. Copiarla dentro de la carpeta pública del servidor Apache (la raíz de documentos, por ejemplo `htdocs` o `/var/www/html`).
3. Iniciar los servicios de **Apache** y **MySQL**.

### 3. Crear la base de datos

1. Abrir tu cliente SQL (phpMyAdmin, MySQL Workbench o la consola `mysql`).
2. Importar la base de datos "riobase"



### 4. Revisar la conexión

Los datos de conexión están en `assets/php/conexion.php`:

```php
const DB_HOST    = 'localhost:3306';
const DB_NAME    = 'riobase';
const DB_USER    = 'root';
const DB_PASS    = '';
```

Por defecto usa el usuario `root`, contraseña vacía y el puerto `3306`. Si tu servidor MySQL usa otros valores, cambialos en ese archivo.

> ⚠️ El formulario de docentes (`assets/php/guardar_docente.php`) tiene los datos de conexión escritos dentro del propio archivo. Si cambiás el usuario, la contraseña o el puerto, actualizalos también ahí.

### 5. Abrir el sitio

Desde el navegador:

```text
http://localhost/carpetaprincipal/index.php
```

(Reemplazá `carpeta principal` por el nombre de la carpeta donde copiaste el proyecto.)

### 6. Probar los formularios

1. Entrar a **Inscripciones** (`seconds_index/inscripciones.php`) y enviar un formulario de estudiante o de docente.
2. Revisar el registro nuevo en tu cliente SQL (base `riobase` → tablas `cupo_estudiantes` o `docentes`) o desde el panel de administración.

### 7. Entrar al panel de administración

El panel no trae contraseñas predeterminadas: hay que configurar un usuario y el *hash* de una contraseña propia en el servidor Apache. El paso a paso está en [`crud.md`](crud.md#2-configurar-el-acceso).

```text
http://localhost/carpetaprincipal/admin.php
```

> Requiere conexión a internet, ya que Bootstrap, los iconos y las tipografías se cargan desde un CDN (Red de Distribución de Contenidos).


## 🔒 Seguridad en pocas palabras

- Todas las consultas a la base usan **sentencias preparadas** (PDO), sin concatenar datos del usuario.
- Los formularios públicos se **validan dos veces**: en el navegador (JavaScript) y en el servidor (PHP).
- Los formularios públicos incluyen un campo oculto *anti-spam* (honeypot).
- El panel exige **inicio de sesión**, usa **tokens CSRF** en cada formulario y guarda la contraseña solo como **hash**.
- Los archivos subidos (imágenes y PDF) se validan por tipo real, tamaño y firma del archivo.



## 📚 Documentación

| Archivo | Contenido |
| --- | --- |
| [`crud.md`](crud.md) | Guía explicada del panel de administración: cómo funciona, cómo se usa y cómo está construido. |
| `database/riobase.sql` | Estructura de la base de datos comentada tabla por tabla. |


