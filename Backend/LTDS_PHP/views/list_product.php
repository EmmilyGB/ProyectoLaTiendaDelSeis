<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
    
</head>
<body>
<div class="wrapper-box">

    <form action="index.php?action=dashboard" method="post">
        <button type="submit" class="btn-dashboard mb-3">
            <i class="bi bi-arrow-left-circle-fill"></i> Volver al Dashboard
        </button>
    </form>

    <!--  BOTÓN PDF -->
<a href="pdf/productos_pdf.php" target="_blank" class="btn btn-danger mb-3">
    <i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF
</a>

    <h1 class="dashboard-title">Lista de Productos</h1>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Material</th>
                    <th>Talla</th>
                    <th>Ud Medida</th>
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
                    <td><?= htmlspecialchars($p['Nombre']) ?></td>
                    <td>$<?= number_format($p['Precio'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($p['Material']) ?></td>
                    <td><?= htmlspecialchars($p['Talla']) ?></td>
                    <td><?= htmlspecialchars($p['UdMedida']) ?></td>
                    <td><?= htmlspecialchars($p['Color']) ?></td>
                    <td><?= htmlspecialchars($p['Stock']) ?></td>
                    <td><?= htmlspecialchars($p['Oferta']) ?></td>
                    <td><?= htmlspecialchars($p['Categoria']) ?></td>
                    <td><?= htmlspecialchars($p['Marca']) ?></td>

                    <td><?= htmlspecialchars($p['Descripcion']) ?></td>
                    <td>
                        <?php if (!empty($p['Foto'])): ?>
                            <img src="uploads/<?= htmlspecialchars($p['Foto']) ?>" width="80" style="border-radius:8px;">
                        <?php else: ?>
                            <span class="text-muted">Sin foto</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="index.php?action=editProduct&id=<?= $p['IdProducto'] ?>" class="action-btn edit-btn mb-1 d-block">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </a>
                        <a href="index.php?action=deleteProduct&id=<?= $p['IdProducto'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?')" class="action-btn delete-btn d-block">
                            <i class="bi bi-trash-fill"></i> Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>