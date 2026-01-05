<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuiaTallas/Latiendadelseis</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/guiaTallas.css">
</head>



<body>
    <!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>








<section class="guia-tallas container py-5">

    <!-- TÍTULO CABALLERO -->
    <div class="row justify-content-center mb-4">
        <div class="col-12 text-center">
            <h2 class="titulo-guia">TALLA DE CABALLERO</h2>
        </div>
    </div>

    <!-- TARJETA CABALLERO -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <div class="card tabla-card p-3 p-md-4 shadow-lg">
                <div class="table-responsive">
                    <table class="table tabla-tallas text-center">

                        <thead>
                            <tr>
                                <th>COL <img src="img/colombia.png" class="flag"></th>
                                <th>US <img src="img/estados-unidos.png" class="flag"></th>
                                <th>EUR <img src="img/union-europea.png" class="flag"></th>
                                <th>CM <img src="img/cm.png" class="flag"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr><td>37</td><td>7</td><td>40</td><td>25</td></tr>
                            <tr><td>38</td><td>8</td><td>41</td><td>26</td></tr>
                            <tr><td>39/40</td><td>8.5/9</td><td>42</td><td>26.5</td></tr>
                            <tr><td>41</td><td>9.5</td><td>43</td><td>27</td></tr>
                            <tr><td>42</td><td>10</td><td>44</td><td>28</td></tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- DIVISOR -->
    <div class="row my-5">
        <div class="col-12">
            <hr class="divisor">
        </div>
    </div>

    <!-- TÍTULO DAMA -->
    <div class="row justify-content-center mb-4">
        <div class="col-12 text-center">
            <h2 class="titulo-guia">TALLA DE DAMA</h2>
        </div>
    </div>

    <!-- TARJETA DAMA -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <div class="card tabla-card p-3 p-md-4 shadow-lg">
                <div class="table-responsive">
                    <table class="table tabla-tallas text-center">

                        <thead>
                            <tr>
                                <th>COL <img src="img/colombia.png" class="flag"></th>
                                <th>US <img src="img/estados-unidos.png" class="flag"></th>
                                <th>EUR <img src="img/union-europea.png" class="flag"></th>
                                <th>CM <img src="img/cm.png" class="flag"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr><td>35</td><td>5/5.5</td><td>36</td><td>22.5</td></tr>
                            <tr><td>36</td><td>6</td><td>37</td><td>23.5</td></tr>
                            <tr><td>37</td><td>6.5/7</td><td>38</td><td>24</td></tr>
                            <tr><td>38</td><td>7.5/8</td><td>39</td><td>25</td></tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

</section>














<div id="footer"></div>

<script>
    fetch("footer.html")
        .then(res => res.text())
        .then(html => {
            document.getElementById("footer").innerHTML = html;
        });
</script>




        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>