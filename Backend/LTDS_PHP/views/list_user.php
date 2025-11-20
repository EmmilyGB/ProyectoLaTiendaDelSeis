<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Lista de Usuarios</h1>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
                    <td><?= $u['TipoDoc'] ?></td>
                    <td><?= $u['NombreCom'] ?></td>
                    <td><?= $u['Correo'] ?></td>
                    <td><?= $u['Tel'] ?></td>
                    <td><?= $u['Direccion'] ?></td>
                    <td><?= $u['Rol'] ?></td>

                    <td>
                        <a href="index.php?action=editUser&id=<?= $u['NumDoc'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="index.php?action=deleteUser&id=<?= $u['NumDoc'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?action=dashboard" class="btn btn-secondary mt-3">Volver</a>

</div>

</body>
</html>
