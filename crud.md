# Panel CRUD explicado — base de datos `riobase`

Esta guía explica **qué hace** el panel de administración, **cómo se usa** y **cómo está construido por dentro**, para que cualquier persona del proyecto pueda mantenerlo.

> **CRUD** son las cuatro operaciones básicas sobre los datos: **C**reate (crear), **R**ead (leer), **U**pdate (actualizar) y **D**elete (eliminar). El panel las aplica a los registros de la escuela y, además, permite cambiar contenido del sitio público (agenda, imágenes, PDF y enlaces).

El panel se abre en:

```text
http://localhost/carpetaprincipal/admin.php
```

(Reemplazá `carpetaprincipal` por el nombre de la carpeta donde está el proyecto en tu servidor Apache.)

## 1. Guía rápida de uso

**Registrar a mano un cupo de estudiante**
1. Pestaña **Cupo de estudiante** → completar el formulario.
2. Si la persona es menor de 18, primero crear el tutor en la pestaña **Tutores** y luego elegirlo en el cupo.
3. Marcar la aceptación de términos y guardar.

**Confirmar o cancelar un cupo**
1. Buscar a la persona por nombre o cédula.
2. **Editar** → cambiar el estado a *Confirmado*, o usar **Cancelar cupo**.

**Dar de baja un curso que ya no se dicta**
1. Pestaña **Cursos** → **Editar** → estado **Inactivo** → guardar. (No lo elimines: tiene cupos asociados.)

**Cambiar una foto de la página**
1. **Imágenes de la página** → ubicar el grupo y el lugar → elegir archivo → guardar.

**Publicar los horarios nuevos**
1. **Mod. exámenes y horarios** → elegir *horarios* → subir el PDF. El sitio ya muestra la versión nueva.





---

## 2. Qué permite hacer

El panel tiene **8 pestañas**. Las primeras cuatro trabajan sobre tablas de la base; las otras cuatro, sobre contenido que se ve en el sitio público.

| Pestaña | Qué administra | Operaciones |
| --- | --- | --- |
| **Cupo de estudiante** | Reservas de cupo hechas en el formulario | Crear, buscar, editar, eliminar, cancelar |
| **Cursos** | Oferta educativa (tipo, nombre, sector, activo) | Crear, buscar, editar, eliminar |
| **Tutores** | Adultos responsables de estudiantes menores | Crear, buscar, editar, eliminar |
| **Docentes** | Solicitudes del formulario de docentes | Crear, buscar, editar, eliminar, cancelar |
| **Agenda** | Eventos que se muestran en Inicio y en Noticias | Agregar, editar, eliminar |
| **Mod. exámenes y horarios** | PDF públicos de horarios y de exámenes | Subir (se conserva el historial) |
| **Imágenes de la página** | Fotos del sitio y sus títulos destacados | Subir, reemplazar, eliminar, editar título |
| **Enlaces externos** | URL a páginas y documentos de otras instituciones | Editar |

---

## 3. Configurar el acceso

El panel **no tiene contraseñas predeterminadas**. Antes de entrar hay que definir dos variables de entorno en el servidor Apache:

| Variable | Qué contiene |
| --- | --- |
| `CRUD_ADMIN_USER` | El nombre de usuario del administrador |
| `CRUD_ADMIN_PASSWORD_HASH` | El *hash* (no la contraseña) generado con `password_hash()` |

**Paso 1 — Generar el hash** de una contraseña propia (desde una terminal con PHP instalado):

```bash
php -r "echo password_hash('CAMBIA_ESTA_CONTRASENA', PASSWORD_DEFAULT), PHP_EOL;"
```

Reemplazá `CAMBIA_ESTA_CONTRASENA` por una contraseña robusta. 

**Paso 2 — Guardar las variables** en la configuración de Apache (en el `VirtualHost` o en el archivo de configuración del sitio):

```apache
SetEnv CRUD_ADMIN_USER "admin"
SetEnv CRUD_ADMIN_PASSWORD_HASH "$2y$..."
```

