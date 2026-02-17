<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La tienda del seis - Alt</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/home_alt.css">
</head>
<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<main class="home-alt">
    <section class="alt-variant-switch py-3">
        <div class="container d-flex gap-2 flex-wrap align-items-center">
            <span class="alt-variant-label">Prototipos de home:</span>
            <a href="index.php?action=homeAlt" class="btn alt-btn-main">Opcion 1</a>
        </div>
    </section>

    <section class="alt-hero">
        <div class="alt-hero-bg-shape"></div>
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <p class="alt-kicker">NUEVA EXPERIENCIA</p>
                    <h1 class="alt-title">La tienda del seis, con una vitrina mas potente</h1>
                    <p class="alt-subtitle">Zapatillas y perfumes originales con una visual mas dinamica, mejores ofertas y mas enfoque en producto.</p>
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="#alt-destacados" class="btn alt-btn-main">Ver destacados</a>
                        <a href="index.php?action=ofertas" class="btn alt-btn-ghost">Ir a ofertas</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="alt-hero-card">
                        <h6 class="mb-2">Categorias rapidas</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a class="alt-chip" href="index.php?action=hombre">Hombre</a>
                            <a class="alt-chip" href="index.php?action=mujer">Mujer</a>
                            <a class="alt-chip" href="index.php?action=unisex">Unisex</a>
                            <a class="alt-chip" href="index.php?action=ofertas">Ofertas</a>
                        </div>
                        <hr>
                        <div class="alt-stats">
                            <div><strong><?= count($productos ?? []) ?></strong><span>Productos destacados</span></div>
                            <div><strong>100%</strong><span>Originales</span></div>
                            <div><strong>24/7</strong><span>Compra online</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="alt-destacados" class="alt-featured py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                <h2 class="alt-section-title mb-0">Productos destacados</h2>
                <a href="index.php?action=buscarProductos" class="alt-link-more">Explorar todo <i class="bi bi-arrow-right-short"></i></a>
            </div>

            <?php $chunks = array_chunk($productos ?? [], 3); ?>
            <div id="carouselAltHome" class="carousel slide" data-bs-ride="carousel">
                <?php if (count($chunks) > 1): ?>
                    <div class="carousel-indicators alt-indicators">
                        <?php foreach ($chunks as $i => $chunk): ?>
                            <button type="button" data-bs-target="#carouselAltHome" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="carousel-inner">
                    <?php foreach ($chunks as $i => $group): ?>
                        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                            <div class="row g-4">
                                <?php foreach ($group as $p): ?>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <article class="alt-product-card h-100 position-relative">
                                            <div class="alt-product-image-wrap">
                                                <img src="uploads/<?= htmlspecialchars($p['Foto']) ?>" alt="<?= htmlspecialchars($p['Nombre']) ?>" class="img-fluid alt-product-image">
                                            </div>

                                            <div class="position-absolute" style="top:10px; right:10px;">
                                                <?php if (isset($_SESSION['usuario']) && $favoritoController->isFavorito($p['IdProducto'])): ?>
                                                    <a href="index.php?action=removeFavorite&id=<?= $p['IdProducto'] ?>" class="favorite-toggle favorite-filled" aria-label="Quitar favorito">
                                                        <i class="bi bi-heart-fill"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="index.php?action=addFavorite&id=<?= $p['IdProducto'] ?>" class="favorite-toggle favorite-empty" aria-label="Agregar favorito">
                                                        <i class="bi bi-heart"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>

                                            <div class="p-3">
                                                <h5 class="mb-1 alt-product-name"><?= htmlspecialchars($p['Nombre']) ?></h5>
                                                <p class="mb-3 alt-product-price">COP <?= number_format($p['Precio'], 0, ',', '.') ?></p>
                                                <a href="index.php?action=verProducto&id=<?= $p['IdProducto'] ?>" class="btn alt-btn-small w-100">Ver producto</a>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($chunks) > 1): ?>
                    <button class="carousel-control-prev alt-control" type="button" data-bs-target="#carouselAltHome" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next alt-control" type="button" data-bs-target="#carouselAltHome" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="alt-brands py-5">
        <div class="container">
            <h2 class="alt-section-title text-center mb-4">Marcas destacadas</h2>
            <div class="row justify-content-center g-3">
                <div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="alt-brand-card"><img src="img/Adidas.png" alt="Adidas"></div></div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="alt-brand-card"><img src="img/Vans.png" alt="Vans"></div></div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="alt-brand-card"><img src="img/NewBalance.png" alt="New Balance"></div></div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="alt-brand-card"><img src="img/Puma.png" alt="Puma"></div></div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
