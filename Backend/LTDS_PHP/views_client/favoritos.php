<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/tablasdproductos.css">
    <link rel="stylesheet" href="css/favoritos.css">
</head>

<body>


<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>



    <!-- BANNER CATEGORIA -->
    <div class="banner-categoria-hombre">
        <h1>Favoritos</h1></i>

    </div>





<!-- ======= SECCIÓN PRODUCTOS HOMBRE ======= -->
<div class="container-fluid seccion-productos seccion-hombre"></div>

    <div class="container">
        <div class="row product-row">

            <?php if (!empty($productos) && is_array($productos)): ?>

                <?php foreach ($productos as $producto): ?>

                <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                    <div class="card product-card h-100 position-relative">

                        <div class="position-absolute" style="top:8px; right:8px;">
                            <?php if (isset($_SESSION['usuario']) && $favoritoController->isFavorito($producto['IdProducto'])): ?>
                                <a href="index.php?action=removeFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-filled" aria-label="Quitar favorito"><i class="bi bi-heart-fill"></i></a>
                            <?php else: ?>
                                <a href="index.php?action=addFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-empty" aria-label="Agregar favorito"><i class="bi bi-heart"></i></a>
                            <?php endif; ?>
                        </div>

                        <a href="index.php?action=verProducto&id=<?= $producto['IdProducto'] ?>" class="text-decoration-none">
                            <img src="uploads/<?= htmlspecialchars($producto['Foto']) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($producto['Nombre']) ?>">

                            <div class="card-body text-center">
                                <h6 class="product-name mb-1"><?= htmlspecialchars($producto['Nombre']) ?></h6>
                                <p class="product-price mb-0">$<?= number_format($producto['Precio'], 0, ',', '.') ?></p>
                            </div>
                        </a>
                    </div>
                </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p class="text-center">No tienes favoritos todavía.</p>

            <?php endif; ?>

        </div>
    </div>






<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
