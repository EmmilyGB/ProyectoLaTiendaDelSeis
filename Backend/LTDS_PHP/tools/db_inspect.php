<?php
require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

header('Content-Type: text/html; charset=utf-8');

echo "<h2>Inspección rápida de la BD</h2>";

try {
    // Listar categorías
    $stmt = $conn->prepare("SELECT IdCategoria, NomCategoria FROM categoria");
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Categorías</h3>";
    if (empty($categorias)) {
        echo "<p>No hay categorías en la tabla <strong>categoria</strong>.</p>";
    } else {
        echo "<table border=1 cellpadding=6 cellspacing=0><tr><th>IdCategoria</th><th>NomCategoria</th><th>#Productos</th></tr>";
        foreach ($categorias as $cat) {
            $cstmt = $conn->prepare("SELECT COUNT(*) as cnt FROM producto WHERE IdCategoria = ?");
            $cstmt->execute([$cat['IdCategoria']]);
            $cnt = $cstmt->fetch(PDO::FETCH_ASSOC)['cnt'];
            echo "<tr><td>{$cat['IdCategoria']}</td><td>".htmlspecialchars($cat['NomCategoria'])."</td><td>{$cnt}</td></tr>";
        }
        echo "</table>";
    }

    // Listar algunos productos con su categoria nombre real
    echo "<h3>Ejemplo de productos (primeras 20 filas)</h3>";
    $pstmt = $conn->prepare("SELECT p.IdProducto, p.Nombre, p.Precio, p.IdCategoria, ca.NomCategoria, p.Foto FROM producto p LEFT JOIN categoria ca ON p.IdCategoria = ca.IdCategoria LIMIT 20");
    $pstmt->execute();
    $productos = $pstmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($productos)) {
        echo "<p>No hay productos en la tabla <strong>producto</strong>.</p>";
    } else {
        echo "<table border=1 cellpadding=6 cellspacing=0><tr><th>IdProducto</th><th>Nombre</th><th>Precio</th><th>IdCategoria</th><th>NomCategoria</th><th>Foto</th></tr>";
        foreach ($productos as $p) {
            $foto = htmlspecialchars($p['Foto']);
            echo "<tr><td>{$p['IdProducto']}</td><td>".htmlspecialchars($p['Nombre'])."</td><td>".htmlspecialchars($p['Precio'])."</td><td>{$p['IdCategoria']}</td><td>".htmlspecialchars($p['NomCategoria'])."</td><td>{$foto}</td></tr>";
        }
        echo "</table>";
    }

} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}

echo "<p>Una vez revises los resultados, elimina este archivo `tools/db_inspect.php` por seguridad.</p>";

?>