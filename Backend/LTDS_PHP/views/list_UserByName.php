<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Usuario</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     <link rel="stylesheet" href="css/list_UserByName.css">
</head>

<body>

<div class="wrapper-box">

    <!-- Botón volver al Dashboard -->
    <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard">
            <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
    </form>

    <h1 class="dashboard-title">Buscar usuario por nombre</h1>
    
    <!-- FORMULARIO DE BÚSQUEDA -->
    <form action="index.php" method="get" style="margin-bottom:0;">
        <input type="hidden" name="action" value="UsersByName">

        <label for="NombreCom">Nombre:</label><br>
        <input type="text" id="NombreCom" name="NombreCom" required>

        <!-- Botones lado a lado -->
        <div style="display: flex; gap: 10px; margin-top: 15px;">

            <!-- Botón BUSCAR -->
            <button type="submit" class="btn-small btn-red">
                <i class="bi bi-search"></i> Buscar
            </button>

            <!-- Botón VOLVER (NO valida el form) -->
            <a href="index.php?action=UsersByName" 
               class="btn-small btn-gray" 
               role="button" 
               style="text-decoration:none;">
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
                        <th>ID</th>
                        <th>N° Documento</th>
                        <th>Tipo Documento</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th>Tel</th>
                        <th>Dirección</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['IdUsuario'] ?></td>
                        <td><?= $u['NumDoc'] ?></td>
                        <td><?= $u['TipoDoc'] ?></td>
                        <td><?= $u['NombreCom'] ?></td>
                        <td><?= $u['Correo'] ?></td>
                        <td><?= $u['Password'] ?></td>
                        <td><?= $u['Tel'] ?></td>
                        <td><?= $u['Direccion'] ?></td>
                        <td><?= $u['Rol'] ?></td>

                        <td class="text-center">

                            <a href="index.php?action=editUser&id=<?= $u['IdUsuario'] ?>"
                               class="action-btn edit-btn">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>

                            <a href="index.php?action=deleteUser&id=<?= $u['IdUsuario'] ?>"
                               onclick="return confirm('¿Seguro que deseas eliminar este usuario?')"
                               class="action-btn delete-btn">
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </a>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php elseif (isset($usuarios)): ?>
        <p>No se encontraron usuarios con ese nombre.</p>
    <?php endif; ?>

</div>

</body>
</html>

