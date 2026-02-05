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

    <!-- BotÃ³n volver al Dashboard -->
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
                <tr class="<?= !empty($f['Inhabilitado']) ? 'table-warning' : '' ?>">
                    <td><?= $f['IdFactura'] ?></td>
                    <td><?= $f['FechaFactura'] ?></td>
                    <td><?= htmlspecialchars($f['NombreCom'] ?? 'Sin nombre') ?></td>
                    <td>$<?= number_format($f['Total'], 0, ',', '.') ?></td>

                    
                    <td>

                        <!-- Ver factura -->
                        <a href="index.php?action=viewFactura&id=<?= $f['IdFactura'] ?>" class="btn btn-sm btn-info">
                            Detalle de factura
                        </a>

                        <!-- Ver PDF -->
                        <a href="index.php?action=viewFacturaPdf&id=<?= $f['IdFactura'] ?>" class="btn btn-sm btn-secondary" target="_blank" rel="noopener">
                            Ver PDF
                        </a>

                        <!-- Inhabilitar factura (o eliminar si no tiene productos) -->
                        <?php if (!empty($f['Inhabilitado'])): ?>
                            <button type="button" class="btn btn-sm btn-warning" disabled>Inhabilitada</button>
                        <?php else: ?>
                            <a href="index.php?action=inhabilitarFactura&id=<?= $f['IdFactura'] ?>"
                            class="btn btn-sm btn-warning"
                            onclick="return confirm('¿Seguro que deseas inhabilitar esta factura? Si no tiene productos, se eliminará.');">
                                Inhabilitar
                            </a>
                        <?php endif; ?>
</td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($pagination) && $pagination['totalPages'] > 1): ?>
        <?php
        if (!function_exists('pageUrl')) {
            function pageUrl($page) {
                $params = $_GET;
                $params['page'] = $page;
                return 'index.php?' . http_build_query($params);
            }
        }
        ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($pagination['page'] <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($pagination['page'] <= 1) ? '#' : pageUrl($pagination['page'] - 1) ?>">Â«</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                    <li class="page-item <?= ($i === $pagination['page']) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= pageUrl($i) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($pagination['page'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($pagination['page'] >= $pagination['totalPages']) ? '#' : pageUrl($pagination['page'] + 1) ?>">Â»</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

</div>
<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
