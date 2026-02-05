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
        if (!isset($_SESSION['usuario'])) {
            $favoritos = [];
            include __DIR__ . '/../views_client/mis_favoritos.php';
            return;
        }

        $perPage = 30;
        $page = max(1, (int)($_GET['page'] ?? 1));
        $num = $_SESSION['usuario']['NumDoc'];
        $total = $this->favoritoModel->countByUser($num);
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $favoritos = $this->favoritoModel->listByUserPaged($num, $perPage, $offset);
        $pagination = ['page' => $page, 'totalPages' => $totalPages];
        include __DIR__ . '/../views_client/mis_favoritos.php';
    }

    public function isFavorito($IdProducto) {
        if (!isset($_SESSION['usuario'])) return false;
        return $this->favoritoModel->isFavorito($_SESSION['usuario']['NumDoc'], $IdProducto);
    }
}

?>
