<?php
require_once __DIR__ . '/../model/CarruselModel.php';
require_once __DIR__ . '/../model/Produmodel.php';

class CarruselController {
    private $db;
    private $carruselModel;
    private $productoModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->carruselModel = new CarruselModel($this->db);
        $this->productoModel = new Produmodel($this->db);
    }

    // Mostrar formulario para seleccionar productos del carrusel
    public function manageCarrusel() {
        $q = trim($_GET['q'] ?? '');
        if ($q !== '') {
            $productos = $this->productoModel->getProductoByNombre($q);
        } else {
            $productos = $this->productoModel->listarProductos();
        }
        $selected = $this->carruselModel->getAll();
        include __DIR__ . '/../views/manage_carrusel.php';
    }

    // Guardar selección enviada por POST
    public function saveCarrusel() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=manageCarrusel');
            exit;
        }

        $ids = $_POST['productos'] ?? [];
        // Aseguramos que sean enteros
        $clean = array_map('intval', $ids);
        $this->carruselModel->setAll($clean);
        $_SESSION['success'] = 'Carrusel actualizado';
        header('Location: index.php?action=manageCarrusel');
        exit;
    }
}

?>
