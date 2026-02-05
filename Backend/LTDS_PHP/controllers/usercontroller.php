<?php

require_once __DIR__ . '/../model/Usermodel.php';
require_once __DIR__ . '/../model/rolmodel.php';
require_once __DIR__ . '/../model/TipoDocModel.php';

/* =========================
    CONTROLLER: Usercontroller
    ========================= */

class Usercontroller {

    private $db;
    public  $Usermodel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->Usermodel = new Usermodel($this->db);
    }

    // INSERTAR
    public function insertuser() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = $this->Usermodel->InsertarUsuario(
                $_POST['NumDoc'],
                $_POST['IdTipoDocum'],
                $_POST['NombreCom'],
                $_POST['Correo'],
                $_POST['Password'],
                $_POST['Tel'],
                $_POST['Direccion'],
                $_POST['Rol']
            );

            if ($result === "duplicate_doc") {
                $_SESSION['error'] = "El número de documento ya está registrado";
                header("Location: index.php?action=insertuser");
                exit;
            }
            if ($result === "duplicate_email") {
                $_SESSION['error'] = "El correo ya está registrado";
                header("Location: index.php?action=insertuser");
                exit;
            }
            if ($result === "duplicate_both") {
                $_SESSION['error'] = "El correo y el número de documento ya están registrados";
                header("Location: index.php?action=insertuser");
                exit;
            }

            header("Location: index.php?action=listUser");
            exit;
        }
    }

    // LISTAR
    public function listar() {
        return $this->Usermodel->listarUsuariosWithDocAndRole();
    }

    public function listarPaged($page, $perPage) {
        $total = $this->Usermodel->countUsuarios();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $items = $this->Usermodel->listarUsuariosWithDocAndRolePaged($perPage, $offset);
        return ['items' => $items, 'total' => $total, 'page' => $page, 'totalPages' => $totalPages];
    }

    public function UsersByName() {
        $NombreCom = $_GET['NombreCom'] ?? '';

        // Buscar usuarios por nombre (usa la conexión $this->db y retorna datos con rol y tipo de documento)
        $sql = "SELECT u.*, r.NameRol, t.TipoDoc
                FROM usuario u
                INNER JOIN rol r ON u.Rol = r.Rol
                INNER JOIN tipodocum t ON u.IdTipoDocum = t.IdTipoDocum
                WHERE u.NombreCom LIKE ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['%' . $NombreCom . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UsersByNamePaged($NombreCom, $page, $perPage) {
        $total = $this->Usermodel->countUsuariosByName($NombreCom);
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $items = $this->Usermodel->listarUsuariosByNamePaged($NombreCom, $perPage, $offset);
        return ['items' => $items, 'total' => $total, 'page' => $page, 'totalPages' => $totalPages];
    }


    // FORMULARIO EDITAR
    public function editarFormulario() {
        $id = $_GET['id'];

        // USUARIO
        $usuario = $this->Usermodel->getUsuarioById($id);

        // ROLES & TIPOS DOCUMENTO
        $RolModel = new RolModel($this->db);
        $roles = $RolModel->getRoles();

        $TipodocModel = new TipoDocModel($this->db);
        $docums = $TipodocModel->gettipodocum();

        include __DIR__ . '/../views/edit_user.php';
    }


    // ACTUALIZAR
    public function actualizarUsuario() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->Usermodel->actualizarUsuario(
                $_POST['NumDoc'],          // Nuevo NumDoc
                $_POST['IdTipoDocum'],     // TipoDoc (FK)
                $_POST['NombreCom'],
                $_POST['Correo'],
                $_POST['Password'],
                $_POST['Tel'],
                $_POST['Direccion'],
                $_POST['Rol'],
                $_POST['NumDocOriginal']   // NumDoc viejo (clave primaria)
            );

            header("Location: index.php?action=listUser");
            exit;
        }
    }


    // ELIMINAR
    public function eliminarUsuario() {
        $id = $_GET['id'];
        $this->Usermodel->eliminarUsuario($id);

        // Si venía de UsersByName, volver allí
        if (isset($_GET['from']) && $_GET['from'] === 'UsersByName') {
            $nombre = $_GET['NombreCom'] ?? '';
            header("Location: index.php?action=UsersByName&NombreCom=" . urlencode($nombre));
            exit;
        }

        header("Location: index.php?action=listUser");
        exit;
    }

}
?>
