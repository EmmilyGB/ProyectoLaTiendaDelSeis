<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Producto</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/Form.css">
</head>

<body>

<div class="center-wrapper">
  <div class="wrapper-box">

    <h1 class="dashboard-title mb-4">Editar Producto</h1>

    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger text-center mb-3">
        <?= $_SESSION['error']; ?>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>


    <form action="index.php?action=updateProduct" method="POST" enctype="multipart/form-data" class="form-column">

      <input type="hidden" name="IdProducto" value="<?= $producto['IdProducto'] ?>">
      <input type="hidden" name="Foto_actual" value="<?= $producto['Foto'] ?>">

      <label class="form-label">Nombre</label>
      <input type="text" name="Nombre" value="<?= htmlspecialchars($producto['Nombre']) ?>" class="form-control mb-2" required>

      <label class="form-label">Precio</label>
      <input type="number" name="Precio" value="<?= $producto['Precio'] ?>" class="form-control mb-2" required>

      <label class="form-label">Material</label>
      <input type="text" name="Material" value="<?= htmlspecialchars($producto['Material']) ?>" class="form-control mb-2" required>

      <!-- TALLA -->
      <label class="form-label">Talla</label>
      <select name="IdTalla" class="form-select mb-2" required>
        <option value="">Seleccione talla</option>
        <?php foreach ($tallas as $talla): ?>
          <option value="<?= $talla['IdTalla']; ?>"
            <?= ($talla['IdTalla'] == $producto['IdTalla']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($talla['NomTalla']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label class="form-label">Unidad Medida</label>
      <input type="text" name="UdMedida" value="<?= htmlspecialchars($producto['UdMedida']) ?>" class="form-control mb-2" required>

      <!-- COLOR -->
      <label class="form-label">Color</label>
      <select name="IdColor" class="form-select mb-2" required>
        <option value="">Seleccione color</option>
        <?php foreach ($colores as $color): ?>
          <option value="<?= $color['IdColor']; ?>"
            <?= ($color['IdColor'] == $producto['IdColor']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($color['NomColor']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label class="form-label">Stock</label>
      <input type="number" name="Stock" value="<?= $producto['Stock'] ?>" class="form-control mb-2" required>

      <label class="form-label">Oferta</label>
      <input type="number" name="Oferta" value="<?= $producto['Oferta'] ?>" class="form-control mb-2">

      <!-- CATEGORÍA -->
      <label class="form-label">Categoría</label>
      <select name="IdCategoria" class="form-select mb-2" required>
        <option value="">Seleccione categoría</option>
        <?php foreach ($categorias as $categoria): ?>
          <option value="<?= $categoria['IdCategoria']; ?>"
            <?= ($categoria['IdCategoria'] == $producto['IdCategoria']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($categoria['NomCategoria']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- MARCA -->
      <label class="form-label">Marca</label>
      <select name="IdMarca" class="form-select mb-2" required>
        <option value="">Seleccione marca</option>
        <?php foreach ($marcas as $marca): ?>
          <option value="<?= $marca['IdMarca']; ?>"
            <?= ($marca['IdMarca'] == $producto['IdMarca']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($marca['NomMarca']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label class="form-label">Descripción</label>
      <textarea name="Descripcion" class="form-control mb-2" rows="3" required><?= htmlspecialchars($producto['Descripcion']) ?></textarea>

      <label class="form-label mt-2">Foto actual</label>
      <?php if ($producto['Foto']): ?>
        <div class="text-center mb-3">
          <img src="uploads/<?= htmlspecialchars($producto['Foto']) ?>" class="img-thumbnail" style="max-width:140px;">
        </div>
      <?php endif; ?>

      <label class="form-label">Subir nueva foto</label>
      <input type="file" name="Foto" class="form-control mb-3">

      <button type="submit" class="btn-dashboard w-100 mb-3">
        <i class="bi bi-pencil-square"></i> Actualizar Producto
      </button>

    </form>

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
