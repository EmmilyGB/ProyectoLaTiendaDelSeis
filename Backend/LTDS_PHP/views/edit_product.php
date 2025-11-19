<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Producto</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="css/Form.css">

</head>

<body>

  <div class="center-wrapper">
    <div class="wrapper-box">

      <h1 class="dashboard-title mb-4">Editar Producto</h1>

      <form action="index.php?action=updateProduct" method="POST" enctype="multipart/form-data" class="form-column">

        <!-- Hidden -->
        <input type="hidden" name="IdProducto" value="<?= $producto['IdProducto'] ?>">
        <input type="hidden" name="Foto_actual" value="<?= $producto['Foto'] ?>">

        <label class="form-label">Nombre</label>
        <input type="text" name="Nombre" value="<?= $producto['Nombre'] ?>" class="form-control mb-2" required>

        <label class="form-label">Precio</label>
        <input type="number" name="Precio" value="<?= $producto['Precio'] ?>" class="form-control mb-2" required>

        <label class="form-label">Material</label>
        <input type="text" name="Material" value="<?= $producto['Material'] ?>" class="form-control mb-2" required>

        <label class="form-label">Talla / Unidad Medida</label>
        <input type="text" name="Talla_unidadMedida" value="<?= $producto['Talla_unidadMedida'] ?>" class="form-control mb-2" required>

        <label class="form-label">Color</label>
        <input type="text" name="Color" value="<?= $producto['Color'] ?>" class="form-control mb-2" required>

        <label class="form-label">Stock</label>
        <input type="number" name="Stock" value="<?= $producto['Stock'] ?>" class="form-control mb-2" required>

        <label class="form-label">Oferta</label>
        <input type="number" name="Oferta" value="<?= $producto['Oferta'] ?>" class="form-control mb-2">

        <label class="form-label">Categoría</label>
        <input type="text" name="Categoria" value="<?= $producto['Categoria'] ?>" class="form-control mb-2" required>

        <label class="form-label">Marca</label>
        <input type="text" name="Marca" value="<?= $producto['Marca'] ?>" class="form-control mb-2" required>

        <label class="form-label">Descripción</label>
        <textarea name="Descripcion" class="form-control mb-2" rows="3" required><?= $producto['Descripcion'] ?></textarea>

        <!-- Foto actual -->
        <label class="form-label mt-2">Foto actual</label>
        <?php if ($producto['Foto']): ?>
          <div class="text-center mb-3">
            <img src="uploads/<?= $producto['Foto'] ?>" class="img-thumbnail" style="max-width: 140px; border-radius: 12px;">
          </div>
        <?php else: ?>
          <p class="text-muted mb-2">No tiene foto</p>
        <?php endif; ?>

        <!-- Nueva foto -->
        <label class="form-label">Subir nueva foto</label>
        <input type="file" name="Foto" class="form-control mb-3">

        <!-- Botón actualizar -->
        <button type="submit" class="btn-dashboard w-100 mb-3">
          <i class="bi bi-pencil-square"></i> Actualizar Producto
        </button>

      </form>

      <!-- Botón volver -->
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
