<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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

    <h1 class="dashboard-title">Lista de Usuarios</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Tipo Doc</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['NumDoc'] ?></td>
                    <td><?= htmlspecialchars($u['TipoDoc'] ?? $u['IdTipoDocum']) ?></td>
                    <td><?= htmlspecialchars($u['NombreCom']) ?></td>
                    <td><?= htmlspecialchars($u['Correo']) ?></td>
                    <td><?= htmlspecialchars($u['Tel']) ?></td>
                    <td><?= htmlspecialchars($u['Direccion']) ?></td>
                    <td><?= htmlspecialchars($u['NameRol'] ?? $u['Rol']) ?></td>

                    <td class="text-center">
                        <a href="index.php?action=editUser&id=<?= $u['NumDoc'] ?>" class="action-btn edit-btn">Editar</a>

                        <a href="index.php?action=deleteUser&id=<?= $u['NumDoc'] ?>" class="action-btn delete-btn" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
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
                    <a class="page-link" href="<?= ($pagination['page'] <= 1) ? '#' : pageUrl($pagination['page'] - 1) ?>">«</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                    <li class="page-item <?= ($i === $pagination['page']) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= pageUrl($i) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($pagination['page'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($pagination['page'] >= $pagination['totalPages']) ? '#' : pageUrl($pagination['page'] + 1) ?>">»</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

</div>

</body>
</html>
