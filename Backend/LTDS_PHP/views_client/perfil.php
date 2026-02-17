<?php // session started in bootstrap ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/inicioSesion.css">
</head>
<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<section class="registro-section d-flex align-items-center justify-content-center">
    <div class="registro-card p-4 shadow" style="max-width:520px; width:100%;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Mi perfil</h2>
            <a href="index.php?action=misPedidos" class="mis-pedidos-btn">
                <i class="bi bi-bag-check"></i> Mis pedidos
            </a>
        </div>

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

        <form method="POST" action="index.php?action=updatePerfil">

            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="NombreCom" class="form-control" value="<?= htmlspecialchars($usuario['NombreCom'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="Correo" class="form-control" value="<?= htmlspecialchars($usuario['Correo'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="Tel" class="form-control" value="<?= htmlspecialchars($usuario['Tel'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="Direccion" class="form-control" value="<?= htmlspecialchars($usuario['Direccion'] ?? '') ?>" required>
            </div>

            <hr class="my-4">

            <div class="mb-3">
                <label class="form-label">Contraseña actual</label>
                <input type="password" name="PasswordActual" class="form-control" required>
                <div class="form-text">Necesaria para guardar cambios.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nueva contraseña (opcional)</label>
                <input type="password" name="PasswordNueva" class="form-control" placeholder="Dejar en blanco para mantener">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar nueva contraseña</label>
                <input type="password" name="PasswordConfirm" class="form-control" placeholder="Repetir nueva contraseña">
            </div>

            <button type="submit" class="btn btn-danger w-100">Guardar cambios</button>
        </form>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
