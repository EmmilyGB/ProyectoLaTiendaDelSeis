<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro | Latiendadelseis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/crearCuenta.css">
</head>

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<section class="registro-section d-flex justify-content-center align-items-center">
    <div class="registro-card p-4 shadow">

        <h2 class="text-center mb-4">Crear cuenta</h2>

        <!-- MOSTRAR ERRORES -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=register" method="POST">

            <!-- Número de documento -->
            <div class="mb-2">
                <input type="text" name="NumDoc" class="form-control" placeholder="Número de documento" required>
            </div>

            <!-- Tipo de documento -->
            <div class="mb-3">
                <label class="form-label">Tipo de Documento*</label>
                <select class="form-control" name="TipoDoc" required>
                    <option value="">Selecciona una opción</option>
                    <?php foreach ($tipoDocs as $tipoDoc): ?>
                        <option value="<?= htmlspecialchars($tipoDoc['IdTipoDocum']); ?>">
                            <?= htmlspecialchars($tipoDoc['TipoDoc']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Nombre completo -->
            <div class="mb-2">
                <input type="text" name="NombreCom" class="form-control" placeholder="Nombre completo" required>
            </div>

            <!-- Correo -->
            <div class="mb-2">
                <input type="email" name="Correo" class="form-control" placeholder="Correo electrónico" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-2">
                <input type="password" name="Password" class="form-control" placeholder="Contraseña" required>
            </div>

            <!-- Confirmar contraseña -->
            <div class="mb-2">
                <input type="password" name="PasswordConfirm" class="form-control" placeholder="Confirma tu contraseña" required>
            </div>

            <!-- Teléfono -->
            <div class="mb-2">
                <input type="text" name="Telefono" class="form-control" placeholder="Teléfono" required>
            </div>

            <!-- Dirección -->
            <div class="mb-3">
                <input type="text" name="Direccion" class="form-control" placeholder="Dirección" required>
            </div>

            <!-- ROL OCULTO -->
            <input type="hidden" name="IdRol" value="2">

            <button type="submit" class="btn btn-danger w-100">Registrarme</button>
        </form>

        <div class="text-center mt-3">
            <a href="index.php?action=login" class="text-danger">
                ¿Ya tienes cuenta? Inicia sesión
            </a>
        </div>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
