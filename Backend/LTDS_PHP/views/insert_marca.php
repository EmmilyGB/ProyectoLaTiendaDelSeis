<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar Marca</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/Form.css">
</head>
<body>
<div class="center-wrapper">
  <div class="wrapper-box">
    <h1 class="dashboard-title mb-4">Agregar Marca</h1>

    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="index.php?action=insertMarca" method="POST" class="form-column">
      <label class="form-label">Nombre de la Marca</label>
      <input type="text" name="NomMarca" class="form-control mb-3" required>

      <button type="submit" class="btn-dashboard w-100">Guardar Marca</button>
    </form>

    <form action="index.php?action=insertProdu" method="get" class="mt-3">
      <button type="submit" class="btn-dashboard w-100">Volver a Producto</button>
    </form>
  </div>
</div>
</body>
</html>