<?php
if (!isset($_SESSION['usuario']) || (int)($_SESSION['usuario']['Rol'] ?? 0) !== 1) {
    header("Location: index.php?action=login");
    exit;
}

$productos = $productos ?? [];
$ofertasMap = $ofertasMap ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion de Ofertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/tables.css">
</head>
<body class="p-4">
<div class="container">
    <h3>Gestionar ofertas de productos</h3>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form class="row g-2 mb-3" method="get" action="index.php">
        <input type="hidden" name="action" value="manageOfertas">
        <div class="col-auto">
            <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" class="form-control" placeholder="Buscar producto por nombre">
        </div>
        <div class="col-auto">
            <button class="action-primary" type="submit">Buscar</button>
        </div>
        <div class="col-auto">
            <a href="index.php?action=manageOfertas" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <form action="index.php?action=saveOfertas" method="post">
        <div class="row g-3">
            <?php foreach ($productos as $p): ?>
                <?php
                $id = (int)$p['IdProducto'];
                $precioOriginal = (float)$p['Precio'];
                $precioOferta = $ofertasMap[$id] ?? null;
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="uploads/<?= htmlspecialchars($p['Foto'] ?? '') ?>" class="card-img-top carousel-thumb img-fluid" alt="<?= htmlspecialchars($p['Nombre'] ?? '') ?>">
                        <div class="card-body">
                            <h6 class="mb-1"><?= htmlspecialchars($p['Nombre']) ?></h6>
                            <p class="mb-2">Precio actual: <strong>$<?= number_format($precioOriginal, 0, ',', '.') ?></strong></p>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="oferta_<?= $id ?>" name="productos[]" value="<?= $id ?>" <?= $precioOferta !== null ? 'checked' : '' ?>>
                                <label class="form-check-label" for="oferta_<?= $id ?>">Mostrar en ofertas</label>
                            </div>
                            <label class="form-label mb-1" for="precio_<?= $id ?>">Nuevo precio oferta</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control"
                                id="precio_<?= $id ?>"
                                name="precio_oferta[<?= $id ?>]"
                                value="<?= $precioOferta !== null ? htmlspecialchars((string)$precioOferta) : '' ?>"
                                placeholder="Ej: 89900">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button class="action-primary" type="submit">Guardar ofertas</button>
            <a href="index.php?action=dashboard" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>
</body>
</html>

