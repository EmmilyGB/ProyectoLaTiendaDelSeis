<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Listar Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
</head>
<body>
<div class="wrapper-box">

    <!-- Botón volver al Dashboard -->
    <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard">
            <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
    </form>    

    <h2>Facturas</h2>
    <a href="index.php?action=insertFactura" class="btn btn-primary mb-3">Crear nueva factura</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facturas as $f): ?>
                <tr>
                    <td><?= $f['IdFactura'] ?></td>
                    <td><?= $f['FechaFactura'] ?></td>
                    <td><?= htmlspecialchars($f['NombreCom'] ?? 'Sin nombre') ?></td>
                    <td>$<?= number_format($f['Total'], 0, ',', '.') ?></td>

                    
                    <td>

                        <!-- Ver factura -->
                        <a href="index.php?action=viewFactura&id=<?= $f['IdFactura'] ?>" class="btn btn-sm btn-info">
                            Detalle de factura
                        </a>

                        <!-- Eliminar factura -->
                        <a href="index.php?action=deleteFactura&id=<?= $f['IdFactura'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Seguro que quieres eliminar esta factura? Esta acción NO se puede deshacer.');">
                            Eliminar
                        </a>
</td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
