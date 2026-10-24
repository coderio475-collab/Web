<?php
/**
 * Formulario del CRUD para cambiar los destinos externos usados por el sitio.
 */
declare(strict_types=1);
?>
<section class="admin-card p-3 p-md-4 mb-4">
    <h2 class="h4 mb-2">Enlaces externos</h2>
    <p class="text-muted">Cambiá el destino de los enlaces públicos. Usá una dirección completa que empiece con https:// o http://.</p>
    <!-- Un único formulario facilita guardar todos los destinos juntos. -->
    <form method="post">
        <input type="hidden" name="accion" value="guardar_enlaces_externos">
        <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
        <div class="row g-3">
            <?php foreach (ENLACES_EXTERNOS as $clave => [$etiqueta, $predeterminada]): ?>
                <?php $ubicacion = 'enlace_' . $clave; ?>
                <div class="col-12">
                    <label class="form-label" for="<?= escapar($ubicacion) ?>"><?= escapar($etiqueta) ?></label>
                    <input class="form-control" type="url" id="<?= escapar($ubicacion) ?>" name="enlaces[<?= escapar($clave) ?>]" maxlength="500" value="<?= escapar($titulosImagenes[$ubicacion] ?? $predeterminada) ?>" required>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Guardar enlaces</button>
    </form>
</section>
