<?php
ob_start(); // PROTECCIÓN CONTRA SALIDA PREVIA

require_once __DIR__ . '/../fpdf/fpdf.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Produmodel.php';

$database = new Database();
$db = $database->getConnection();
$model = new Produmodel($db);

// ⚠️ IMPORTANTE:
// Este método debe usar JOIN y devolver:
// Talla, Color, Categoria, Marca (NO los IDs)
$productos = $model->listarProductos();

$pdf = new FPDF('L', 'mm', 'A4'); // Horizontal
$pdf->AddPage();

// TÍTULO
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 12, utf8_decode('Listado de Productos'), 0, 1, 'C');
$pdf->Ln(4);

// ENCABEZADOS
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'ID', 1, 0, 'C');
$pdf->Cell(50, 8, 'Nombre', 1);
$pdf->Cell(25, 8, 'Precio', 1);
$pdf->Cell(25, 8, 'Talla', 1);
$pdf->Cell(30, 8, 'Color', 1);
$pdf->Cell(35, 8, 'Categoria', 1);
$pdf->Cell(35, 8, 'Marca', 1);
$pdf->Cell(20, 8, 'Stock', 1);
$pdf->Ln();

// DATOS
$pdf->SetFont('Arial', '', 9);

foreach ($productos as $p) {
    $pdf->Cell(10, 8, $p['IdProducto'], 1);
    $pdf->Cell(50, 8, utf8_decode($p['Nombre']), 1);
    $pdf->Cell(25, 8, '$' . number_format($p['Precio'], 0, ',', '.'), 1);
    $pdf->Cell(25, 8, utf8_decode($p['Talla']), 1);
    $pdf->Cell(30, 8, utf8_decode($p['Color']), 1);
    $pdf->Cell(35, 8, utf8_decode($p['Categoria']), 1);
    $pdf->Cell(35, 8, utf8_decode($p['Marca']), 1);
    $pdf->Cell(20, 8, $p['Stock'], 1);
    $pdf->Ln();
}

// LIMPIA BUFFER Y GENERA PDF
ob_end_clean();
$pdf->Output('I', 'productos.pdf');
