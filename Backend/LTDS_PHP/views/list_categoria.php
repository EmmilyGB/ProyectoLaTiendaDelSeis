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

    <?php if (!empty($pagination) && $pagination['totalPages'] > 1): ?>
      <?php
      if (!function_exists('pageUrl')) {
        function pageUrl($page) {
          $params = $_GET;
          $params['page'] = $page;
          return 'index.php?' . http_build_query($params);
        }
      }
      ?>
      <nav class="mt-4">
        <ul class="pagination justify-content-center">
          <li class="page-item <?= ($pagination['page'] <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($pagination['page'] <= 1) ? '#' : pageUrl($pagination['page'] - 1) ?>">«</a>
          </li>
          <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
            <li class="page-item <?= ($i === $pagination['page']) ? 'active' : '' ?>">
              <a class="page-link" href="<?= pageUrl($i) ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
          <li class="page-item <?= ($pagination['page'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($pagination['page'] >= $pagination['totalPages']) ? '#' : pageUrl($pagination['page'] + 1) ?>">»</a>
          </li>
        </ul>
      </nav>
    <?php endif; ?>

    <a href="index.php?action=dashboard" class="btn btn-secondary">Volver al dashboard</a>
  </div>
</body>
</html>
