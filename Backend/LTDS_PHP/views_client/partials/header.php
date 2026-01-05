<!-- ======= HEADER ======= --> 
<header class="custom-header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="home.php">
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
                    <li class="nav-item"><a class="nav-link" href="productos.php?cat=hombre">Hombre</a></li>
                    <li class="nav-item"><a class="nav-link" href="productos.php?cat=mujer">Mujer</a></li>
                    <li class="nav-item"><a class="nav-link" href="productos.php?cat=unisex">Unisex</a></li>
                    <li class="nav-item"><a class="nav-link" href="productos.php?ofertas=1">Ofertas</a></li>
                </ul>

                <!-- BARRA DE BÚSQUEDA -->
                <form class="d-flex me-3 search-bar" action="productos.php" method="get">
                    <input class="form-control" type="search" name="q" placeholder="¿Qué estás buscando?">
                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- ICONOS -->
                <div class="d-flex align-items-center iconos">
                    <a href="#" class="text-white me-3"><i class="bi bi-heart"></i></a>
                    <a href="login.php" class="text-white me-3"><i class="bi bi-person"></i></a>
                    <a href="carrito.php" class="text-white"><i class="bi bi-cart"></i></a>
                </div>

            </div>
        </div>
    </nav>
</header>
