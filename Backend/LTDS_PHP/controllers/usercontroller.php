<?php

require_once 'config/database.php';
require_once 'model/Usermodel.php';

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

        if ($result === "duplicate") {
            include 'views/error_duplicate.php';
            exit;
        }

        header("Location: index.php?action=listUser");
        exit;
    }
}

    // LISTAR
    public function listar() {
        return $this->Usermodel->listarUsuarios();
    }

    public function UsersByName() {
        $NombreCom = $_GET['NombreCom'] ?? '';
        return $this->Usermodel->getUsuarioByNombre($NombreCom);
    }


    // FORMULARIO EDITAR
    public function editarFormulario() {
    $id = $_GET['id'];

    // USUARIO
    $usuario = $this->Usermodel->getUsuarioById($id);

    // ROLES
    require_once 'model/rolmodel.php';
    $RolModel = new RolModel($this->db);
    $roles = $RolModel->getRoles();

    include 'views/edit_user.php';
}


    // ACTUALIZAR
    public function actualizarUsuario() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $this->Usermodel->actualizarUsuario(
            $_POST['NumDoc'],          // Nuevo NumDoc
            $_POST['IdTipoDocum'],     // TipoDoc
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

    // Si no, volver a la lista general
    header("Location: index.php?action=listUser");
    exit;
}

}
