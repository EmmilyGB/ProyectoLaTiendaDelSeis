<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: #000;
    color: #fff;
    text-align: center;
    padding-top: 100px;
}

.error-box {
    background: #d00000;
    padding: 30px;
    border-radius: 15px;
    display: inline-block;
    color: white;
}
a.btn-back {
    margin-top: 20px;
    display: inline-block;
    padding: 12px 25px;
    background: #fff;
    color: #000;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
}
a.btn-back:hover {
    background: #ccc;
}
</style>
</head>
<body>

<div class="error-box">
    <h1>Error: 23000</h1>
    <h3>Los Datos ingresados ya existen</h3>
    <p>Por favor intente de nuevo.</p>
</div>

<br>

<a class="btn-back" href="index.php?action=insertuser">Volver al formulario</a>

</body>
</html>