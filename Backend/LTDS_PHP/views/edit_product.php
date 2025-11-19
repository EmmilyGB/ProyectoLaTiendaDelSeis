<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
<h1>Editar Producto</h1>

<form action="index.php?action=updateProduct" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="IdProducto" value="<?= $producto['IdProducto'] ?>">
    <input type="hidden" name="Foto_actual" value="<?= $producto['Foto'] ?>">

    <label>Nombre:</label>
    <input type="text" name="Nombre" value="<?= $producto['Nombre'] ?>"><br>

    <label>Precio:</label>
    <input type="number" name="Precio" value="<?= $producto['Precio'] ?>"><br>

    <label>Material:</label>
    <input type="text" name="Material" value="<?= $producto['Material'] ?>"><br>

    <label>Talla/Unidad Medida:</label>
    <input type="text" name="Talla_unidadMedida" value="<?= $producto['Talla_unidadMedida'] ?>"><br>

    <label>Color:</label>
    <input type="text" name="Color" value="<?= $producto['Color'] ?>"><br>

    <label>Stock:</label>
    <input type="number" name="Stock" value="<?= $producto['Stock'] ?>"><br>

    <label>Oferta:</label>
    <input type="text" name="Oferta" value="<?= $producto['Oferta'] ?>"><br>

    <label>Categoria:</label>
    <input type="text" name="Categoria" value="<?= $producto['Categoria'] ?>"><br>

    <label>Marca:</label>
    <input type="text" name="Marca" value="<?= $producto['Marca'] ?>"><br>

    <label>Descripcion:</label>
    <input type="text" name="Descripcion" value="<?= $producto['Descripcion'] ?>"><br>

    <p>Foto actual:</p>
    <?php if ($producto['Foto']): ?>
        <img src="uploads/<?= $producto['Foto'] ?>" width="120">
    <?php else: ?>
        <p>No tiene foto</p>
    <?php endif; ?>
    <br>

    <label>Subir nueva foto:</label>
    <input type="file" name="Foto"><br>

    <input type="submit" value="Actualizar">

    <form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>
</form>

</body>
</html>