<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Hombre</title>

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


<!-- BANNER -->
<div class="banner-categoria-hombre">
    <h1>Hombre</h1>
</div>

<!-- ===== PRODUCTOS ===== -->
<div class="container my-4">
    <!-- FILTROS -->
    <form method="get" action="index.php" class="mb-3 d-flex gap-2 align-items-center">
        <input type="hidden" name="action" value="hombre">
        <select name="IdColor" class="form-select" style="width:180px;">
            <option value="">Todos los colores</option>
            <?php foreach ($colores as $color): ?>
                <option value="<?= $color['IdColor'] ?>" <?= (isset($_GET['IdColor']) && $_GET['IdColor']==$color['IdColor'])? 'selected':'' ?>><?= htmlspecialchars($color['NomColor']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="IdTalla" class="form-select" style="width:180px;">
            <option value="">Todas las tallas</option>
            <?php foreach ($tallas as $talla): ?>
                <option value="<?= $talla['IdTalla'] ?>" <?= (isset($_GET['IdTalla']) && $_GET['IdTalla']==$talla['IdTalla'])? 'selected':'' ?>><?= htmlspecialchars($talla['NomTalla']) ?></option>
            <?php endforeach; ?>
        </select>

        <button class="btn btn-primary">Filtrar</button>
    </form>

    <?php if (empty($productos)): ?>
        <p class="text-center">No hay productos disponibles.</p>
    <?php else: ?>

    <div class="row g-3">

        <?php foreach ($productos as $producto): ?>

        <div class="col-6 col-md-4 col-lg-2">
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

<!-- ===== PAGINACIÓN (luego la hacemos dinámica) ===== -->
<nav class="my-4">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="#">«</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">»</a></li>
    </ul>
</nav>

<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
