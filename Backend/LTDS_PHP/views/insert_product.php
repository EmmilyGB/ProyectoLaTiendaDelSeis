<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insertar Producto</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/Form.css">
</head>

<body>

  <div class="center-wrapper">
    <div class="wrapper-box">

      <h1 class="dashboard-title">Insertar Producto</h1>

      <form action="index.php?action=insertProdu" method="POST" enctype="multipart/form-data" class="form-column">

        <label class="form-label">Nombre</label>
        <input type="text" name="Nombre" class="form-control mb-2" required>

        <label class="form-label">Precio</label>
        <input type="number" name="Precio" class="form-control mb-2" required>

        <label class="form-label">Material</label>
        <input type="text" name="Material" class="form-control mb-2" required>

        <label class="form-label">Talla</label>
        <input type="number" name="IdTalla" class="form-control mb-2" required>

        <label class="form-label">Unidad Medida</label>
        <input type="text" name="UdMedida" class="form-control mb-2" required>

        <label class="form-label">Color</label>
        <input type="number" name="IdColor" class="form-control mb-2" required>

        <label class="form-label">Stock</label>
        <input type="number" name="Stock" class="form-control mb-2" required>

        <label class="form-label">Oferta</label>
        <input type="number" name="Oferta" class="form-control mb-2">

        <label class="form-label">Categoría</label>
        <input type="number" name="idCategoria" class="form-control mb-2" required>

        <label class="form-label">Marca</label>
        <input type="number" name="IdMarca" class="form-control mb-2" required>

        <label class="form-label">Descripción</label>
        <textarea name="Descripcion" class="form-control mb-2" rows="3" required></textarea>

        <label class="form-label">Foto</label>
        <input type="file" name="Foto" class="form-control mb-3" accept="image/*">

        <!-- BOTÓN GUARDAR -->
        <button type="submit" class="btn-dashboard w-100 mb-3">
          <i class="bi bi-save-fill"></i> Guardar Producto
        </button>

      </form>

      <!-- BOTÓN VOLVER -->
      <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard w-100">
          <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
      </form>

    </div>
  </div>

  <!-- Bootstrap Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>