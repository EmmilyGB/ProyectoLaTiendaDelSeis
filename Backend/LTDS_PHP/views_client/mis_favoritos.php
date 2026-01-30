<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Favoritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/favoritos.css">
</head>
<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container py-5">
    <h2>Mis Favoritos</h2>

    <?php if (empty($favoritos)): ?>
        <p>No tienes productos en favoritos.</p>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($favoritos as $f): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card">
                        <img src="uploads/<?= htmlspecialchars($f['Foto']) ?>" class="card-img-top">
                        <div class="card-body text-center">
                            <h6><?= htmlspecialchars($f['Nombre']) ?></h6>
                            <p class="mb-2">COP <?= number_format($f['Precio'],0,',','.') ?></p>
                            <a href="index.php?action=verProducto&id=<?= $f['IdProducto'] ?>" class="btn btn-sm btn-primary">Ver</a>
                            <a href="index.php?action=removeFavorite&id=<?= $f['IdProducto'] ?>" class="btn btn-sm btn-outline-danger">Quitar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>