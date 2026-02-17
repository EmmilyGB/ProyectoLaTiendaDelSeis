<?php // session started in bootstrap ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña | La Tienda del Seis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/inicioSesion.css">
</head>

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<section class="registro-section d-flex align-items-center justify-content-center">
    <div class="registro-card p-4 shadow">

        <h2 class="text-center mb-4">Nueva Contraseña</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="alert alert-info mb-4">
            <small>
                <strong>La contraseña debe tener:</strong><br>
                • Mínimo 8 caracteres<br>
                • Se recomienda usar mayúsculas, números y símbolos
            </small>
        </div>

        <form method="POST" action="index.php?action=cambiar-password">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control" 
                    placeholder="Mínimo 8 caracteres"
                    required 
                    minlength="8"
                >
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                <input 
                    type="password" 
                    name="password_confirm" 
                    id="password_confirm" 
                    class="form-control" 
                    placeholder="Repite la contraseña"
                    required 
                    minlength="8"
                >
            </div>

            <button type="submit" class="btn btn-danger w-100">
                CAMBIAR CONTRASEÑA
            </button>
        </form>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>