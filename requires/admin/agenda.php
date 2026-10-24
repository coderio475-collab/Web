<?php
/**
 * ============================================================================
 * agenda.php — SECCIÓN "AGENDA DE LA PÁGINA"
 * Permite agregar, modificar y eliminar eventos de la agenda 
 * ============================================================================
 */
declare(strict_types=1);

// Permite agregar, modificar y eliminar eventos de la agenda publica.
?>

            <section class="admin-card p-3 p-md-4 mb-4">
                <h2 class="h4 mb-2">Agenda de la página</h2>
                <p class="text-muted">Los eventos se muestran en la portada y en la página de noticias. Podés modificar el nombre y la fecha, agregar eventos o eliminarlos.</p>
                <!-- Formulario para AGREGAR un evento nuevo (fecha + nombre) -->
                <form method="post" class="row g-3 border rounded p-3 mb-4">
                    <input type="hidden" name="accion" value="guardar_evento_agenda">
                    <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                    <div class="col-md-4">
                        <label class="form-label" for="agenda_fecha_nuevo">Fecha</label>
                        <input class="form-control" type="date" id="agenda_fecha_nuevo" name="fecha" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="agenda_titulo_nuevo">Nombre del evento</label>
                        <input class="form-control" type="text" id="agenda_titulo_nuevo" name="titulo" maxlength="180" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100" type="submit">Agregar</button>
                    </div>
                </form>
                <?php /* Lista de eventos existentes: cada uno tiene un formulario para guardar cambios y otro para eliminar */ ?>
                <?php foreach ($agendaEventos as $evento): ?>
                    <div class="border rounded p-3 mb-3">
                        <form method="post" class="row g-3 align-items-end">
                            <input type="hidden" name="accion" value="guardar_evento_agenda">
                            <input type="hidden" name="id" value="<?= (int) $evento['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                            <div class="col-md-3">
                                <label class="form-label" for="agenda_fecha_<?= (int) $evento['id'] ?>">Fecha</label>
                                <input class="form-control" type="date" id="agenda_fecha_<?= (int) $evento['id'] ?>" name="fecha" value="<?= escapar($evento['fecha']) ?>" required>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label" for="agenda_titulo_<?= (int) $evento['id'] ?>">Nombre del evento</label>
                                <input class="form-control" type="text" id="agenda_titulo_<?= (int) $evento['id'] ?>" name="titulo" maxlength="180" value="<?= escapar($evento['titulo']) ?>" required>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100" type="submit">Guardar</button>
                            </div>
                        </form>
                        <form method="post" class="mt-2" onsubmit="return confirm('¿Eliminar este evento de la agenda?');">
                            <input type="hidden" name="accion" value="eliminar_evento_agenda">
                            <input type="hidden" name="id" value="<?= (int) $evento['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar evento</button>
                        </form>
                    </div>
                <?php endforeach; ?>
                <?php /* Mensaje cuando no hay eventos */ ?>
                <?php if ($agendaEventos === []): ?>
                    <p class="text-muted mb-0">Todavía no hay eventos en la agenda.</p>
                <?php endif; ?>
            </section>