<h1>Lista de Usuarios</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>NumDoc</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Tel</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['IdUsuario'] ?></td>
        <td><?= $u['NumDoc'] ?></td>
        <td><?= $u['NombreCom'] ?></td>
        <td><?= $u['Correo'] ?></td>
        <td><?= $u['Tel'] ?></td>

        <td>
            <a href="index.php?action=editUser&id=<?= $u['IdUsuario'] ?>">Editar</a> |
            <a href="index.php?action=deleteUser&id=<?= $u['IdUsuario'] ?>"
                onclick="return confirm('¿Seguro?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
