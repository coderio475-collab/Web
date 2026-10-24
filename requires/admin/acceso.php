<?php
/**
 * ============================================================================
 * acceso.php — FORMULARIO DE INICIO DE SESIÓN
 * Envía por POST: usuario, contraseña y el token CSRF 
 * ============================================================================
 */
declare(strict_types=1);

// Muestra el formulario de inicio de sesion y el aviso de configuracion de credenciales.
?>

        <section class="admin-card p-4 p-md-5 mx-auto" style="max-width: 520px">
            <h2 class="h4 mb-3">Iniciar sesión</h2>
            <?php /* Aviso si faltan las variables de entorno con usuario y hash de contraseña */ ?>
            <?php if (!$credencialesConfiguradas): ?>
                <p>Configurá <code>CRUD_ADMIN_USER</code> y <code>CRUD_ADMIN_PASSWORD_HASH</code> en Apache antes de ingresar. Consultá <code>main/database/CRUD.md</code>.</p>
            <?php endif; ?>
            <?php /* Formulario de login (la validación la hace controlador.php) */ ?>
            <form method="post" autocomplete="on">
                <input type="hidden" name="accion" value="login">
                <input type="hidden" name="csrf_token" value="<?= escapar(csrf_token()) ?>">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input class="form-control" id="usuario" name="usuario" autocomplete="username" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input class="form-control" type="password" id="contrasena" name="contrasena" autocomplete="current-password" required>
                </div>
                <button class="btn btn-primary" type="submit">Ingresar</button>
            </form>
        </section>
