<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
</head>

<body>

<div class="wrapper-box">

    <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard">
            <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
    </form>

    <h1 class="dashboard-title">Buscar usuario por nombre</h1>

    <form action="index.php" method="get" style="margin-bottom:0;">
        <input type="hidden" name="action" value="UsersByName">

        <label for="NombreCom">Nombre:</label><br>
        <input type="text" id="NombreCom" name="NombreCom" required>

        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <button type="submit" class="btn-small btn-red">
                <i class="bi bi-search"></i> Buscar
            </button>

            <a href="index.php?action=UsersByName" class="btn-small btn-gray" role="button" style="text-decoration:none;">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

    </form>

    <?php if (isset($usuarios) && count($usuarios) > 0): ?>

        <h1 class="dashboard-title">Lista de Usuarios</h1>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>N° Documento</th>
                        <th>Tipo Documento</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Tel</th>
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
                        <a href="index.php?action=editUser&id=<?= $u['NumDoc'] ?>&from=UsersByName&NombreCom=<?= urlencode($_GET['NombreCom'] ?? '') ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="index.php?action=deleteUser&id=<?= $u['NumDoc'] ?>&from=UsersByName&NombreCom=<?= urlencode($_GET['NombreCom'] ?? '') ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
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

    <?php elseif (isset($usuarios)): ?>
        <p>No se encontraron usuarios con ese nombre.</p>
    <?php endif; ?>

</div>

</body>
</html>
