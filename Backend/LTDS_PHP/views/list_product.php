<h1>Lista de Productos</h1>

<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nombre del producto</th>
        <th>Precio</th>
        <th>Material</th>
        <th>Talla / Unidad</th>
        <th>Color</th>
        <th>Stock</th>
        <th>Oferta</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Descripción</th>
        <th>Foto</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p['IdProducto'] ?></td>
        <td><?= $p['Nombre'] ?></td>
        <td><?= $p['Precio'] ?></td>
        <td><?= $p['Material'] ?></td>
        <td><?= $p['Talla_unidadMedida'] ?></td>
        <td><?= $p['Color'] ?></td>
        <td><?= $p['Stock'] ?></td>
        <td><?= $p['Oferta'] ?></td>
        <td><?= $p['Categoria'] ?></td>
        <td><?= $p['Marca'] ?></td>
        <td><?= $p['Descripcion'] ?></td>


        <td>
            <?php if (!empty($p['Foto'])): ?>
                <img src="uploads/<?= $p['Foto'] ?>" width="80">
            <?php else: ?>
                Sin foto
            <?php endif; ?>
        </td>

        <td>
            <a href="index.php?action=editProduct&id=<?= $p['IdProducto'] ?>">Editar</a>
            |
            <a href="index.php?action=deleteProduct&id=<?= $p['IdProducto'] ?>"
                onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>
