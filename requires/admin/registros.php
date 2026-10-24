<?php
/**
 * ============================================================================
 * registros.php — VISTA PRINCIPAL: FORMULARIO + TABLA DE REGISTROS
 * panel admin del crud
 *   2. Buscador y tabla con hasta 100 registros, con botones Editar, Eliminar
 *      y Cancelar (cupo / solicitud docente)
 * Los datos ($registro, $cursos, $tutores, $pdo, $busqueda) los prepara acciones.php.
 * ============================================================================
 */
declare(strict_types=1);

// Muestra el formulario de edicion y la tabla de registros administrativos.
?>

            <?php /* Modo: si $registro trae datos se está EDITANDO; si está vacío se está CREANDO */ ?>
        <section class="admin-card p-3 p-md-4 mb-4">
            <?php $editando = $registro !== []; ?>
            <h2 class="h4 mb-3"><?= $editando ? 'Editar' : 'Crear' ?> <?= escapar(NOMBRES_TABLAS[$tabla]) ?></h2>
            <!-- 1. FORMULARIO de creación / edición -->
            <form method="post" class="row g-3">
                <input type="hidden" name="accion" value="<?= $editando ? 'actualizar' : 'crear' ?>">
                <input type="hidden" name="tabla" value="<?= escapar($tabla) ?>">
                <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                <?php if ($editando): ?><input type="hidden" name="id" value="<?= (int) $registro['id'] ?>"><?php endif; ?>

                <?php /* Campos de CURSOS */ ?>
                <?php if ($tabla === 'cursos'): ?>
                    <?php campo_texto('tipo', 'Tipo', (string) ($registro['tipo'] ?? ''), ['maxlength' => 80]); ?>
                    <?php campo_texto('nombre', 'Nombre del curso', (string) ($registro['nombre'] ?? ''), ['maxlength' => 100]); ?>
                    <?php campo_texto('sector', 'Sector', (string) ($registro['sector'] ?? ''), ['maxlength' => 80]); ?>
                    <div class="col-md-6">
                        <label for="activo" class="form-label">Estado</label>
                        <select class="form-select" id="activo" name="activo">
                            <option value="1" <?= seleccionar_opcion((string) ($registro['activo'] ?? '1'), '1') ?>>Activo</option>
                            <option value="0" <?= seleccionar_opcion((string) ($registro['activo'] ?? '1'), '0') ?>>Inactivo</option>
                        </select>
                    </div>
                <?php /* Campos de TUTORES:*/ ?>
                <?php elseif ($tabla === 'tutores'): ?>
                    <?php campo_texto('nombre_completo', 'Nombre completo', (string) ($registro['nombre_completo'] ?? ''), ['maxlength' => 120]); ?>
                    <?php campo_texto('telefono', 'Teléfono (9 números)', (string) ($registro['telefono'] ?? ''), ['maxlength' => 20]); ?>
                    <?php campo_texto('email', 'Correo electrónico', (string) ($registro['email'] ?? ''), ['type' => 'email', 'maxlength' => 150]); ?>
                <?php /* Campos de DOCENTES*/ ?>
                <?php elseif ($tabla === 'docentes'): ?>
                    <?php campo_texto('nombre_completo', 'Nombre completo', (string) ($registro['nombre_completo'] ?? ''), ['maxlength' => 120]); ?>
                    <?php campo_texto('cedula', 'Cédula (8 dígitos)', (string) ($registro['cedula'] ?? ''), ['maxlength' => 8]); ?>
                    <?php campo_texto('email', 'Correo electrónico', (string) ($registro['email'] ?? ''), ['type' => 'email', 'maxlength' => 150]); ?>
                    <?php campo_texto('telefono', 'Teléfono (9 números)', (string) ($registro['telefono'] ?? ''), ['maxlength' => 20]); ?>
                    <?php campo_texto('fecha_nacimiento', 'Fecha de nacimiento', (string) ($registro['fecha_nacimiento'] ?? ''), ['type' => 'date']); ?>
                    <?php campo_texto('formacion_academica', 'Formación académica', (string) ($registro['formacion_academica'] ?? ''), ['maxlength' => 100]); ?>
                    <div class="col-md-6">
                        <label for="solicitud" class="form-label">Solicitud</label>
                        <select class="form-select" id="solicitud" name="solicitud" required>
                            <option value="especializacion" <?= seleccionar_opcion((string) ($registro['solicitud'] ?? ''), 'especializacion') ?>>Especialización</option>
                            <option value="otro" <?= seleccionar_opcion((string) ($registro['solicitud'] ?? ''), 'otro') ?>>Otra solicitud</option>
                        </select>
                    </div>
                    <?php campo_texto('solicitud_detalle', 'Detalle de otra solicitud', (string) ($registro['solicitud_detalle'] ?? ''), ['maxlength' => 30, 'required' => false]); ?>
                    <div class="col-12">
                        <label for="mensaje_docente" class="form-label">Algo que quieras decirnos (opcional)</label>
                        <textarea class="form-control" id="mensaje_docente" name="mensaje" rows="3" maxlength="330"><?= escapar((string) ($registro['mensaje'] ?? '')) ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="estado_docente" class="form-label">Estado de la solicitud</label>
                        <select class="form-select" id="estado_docente" name="estado">
                            <?php foreach (['recibido' => 'Recibido', 'contactado' => 'Contactado', 'descartado' => 'Descartado', 'cancelado' => 'Cancelado'] as $clave => $texto): ?>
                                <option value="<?= escapar($clave) ?>" <?= seleccionar_opcion((string) ($registro['estado'] ?? 'recibido'), $clave) ?>><?= escapar($texto) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 form-check ms-2">
                        <input class="form-check-input" type="checkbox" id="acepta_terminos_docente" name="acepta_terminos" value="1" required <?= $editando ? 'checked' : '' ?>>
                        <label class="form-check-label" for="acepta_terminos_docente">Consta la aceptación de términos y política de privacidad</label>
                    </div>
                <?php /* Campos de CUPO DE ESTUDIANTES  */ ?>
                <?php else: ?>
                    <?php campo_texto('nombre_completo', 'Nombre completo', (string) ($registro['nombre_completo'] ?? ''), ['maxlength' => 120]); ?>
                    <?php campo_texto('cedula', 'Cédula (8 dígitos)', (string) ($registro['cedula'] ?? ''), ['maxlength' => 8]); ?>
                    <?php campo_texto('email', 'Correo electrónico', (string) ($registro['email'] ?? ''), ['type' => 'email', 'maxlength' => 150]); ?>
                    <?php campo_texto('telefono', 'Teléfono (9 números)', (string) ($registro['telefono'] ?? ''), ['maxlength' => 20]); ?>
                    <?php campo_texto('fecha_nacimiento', 'Fecha de nacimiento', (string) ($registro['fecha_nacimiento'] ?? ''), ['type' => 'date']); ?>
                    <div class="col-md-6">
                        <label for="curso_id" class="form-label">Curso</label>
                        <select class="form-select" id="curso_id" name="curso_id" required><?php mostrar_curso_options($cursos, (string) ($registro['curso_id'] ?? '')); ?></select>
                    </div>
                    <div class="col-md-6">
                        <label for="tutor_id" class="form-label">Tutor (obligatorio para menores de 18)</label>
                        <select class="form-select" id="tutor_id" name="tutor_id"><?php mostrar_tutor_options($tutores, (string) ($registro['tutor_id'] ?? '')); ?></select>
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado de la inscripción</label>
                        <select class="form-select" id="estado" name="estado">
                            <?php foreach (['reservado' => 'Reservado', 'confirmado' => 'Confirmado', 'cancelado' => 'Cancelado'] as $clave => $texto): ?>
                                <option value="<?= escapar($clave) ?>" <?= seleccionar_opcion((string) ($registro['estado'] ?? 'reservado'), $clave) ?>><?= escapar($texto) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="mensaje" class="form-label">Algo que quieras decirnos (opcional)</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" maxlength="330"><?= escapar((string) ($registro['mensaje'] ?? '')) ?></textarea>
                    </div>
                    <div class="col-12 form-check ms-2">
                        <input class="form-check-input" type="checkbox" id="acepta_terminos" name="acepta_terminos" value="1" required <?= $editando ? 'checked' : '' ?>>
                        <label class="form-check-label" for="acepta_terminos">Consta la aceptación de términos y política de privacidad</label>
                    </div>
                <?php endif; ?>
                <?php /* Botones del formulario: guardar/crear y, si se edita, cancelar */ ?>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-primary" type="submit"><?= $editando ? 'Guardar cambios' : 'Crear registro' ?></button>
                    <?php if ($editando): ?><a class="btn btn-outline-secondary" href="admin.php?tabla=<?= escapar($tabla) ?>">Cancelar</a><?php endif; ?>
                </div>
            </form>
        </section>

        <!-- 2. TABLA DE REGISTROS con buscador -->
        <section class="admin-card p-3 p-md-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <h2 class="h4 mb-0">Registros</h2>
                <!-- Buscador  filtra con LIKE en varias columnas -->
                <form method="get" class="d-flex gap-2">
                    <input type="hidden" name="tabla" value="<?= escapar($tabla) ?>">
                    <label class="visually-hidden" for="buscar">Buscar registros</label>
                    <input class="form-control" id="buscar" name="buscar" value="<?= escapar($busqueda) ?>" placeholder="Buscar...">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle admin-table">
                    <?php /* Encabezados de la tabla según la tabla elegida */ ?>
                    <thead><tr>
                        <?php if ($tabla === 'cursos'): ?>
                            <th>ID</th><th>Tipo</th><th>Curso</th><th>Sector</th><th>Estado</th>
                        <?php elseif ($tabla === 'tutores'): ?>
                            <th>ID</th><th>Nombre</th><th>Teléfono</th><th>Correo</th>
                        <?php elseif ($tabla === 'docentes'): ?>
                            <th>ID</th><th>Docente</th><th>Cédula</th><th>Formación</th><th>Solicitud</th><th>Mensaje</th><th>Estado</th><th>Fecha</th>
                        <?php else: ?>
                            <th>ID</th><th>Estudiante</th><th>Cédula</th><th>Curso</th><th>Mensaje</th><th>Estado</th><th>Fecha</th>
                        <?php endif; ?>
                        <th>Acciones</th>
                    </tr></thead>
                    <tbody>
                    <?php if ($pdo !== null):
                        // Arma la consulta SQL según la tabla (máx. 100 filas); si hay búsqueda agrega WHERE ... LIKE
                        if ($tabla === 'cursos') {
                            $sql = 'SELECT id, tipo, nombre, sector, activo FROM cursos';
                            if ($busqueda !== '') {
                                $sql .= ' WHERE tipo LIKE :q1 OR nombre LIKE :q2 OR sector LIKE :q3';
                            }
                            $sql .= ' ORDER BY tipo, nombre LIMIT 100';
                        } elseif ($tabla === 'tutores') {
                            $sql = 'SELECT id, nombre_completo, telefono, email FROM tutores';
                            if ($busqueda !== '') {
                                $sql .= ' WHERE nombre_completo LIKE :q1 OR telefono LIKE :q2 OR email LIKE :q3';
                            }
                            $sql .= ' ORDER BY id DESC LIMIT 100';
                        } elseif ($tabla === 'docentes') {
                            $sql = 'SELECT id, nombre_completo, cedula, formacion_academica, solicitud, solicitud_detalle, mensaje, estado, fecha_registro
                                    FROM docentes';
                            if ($busqueda !== '') {
                                $sql .= ' WHERE nombre_completo LIKE :q1 OR cedula LIKE :q2 OR email LIKE :q3 OR formacion_academica LIKE :q4 OR solicitud_detalle LIKE :q5 OR mensaje LIKE :q6';
                            }
                            $sql .= ' ORDER BY id DESC LIMIT 100';
                        } else {
                            $sql = 'SELECT i.id, i.nombre_completo, i.cedula, i.email, i.mensaje, i.estado, i.fecha_registro, c.nombre AS curso
                                    FROM cupo_estudiantes i LEFT JOIN cursos c ON c.id = i.curso_id';
                            if ($busqueda !== '') {
                                $sql .= ' WHERE i.nombre_completo LIKE :q1 OR i.cedula LIKE :q2 OR i.email LIKE :q3 OR c.nombre LIKE :q4 OR i.mensaje LIKE :q5';
                            }
                            $sql .= ' ORDER BY i.id DESC LIMIT 100';
                        }
                        // Ejecuta la consulta; cada :qN recibe el texto buscado entre % (cantidad de columnas según la tabla)
                        $stmt = $pdo->prepare($sql);
                        if ($busqueda !== '') {
                            $cantidadParametros = match ($tabla) {
                                'cupo_estudiantes' => 5,
                                'docentes' => 6,
                                default => 3,
                            };
                            foreach (range(1, $cantidadParametros) as $indice) {
                                $stmt->bindValue(':q' . $indice, '%' . $busqueda . '%', PDO::PARAM_STR);
                            }
                        }
                        $stmt->execute();
                        $filas = $stmt->fetchAll();
                        foreach ($filas as $fila): ?>
                            <tr>
                                <?php /* Celdas de cada fila según la tabla elegida */ ?>
                                <?php if ($tabla === 'cursos'): ?>
                                    <td><?= (int) $fila['id'] ?></td><td><?= escapar($fila['tipo']) ?></td><td><?= escapar($fila['nombre']) ?></td><td><?= escapar($fila['sector']) ?></td>
                                    <td><?= (int) $fila['activo'] === 1 ? 'Activo' : 'Inactivo' ?></td>
                                <?php elseif ($tabla === 'tutores'): ?>
                                    <td><?= (int) $fila['id'] ?></td><td><?= escapar($fila['nombre_completo']) ?></td><td><?= escapar($fila['telefono']) ?></td><td><?= escapar($fila['email']) ?></td>
                                <?php elseif ($tabla === 'docentes'): ?>
                                    <td><?= (int) $fila['id'] ?></td><td><?= escapar($fila['nombre_completo']) ?></td><td><?= escapar($fila['cedula']) ?></td><td><?= escapar($fila['formacion_academica']) ?></td><td><?= escapar($fila['solicitud'] === 'otro' ? ($fila['solicitud_detalle'] ?: 'Otra solicitud') : 'Especialización') ?></td><td><?= escapar($fila['mensaje'] ?: '—') ?></td><td><?= escapar(ucfirst($fila['estado'])) ?></td><td><?= escapar($fila['fecha_registro']) ?></td>
                                <?php else: ?>
                                    <td><?= (int) $fila['id'] ?></td><td><?= escapar($fila['nombre_completo']) ?></td><td><?= escapar($fila['cedula']) ?></td><td><?= escapar($fila['curso'] ?? 'Sin curso') ?></td><td><?= escapar($fila['mensaje'] ?: '—') ?></td><td><?= escapar(ucfirst($fila['estado'])) ?></td><td><?= escapar($fila['fecha_registro']) ?></td>
                                <?php endif; ?>
                                <?php /* Columna ACCIONES: Editar, Eliminar y (según la tabla) Cancelar cupo / solicitud */ ?>
                                <td><div class="admin-actions">
                                    <a class="btn btn-sm btn-outline-primary" href="admin.php?tabla=<?= escapar($tabla) ?>&editar=<?= (int) $fila['id'] ?>">Editar</a>
                                    <form method="post" onsubmit="return confirm('¿Eliminar este registro?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="tabla" value="<?= escapar($tabla) ?>">
                                        <input type="hidden" name="id" value="<?= (int) $fila['id'] ?>">
                                        <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                    </form>
                                    <?php if ($tabla === 'cupo_estudiantes' && $fila['estado'] !== 'cancelado'): ?>
                                        <form method="post" onsubmit="return confirm('¿Cancelar este cupo de estudiante?');">
                                            <input type="hidden" name="accion" value="cancelar_cupo">
                                            <input type="hidden" name="id" value="<?= (int) $fila['id'] ?>">
                                            <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                                            <button class="btn btn-sm btn-outline-warning" type="submit">Cancelar cupo</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($tabla === 'docentes' && $fila['estado'] !== 'cancelado'): ?>
                                        <form method="post" onsubmit="return confirm('¿Cancelar esta solicitud docente?');">
                                            <input type="hidden" name="accion" value="cancelar_docente">
                                            <input type="hidden" name="id" value="<?= (int) $fila['id'] ?>">
                                            <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                                            <button class="btn btn-sm btn-outline-warning" type="submit">Cancelar solicitud</button>
                                        </form>
                                    <?php endif; ?>
                                </div></td>
                            </tr>
                        <?php endforeach;
                        // Si no hay resultados, muestra una fila avisándolo
                        if ($filas === []): ?>
                            <tr><td colspan="<?= $tabla === 'cupo_estudiantes' ? 8 : ($tabla === 'cursos' ? 6 : ($tabla === 'docentes' ? 9 : 5)) ?>" class="text-center text-muted py-4">No se encontraron registros.</td></tr>
                        <?php endif;
                    endif; ?>
                    </tbody>
                </table>
            </div>
            <p class="small text-muted mb-0">Se muestran hasta 100 registros por vista. Usá la búsqueda para encontrar registros adicionales.</p>
        </section>