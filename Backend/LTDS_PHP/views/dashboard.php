<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
  header("Location: index.php?action=login");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
  <div class="center-wrapper">
    <div class="wrapper-box">
      <div class="dashboard-header">
        <img src="img/logo.png" alt="Logo" class="dashboard-logo">
        <h1 class="dashboard-title">DASHBOARD</h1>
      </div>

      <div class="button-column">
        <button class="btn-dashboard main-btn" data-bs-toggle="collapse" data-bs-target="#usuarioMenu">
          <i class="bi bi-person-fill"></i>
          <span>Usuario</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div id="usuarioMenu" class="collapse menu-box">
          <form action="index.php" method="get">
            <button type="submit" name="action" value="insertuser" class="btn-dashboard sub-btn">
              <i class="bi bi-person-plus-fill"></i>
              <span>Insertar Usuario</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="UsersByName" class="btn-dashboard sub-btn">
              <i class="bi bi-search"></i>
              <span>Buscar Usuario</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="listUser" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Lista Usuarios</span>
            </button>
          </form>
        </div>

        <button class="btn-dashboard main-btn" data-bs-toggle="collapse" data-bs-target="#productoMenu">
          <i class="bi bi-box-seam"></i>
          <span>Producto</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div id="productoMenu" class="collapse menu-box">
          <form action="index.php" method="get">
            <button type="submit" name="action" value="insertProdu" class="btn-dashboard sub-btn">
              <i class="bi bi-box-seam"></i>
              <span>Insertar Producto</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="ProductsByName" class="btn-dashboard sub-btn">
              <i class="bi bi-search"></i>
              <span>Buscar Producto</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="listProduct" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Lista Productos</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="manageCategorias" class="btn-dashboard sub-btn">
              <i class="bi bi-tags"></i>
              <span>Gestionar Categorias</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="manageMarcas" class="btn-dashboard sub-btn">
              <i class="bi bi-tags-fill"></i>
              <span>Gestionar Marcas</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="manageCarrusel" class="btn-dashboard sub-btn">
              <i class="bi bi-images"></i>
              <span>Gestionar Carrusel</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="manageOfertas" class="btn-dashboard sub-btn">
              <i class="bi bi-percent"></i>
              <span>Gestionar Ofertas</span>
            </button>
          </form>
        </div>

        <button class="btn-dashboard main-btn" data-bs-toggle="collapse" data-bs-target="#facturaMenu">
          <i class="bi bi-bag-check"></i>
          <span>Pedidos</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div id="facturaMenu" class="collapse menu-box">
          <form action="index.php" method="get">
            <button type="submit" name="action" value="insertFactura" class="btn-dashboard sub-btn">
              <i class="bi bi-receipt"></i>
              <span>Crear Factura</span>
            </button>
          </form>

          <form action="index.php" method="get">
            <button type="submit" name="action" value="listFactura" class="btn-dashboard sub-btn">
              <i class="bi bi-journal-text"></i>
              <span>Gestionar Pedidos</span>
            </button>
          </form>
        </div>
      </div>

      <div class="d-flex justify-content-center mb-3 mt-4">
        <a href="index.php?action=logout" class="btn btn-danger">
          <i class="bi bi-box-arrow-right"></i> Cerrar sesion
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
