<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
  header("Location: index.php?action=login");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Insertar Categoría</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h3>Agregar nueva categoría</h3>
    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="index.php?action=insertCategoria" method="post" class="mt-3">
      <div class="mb-3">
        <label class="form-label">Nombre categoría</label>
        <input type="text" name="NomCategoria" class="form-control" required>
      </div>
      <button class="action-primary" type="submit">Guardar</button>
      <a href="index.php?action=listCategoriaAdmin" class="action-danger">Volver</a>
    </form>
  </div>
</body>
</html>
