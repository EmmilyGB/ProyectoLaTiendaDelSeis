<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Usuario</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/list_UserByName.css">
</head>

<body>

<div class="wrapper-box">

    <!-- Botón volver al Dashboard -->
    <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard">
            <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
    </form>

    <h1 class="dashboard-title">Buscar Producto por nombre</h1>
    
    <!-- FORMULARIO DE BÚSQUEDA -->
    <form action="index.php" method="get" style="margin-bottom:0;">
        <input type="hidden" name="action" value="ProductsByName">

        <label for="Nombre">Nombre:</label><br>
        <input type="text" id="Nombre" name="Nombre" required>

        <!-- Botones lado a lado -->
        <div style="display: flex; gap: 10px; margin-top: 15px;">

            <!-- Botón BUSCAR -->
            <button type="submit" class="btn-small btn-red">
                <i class="bi bi-search"></i> Buscar
            </button>

            <!-- Botón VOLVER (NO valida el form) -->
            <a href="index.php?action=ProductsByName" 
            class="btn-small btn-gray" 
            role="button" 
            style="text-decoration:none;">
                <i class="bi bi-arrow-left"></i> Volver
            </a>

        </div>

    </form>

    <?php if (isset($productos) && count($productos) > 0): ?>

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

    <?php elseif (isset($productos)): ?>
        <p>No se encontraron productos con ese nombre.</p>
    <?php endif; ?>

</div>

</body>
</html>

