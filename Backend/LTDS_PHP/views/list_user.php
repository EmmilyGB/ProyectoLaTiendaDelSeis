<h1>Lista de Usuarios</h1>

<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Numero de Documento</th>
        <th>Tipo de Documento</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Conraseña</th>
        <th>Tel</th>
        <th>Direccion</th>
        <th>Rol</th>

        <th>Acciones</th>
    </tr>

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

        <td>
            <a href="index.php?action=editUser&id=<?= $u['IdUsuario'] ?>">Editar</a> |
            <a href="index.php?action=deleteUser&id=<?= $u['IdUsuario'] ?>"
                onclick="return confirm('¿Seguro?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>
