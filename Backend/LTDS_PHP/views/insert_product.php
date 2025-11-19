<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Producto</title>
</head>
<body>

    <h1>Insertar Producto</h1>

<form action="index.php?action=insertProdu" method="POST" enctype="multipart/form-data">

    <label>Nombre:</label>
    <input type="text" name="Nombre" required><br>

    <label>Precio:</label>
    <input type="number" name="Precio" required><br>

    <label>Material:</label>
    <input type="text" name="Material" required><br>

    <label>Talla/Unidad Medida:</label>
    <input type="text" name="Talla_unidadMedida" required><br>

    <label>Color:</label>
    <input type="text" name="Color" required><br>

    <label>Stock:</label>
    <input type="number" name="Stock" required><br>

    <label>Oferta:</label>
    <input type="text" name="Oferta" required><br>

    <label>Categoria:</label>
    <input type="text" name="Categoria" required><br>

    <label>Marca:</label>
    <input type="text" name="Marca" required><br>

    <label>Descripcion:</label>
    <input type="text" name="Descripcion" required><br>

    <label>Foto:</label>
    <input type="file" name="Foto"><br>

    <input type="submit" value="Guardar">
</form>

<form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>


</body>
</html>