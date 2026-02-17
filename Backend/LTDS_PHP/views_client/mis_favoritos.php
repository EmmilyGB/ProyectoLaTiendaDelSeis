<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/favoritos.css">
    <link rel="stylesheet" href="css/tablasdproductos.css">
</head>
<body class="favorites-page-body">

<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container py-5 favorites-page">
    <h2>Mis Favoritos</h2>

    <?php if (empty($favoritos)): ?>
        <p>No tienes productos en favoritos.</p>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($favoritos as $f): ?>
                <div class="col-6 col-md-4 product-col">
                    <div class="card product-card h-100 position-relative favorite-card">
                        <a href="index.php?action=verProducto&id=<?= $f['IdProducto'] ?>" class="text-decoration-none">
                            <img src="uploads/<?= htmlspecialchars($f['Foto']) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($f['Nombre']) ?>">
                        </a>
                        <div class="card-body text-center favorite-card-body">
                            <h6 class="product-name mb-1"><?= htmlspecialchars($f['Nombre']) ?></h6>
                            <p class="product-price mb-2">$<?= number_format($f['Precio'],0,',','.') ?></p>
                            <div class="favorite-actions">
                                <a href="index.php?action=verProducto&id=<?= $f['IdProducto'] ?>" class="btn btn-sm btn-primary">Ver</a>
                                <a href="index.php?action=removeFavorite&id=<?= $f['IdProducto'] ?>" class="btn btn-sm btn-outline-danger">Quitar</a>
                            </div>
                        </div>
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

<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
