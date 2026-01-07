<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito | Latiendadelseis</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/carrito.css">
</head>

<body>

<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>





<div class="cart">

    <h1 class="mb-3">Tu carrito</h1>

    <div class="notice">
        ⚠️ Los productos en el carrito no se apartan.
    </div>

    <?php if (empty($cart)): ?>
        <p class="text-center mt-4">Tu carrito está vacío</p>
    <?php else: ?>

        <?php 
        $subtotal = 0;
        foreach ($cart as $item):
            $subtotal += $item['Subtotal'];
        ?>

        <!-- ITEM -->
        <div class="cart-item row align-items-center gy-3">

            <!-- IMAGEN -->
            <div class="col-4 col-md-2 text-center">
                <img src="uploads/<?= htmlspecialchars($item['Foto'] ?? 'img/default.png') ?>"
                    class="img-fluid cart-img">
            </div>

            <!-- NOMBRE -->
            <div class="col-8 col-md-4">
                <h2 class="item-title"><?= htmlspecialchars($item['Nombre']) ?></h2>
            </div>

            <!-- CANTIDAD -->
            <div class="col-6 col-md-3 d-flex align-items-center justify-content-md-center gap-2">
                <a href="index.php?action=updateCart&id=<?= $item['IdProducto'] ?>&op=minus"
                class="qty-btn">−</a>

                <span class="fw-bold"><?= $item['Cantidad'] ?></span>

                <a href="index.php?action=updateCart&id=<?= $item['IdProducto'] ?>&op=plus"
                class="qty-btn">+</a>
            </div>

            <!-- PRECIO -->
            <div class="col-4 col-md-2 fw-bold text-md-end">
                $<?= number_format($item['Subtotal'], 0, ',', '.') ?>
            </div>

            <!-- ELIMINAR -->
            <div class="col-2 col-md-1 text-end">
                <a href="index.php?action=removeFromCart&id=<?= $item['IdProducto'] ?>"
                class="remove-btn">✕</a>
            </div>

        </div>
        <hr>

        <?php endforeach; ?>
    <?php endif; ?>



    <!-- RESUMEN -->
    <div class="cart-summary mt-4">
        <div>
            <div class="subtotal">Subtotal:</div>
            <div class="total">$<?= number_format($subtotal ?? 0, 0, ',', '.') ?></div>
        </div>
        <button class="checkout">Finalizar compra</button>
    </div>

</div>

<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
