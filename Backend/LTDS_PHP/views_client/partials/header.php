<?php // session started in bootstrap ?>

<!-- ======= HEADER ======= -->
<header class="custom-header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="index.php?action=home">
                <img src="img/logo.png" alt="Logo" class="logo">
            </a>

            <!-- BOTÓN HAMBURGUESA -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- CONTENIDO DEL MENÚ -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- LINKS DE NAVEGACIÓN -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=hombre">Hombre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=mujer">Mujer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=unisex">Unisex</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=ofertas">Ofertas</a>
                    </li>
                </ul>

                <!-- BARRA DE BÚSQUEDA -->
                <form class="d-flex me-3 search-bar" action="index.php" method="get">
                    <input type="hidden" name="action" value="ProductsByName">
                    <input class="form-control" type="search" name="Nombre" placeholder="¿Qué estás buscando?" aria-label="Buscar productos">
                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- ICONOS -->
                <div class="d-flex align-items-center iconos">

                    <!-- FAVORITOS -->
                    <a href="index.php?action=misFavoritos" class="text-white me-3" title="Favoritos">
                        <i class="bi bi-heart"></i>
                    </a>

                    <!-- USUARIO -->
                    <?php if (!empty($_SESSION['usuario'])): ?>

                        <!-- BIENVENIDA -->
                        <span class="text-white me-3 small">
                            Bienvenid@, <?= htmlspecialchars($_SESSION['usuario']['Nombre']) ?>
                        </span>

                        <!-- CERRAR SESIÓN -->
                        <a href="index.php?action=logout" class="text-white me-3" title="Cerrar sesión">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>

                    <?php else: ?>

                        <!-- INICIAR SESIÓN -->
                        <a href="index.php?action=login" class="text-white me-3" title="Iniciar sesión">
                            <i class="bi bi-person"></i>
                        </a>

                    <?php endif; ?>

                    <!-- CARRITO -->
                    <a href="index.php?action=verCarrito" class="text-white" title="Carrito">
                        <i class="bi bi-cart"></i>
                    </a>

                </div>

            </div>
        </div>
    </nav>
</header>
