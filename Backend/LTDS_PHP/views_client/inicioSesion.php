<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InicioSesion/Latiendadelseis</title>

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

            <form>
                <!-- Correo -->
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico*</label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo">
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña*</label>
                    <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-3">
                    <label for="confirmar" class="form-label">Confirmar contraseña*</label>
                    <input type="password" class="form-control" id="confirmar" placeholder="Confirma tu contraseña">
                </div>

                <!-- Recordarme -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="recordar">
                    <label class="form-check-label" for="recordar">Recordarme</label>
                </div>

                <!-- Botón -->
                <button type="submit" class="btn btn-danger w-100">REGISTRARME</button>

                <!-- Enlace -->
                <div class="text-center mt-3">
                    <a href="#" class="text-danger me-3">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="text-center mt-3">
                    <a href="crearCuenta.html" class="text-danger me-3">¿No tienes cuenta? Crear cuenta</a>
                </div>
                
            </form>
        </div>
    </section>


<div id="footer"></div>

<script>
    fetch("footer.html")
        .then(res => res.text())
        .then(html => {
            document.getElementById("footer").innerHTML = html;
        });
</script>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>