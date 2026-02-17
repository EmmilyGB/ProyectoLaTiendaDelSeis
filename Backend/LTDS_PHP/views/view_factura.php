<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ver Factura <?= $factura['IdFactura'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
</head>
<body>
<div class="wrapper-box">
    <?php
    if (!function_exists('estadoBadgeClassDetalle')) {
        function estadoBadgeClassDetalle($estado) {
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
    $estadoFactura = $factura['Estado'] ?? 'Pendiente';
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h3>Factura #<?= $factura['IdFactura'] ?></h3>
        <div><?= $factura['FechaFactura'] ?></div>
    </div>

    <p><strong>Cliente:</strong> <?= htmlspecialchars($factura['NombreCom'] ?? '') ?> <br>
        <strong>Documento:</strong> <?= htmlspecialchars($factura['NumDoc']) ?><br>
        <strong>Estado pedido:</strong>
        <span class="badge <?= estadoBadgeClassDetalle($estadoFactura) ?>"><?= htmlspecialchars($estadoFactura) ?></span>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered">
        <thead><tr><th>Producto</th><th>Talla</th><th>Color</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr></thead>
        <tbody>
            <?php foreach ($detalles as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['Nombre'] ?? 'Sin nombre') ?></td>
                <td><?= htmlspecialchars($d['Talla'] ?? '-') ?></td>
                <td><?= htmlspecialchars($d['Color'] ?? '-') ?></td>
                <td>$<?= number_format($d['PrecioUnitario'],0,',','.') ?></td>
                <td><?= $d['Cantidad'] ?></td>
                <td>$<?= number_format($d['Subtotal'],0,',','.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
            <td colspan="5" class="text-end"><strong>Total</strong></td>
            <td><strong>$<?= number_format($factura['Total'],0,',','.') ?></strong></td>
            </tr>
        </tfoot>
        </table>
    </div>

    <a href="index.php?action=listFactura" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
