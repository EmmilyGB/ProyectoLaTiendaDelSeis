<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura inhabilitada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
</head>
<body>
<div class="wrapper-box">
    <div class="alert alert-warning" role="alert">
        Inhabilitado
    </div>

    <?php if (!empty($factura['IdFactura'])): ?>
        <p><strong>Factura #<?= $factura['IdFactura'] ?></strong></p>
    <?php endif; ?>

    <a href="index.php?action=listFactura" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