**Paso 3 — Reiniciar Apache** para que tome los cambios.

**Paso 4 — Entrar** a `admin.php` con el usuario y la contraseña elegidos.


---

## 4. Cómo está organizado por dentro

`admin.php` es solo la **puerta de entrada**: una única línea que delega todo en `requires/admin/controlador.php`. El panel está dividido en archivos pequeños, cada uno con una responsabilidad.

| Archivo (`requires/admin/`) | Responsabilidad |
| --- | --- |
| `controlador.php` | Director de orquesta: carga lo necesario, decide qué tabla o sección se pidió, atiende el **login** y el **logout** y luego llama a `acciones.php` y `pagina.php`. |
| `configuracion.php` | Sesión segura, zona horaria (`America/Montevideo`), conexión y lista de tablas permitidas (`TABLAS_ADMIN`). |
| `funciones.php` | Herramientas compartidas: `escapar()`, `csrf_token()`, `campo()`, redirecciones con mensaje y ayudas para dibujar formularios. |
| `acciones.php` | **El corazón del CRUD**: carga los datos y ejecuta crear / editar / eliminar / cancelar / subir archivos. |
| `pagina.php` | Estructura HTML: muestra el login o, si hay sesión, las pestañas y la vista elegida. |
| `acceso.php` | Formulario de login. |
| `navegacion.php` | Pestañas del panel. |
| `secciones.php` | Elige qué vista cargar según `?seccion=`. |
| `registros.php` | Vista de las 4 tablas: formulario de alta/edición + buscador + tabla. |
| `agenda.php`, `modificaciones.php`, `imagenes.php`, `enlaces.php` | Vistas de las secciones especiales. |

Archivos de apoyo fuera de la carpeta del panel (`assets/php/`):

| Archivo | Para qué sirve |
| --- | --- |
| `conexion.php` | Función `obtener_conexion()`: devuelve la conexión PDO a MySQL (se reutiliza la misma en toda la petición). |
| `validaciones.php` | Funciones de limpieza y validación: nombre, cédula, email, teléfono y cálculo de edad. |
| `imagenes_config.php` | Catálogo de **ubicaciones de imágenes** que se pueden administrar. |
| `enlaces_config.php` / `enlaces.php` | Catálogo de **enlaces externos** editables y funciones para leerlos y validarlos. |
| `contenido_publico.php` | Lee agenda y títulos para mostrarlos en el sitio público. |
| `imagen.php` / `archivo.php` | Entregan al navegador la imagen o el PDF guardados en la base. |

### Recorrido de una petición

Esto es lo que pasa cuando entrás a `admin.php` y, por ejemplo, guardás un cambio:

```text
admin.php
   └─► controlador.php
         1. Carga configuracion.php (sesión segura, conexión) y funciones.php
         2. Lee ?tabla= y ?seccion= y los compara con listas permitidas
         3. ¿Es un login o un logout? → los atiende y termina
         4. Carga acciones.php
               ├─ ¿Hay sesión de administrador? Si no → solo se muestra el login
               ├─ Consulta datos comunes (cursos, tutores, agenda, imágenes...)
               ├─ ¿Llegó un POST? → verifica el token CSRF
               │     └─ ejecuta la acción (crear, actualizar, eliminar...)
               │     └─ redirige a la tabla con un mensaje ("Cambios guardados.")
               └─ ¿Viene ?editar=ID? → lee ese registro para rellenar el formulario
         5. Carga pagina.php → dibuja el HTML (login o panel)
```

Detalle clave: después de cada acción exitosa el panel **redirige** (`header('Location: ...')`) y deja el mensaje en la sesión. Así, si la persona recarga la página, el formulario **no se vuelve a enviar** por accidente.

---

## 5. La base de datos

`database/riobase.sql`  Estas son las que usa el panel:

