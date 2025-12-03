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
    <div class="d-flex justify-content-between align-items-center">
        <h3>Factura #<?= $factura['IdFactura'] ?></h3>
        <div><?= $factura['FechaFactura'] ?></div>
    </div>

    <p><strong>Cliente:</strong> <?= htmlspecialchars($factura['NombreCom'] ?? '') ?> <br>
        <strong>Documento:</strong> <?= htmlspecialchars($factura['NumDoc']) ?></p>

    <div class="table-responsive">
        <table class="table table-bordered">
        <thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr></thead>
        <tbody>
            <?php foreach ($detalles as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['Nombre'] ?? 'Sin nombre') ?></td>
                <td>$<?= number_format($d['PrecioUnitario'],0,',','.') ?></td>
                <td><?= $d['Cantidad'] ?></td>
                <td>$<?= number_format($d['Subtotal'],0,',','.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
            <td colspan="3" class="text-end"><strong>Total</strong></td>
            <td><strong>$<?= number_format($factura['Total'],0,',','.') ?></strong></td>
            </tr>
        </tfoot>
        </table>
    </div>

    <a href="index.php?action=listFactura" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
