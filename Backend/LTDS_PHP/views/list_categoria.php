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
  <title>Lista de Categorías</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>Categorías</h3>
      <a href="index.php?action=manageCategorias" class="btn-dashboard inline">Gestionar Categorías</a>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categorias as $cat): ?>
          <tr>
            <td><?= htmlspecialchars($cat['IdCategoria']) ?></td>
            <td><?= htmlspecialchars($cat['NomCategoria']) ?></td>
            <td>
              <a href="index.php?action=editCategoria&id=<?= $cat['IdCategoria'] ?>" class="sub-btn small">Editar</a>
              <a href="index.php?action=deleteCategoria&id=<?= $cat['IdCategoria'] ?>" class="action-danger" onclick="return confirm('Eliminar categoría?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a href="index.php?action=dashboard" class="btn btn-secondary">Volver al dashboard</a>
  </div>
</body>
</html>
