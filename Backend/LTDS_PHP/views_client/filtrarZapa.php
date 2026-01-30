<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Filtro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/Flitrar.css">
</head>

<body class="bg-dark">

<!-- FILTROS -->
<div class="container my-4">
    <div class="d-flex flex-wrap align-items-center gap-3 filtro-barra">

        <span class="filtro-label">Filtrar por</span>

        <!-- MARCA -->
        <div class="dropdown">
            <button class="btn filtro-btn dropdown-toggle" data-bs-toggle="dropdown">
                Marca
            </button>
            <div class="dropdown-menu p-3 filtro-dropdown">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nike">
                    <label class="form-check-label" for="nike">Nike</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="adidas">
                    <label class="form-check-label" for="adidas">Adidas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="puma">
                    <label class="form-check-label" for="puma">Puma</label>
                </div>
            </div>
        </div>

<!-- COLOR -->
<div class="dropdown" data-bs-auto-close="outside">
    <button class="btn filtro-btn dropdown-toggle" data-bs-toggle="dropdown">
        Color
    </button>

    <div class="dropdown-menu p-3 filtro-dropdown">

        <label class="color-item">
            <input type="checkbox" name="color" value="negro">
            <span class="color-dot negro"></span>
            <span class="color-text">Negro</span>
        </label>

        <label class="color-item">
            <input type="checkbox" name="color" value="blanco">
            <span class="color-dot blanco"></span>
            <span class="color-text">Blanco</span>
        </label>

        <label class="color-item">
            <input type="checkbox" name="color" value="rojo">
            <span class="color-dot rojo"></span>
            <span class="color-text">Rojo</span>
        </label>

        <label class="color-item">
            <input type="checkbox" name="color" value="azul">
            <span class="color-dot azul"></span>
            <span class="color-text">Azul</span>
        </label>

        <label class="color-item">
            <input type="checkbox" name="color" value="blanco">
            <span class="color-dot blanco"></span>
            <span class="color-text">blanco</span>
        </label>

    </div>
</div>



        <!-- TALLA -->
        <div class="dropdown">
            <button class="btn filtro-btn dropdown-toggle" data-bs-toggle="dropdown">
                Talla
            </button>
            <div class="dropdown-menu p-3 filtro-dropdown">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="38">
                    <label class="form-check-label" for="38">38</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="39">
                    <label class="form-check-label" for="39">39</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="40">
                    <label class="form-check-label" for="40">40</label>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- BOOTSTRAP JS (OBLIGATORIO) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
