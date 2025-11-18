<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insertar usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- <?php var_dump($docums); ?> -->
    <h1>insertar usuario</h1>
    <form action="index.php?action=insertuser" method="POST" enctype="multipart/form-data">
        <label for="NumDoc">Numero de documento:</label>
        <input type="text" name="NumDoc" id="NumDoc" required><br>

        <!-- <label for="tipo_documento">Tipo de documento:</label>
        <input type="text" name="tipo_documento" id="tipo_documento" required><br> -->

        <label for="TipoDoc">Tipo de documento:</label>
        <select name="TipoDoc" id="">
            <?php foreach ($docums as $docum): ?>
                <option value="<?= $docum['IdTipoDocum']; ?>"><?= $docum['TipoDoc']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

        <label for="NombreCom">Nombre:</label>
        <input type="text" name="NombreCom" id="NombreCom" required><br>

        <label for="Correo">Email:</label>
        <input type="email" name="Correo" id="Correo" required><br>

        <label for="Password">Password:</label>
        <input type="password" name="Password" id="Password" required><br>

        <label for="Tel">Telefono:</label>
        <input type="text" name="Tel" id="Tel" required><br>

        <label for="Direccion">Direccion:</label>
        <input type="text" name="Direccion" id="Direccion" required><br>

        <label for="Rol">Rol:</label>
        <input type="text" name="Rol" id="Rol" required><br>


        <input type="submit" value="guardar">
    </form>
    
    <form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>

</body>
</html>