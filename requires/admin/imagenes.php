<?php
/**
 * ============================================================================
 * imagenes.php — APARTADO PARA ADMINISTRAR LAS IMÁGENES DEL SITIO
 * Las acciones las procesa subidas.php (guardar_imagen, eliminar_imagen) y acciones.php.
 * ============================================================================
 */
declare(strict_types=1);

// Administra los titulos y las imagenes que se publican en los espacios del sitio.
?>

            <section class="admin-card p-3 p-md-4 mb-4">
                <h2 class="h4 mb-2">Imágenes de la página</h2>
                <p class="text-muted">Cada espacio tiene una ubicación fija. Al subir otra imagen en el mismo espacio, se reemplaza la anterior y el cambio aparece en la página pública.</p>
                <?php /* Lista de grupos  para ordenar las tarjetas */ ?>
                <?php $gruposImagenes = array_values(array_unique(array_column(UBICACIONES_IMAGENES, 'grupo'))); ?>
                <?php foreach ($gruposImagenes as $grupoImagenes): ?>
                    <h3 class="h5 mt-4 mb-3"><?= escapar($grupoImagenes) ?></h3>
                    <div class="row g-3">
                        <?php /* Una tarjeta por cada ubicación del grupo */ ?>
                        <?php foreach (UBICACIONES_IMAGENES as $ubicacion => $definicion): ?>
                            <?php if ($definicion['grupo'] !== $grupoImagenes) continue; ?>
                            <?php /* Busca en $imagenes (cargada en acciones.php)  */ ?>
                            <?php $imagenActual = null; ?>
                            <?php foreach ($imagenes as $imagen): ?>
                                <?php if ($imagen['ubicacion'] === $ubicacion) { $imagenActual = $imagen; break; } ?>
                            <?php endforeach; ?>
                            <div class="col-md-6 col-xl-4">
                                <article class="border rounded p-3 h-100">
                                    <h4 class="h6"><?= escapar($definicion['etiqueta']) ?></h4>
                                    <?php /* Formulario del TÍTULO destacado (solo si la ubicación tiene titulo_default) */ ?>
                                    <?php if (isset($definicion['titulo_default'])): ?>
                                        <form method="post" class="mb-3">
                                            <input type="hidden" name="accion" value="guardar_titulo_imagen">
                                            <input type="hidden" name="ubicacion" value="<?= escapar($ubicacion) ?>">
                                            <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                                            <label class="form-label small" for="titulo_<?= escapar($ubicacion) ?>">Título destacado</label>
                                            <input
                                                class="form-control form-control-sm mb-2"
                                                type="text"
                                                id="titulo_<?= escapar($ubicacion) ?>"
                                                name="titulo"
                                                maxlength="180"
                                                value="<?= escapar($titulosImagenes[$ubicacion] ?? $definicion['titulo_default']) ?>"
                                                required>
                                            <button class="btn btn-sm btn-outline-primary" type="submit">Guardar título</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php /* Vista previa de la imagen actual (la sirve assets/php/imagen.php) */ ?>
                                    <?php if ($imagenActual !== null): ?>
                                        <img
                                            src="assets/php/imagen.php?ubicacion=<?= rawurlencode($ubicacion) ?>"
                                            alt="<?= escapar($definicion['etiqueta']) ?>"
                                            class="img-fluid rounded mb-2"
                                            style="width:100%;height:180px;object-fit:cover">
                                        <p class="small text-muted mb-2"><?= escapar($imagenActual['nombre_original']) ?> · <?= escapar($imagenActual['fecha_subida']) ?></p>
                                    <?php else: ?>
                                        <p class="small text-muted">Aún no hay una imagen cargada.</p>
                                    <?php endif; ?>
                                    <?php /* Formulario para SUBIR / REEMPLAZAR la imagen */ ?>
                                    <form method="post" enctype="multipart/form-data" class="mb-2">
                                        <input type="hidden" name="accion" value="guardar_imagen">
                                        <input type="hidden" name="ubicacion" value="<?= escapar($ubicacion) ?>">
                                        <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                                        <label class="form-label small" for="imagen_<?= escapar($ubicacion) ?>"><?= $imagenActual === null ? 'Subir imagen' : 'Reemplazar imagen' ?> (máximo 10 MB)</label>
                                        <input class="form-control form-control-sm mb-2" type="file" id="imagen_<?= escapar($ubicacion) ?>" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" required>
                                        <button class="btn btn-sm btn-primary" type="submit"><?= $imagenActual === null ? 'Subir' : 'Reemplazar' ?></button>
                                    </form>
                                    <?php /* Formulario para ELIMINAR la imagen (pide confirmación) */ ?>
                                    <?php if ($imagenActual !== null): ?>
                                        <form method="post" onsubmit="return confirm('¿Eliminar esta imagen de la página?');">
                                            <input type="hidden" name="accion" value="eliminar_imagen">
                                            <input type="hidden" name="ubicacion" value="<?= escapar($ubicacion) ?>">
                                            <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar imagen</button>
                                        </form>
                                    <?php endif; ?>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </section>
