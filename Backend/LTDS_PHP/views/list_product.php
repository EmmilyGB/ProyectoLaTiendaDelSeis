<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos globales -->
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            padding: 40px;
        }

        .wrapper-box {
            background: #fff;
            color: #000;
            padding: 25px;
            border-radius: 18px;
            max-width: 1200px;
            margin: auto;
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        /* Tabla moderna */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
            background: #fafafa;
        }

        th {
            background: #d00000;
            color: #fff;
            padding: 12px;
            text-align: center;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        tr:hover {
            background: #f3f3f3;
        }

        img {
            border-radius: 10px;
        }

        /* Botones */
        .btn-dashboard {
            background-color: #d00000;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-size: 17px;
            width: 100%;
            transition: 0.2s;
        }

        .btn-dashboard:hover {
            background-color: #a00000;
            transform: scale(1.03);
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            color: #fff;
        }

        .edit-btn {
            background: #0d6efd;
        }

        .delete-btn {
            background: #dc3545;
        }

        .edit-btn:hover { background: #0b5ed7; }
        .delete-btn:hover { background: #b52a37; }

        .table-responsive {
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="wrapper-box">

        <form action="index.php?action=dashboard" method="post" class="mt-4">
            <button type="submit" class="btn-dashboard">
                <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
            </button>
        </form>

        <h1 class="dashboard-title">Lista de Productos</h1>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Material</th>
                        <th>Talla / Unidad</th>
                        <th>Color</th>
                        <th>Stock</th>
                        <th>Oferta</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Descripción</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?= $p['IdProducto'] ?></td>
                        <td><?= $p['Nombre'] ?></td>
                        <td>$<?= $p['Precio'] ?></td>
                        <td><?= $p['Material'] ?></td>
                        <td><?= $p['Talla_unidadMedida'] ?></td>
                        <td><?= $p['Color'] ?></td>
                        <td><?= $p['Stock'] ?></td>
                        <td><?= $p['Oferta'] ?></td>
                        <td><?= $p['Categoria'] ?></td>
                        <td><?= $p['Marca'] ?></td>
                        <td><?= $p['Descripcion'] ?></td>

                        <td>
                            <?php if (!empty($p['Foto'])): ?>
                                <img src="uploads/<?= $p['Foto'] ?>" width="80">
                            <?php else: ?>
                                <span class="text-muted">Sin foto</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">

                            <a href="index.php?action=editProduct&id=<?= $p['IdProducto'] ?>"
                               class="action-btn edit-btn mb-1 d-block">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>

                            <a href="index.php?action=deleteProduct&id=<?= $p['IdProducto'] ?>"
                               onclick="return confirm('¿Seguro que deseas eliminar este producto?')"
                               class="action-btn delete-btn d-block">
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </a>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
