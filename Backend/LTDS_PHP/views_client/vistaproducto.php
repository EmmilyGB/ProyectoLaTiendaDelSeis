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
                    <?php $disponible = (int)($producto['Stock'] ?? 0) > 0; ?>

                    <?php if ($disponible): ?>
                    <div class="mt-3 mb-2 fw-semibold">Talla</div>

                    <form method="get" action="index.php" class="mb-3">
                        <input type="hidden" name="action" value="addToCart">
                        <input type="hidden" name="id" value="<?= $producto['IdProducto'] ?>">

                        <div class="row g-2 align-items-center">
                            <div class="col-6">
                                <select name="IdTalla" class="form-select">
                                    <?php foreach ($tallas as $t): ?>
                                        <option value="<?= $t['IdTalla'] ?>" <?= ($t['IdTalla'] == $producto['IdTalla'])? 'selected':'' ?>><?= htmlspecialchars($t['NomTalla']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-6">
                                <?php
                                // Mostrar color asignado al producto como burbuja y texto (no editable)
                                $colorName = '';
                                $colorHex = null;
                                foreach ($colores as $col) {
                                    if ($col['IdColor'] == $producto['IdColor']) {
                                        $colorName = $col['NomColor'];
                                        // intentar campos comunes para color hex en la tabla
                                        if (!empty($col['Hex'])) $colorHex = $col['Hex'];
                                        if (empty($colorHex) && !empty($col['Codigo'])) $colorHex = $col['Codigo'];
                                        if (empty($colorHex) && !empty($col['Hexa'])) $colorHex = $col['Hexa'];
                                        break;
                                    }
                                }
                                // Si el valor no es un código hex válido, lo dejamos para mostrar solo nombre
                                $circleStyle = '';
                                if ($colorHex) {
                                    $circleStyle = "background-color: " . htmlspecialchars($colorHex) . ";border:1px solid rgba(0,0,0,0.08);";
                                }
                                ?>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="color-bubble" style="width:28px;height:28px;border-radius:50%;<?= $circleStyle ?>;display:inline-block;flex:0 0 28px;">
                                        <?php if (!$colorHex): ?>
                                            <span class="visually-hidden">Color</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-control-plaintext"><?= htmlspecialchars($colorName ?: 'N/A') ?></div>
                                </div>
                                <input type="hidden" name="IdColor" value="<?= htmlspecialchars($producto['IdColor']) ?>">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" value="1" min="1" max="<?= $producto['Stock'] ?>">
                        </div>

                        <div class="mt-2">
                            <a href="index.php?action=guiaTallas" class="text-decoration-none fw-semibold" style="color:#b30000;">Guía de tallas</a>
                        </div>

                        <div class="row mt-4 align-items-center">
                            <div class="col-8">
                                <button type="submit" class="btn-cart">Agregar al carrito</button>
                            </div>
                            <div class="col-4 text-end">
                                <?php if (isset($isFavorito) && $isFavorito): ?>
                                    <a href="index.php?action=removeFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-filled" aria-label="Quitar favorito"><i class="bi bi-heart-fill"></i></a>
                                <?php else: ?>
                                    <a href="index.php?action=addFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-empty" aria-label="Agregar favorito"><i class="bi bi-heart"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </form>
                    <?php else: ?>
                        <div class="alert alert-danger mt-3 mb-2">
                            Producto no disponible
                        </div>
                        <?php
                        $msg = 'El producto ' . ($producto['Nombre'] ?? '') . ' no esta disponible, mas informacion por favor';
                        $whatsappLink = 'https://wa.me/573187916563?text=' . urlencode($msg);
                        ?>
                        <div class="mt-2">
                            <a href="<?= htmlspecialchars($whatsappLink) ?>" class="text-decoration-none fw-semibold" style="color:#b30000;" target="_blank" rel="noopener">Saber más</a>
                        </div>
                        <div class="row mt-4 align-items-center">
                            <div class="col-12 text-end">
                                <?php if (isset($isFavorito) && $isFavorito): ?>
                                    <a href="index.php?action=removeFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-filled" aria-label="Quitar favorito"><i class="bi bi-heart-fill"></i></a>
                                <?php else: ?>
                                    <a href="index.php?action=addFavorite&id=<?= $producto['IdProducto'] ?>" class="favorite-toggle favorite-empty" aria-label="Agregar favorito"><i class="bi bi-heart"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- DESCRIPCIÃ“N -->
        <div class="desc-box mt-5">
            <h5 class="fw-bold">DescripciÃ³n</h5>
            <p><?= htmlspecialchars($producto['Descripcion']) ?></p>
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

