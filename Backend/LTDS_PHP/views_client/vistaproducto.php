<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista del Producto</title>

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/vistaproducto.css">
</head>



<body class="bg-light">

<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>











    <div class="container py-5">

        <div class="row align-items-center gy-4">

            <!-- IMAGEN -->
            <div class="col-md-6 text-center">
                <img src="uploads/<?= htmlspecialchars($producto['Foto']) ?>" class="img-fluid w-75">
            </div>

            <!-- INFO -->
            <div class="col-md-6">
                <div class="product-box">

                    <h2 class="product-title"><?= htmlspecialchars($producto['Nombre']) ?></h2>


                    <div class="rating-stars mb-2">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <span class="fw-bold ms-2">4.5</span>
                    </div>

                    <h4 class="fw-bold">COP <?= number_format($producto['Precio'], 0, ',', '.') ?></h4>


                    <div class="mt-3 mb-2 fw-semibold">Talla</div>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="size-btn">7</span>
                        <span class="size-btn">7.5</span>
                        <span class="size-btn">8</span>
                        <span class="size-btn">8.5</span>
                        <span class="size-btn">9</span>
                        <span class="size-btn">9.5</span>
                        <span class="size-btn">10</span>
                        <span class="size-btn">10.5</span>
                        <span class="size-btn">11</span>
                    </div>

                    <div class="mt-2">
                        <a href="guiaTallas.php" class="text-decoration-none fw-semibold" style="color:#b30000;">Guía de tallas</a>
                    </div>

                    <div class="row mt-4 align-items-center">
                        <div class="col-10">
                            <button class="btn-cart">Agregar al carrito</button>
                        </div>
                        <div class="col-2 text-end">
                            <i class="bi bi-heart-fill heart-btn"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- DESCRIPCIÓN -->
        <div class="desc-box mt-5">
            <h5 class="fw-bold">Descripción</h5>
            <p><?= htmlspecialchars($producto['Descripcion']) ?></p>
        </div>

        <!-- ACORDEÓN -->
        <div class="accordion mt-4" id="productAccordion">

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#caracteristicas">
                        Características
                    </button>
                </h2>
                <div id="caracteristicas" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        - Material de alta calidad <br>
                        - Suela resistente <br>
                        - Diseño original New Balance
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#opiniones">
                        Opiniones y valoraciones
                    </button>
                </h2>
                <div id="opiniones" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        ⭐⭐⭐⭐⭐ Excelente calidad, super cómodas.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#envio">
                        Envío y garantía
                    </button>
                </h2>
                <div id="envio" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Envíos a todo el país.  
                        Garantía de 30 días por defectos de fábrica.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lavado">
                        Lavado y cuidado
                    </button>
                </h2>
                <div id="lavado" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Limpiar con paño húmedo.  
                        No usar blanqueador.
                    </div>
                </div>
            </div>

        </div>

    </div>









<?php include __DIR__ . '/partials/footer.php'; ?>


    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
