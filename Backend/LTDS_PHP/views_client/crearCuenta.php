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

    <input type="text" name="NumDoc" class="form-control mb-2" placeholder="Número de documento" required>

    <select name="TipoDoc" class="form-control mb-2" required>
        <option value="">Tipo de documento</option>
        <option value="CC">Cédula de ciudadanía</option>
        <option value="TI">Tarjeta de identidad</option>
        <option value="CE">Cédula extranjería</option>
    </select>

    <input type="text" name="NombreCom" class="form-control mb-2" placeholder="Nombre completo" required>

    <input type="email" name="Correo" class="form-control mb-2" placeholder="Correo electrónico" required>

    <input type="password" name="Password" class="form-control mb-2" placeholder="Contraseña" required>

    <input type="text" name="Telefono" class="form-control mb-2" placeholder="Teléfono" required>

    <input type="text" name="Direccion" class="form-control mb-3" placeholder="Dirección" required>

    <!-- ROL OCULTO (CLIENTE = 2) -->
    <input type="hidden" name="IdRol" value="2">

    <button type="submit" class="btn btn-danger w-100">Registrarme</button>
</form>

<div class="text-center mt-3">
    <a href="index.php?action=login" class="text-danger">¿Ya tienes cuenta? Inicia sesión</a>
</div>

</div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
