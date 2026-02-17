<?php // session started in bootstrap ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | La Tienda del Seis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/inicioSesion.css">
</head>

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<section class="registro-section d-flex align-items-center justify-content-center min-vh-100 py-4">
    <div class="registro-card p-4 shadow mw-100 mx-auto" style="max-width: 400px;">

        <h2 class="text-center mb-4">Recuperar contraseña</h2>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

        <form method="POST" action="index.php?action=enviar-reset">

            <div class="mb-3">
                <input type="email" name="correo" class="form-control" placeholder="Correo electronico" required>
            </div>

            <button type="submit" class="btn btn-danger w-100">
                RECUPERAR CONTRASEÑA
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
