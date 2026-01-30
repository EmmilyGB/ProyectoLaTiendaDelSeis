<?php // session started in bootstrap ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión | La Tienda del Seis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/inicioSesion.css">
</head>

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<section class="registro-section d-flex align-items-center justify-content-center">
    <div class="registro-card p-4 shadow">

        <h2 class="text-center mb-4">Inicia sesión</h2>

        <!-- MENSAJES -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login">

            <div class="mb-3">
                <input type="email" name="Correo" class="form-control" placeholder="Correo electronico" required>
            </div>

            <div class="mb-3">
                <input type="password" name="Password" class="form-control" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn btn-danger w-100">
                INICIAR SESIÓN
            </button>

            <div class="text-center mt-3">
                <a href="index.php?action=crearCuenta" class="text-danger">
                    ¿No tienes cuenta? Crear cuenta
                </a>
            </div>

        </form>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
