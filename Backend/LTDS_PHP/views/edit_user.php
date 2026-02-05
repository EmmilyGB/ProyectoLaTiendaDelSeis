<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuario</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="css/Form.css">
</head>

<body>

  <div class="center-wrapper">
    <div class="wrapper-box">

      <h1 class="dashboard-title mb-4">Editar Usuario</h1>

      <form action="index.php?action=updateUser" method="POST" class="form-column">

        <!-- NUMERO ORIGINAL DEL DOCUMENTO (clave primaria) -->
        <input type="hidden" name="NumDocOriginal" value="<?= $usuario['NumDoc'] ?>">

        <label class="form-label">Número de Documento</label>
        <input type="text" name="NumDoc" value="<?= $usuario['NumDoc'] ?>" class="form-control mb-2" required>

        <label class="form-label">Tipo de Documento</label>
        <select name="IdTipoDocum" class="form-select mb-2">
          <?php foreach ($docums as $docum): ?>
            <option value="<?= $docum['IdTipoDocum']; ?>"
              <?= ($usuario['IdTipoDocum'] == $docum['IdTipoDocum']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($docum['TipoDoc']); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <label class="form-label">Nombre Completo</label>
        <input type="text" name="NombreCom" value="<?= $usuario['NombreCom'] ?>" class="form-control mb-2" required>

        <label class="form-label">Correo</label>
        <input type="email" name="Correo" value="<?= $usuario['Correo'] ?>" class="form-control mb-2" required>

        <label class="form-label">Password</label>
        <input type="password" name="Password" class="form-control mb-2" placeholder="Dejar en blanco para mantener">

        <label class="form-label">Teléfono</label>
        <input type="text" name="Tel" value="<?= $usuario['Tel'] ?>" class="form-control mb-2" required>

        <label class="form-label">Dirección</label>
        <input type="text" name="Direccion" value="<?= $usuario['Direccion'] ?>" class="form-control mb-2" required>

        <label class="form-label">Rol</label>
        <select name="Rol" class="form-select mb-3">
          <?php foreach ($roles as $rol): ?>
            <option value="<?= $rol['Rol']; ?>"
              <?= ($rol['Rol'] == $usuario['Rol']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($rol['NameRol']); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <!-- Botón actualizar -->
        <button type="submit" class="btn-dashboard w-100 mb-3">
          <i class="bi bi-pencil-square"></i> Actualizar Usuario
        </button>
      </form>

      <!-- Botón volver -->
      <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard w-100">
          <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
      </form>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
