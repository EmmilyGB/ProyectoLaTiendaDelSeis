<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La tienda del seis</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>

<main>

    <!-- ===== HERO / IMAGEN PRINCIPAL ===== -->
    <section class="hero-index d-flex align-items-center justify-content-center text-center">
        <div class="hero-content">
            <h1>La tienda del seis</h1>
            <p>Perfumes y zapatillas 100% originales</p>
            <a href="#productos" class="btn btn-dark mt-3">Ver productos</a>
        </div>
    </section>

    <!-- ===== DIVISIÓN CON IMAGEN ===== -->
<section class="divider-image"></section>

<!-- ===== CARRUSEL PRODUCTOS ===== -->
<section id="productos" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">PRODUCTOS DESTACADOS</h2>

        <div id="carouselProductos" class="carousel slide" data-bs-ride="carousel">
            <?php
            // Agrupar productos en slides de 4
            $chunks = array_chunk($productos ?? [], 4);
            ?>

            <?php if (count($chunks) > 1): ?>
            <div class="carousel-indicators mb-4">
                <?php foreach ($chunks as $i => $chunk): ?>
                    <button type="button" data-bs-target="#carouselProductos" data-bs-slide-to="<?= $i ?>" class="<?= $i===0 ? 'active' : '' ?>" aria-current="<?= $i===0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i+1 ?>"></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="carousel-inner">
                <?php foreach ($chunks as $i => $group): ?>
                    <div class="carousel-item <?= $i===0 ? 'active' : '' ?>">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ($group as $p): ?>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card text-center border-0 position-relative">
                                        <img src="uploads/<?= htmlspecialchars($p['Foto']) ?>" class="img-fluid carousel-product-img" alt="<?= htmlspecialchars($p['Nombre']) ?>">

                                        <div class="position-absolute" style="top:8px; right:8px;">
                                            <?php if (isset($_SESSION['usuario']) && $favoritoController->isFavorito($p['IdProducto'])): ?>
                                                <a href="index.php?action=removeFavorite&id=<?= $p['IdProducto'] ?>" class="favorite-toggle favorite-filled" aria-label="Quitar favorito"><i class="bi bi-heart-fill"></i></a>
                                            <?php else: ?>
                                                <a href="index.php?action=addFavorite&id=<?= $p['IdProducto'] ?>" class="favorite-toggle favorite-empty" aria-label="Agregar favorito"><i class="bi bi-heart"></i></a>
                                            <?php endif; ?>
                                        </div>

                                        <h5 class="mt-3"><?= htmlspecialchars($p['Nombre']) ?></h5>
                                        <p class="precio">COP <?= number_format($p['Precio'],0,',','.') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (count($chunks) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            <?php endif; ?>

        </div>
    </div>
</section>


    <!-- ===== DIVISIÓN CON IMAGEN ===== -->
<section class="divider-image"></section>


    <!-- ===== BENEFICIOS ===== -->
    <section class="beneficios py-5 bg-light">
        <div class="container">
            <div class="row text-center g-4">

                <div class="col-md-4">
                    <i class="bi bi-shield-lock fs-1"></i>
                    <h5 class="mt-3">Compra segura y protegida</h5>
                    <p>Pagos 100% confiables</p>
                </div>

                <div class="col-md-4">
                    <i class="bi bi-award fs-1"></i>
                    <h5 class="mt-3">Productos de calidad</h5>
                    <p>Originales y garantizados</p>
                </div>

                <div class="col-md-4">
                    <i class="bi bi-truck fs-1"></i>
                    <h5 class="mt-3">Envíos nacionales</h5>
                    <p>A cualquier parte de Colombia</p>
                </div>

            </div>
        </div>
    </section>


    <!-- ===== NEWSLETTER ===== -->
    <section class="newsletter py-5 text-center">
        <div class="container">
            <h2>Regístrate y recibe descuentos</h2>
            <p class="mb-4">Promociones exclusivas directo a tu correo</p>

            <form class="d-flex justify-content-center gap-2 flex-wrap">
                <input type="email" class="form-control w-50" placeholder="Tu correo electrónico" required>
                <button type="submit" class="btn btn-dark">Enviar</button>
            </form>
        </div>
    </section>

        <!-- ===== DIVISIÓN CON IMAGEN ===== -->
<section class="divider-image"></section>

    <!-- ===== MARCAS DESTACADAS ===== -->
<section class="marcas-destacadas py-5">
    <div class="container">
        <h2 class="mb-4 text-center">MARCAS DESTACADAS</h2>

        <div class="row justify-content-center g-4">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="marca-card">
                    <img src="img/adidas.png" alt="Adidas">
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="marca-card">
                    <img src="img/Vans.png" alt="Vans">
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="marca-card">
                    <img src="img/NewBalance.png" alt="New Balance">
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="marca-card">
                    <img src="img/puma.png" alt="Puma">
                </div>
            </div>
        </div>
    </div>
</section>


</main>

<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>