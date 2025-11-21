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

</div>

</body>
</html>