<?php
require_once __DIR__ . '/../model/MarcaModel.php';

/* =========================
    CONTROLLER: MarcaController
    ========================= */
class MarcaController {
    private $MarcaModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->MarcaModel = new MarcaModel($this->db);
    }

    public function listMarca() {
        return $this->MarcaModel->getMarca();
    }

    public function insertMarca() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['NomMarca'] ?? '');
            if ($nombre === '') {
                $_SESSION['error'] = "El nombre de la marca es obligatorio";
                header("Location: index.php?action=insertMarca");
                exit;
            }
            $this->MarcaModel->insertMarca($nombre);
            $_SESSION['success'] = "Marca añadida correctamente";
            header("Location: index.php?action=insertProdu");
            exit;
        }

        include __DIR__ . '/../views/insert_marca.php';
    }

    // Mostrar y manejar gestión de marcas (agregar / eliminar) en una sola vista
    public function manageMarcas() {
        // POST -> agregar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['NomMarca'] ?? '');
            if ($nombre !== '') {
                $this->MarcaModel->insertMarca($nombre);
                $_SESSION['success'] = 'Marca añadida';
            }
            header('Location: index.php?action=manageMarcas');
            exit;
        }

        // GET -> mostrar
        $perPage = 20;
        $page = max(1, (int)($_GET['page'] ?? 1));
        $total = $this->MarcaModel->countMarca();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $marcas = $this->MarcaModel->getMarcaPaged($perPage, $offset);
        $pagination = ['page' => $page, 'totalPages' => $totalPages];
        include __DIR__ . '/../views/manage_marcas.php';
    }

    public function deleteMarca() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->MarcaModel->deleteMarca($id);
        }
        header('Location: index.php?action=manageMarcas');
        exit;
    }
}
?>
