<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
</head>
<body>
<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container py-4">
    <?php
    if (!function_exists('estadoBadgeClassCliente')) {
        function estadoBadgeClassCliente($estado) {
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
    ?>
    <h2 class="mb-3 text-white">Mis pedidos</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="table-responsive bg-white rounded shadow-sm p-2">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th># Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pedidos)): ?>
                    <tr><td colspan="5" class="text-center">Aún no tienes pedidos.</td></tr>
                <?php else: ?>
                    <?php foreach ($pedidos as $p): ?>
                        <tr>
                            <td><?= (int)$p['IdFactura'] ?></td>
                            <td><?= htmlspecialchars($p['FechaFactura']) ?></td>
                            <td>$<?= number_format($p['Total'], 0, ',', '.') ?></td>
                            <?php $estadoPedido = $p['Estado'] ?? 'Pendiente'; ?>
                            <td><span class="badge <?= estadoBadgeClassCliente($estadoPedido) ?>"><?= htmlspecialchars($estadoPedido) ?></span></td>
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="index.php?action=verMiPedido&id=<?= (int)$p['IdFactura'] ?>">Ver</a>
                                <a class="btn btn-sm btn-outline-dark" href="index.php?action=verMiPedidoPdf&id=<?= (int)$p['IdFactura'] ?>" target="_blank" rel="noopener">Factura PDF</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($pagination) && $pagination['totalPages'] > 1): ?>
        <?php
        if (!function_exists('pageUrlMisPedidos')) {
            function pageUrlMisPedidos($page) {
                $params = $_GET;
                $params['page'] = $page;
                return 'index.php?' . http_build_query($params);
            }
        }
        ?>
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($pagination['page'] <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($pagination['page'] <= 1) ? '#' : pageUrlMisPedidos($pagination['page'] - 1) ?>">«</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                    <li class="page-item <?= ($i === $pagination['page']) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= pageUrlMisPedidos($i) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($pagination['page'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($pagination['page'] >= $pagination['totalPages']) ? '#' : pageUrlMisPedidos($pagination['page'] + 1) ?>">»</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
