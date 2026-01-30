<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
  header("Location: index.php?action=login");
  exit;
}

if (empty($categoria)) {
    header('Location: index.php?action=listCategoriaAdmin');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Categoría</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h3>Editar categoría</h3>
    <form action="index.php?action=updateCategoria" method="post" class="mt-3">
      <input type="hidden" name="IdCategoria" value="<?= htmlspecialchars($categoria['IdCategoria']) ?>">
      <div class="mb-3">
        <label class="form-label">Nombre categoría</label>
        <input type="text" name="NomCategoria" class="form-control" value="<?= htmlspecialchars($categoria['NomCategoria']) ?>" required>
      </div>
      <button class="action-primary" type="submit">Actualizar</button>
      <a href="index.php?action=listCategoriaAdmin" class="action-danger">Volver</a>
    </form>
  </div>
</body>
</html>
