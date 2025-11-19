<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insertar usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Insertar Usuario</h1>

<form action="index.php?action=insertuser" method="POST">

    <label>NumDoc:</label>
    <input type="text" name="NumDoc" required><br>

    <label>TipoDoc:</label>
    <input type="text" name="TipoDoc" required><br>

    <label>Nombre completo:</label>
    <input type="text" name="NombreCom" required><br>

    <label>Correo:</label>
    <input type="email" name="Correo" required><br>

    <label>Password:</label>
    <input type="password" name="Password" required><br>

    <label>Tel:</label>
    <input type="text" name="Tel" required><br>

    <label>Direccion:</label>
    <input type="text" name="Direccion" required><br>

    <label>Rol:</label>
    <input type="text" name="Rol" required><br>

    <input type="submit" value="Guardar">
</form>

<form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>

</body>
</html>