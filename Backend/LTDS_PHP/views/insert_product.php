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

      <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center mb-3">
          <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>


      <form action="index.php?action=insertProdu" method="POST" enctype="multipart/form-data" class="form-column">

        <label class="form-label">Nombre</label>
        <input type="text" name="Nombre" class="form-control mb-2" required>

        <label class="form-label">Precio</label>
        <input type="number" name="Precio" class="form-control mb-2" required>

        <label class="form-label">Material</label>
        <input type="text" name="Material" class="form-control mb-2" required>

        <label class="form-label">Tallas y stock</label>
        <div class="table-responsive mb-2">
          <table class="table table-bordered align-middle mb-2" id="tabla-tallas-stock">
            <thead>
              <tr>
                <th style="width:65%;">Talla</th>
                <th style="width:25%;">Stock</th>
                <th style="width:10%;"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <select name="IdTallaMulti[]" class="form-select" required>
                    <option value="">Seleccione talla</option>
                    <?php foreach ($tallas as $talla): ?>
                      <option value="<?= $talla['IdTalla']; ?>">
                        <?= htmlspecialchars($talla['NomTalla']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td>
                  <input type="number" name="StockMulti[]" class="form-control" min="0" value="0" required>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeTallaRow(this)">x</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm mb-2" onclick="addTallaRow()">+ Agregar talla</button>


        <label class="form-label">Color</label>
            <select name="IdColor" class="form-select mb-2" required>
              <option value="">Seleccione color</option>
              <?php foreach ($colores as $color): ?>
                <option value="<?= $color['IdColor']; ?>">
                  <?= htmlspecialchars($color['NomColor']); ?>
                </option>
              <?php endforeach; ?>
            </select>


        <label class="form-label">Categoría</label>
            <select name="IdCategoria" class="form-select mb-2" required>
              <option value="">Seleccione categoría</option>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['IdCategoria']; ?>">
                  <?= htmlspecialchars($categoria['NomCategoria']); ?>
                </option>
              <?php endforeach; ?>
            </select>


        <label class="form-label">Marca</label>
            <select name="IdMarca" class="form-select mb-2" required>
              <option value="">Seleccione marca</option>
              <?php foreach ($marcas as $marca): ?>
                <option value="<?= $marca['IdMarca']; ?>">
                  <?= htmlspecialchars($marca['NomMarca']); ?>
                </option>
              <?php endforeach; ?>
            </select>


        <label class="form-label">Descripción</label>
        <textarea name="Descripcion" class="form-control mb-2" rows="3" required></textarea>

        <label class="form-label">Foto</label>
        <input type="file" name="Foto" class="form-control mb-3" accept="image/*">

        <label class="form-label">Fotos adicionales</label>
        <input type="file" name="Fotos[]" class="form-control mb-3" accept="image/*" multiple>

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
  <script>
    function addTallaRow() {
      const tbody = document.querySelector('#tabla-tallas-stock tbody');
      const firstRow = tbody.querySelector('tr');
      const clone = firstRow.cloneNode(true);
      clone.querySelector('select').value = '';
      clone.querySelector('input').value = '0';
      tbody.appendChild(clone);
    }

    function removeTallaRow(btn) {
      const tbody = document.querySelector('#tabla-tallas-stock tbody');
      if (tbody.querySelectorAll('tr').length <= 1) return;
      btn.closest('tr').remove();
    }
  </script>

</body>
</html>
