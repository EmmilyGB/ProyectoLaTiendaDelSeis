<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unisex</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/tablasdproductos.css">
</head>

<body>


<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>


<div id="filtrarZapa"></div>

    <script>
    fetch("filtrarZapa.html")
        .then(res => res.text())
        .then(html => document.getElementById("filtrarZapa").innerHTML = html);
    </script>



    <!-- BANNER CATEGORIA -->
    <div class="banner-categoria-hombre">
        <h1>Unisex</h1>
    </div>





<!-- ======= SECCIÓN PRODUCTOS HOMBRE ======= -->
<div class="container-fluid seccion-productos seccion-hombre"></div>

    <div class="container">
        <div class="row product-row">

            <!-- PRODUCTO 1 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Puma.png" class="card-img-top" alt="Puma">
                        <div class="card-body text-center">
                            <h5 class="product-name">Puma Runner</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 2 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Nike.png" class="card-img-top" alt="Nike">
                        <div class="card-body text-center">
                            <h5 class="product-name">Nike Air</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 3 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Reebok.png" class="card-img-top" alt="Reebok">
                        <div class="card-body text-center">
                            <h5 class="product-name">Reebok Classic</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 4 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Adidas.png" class="card-img-top" alt="Adidas">
                        <div class="card-body text-center">
                            <h5 class="product-name">Adidas Sport</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 5 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Gola.png" class="card-img-top" alt="Gola">
                        <div class="card-body text-center">
                            <h5 class="product-name">Gola Retro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 6 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Diadora.png" class="card-img-top" alt="Diadora">
                        <div class="card-body text-center">
                            <h5 class="product-name">Diadora Pro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>


    <div class="container">
        <div class="row product-row">

            <!-- PRODUCTO 1 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Puma.png" class="card-img-top" alt="Puma">
                        <div class="card-body text-center">
                            <h5 class="product-name">Puma Runner</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 2 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Nike.png" class="card-img-top" alt="Nike">
                        <div class="card-body text-center">
                            <h5 class="product-name">Nike Air</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 3 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Reebok.png" class="card-img-top" alt="Reebok">
                        <div class="card-body text-center">
                            <h5 class="product-name">Reebok Classic</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 4 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Adidas.png" class="card-img-top" alt="Adidas">
                        <div class="card-body text-center">
                            <h5 class="product-name">Adidas Sport</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 5 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Gola.png" class="card-img-top" alt="Gola">
                        <div class="card-body text-center">
                            <h5 class="product-name">Gola Retro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 6 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Diadora.png" class="card-img-top" alt="Diadora">
                        <div class="card-body text-center">
                            <h5 class="product-name">Diadora Pro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>



    <div class="container">
        <div class="row product-row">

            <!-- PRODUCTO 1 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Puma.png" class="card-img-top" alt="Puma">
                        <div class="card-body text-center">
                            <h5 class="product-name">Puma Runner</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 2 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Nike.png" class="card-img-top" alt="Nike">
                        <div class="card-body text-center">
                            <h5 class="product-name">Nike Air</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 3 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Reebok.png" class="card-img-top" alt="Reebok">
                        <div class="card-body text-center">
                            <h5 class="product-name">Reebok Classic</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 4 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Adidas.png" class="card-img-top" alt="Adidas">
                        <div class="card-body text-center">
                            <h5 class="product-name">Adidas Sport</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 5 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Gola.png" class="card-img-top" alt="Gola">
                        <div class="card-body text-center">
                            <h5 class="product-name">Gola Retro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 6 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Diadora.png" class="card-img-top" alt="Diadora">
                        <div class="card-body text-center">
                            <h5 class="product-name">Diadora Pro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>


    <div class="container">
        <div class="row product-row">

            <!-- PRODUCTO 1 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Puma.png" class="card-img-top" alt="Puma">
                        <div class="card-body text-center">
                            <h5 class="product-name">Puma Runner</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 2 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Nike.png" class="card-img-top" alt="Nike">
                        <div class="card-body text-center">
                            <h5 class="product-name">Nike Air</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 3 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Reebok.png" class="card-img-top" alt="Reebok">
                        <div class="card-body text-center">
                            <h5 class="product-name">Reebok Classic</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 4 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Adidas.png" class="card-img-top" alt="Adidas">
                        <div class="card-body text-center">
                            <h5 class="product-name">Adidas Sport</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 5 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Gola.png" class="card-img-top" alt="Gola">
                        <div class="card-body text-center">
                            <h5 class="product-name">Gola Retro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 6 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Diadora.png" class="card-img-top" alt="Diadora">
                        <div class="card-body text-center">
                            <h5 class="product-name">Diadora Pro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>



    <div class="container">
        <div class="row product-row">

            <!-- PRODUCTO 1 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Puma.png" class="card-img-top" alt="Puma">
                        <div class="card-body text-center">
                            <h5 class="product-name">Puma Runner</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 2 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Nike.png" class="card-img-top" alt="Nike">
                        <div class="card-body text-center">
                            <h5 class="product-name">Nike Air</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 3 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Reebok.png" class="card-img-top" alt="Reebok">
                        <div class="card-body text-center">
                            <h5 class="product-name">Reebok Classic</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 4 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Adidas.png" class="card-img-top" alt="Adidas">
                        <div class="card-body text-center">
                            <h5 class="product-name">Adidas Sport</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 5 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Gola.png" class="card-img-top" alt="Gola">
                        <div class="card-body text-center">
                            <h5 class="product-name">Gola Retro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PRODUCTO 6 -->
            <div class="col-6 col-md-4 col-lg-2 product-col mb-4">
                <a href="vistaproducto.html" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="img/Diadora.png" class="card-img-top" alt="Diadora">
                        <div class="card-body text-center">
                            <h5 class="product-name">Diadora Pro</h5>
                            <p class="product-price">$99.000</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

</div>







<!-- PAGINACIÓN -->
<nav aria-label="Paginación de productos" class="mt-4">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="#"><</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">></a></li>
    </ul>
</nav>






<div id="footer"></div>
<script>
fetch("footer.html")
    .then(res => res.text())
    .then(html => document.getElementById("footer").innerHTML = html);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
