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

<?php include __DIR__ . '/partials/header.php'; ?>

<!-- BANNER -->
<div class="banner-categoria-hombre">
    <h1>Hombre</h1>
</div>

<!-- ===== PRODUCTOS ===== -->
<div class="container my-4">

    <!-- FILTROS + ORDENAR -->
    <div class="row mb-3 align-items-center g-2">

        <!-- FILTROS -->
        <div class="col-12 col-lg-8">
            <form method="get" action="index.php" class="d-flex flex-wrap gap-2 align-items-center">
                <input type="hidden" name="action" value="hombre">

                <select name="IdColor" class="form-select" style="width:180px;">
                    <option value="">Todos los colores</option>
                    <?php foreach ($colores as $color): ?>
                        <option value="<?= $color['IdColor'] ?>"
                            <?= (isset($_GET['IdColor']) && $_GET['IdColor'] == $color['IdColor']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($color['NomColor']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="IdTalla" class="form-select" style="width:180px;">
                    <option value="">Todas las tallas</option>
                    <?php foreach ($tallas as $talla): ?>
                        <option value="<?= $talla['IdTalla'] ?>"
                            <?= (isset($_GET['IdTalla']) && $_GET['IdTalla'] == $talla['IdTalla']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($talla['NomTalla']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button class="btn btn-primary filter-btn">Filtrar</button>
            </form>
        </div>

        <!-- ORDENAR -->
        <div class="col-12 col-lg-4 d-flex justify-content-lg-end">
            <form method="get" action="index.php">
                <input type="hidden" name="action" value="<?= $_GET['action'] ?? 'hombre' ?>">
                <?php if (isset($_GET['IdColor'])): ?>
                    <input type="hidden" name="IdColor" value="<?= $_GET['IdColor'] ?>">
                <?php endif; ?>
                <?php if (isset($_GET['IdTalla'])): ?>
                    <input type="hidden" name="IdTalla" value="<?= $_GET['IdTalla'] ?>">
                <?php endif; ?>

                <select name="orderBy"
                        class="form-select"
                        style="width:250px;"
                        onchange="this.form.submit()">
                    <option value="">Ordenar por</option>
                    <option value="precio_asc" <?= ($_GET['orderBy'] ?? '') == 'precio_asc' ? 'selected' : '' ?>>Precio: Bajo - Alto</option>
                    <option value="precio_desc" <?= ($_GET['orderBy'] ?? '') == 'precio_desc' ? 'selected' : '' ?>>Precio: Alto - Bajo</option>
                    <option value="nombre_asc" <?= ($_GET['orderBy'] ?? '') == 'nombre_asc' ? 'selected' : '' ?>>Nombre: A - Z</option>
                    <option value="nombre_desc" <?= ($_GET['orderBy'] ?? '') == 'nombre_desc' ? 'selected' : '' ?>>Nombre: Z - A</option>
                    <option value="mas_vendido" <?= ($_GET['orderBy'] ?? '') == 'mas_vendido' ? 'selected' : '' ?>>Más vendido</option>
                </select>
            </form>
        </div>

    </div>

    <?php if (empty($productos)): ?>
        <p class="text-center">No hay productos disponibles.</p>
    <?php else: ?>

    <div class="row g-3">
        <?php foreach ($productos as $producto): ?>
            <div class="col-6 col-md-4 product-col">
                <div class="card product-card h-100 position-relative">

                    <div class="position-absolute" style="top:8px; right:8px;">
                        <?php if (isset($_SESSION['usuario']) && $favoritoController->isFavorito($producto['IdProducto'])): ?>
                            <a href="index.php?action=removeFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-filled">
                                <i class="bi bi-heart-fill"></i>
                            </a>
                        <?php else: ?>
                            <a href="index.php?action=addFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-empty">
                                <i class="bi bi-heart"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <a href="index.php?action=verProducto&id=<?= $producto['IdProducto'] ?>" class="text-decoration-none">
                        <img src="uploads/<?= htmlspecialchars($producto['Foto']) ?>"
                             class="card-img-top img-fluid"
                             alt="<?= htmlspecialchars($producto['Nombre']) ?>">

                        <div class="card-body text-center">
                            <h6 class="product-name mb-1"><?= htmlspecialchars($producto['Nombre']) ?></h6>
                            <p class="product-price mb-0">$<?= number_format($producto['Precio'], 0, ',', '.') ?></p>
                        </div>
                    </a>

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
