<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
  header("Location: index.php?action=login");
  exit;
}

$marcas = $marcas ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestionar Marcas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/tables.css">
</head>
<body class="p-4">
  <div class="container">
    <h3>Gestionar Marcas</h3>

    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
      <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <div class="row mb-3">
      <div class="col-md-6">
        <form action="index.php?action=manageMarcas" method="post" class="d-flex gap-2">
          <input type="text" name="NomMarca" class="form-control" placeholder="Nueva marca" required>
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
        <?php foreach ($marcas as $m): ?>
          <tr>
            <td><?= htmlspecialchars($m['IdMarca']) ?></td>
            <td><?= htmlspecialchars($m['NomMarca']) ?></td>
            <td class="action-cell">
              <a href="index.php?action=deleteMarca&id=<?= $m['IdMarca'] ?>" class="action-danger" onclick="return confirm('Eliminar marca?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>

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
