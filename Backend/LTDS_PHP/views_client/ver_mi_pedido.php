<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Pedido #<?= (int)$factura['IdFactura'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
</head>
<body>
<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container py-4">
    <?php
    if (!function_exists('estadoBadgeClassClienteDetalle')) {
        function estadoBadgeClassClienteDetalle($estado) {
            $map = [
                'Pendiente' => 'text-bg-warning',
                'En proceso' => 'text-bg-info',
                'Enviado' => 'text-bg-primary',
                'Finalizado' => 'text-bg-success',
                'Cancelado' => 'text-bg-danger',
                'Devuelto' => 'text-bg-secondary',
            ];
            return $map[$estado] ?? 'text-bg-dark';
        }
    }
    $estadoPedido = $factura['Estado'] ?? 'Pendiente';
    ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0 text-white">Pedido #<?= (int)$factura['IdFactura'] ?></h3>
        <span class="badge <?= estadoBadgeClassClienteDetalle($estadoPedido) ?>"><?= htmlspecialchars($estadoPedido) ?></span>
    </div>

    <p class="text-white"><strong>Fecha:</strong> <?= htmlspecialchars($factura['FechaFactura']) ?><br>
    <strong>Total:</strong> $<?= number_format($factura['Total'], 0, ',', '.') ?></p>

    <div class="table-responsive bg-white rounded shadow-sm p-2">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['Nombre'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($d['Talla'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($d['Color'] ?? '-') ?></td>
                        <td>$<?= number_format($d['PrecioUnitario'], 0, ',', '.') ?></td>
                        <td><?= (int)$d['Cantidad'] ?></td>
                        <td>$<?= number_format($d['Subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex gap-2">
        <a href="index.php?action=misPedidos" class="btn btn-outline-secondary">Volver</a>
        <a href="index.php?action=verMiPedidoPdf&id=<?= (int)$factura['IdFactura'] ?>" target="_blank" rel="noopener" class="btn btn-dark">Ver factura PDF</a>
    </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
