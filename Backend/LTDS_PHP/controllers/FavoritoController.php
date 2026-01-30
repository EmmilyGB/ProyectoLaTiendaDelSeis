<?php
require_once __DIR__ . '/../model/FavoritoModel.php';

class FavoritoController {
    private $db;
    private $favoritoModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->favoritoModel = new FavoritoModel($this->db);
    }

    public function add() {
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = 'Debes iniciar sesión para agregar favoritos';
            header('Location: index.php?action=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
            exit;
        }

        $numDoc = $_SESSION['usuario']['NumDoc'];
        $this->favoritoModel->addFavorito($numDoc, $id);

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
        exit;
    }

    public function remove() {
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error'] = 'Debes iniciar sesión para eliminar favoritos';
            header('Location: index.php?action=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
            exit;
        }

        $numDoc = $_SESSION['usuario']['NumDoc'];
        $this->favoritoModel->removeFavorito($numDoc, $id);

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
        exit;
    }

    public function list() {
        if (!isset($_SESSION['usuario'])) return [];
        $num = $_SESSION['usuario']['NumDoc'];
        return $this->favoritoModel->listByUser($num);
    }

    public function showFavorites() {
        $favoritos = $this->list();
        include __DIR__ . '/../views_client/mis_favoritos.php';
    }

    public function isFavorito($IdProducto) {
        if (!isset($_SESSION['usuario'])) return false;
        return $this->favoritoModel->isFavorito($_SESSION['usuario']['NumDoc'], $IdProducto);
    }
}

?>