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

      <div class="small text-muted mb-2">La talla se administra en la sección "Tallas y stock del mismo modelo".</div>

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

      <label class="form-label">Agregar fotos adicionales</label>
      <input type="file" name="Fotos[]" class="form-control mb-3" accept="image/*" multiple>

      <?php if (!empty($fotosProducto)): ?>
        <div class="mb-3">
          <label class="form-label">Galería actual</label>
          <div class="d-flex flex-wrap gap-2">
            <?php foreach ($fotosProducto as $fp): ?>
              <div class="border rounded p-2 text-center">
                <img src="uploads/<?= htmlspecialchars($fp['RutaFoto']) ?>" class="img-thumbnail mb-2" style="width:90px;height:90px;object-fit:cover;">
                <div>
                  <?php if (!empty($fp['EsPrincipal'])): ?>
                    <span class="badge bg-success mb-2">Principal</span><br>
                  <?php else: ?>
                    <a href="index.php?action=setProductFotoPrincipal&idBase=<?= (int)$producto['IdProducto'] ?>&idFoto=<?= (int)$fp['IdFoto'] ?>"
                       class="btn btn-sm btn-outline-success mb-2">Principal</a><br>
                  <?php endif; ?>
                  <a href="index.php?action=deleteProductFoto&idBase=<?= (int)$producto['IdProducto'] ?>&idFoto=<?= (int)$fp['IdFoto'] ?>"
                     class="btn btn-sm btn-outline-danger"
                     onclick="return confirm('¿Eliminar esta foto?')">Eliminar</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <button type="submit" class="btn-dashboard w-100 mb-3">
        <i class="bi bi-pencil-square"></i> Actualizar Producto
      </button>

    </form>

    <hr class="my-4">

    <h2 class="h5 mb-3">Tallas y stock del mismo modelo</h2>
    <form action="index.php?action=updateProductTallas" method="POST" class="form-column">
      <input type="hidden" name="IdProducto" value="<?= $producto['IdProducto'] ?>">

      <div class="table-responsive mb-3">
        <table class="table table-bordered align-middle">
          <thead>
            <tr>
              <th>Talla</th>
              <th>Stock</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($variantes as $v): ?>
            <tr>
              <td><?= htmlspecialchars($v['NomTalla']) ?></td>
              <td style="max-width:140px;">
                <input type="number"
                       min="0"
                       name="stock_variante[<?= (int)$v['IdProducto'] ?>]"
                       value="<?= (int)$v['Stock'] ?>"
                       class="form-control">
              </td>
              <td class="text-center">
                <?php if ((int)$v['IdProducto'] !== (int)$producto['IdProducto']): ?>
                  <a href="index.php?action=deleteProductVariante&idBase=<?= (int)$producto['IdProducto'] ?>&idVariante=<?= (int)$v['IdProducto'] ?>"
                     class="btn btn-sm btn-outline-danger"
                     onclick="return confirm('¿Eliminar esta talla del modelo?')">
                    Eliminar
                  </a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <label class="form-label">Agregar nueva talla</label>
      <select name="NuevaIdTalla" class="form-select mb-2">
        <option value="">No agregar talla</option>
        <?php foreach ($tallas as $talla): ?>
          <option value="<?= $talla['IdTalla']; ?>">
            <?= htmlspecialchars($talla['NomTalla']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label class="form-label">Stock de nueva talla</label>
      <input type="number" min="0" name="NuevoStock" class="form-control mb-3" placeholder="Ej: 5">

      <button type="submit" class="btn-dashboard w-100 mb-3">
        <i class="bi bi-box-seam"></i> Guardar tallas y stock
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
