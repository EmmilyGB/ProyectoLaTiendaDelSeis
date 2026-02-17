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
                <?php
                    $galeriaFotos = [];
                    if (!empty($fotosProducto)) {
                        foreach ($fotosProducto as $fp) {
                            if (!empty($fp['RutaFoto'])) $galeriaFotos[] = $fp['RutaFoto'];
                        }
                    }
                    if (!empty($producto['Foto']) && !in_array($producto['Foto'], $galeriaFotos, true)) {
                        array_unshift($galeriaFotos, $producto['Foto']);
                    }
                    if (empty($galeriaFotos)) {
                        $galeriaFotos[] = $producto['Foto'] ?? 'default.png';
                    }
                ?>
                <img id="mainProductImage" src="uploads/<?= htmlspecialchars($galeriaFotos[0]) ?>" class="img-fluid w-75 product-main-image">
                <?php if (count($galeriaFotos) > 1): ?>
                    <div class="product-thumbs mt-3 d-flex justify-content-center gap-2 flex-wrap">
                        <?php foreach ($galeriaFotos as $idx => $foto): ?>
                            <button type="button"
                                    class="thumb-btn <?= $idx === 0 ? 'active' : '' ?>"
                                    data-src="uploads/<?= htmlspecialchars($foto) ?>">
                                <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Foto producto">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
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
                    <?php
                        $disponible = false;
                        $idSeleccionado = (int)$producto['IdProducto'];
                        foreach (($variantes ?? []) as $v) {
                            if ((int)$v['Stock'] > 0) {
                                $disponible = true;
                            }
                        }
                    ?>

                    <?php if ($disponible): ?>
                    <form method="get" action="index.php" class="mb-3">
                        <input type="hidden" name="action" value="addToCart">

                        <div class="purchase-panel mt-3">
                            <div class="purchase-grid">
                                <div class="field-block">
                                    <label class="field-label">Talla</label>
                                <select name="id" id="varianteSelect" class="form-select size-select">
                                    <?php foreach (($variantes ?? []) as $v): ?>
                                        <option value="<?= (int)$v['IdProducto'] ?>"
                                                data-idtalla="<?= (int)$v['IdTalla'] ?>"
                                                data-stock="<?= (int)$v['Stock'] ?>"
                                                <?= ((int)$v['IdProducto'] === $idSeleccionado) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($v['NomTalla']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="IdTalla" id="selectedIdTalla" value="<?= (int)$producto['IdTalla'] ?>">
                                </div>

                                <div class="field-block">
                                    <label class="field-label">Color</label>
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
                                } elseif (mb_strtolower(trim((string)$colorName)) === 'negro') {
                                    $circleStyle = "background-color:#111;border:1px solid rgba(0,0,0,0.25);";
                                }
                                ?>
                                    <div class="color-pill d-flex align-items-center gap-2">
                                    <div class="color-dot" style="<?= $circleStyle ?>">
                                        <?php if (!$colorHex): ?>
                                            <span class="visually-hidden">Color</span>
                                        <?php endif; ?>
                                    </div>
                                        <div class="color-name"><?= htmlspecialchars($colorName ?: 'N/A') ?></div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="IdColor" value="<?= htmlspecialchars($producto['IdColor']) ?>">

                            <div class="stock-line mt-2">
                                <span class="stock-label">Stock disponible</span>
                                <span id="stockDisponible" class="stock-chip">0</span>
                            </div>
                        </div>

                        <div class="mt-3 field-block quantity-block">
                            <label for="cantidad" class="field-label">Cantidad</label>
                            <div class="qty-stepper" role="group" aria-label="Cantidad">
                                <button type="button" class="qty-btn-step" id="qtyMinus" aria-label="Disminuir cantidad">-</button>
                                <input type="number" id="cantidad" name="cantidad" class="form-control qty-input" value="1" min="1" max="<?= (int)$producto['Stock'] ?>">
                                <button type="button" class="qty-btn-step" id="qtyPlus" aria-label="Aumentar cantidad">+</button>
                            </div>
                        </div>

                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <a href="index.php?action=guiaTallas" class="size-guide-link">Guía de tallas</a>
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

        <!-- DESCRIPCIóN -->
        <div class="desc-box mt-5">
            <h5 class="fw-bold">Descripción</h5>
            <p><?= htmlspecialchars($producto['Descripcion']) ?></p>
        </div>
        </div>

    </div>









<?php include __DIR__ . '/partials/footer.php'; ?>


    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      (function () {
        const sel = document.getElementById('varianteSelect');
        const qty = document.getElementById('cantidad');
        const qtyMinus = document.getElementById('qtyMinus');
        const qtyPlus = document.getElementById('qtyPlus');
        const hiddenTalla = document.getElementById('selectedIdTalla');
        const stockBadge = document.getElementById('stockDisponible');
        if (!sel || !qty || !hiddenTalla || !stockBadge || !qtyMinus || !qtyPlus) return;

        function syncQtyButtons() {
          const current = parseInt(qty.value || '1', 10);
          const max = parseInt(qty.max || '1', 10);
          qtyMinus.disabled = current <= 1;
          qtyPlus.disabled = current >= max;
        }

        function syncVariant() {
          const opt = sel.options[sel.selectedIndex];
          const stock = parseInt(opt.getAttribute('data-stock') || '0', 10);
          const idTalla = parseInt(opt.getAttribute('data-idtalla') || '0', 10);
          stockBadge.textContent = String(stock);
          stockBadge.classList.toggle('empty', stock <= 0);
          qty.max = stock > 0 ? stock : 1;
          if (stock <= 0) qty.value = 1;
          if (parseInt(qty.value || '1', 10) > stock && stock > 0) qty.value = stock;
          hiddenTalla.value = idTalla;
          syncQtyButtons();
        }
        const selectedStock = parseInt(sel.options[sel.selectedIndex].getAttribute('data-stock') || '0', 10);
        if (selectedStock <= 0) {
          for (let i = 0; i < sel.options.length; i++) {
            const s = parseInt(sel.options[i].getAttribute('data-stock') || '0', 10);
            if (s > 0) {
              sel.selectedIndex = i;
              break;
            }
          }
        }
        sel.addEventListener('change', syncVariant);
        qty.addEventListener('input', syncQtyButtons);
        qtyMinus.addEventListener('click', function () {
          const current = parseInt(qty.value || '1', 10);
          qty.value = Math.max(1, current - 1);
          syncQtyButtons();
        });
        qtyPlus.addEventListener('click', function () {
          const current = parseInt(qty.value || '1', 10);
          const max = parseInt(qty.max || '1', 10);
          qty.value = Math.min(max, current + 1);
          syncQtyButtons();
        });
        syncVariant();
      })();

      (function () {
        const mainImage = document.getElementById('mainProductImage');
        const thumbButtons = document.querySelectorAll('.thumb-btn');
        if (!mainImage || !thumbButtons.length) return;
        thumbButtons.forEach((btn) => {
          btn.addEventListener('click', function () {
            mainImage.src = this.getAttribute('data-src');
            thumbButtons.forEach((b) => b.classList.remove('active'));
            this.classList.add('active');
          });
        });
      })();
    </script>
    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>

