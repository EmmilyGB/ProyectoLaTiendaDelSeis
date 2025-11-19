<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding: 50px 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 40px;
            color: #333;
        }

        .btn-dashboard {
            min-width: 180px;
            margin: 10px;
        }

        @media (max-width: 576px) {
            .btn-dashboard {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <h1>Dashboard</h1>

    <div class="d-flex flex-wrap justify-content-center">
        <form action="index.php" method="get">
            <button type="submit" name="action" value="insertuser" class="btn btn-primary btn-dashboard">
                <i class="bi bi-person-plus-fill"></i> Insertar Usuario
            </button>
        </form>

        <form action="index.php" method="get">
            <button type="submit" name="action" value="insertProdu" class="btn btn-success btn-dashboard">
                <i class="bi bi-box-seam"></i> Insertar Producto
            </button>
        </form>

        <form action="index.php" method="get">
            <button type="submit" name="action" value="listProduct" class="btn btn-warning btn-dashboard">
                <i class="bi bi-list-ul"></i> Lista Productos
            </button>
        </form>

        <form action="index.php" method="get">
            <button type="submit" name="action" value="listUser" class="btn btn-info btn-dashboard text-white">
                <i class="bi bi-people-fill"></i> Lista Usuarios
            </button>
        </form>
    </div>

    <!-- Bootstrap 5 JS (opcional para algunos componentes) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
