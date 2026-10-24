<?php
/**
 * ============================================================================
 * modificaciones.php — SECCIÓN "MODIFICAR HORARIOS Y EXÁMENES"
 * La subida la procesa accion_subir_archivo() en subidas.php.
 * ============================================================================
 */
declare(strict_types=1);

// Permite publicar archivos PDF y consultar sus versiones recientes.
?>

            <!-- Formulario para SUBIR un PDF nuevo (apartado + archivo) -->
            <section class="admin-card pdf-upload p-3 p-md-4 mb-4">
                <h2 class="h4 mb-2">Modificar horarios y exámenes</h2>
                <p class="text-muted">Subí un PDF nuevo para reemplazar el que ve el público. Se conserva el historial y siempre se muestra la última versión subida para cada apartado.</p>
                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <input type="hidden" name="accion" value="subir_archivo">
                    <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                    <div class="col-md-6">
                        <label for="tipo_archivo" class="form-label">Apartado</label>
                        <select class="form-select" id="tipo_archivo" name="tipo_archivo" required>
                            <option value="horarios">Horarios por materia</option>
                            <option value="examenes">Calendario de exámenes</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="archivo_pdf" class="form-label">Archivo PDF (máximo 50 MB)</label>
                        <input class="form-control" type="file" id="archivo_pdf" name="archivo_pdf" accept="application/pdf,.pdf" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Subir PDF</button>
                    </div>
                </form>
            </section>

            <!-- Lista de PDF ya publicados -->
            <section class="admin-card p-3 p-md-4">
                <h2 class="h4 mb-3">PDF publicados</h2>
                <?php /* Se repite para cada apartado: horarios y exámenes */ ?>
                <?php foreach (['horarios' => 'Horarios por materia', 'examenes' => 'Calendario de exámenes'] as $tipo => $etiqueta): ?>
                    <?php
                    // Junta hasta 3 versiones (las más recientes primero) del apartado actual
                    $versiones = [];
                    foreach ($archivos as $archivo) {
                        if ($archivo['tipo'] === $tipo) {
                            $versiones[] = $archivo;
                            if (count($versiones) >= 3) {
                                break;
                            }
                        }
                    }
                    $archivoActual = $versiones[0] ?? null;
                    ?>
                    <div class="border rounded p-3 mb-3">
                        <h3 class="h5"><?= escapar($etiqueta) ?></h3>
                        <?php /* Si hay PDF: última versión, enlaces para verla y listado de las últimas 3 */ ?>
                        <?php if ($archivoActual !== null): ?>
                            <p class="mb-1">Última versión: <?= escapar($archivoActual['nombre_original']) ?></p>
                            <p class="small text-muted mb-2">Subido: <?= escapar($archivoActual['fecha_subida']) ?></p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <a class="btn btn-sm btn-outline-primary" href="assets/php/archivo.php?tipo=<?= escapar($tipo) ?>" target="_blank" rel="noopener">Ver PDF publicado</a>
                                <?php foreach ($versiones as $indice => $version): ?>
                                    <a class="btn btn-sm btn-outline-secondary" href="assets/php/archivo.php?tipo=<?= escapar($tipo) ?>&id=<?= (int) $version['id'] ?>" target="_blank" rel="noopener">Ver v<?= (int) ($indice + 1) ?></a>
                                <?php endforeach; ?>
                            </div>
                            <div class="small text-muted">
                                <p class="mb-2">Últimos 3 PDFs subidos:</p>
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($versiones as $indice => $version): ?>
                                        <li class="mb-1">
                                            <a href="assets/php/archivo.php?tipo=<?= escapar($tipo) ?>&id=<?= (int) $version['id'] ?>" target="_blank" rel="noopener"><?= escapar($version['nombre_original']) ?></a>
                                            <span> · <?= escapar($version['fecha_subida']) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php /* Si no hay PDF: horarios usa el original del sitio; exámenes avisa que no hay uno publicado */ ?>
                        <?php elseif ($tipo === 'horarios'): ?>
                            <p class="mb-0 text-muted">Todavía no hay una carga nueva; se muestra el PDF original del sitio.</p>
                        <?php else: ?>
                            <p class="mb-0 text-muted">Todavía no hay un PDF publicado.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </section>