```text
cursos ◄──────────── cupo_estudiantes ────────────► tutores
(oferta educativa)   (reservas de cupo)             (responsables de menores)

docentes             agenda_eventos       titulos_imagenes
(solicitudes)        (eventos públicos)   (títulos de imágenes)

archivos             imagenes_sitio       enlaces_sitio
(PDF versionados)    (imágenes por lugar) (URL externas)
```

| Tabla | Qué guarda | Reglas importantes |
| --- | --- | --- |
| `cursos` | `tipo`, `nombre`, `sector`, `activo` | No se repite la pareja tipo + nombre. |
| `tutores` | nombre, teléfono (9 dígitos), email | Se relaciona con los cupos de menores. |
| `cupo_estudiantes` | datos del estudiante, `curso_id`, `tutor_id`, mensaje, estado, IP y fecha | **Cédula única**. Estados: `reservado`, `confirmado`, `cancelado`. Si `es_menor = 1`, `tutor_id` es obligatorio. Los términos deben estar aceptados. Mensaje de hasta 330 caracteres. |
| `docentes` | datos personales, formación, solicitud, mensaje, estado | **Cédula única**. Estados: `recibido`, `contactado`, `descartado`, `cancelado`. |
| `archivos` | PDF (`LONGBLOB`) de tipo `horarios` o `examenes` | Cada subida **agrega una versión**; se muestra la de ID más alto. |
| `imagenes_sitio` | imagen (`LONGBLOB`) por `ubicacion` | Una sola imagen por ubicación (clave única). |
| `agenda_eventos` | `fecha` y `titulo` | Se cargan 4 eventos iniciales solo si la tabla está vacía. |
| `titulos_imagenes` | título editable por `ubicacion` | Solo para las ubicaciones con título destacado. |
| `enlaces_sitio` | `clave` y `url` | Solo claves definidas en `enlaces_config.php`. |

**Claves foráneas:** `cupo_estudiantes` apunta a `cursos` y a `tutores` con `ON DELETE RESTRICT`. Eso significa que la base **impide borrar** un curso o un tutor que todavía tenga cupos asociados. Para un curso que ya no se ofrece, la salida correcta es **marcarlo como Inactivo**.

---


## 6. Seguridad: qué protege y cómo

| Medida | Qué evita | Dónde está |
| --- | --- | --- |
| **Contraseña con hash** (`password_verify`) | Que la contraseña esté guardada o visible en texto plano | `controlador.php` |
| **Credenciales fuera del código** (variables de Apache) | Subir contraseñas al repositorio por error | `controlador.php` |
| **Token CSRF** en todos los formularios | Que otro sitio haga enviar acciones al administrador sin que lo sepa | `funciones.php`, `acciones.php` |
| **Sesión segura:** cookie `httponly` + `SameSite=Strict`, `session_regenerate_id` al entrar | Robo o fijación de sesión | `configuracion.php`, `controlador.php` |
| **Sin caché** (`Cache-Control: no-store`) | Que el navegador guarde páginas privadas | `configuracion.php` |
| **Sentencias preparadas** (PDO) | Inyección SQL | todo el CRUD |
| **Listas permitidas** (tabla, sección, ubicación, clave de enlace) | Que la URL o el formulario fuercen consultas u operaciones no previstas | `controlador.php`, `acciones.php` |
| **`escapar()`** (`htmlspecialchars`) al mostrar datos | Inyección de código en la página (XSS) | `funciones.php` |
| **Validación en el servidor** de cada campo | Datos inválidos aunque se salte el navegador | `validaciones.php`, `acciones.php` |
| **Validación real de archivos** (tipo MIME, firma `%PDF-`, `getimagesize`, tamaño) | Subir archivos disfrazados | `acciones.php` |
| **Claves foráneas** `RESTRICT` y claves únicas | Borrar datos relacionados o duplicar cédulas | `riobase.sql` |

Además, los archivos de apoyo (`conexion.php`, `validaciones.php`) **no se pueden abrir directamente** desde el navegador: si alguien los visita, responden 403.

---





