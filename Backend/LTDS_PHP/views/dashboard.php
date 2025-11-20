<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="css/dashboard.css">

</head>

<body>

  <div class="center-wrapper">
    <div class="wrapper-box">

      <!-- LOGO + TÍTULO -->
      <div class="dashboard-header">
        <img src="img/logo.png" alt="Logo" class="dashboard-logo">
        <h1 class="dashboard-title">Dashboard</h1>
      </div>

      <!-- BOTONES AGRUPADOS -->
      <div class="button-column">

        <!-- === BOTÓN USUARIO === -->
        <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#usuarioMenu">
          <i class="bi bi-person-fill"></i>
          <span>Usuario</span>
        </button>

        <div id="usuarioMenu" class="collapse">

          <form action="index.php" method="get">
            <button type="submit" name="action" value="insertuser" class="btn-dashboard sub-btn">
              <i class="bi bi-person-plus-fill"></i>
              <span>Insertar Usuario</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="listUser" class="btn-dashboard sub-btn">
              <i class="bi bi-people-fill"></i>
              <span>Lista Usuarios</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="UsersByName" class="btn-dashboard sub-btn">
              <i class="bi bi-search"></i>
              <span>Buscar Usuario</span>
            </button>
          </form>

        </div>

        <!-- === BOTÓN PRODUCTO === -->
        <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#productoMenu">
          <i class="bi bi-box-seam"></i>
          <span>Producto</span>
        </button>

        <div id="productoMenu" class="collapse">

          <form action="index.php" method="get">
            <button type="submit" name="action" value="insertProdu" class="btn-dashboard sub-btn">
              <i class="bi bi-box-seam"></i>
              <span>Insertar Producto</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="listProduct" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Lista Productos</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="ProductsByName" class="btn-dashboard sub-btn">
              <i class="bi bi-search"></i>
              <span>Buscar Producto</span>
            </button>
          </form>

        </div>

      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
