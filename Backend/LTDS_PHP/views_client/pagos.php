<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito/Latiendadelseis</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/pagos.css">
</head>


<body>

<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>














<main class="py-5">
    <div class="container">

        <h2 class="text-center mb-5">Finalizar compra</h2>

        <div class="row g-4">

            <!-- ===== DATOS DE PAGO ===== -->
            <div class="col-lg-7">
                <div class="card p-4 bg-dark text-white border-danger">

                    <h4 class="mb-4">Datos de pago</h4>

                    <form>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Nombre y apellido">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" placeholder="correo@email.com">
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label class="form-label">Dirección de envío</label>
                            <input type="text" class="form-control" placeholder="Dirección completa">
                        </div>

                        <!-- Ciudad y Tel -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- MÉTODO DE PAGO -->
                        <h5 class="mb-3">Método de pago</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="pago" checked>
                            <label class="form-check-label">
                                <i class="bi bi-credit-card"></i> Nequi
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="pago">
                            <label class="form-check-label">
                                <i class="bi bi-bank"></i> Bancolombia
                            </label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="pago">
                            <label class="form-check-label">
                                <i class="bi bi-credit-card-2-front"></i> Daviplata
                            </label> 
                        </div> 

                        <button type="submit" class="btn btn-danger w-100 mt-4">
                            Pagar ahora
                        </button>

                    </form>
                </div>
            </div>

            <!-- ===== RESUMEN ===== -->
            <div class="col-lg-5">
                <div class="card p-4 bg-black text-white border-danger">

                    <h4 class="mb-4">Resumen del pedido</h4>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Lattafa Yara</span>
                        <span>COP 245.000</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Adidas Campus</span>
                        <span>COP 599.950</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong class="text-danger">COP 844.950</strong>
                    </div>

                </div>
            </div>

        </div>

    </div>
</main>


















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