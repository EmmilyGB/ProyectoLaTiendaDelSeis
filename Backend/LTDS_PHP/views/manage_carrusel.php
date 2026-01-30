<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
  header("Location: index.php?action=login");
  exit;
}

$productos = $productos ?? [];
$selected = $selected ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión Carrusel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/tables.css">
</head>
<body class="p-4">
  <div class="container">
    <h3>Seleccionar productos para el carrusel</h3>

    <?php if (!empty($_SESSION['success'])): ?>
      <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form class="row g-2 mb-3" method="get" action="index.php">
      <input type="hidden" name="action" value="manageCarrusel">
      <div class="col-auto">
        <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" class="form-control" placeholder="Buscar por nombre en carrusel">
      </div>
      <div class="col-auto">
        <button class="action-primary" type="submit">Buscar</button>
      </div>
      <div class="col-auto">
        <a href="index.php?action=manageCarrusel" class="btn btn-outline-secondary">Limpiar</a>
      </div>
    </form>

    <form action="index.php?action=saveCarrusel" method="post">
      <div class="row g-3">
        <?php foreach ($productos as $p): ?>
          <div class="col-6 col-md-3">
            <div class="card h-100">
              <img src="uploads/<?= htmlspecialchars($p['Foto'] ?? '') ?>" class="card-img-top carousel-thumb img-fluid" alt="<?= htmlspecialchars($p['Nombre'] ?? '') ?>">
              <div class="card-body text-center">
                <h6 class="mb-2"><?= htmlspecialchars($p['Nombre']) ?></h6>
                <div>
                  <input type="checkbox" id="p<?= $p['IdProducto'] ?>" name="productos[]" value="<?= $p['IdProducto'] ?>" <?= in_array($p['IdProducto'],$selected) ? 'checked':'' ?> >
                  <label for="p<?= $p['IdProducto'] ?>"> Incluir</label>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="mt-4">
        <button class="action-primary">Guardar selección</button>
        <a href="index.php?action=dashboard" class="btn btn-secondary">Volver</a>
      </div>
    </form>

  </div>
</body>
</html>
