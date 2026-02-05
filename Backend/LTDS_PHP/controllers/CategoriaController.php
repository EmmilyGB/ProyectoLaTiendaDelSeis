<?php
require_once __DIR__ . '/../model/CategoriaModel.php';

/* =========================
    CONTROLLER: CategoriaController
    ========================= */
class CategoriaController {
    private $CategoriaModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->CategoriaModel = new CategoriaModel($this->db);
    }

    public function listCategoria() {
        return $this->CategoriaModel->getCategoria();
    }

    public function getCategoriaByName($name) {
        return $this->CategoriaModel->getCategoriaByName($name);
    }

    // === ADMIN: mostrar lista en panel ===
    public function listCategoriaAdmin() {
        $perPage = 20;
        $page = max(1, (int)($_GET['page'] ?? 1));
        $total = $this->CategoriaModel->countCategoria();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $categorias = $this->CategoriaModel->getCategoriaPaged($perPage, $offset);
        $pagination = ['page' => $page, 'totalPages' => $totalPages];
        include __DIR__ . '/../views/list_categoria.php';
    }

    // Mostrar formulario de insertar
    public function insertForm() {
        include __DIR__ . '/../views/insert_categoria.php';
    }

    // Guardar nueva categoría
    public function insertCategoria() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->insertForm();
            return;
        }

        $nombre = trim($_POST['NomCategoria'] ?? '');
        if ($nombre === '') {
            $_SESSION['error'] = 'El nombre de la categoría no puede estar vacío';
            header('Location: index.php?action=insertCategoria');
            exit;
        }

        $this->CategoriaModel->insertCategoria($nombre);
        header('Location: index.php?action=listCategoriaAdmin');
        exit;
    }

    // Gestionar categorias en una sola vista (agregar / eliminar)
    public function manageCategorias() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['NomCategoria'] ?? '');
            if ($nombre !== '') {
                $this->CategoriaModel->insertCategoria($nombre);
                $_SESSION['success'] = 'Categoría añadida';
            }
            header('Location: index.php?action=manageCategorias');
            exit;
        }

        $perPage = 20;
        $page = max(1, (int)($_GET['page'] ?? 1));
        $total = $this->CategoriaModel->countCategoria();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $categorias = $this->CategoriaModel->getCategoriaPaged($perPage, $offset);
        $pagination = ['page' => $page, 'totalPages' => $totalPages];
        include __DIR__ . '/../views/manage_categorias.php';
    }

    // Mostrar formulario de edición
    public function editForm() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=listCategoriaAdmin');
            exit;
        }
        $categoria = $this->CategoriaModel->getCategoriaById($id);
        if (!$categoria) {
            header('Location: index.php?action=listCategoriaAdmin');
            exit;
        }
        include __DIR__ . '/../views/edit_categoria.php';
    }

    // Actualizar categoría
    public function updateCategoria() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=listCategoriaAdmin');
            exit;
        }
        $id = $_POST['IdCategoria'] ?? null;
        $nombre = trim($_POST['NomCategoria'] ?? '');
        if (!$id || $nombre === '') {
            $_SESSION['error'] = 'Datos inválidos para actualizar';
            header('Location: index.php?action=listCategoriaAdmin');
            exit;
        }
        $this->CategoriaModel->updateCategoria($id, $nombre);
        header('Location: index.php?action=listCategoriaAdmin');
        exit;
    }

    // Eliminar categoría
    public function deleteCategoria() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=listCategoriaAdmin');
            exit;
        }
        $this->CategoriaModel->deleteCategoria($id);
        header('Location: index.php?action=listCategoriaAdmin');
        exit;
    }
}
?>
