<?php
// iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | La Tienda del Seis</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/inicioSesion.css">
</head>

<body>

<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>

<section class="registro-section d-flex align-items-center justify-content-center">
    <div class="registro-card p-4 shadow">
        <h2 class="text-center mb-4">Inicia sesión</h2>

        <!-- ===== MENSAJE DE ERROR ===== -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- ===== FORMULARIO LOGIN ===== -->
        <form method="POST" action="index.php?action=login">

            <!-- Correo -->
            <div class="mb-3">
                <label class="form-label">Correo electrónico *</label>
                <input type="email" name="Correo" class="form-control" placeholder="Ingresa tu correo" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label">Contraseña *</label>
                <input type="password" name="Password" class="form-control" placeholder="Ingresa tu contraseña" required>
            </div>

            <!-- Recordarme (solo visual, no funcional por ahora) -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="recordar">
                <label class="form-check-label" for="recordar">Recordarme</label>
            </div>

            <!-- Botón -->
            <button type="submit" class="btn btn-danger w-100">
                INICIAR SESIÓN
            </button>

            <!-- Enlaces -->
            <div class="text-center mt-3">
                <a href="#" class="text-danger">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="text-center mt-2">
                <a href="index.php?action=insertuser" class="text-danger">
                    ¿No tienes cuenta? Crear cuenta
                </a>
            </div>

        </form>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
