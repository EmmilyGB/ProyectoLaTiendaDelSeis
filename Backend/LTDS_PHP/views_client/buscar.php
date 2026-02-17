<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/tablasdproductos.css">
</head>

<body>

<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>


<!-- ===== PRODUCTOS ===== -->
<div class="container my-4">

    <?php if (empty($productos)): ?>
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted"></i>
            <h4 class="mt-3">No se encontraron productos</h4>
            <p class="text-muted">Intenta con otros términos de búsqueda</p>
            <a href="index.php?action=home" class="btn btn-primary mt-3">
                <i class="bi bi-house-door"></i> Volver al inicio
            </a>
        </div>
    <?php else: ?>

    <div class="row g-3">

        <?php foreach ($productos as $producto): ?>

        <div class="col-6 col-md-4 product-col">
            <div class="card product-card h-100 position-relative">

                <div class="position-absolute" style="top:8px; right:8px;">
                    <?php if (isset($_SESSION['usuario']) && $favoritoController->isFavorito($producto['IdProducto'])): ?>
                        <a href="index.php?action=removeFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-filled" aria-label="Quitar favorito"><i class="bi bi-heart-fill"></i></a>
                    <?php else: ?>
                        <a href="index.php?action=addFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-empty" aria-label="Agregar favorito"><i class="bi bi-heart"></i></a>
                    <?php endif; ?>
                </div>

                <a href="index.php?action=verProducto&id=<?= $producto['IdProducto'] ?>" class="text-decoration-none">
                    <img 
                        src="uploads/<?= htmlspecialchars($producto['Foto']) ?>" 
                        class="card-img-top img-fluid"
                        alt="<?= htmlspecialchars($producto['Nombre']) ?>"
                    >

                    <div class="card-body text-center">
                        <h6 class="product-name mb-1">
                            <?= htmlspecialchars($producto['Nombre']) ?>
                        </h6>

                        <p class="product-price mb-0">
                            $<?= number_format($producto['Precio'], 0, ',', '.') ?>
                        </p>
                    </div>
                </a>

            </div>
        </div>

        <?php endforeach; ?>

    </div>

    <?php endif; ?>
</div>

<?php if (!empty($pagination) && $pagination['totalPages'] > 1): ?>
    <?php
    if (!function_exists('pageUrl')) {
        function pageUrl($page) {
            $params = $_GET;
            $params['page'] = $page;
            return 'index.php?' . http_build_query($params);
        }
    }
    ?>
    <nav class="my-4">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($pagination['page'] <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= ($pagination['page'] <= 1) ? '#' : pageUrl($pagination['page'] - 1) ?>">«</a>
            </li>
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?= ($i === $pagination['page']) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= pageUrl($i) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($pagination['page'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= ($pagination['page'] >= $pagination['totalPages']) ? '#' : pageUrl($pagination['page'] + 1) ?>">»</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>