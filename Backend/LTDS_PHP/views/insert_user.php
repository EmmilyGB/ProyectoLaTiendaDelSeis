<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Insertar Usuario</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
  <link rel="stylesheet" href="css/Form.css">
</head>

<body>

  <div class="center-wrapper">
    <div class="wrapper-box">

      <h1 class="dashboard-title mb-4">Insertar Usuario</h1>

      <form action="index.php?action=insertuser" method="POST" class="form-column">

        <label class="form-label">Número de Documento</label>
        <input type="text" name="NumDoc" class="form-control mb-2" required>

        <label class="form-label">Tipo de Documento</label>
        <select name="IdTipoDocum" class="form-select mb-2">
          <?php foreach ($docums as $docum): ?>
            <option value="<?= $docum['IdTipoDocum']; ?>">
              <?= $docum['TipoDoc']; ?>
            </option>
          <?php endforeach; ?>
        </select>

        <label class="form-label">Nombre completo</label>
        <input type="text" name="NombreCom" class="form-control mb-2" required>

        <label class="form-label">Correo</label>
        <input type="email" name="Correo" class="form-control mb-2" required>

        <label class="form-label">Password</label>
        <input type="password" name="Password" class="form-control mb-2" required>

        <label class="form-label">Teléfono</label>
        <input type="text" name="Tel" class="form-control mb-2" required>

        <label class="form-label">Dirección</label>
        <input type="text" name="Direccion" class="form-control mb-2" required>

        <label class="form-label">Rol</label>
        <select name="Rol" class="form-select mb-3">
          <?php foreach ($roles as $rol): ?>
            <option value="<?= $rol['Rol']; ?>">
              <?= $rol['NameRol']; ?>
            </option>
          <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-dashboard w-100 mb-3">
          <i class="bi bi-save-fill"></i> Guardar Usuario
        </button>

      </form>

      <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard w-100">
          <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
      </form>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
