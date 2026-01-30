<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
  header("Location: index.php?action=login");
  exit;
}

$categorias = $categorias ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestionar Categorías</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/tables.css">
</head>
<body class="p-4">
  <div class="container">
    <h3>Gestionar Categorías</h3>

    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
      <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <div class="row mb-3">
      <div class="col-md-6">
        <form action="index.php?action=manageCategorias" method="post" class="d-flex gap-2">
          <input type="text" name="NomCategoria" class="form-control" placeholder="Nueva categoría (ej. Hombre)" required>
          <button class="action-primary" type="submit">Agregar</button>
        </form>
      </div>
    </div>

    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <?php foreach ($categorias as $cat): ?>
          <tr>
            <td><?= htmlspecialchars($cat['IdCategoria']) ?></td>
            <td><?= htmlspecialchars($cat['NomCategoria']) ?></td>
            <td class="action-cell">
              <a href="index.php?action=editCategoria&id=<?= $cat['IdCategoria'] ?>" class="sub-btn small">Editar</a>
              <a href="index.php?action=deleteCategoria&id=<?= $cat['IdCategoria'] ?>" class="action-danger" onclick="return confirm('Eliminar categoría?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>

    <a href="index.php?action=dashboard" class="btn btn-secondary">Volver al dashboard</a>
  </div>
</body>
</html>
