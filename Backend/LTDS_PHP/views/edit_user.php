<h1>Editar Usuario</h1>

<form action="index.php?action=updateUser" method="POST">

    <input type="hidden" name="IdUsuario" value="<?= $usuario['IdUsuario'] ?>">

    <label>Numero de Documento:</label>
    <input type="text" name="NumDoc" value="<?= $usuario['NumDoc'] ?>"><br>

    <label>Tipo de Documento:</label>
    <input type="text" name="TipoDoc" value="<?= $usuario['TipoDoc'] ?>"><br>

    <label>Nombre completo:</label>
    <input type="text" name="NombreCom" value="<?= $usuario['NombreCom'] ?>"><br>

    <label>Correo:</label>
    <input type="email" name="Correo" value="<?= $usuario['Correo'] ?>"><br>

    <label>Password:</label>
    <input type="password" name="Password" value="<?= $usuario['Password'] ?>"><br>

    <label>Tel:</label>
    <input type="text" name="Tel" value="<?= $usuario['Tel'] ?>"><br>

    <label>Direccion:</label>
    <input type="text" name="Direccion" value="<?= $usuario['Direccion'] ?>"><br>

    <label for="Rol">Rol:</label>
<select name="Rol" id="Rol">
    <?php foreach ($roles as $rol): ?>
        <option value="<?= $rol['Rol']; ?>"
            <?= ($rol['Rol'] == $usuario['Rol']) ? 'selected' : '' ?>>
            <?= $rol['NameRol']; ?>
        </option>
    <?php endforeach; ?>
</select><br>


    <input type="submit" value="Actualizar">
</form>

<form action="index.php?action=dashboard" method="post">
        <button type="submit" name="action" value="dashboard">dashboard</button>
    </form>