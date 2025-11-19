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

            $this->Usermodel->InsertarUsuario(
                $_POST['NumDoc'],
                $_POST['TipoDoc'],
                $_POST['NombreCom'],
                $_POST['Correo'],
                $_POST['Password'],
                $_POST['Tel'],
                $_POST['Direccion'],
                $_POST['Rol']
            );

            header("Location: index.php?action=listUser");
            exit;
        }
    }

    // LISTAR
    public function listar() {
        return $this->Usermodel->listarUsuarios();
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
                $_POST['NumDoc'],
                $_POST['TipoDoc'],
                $_POST['NombreCom'],
                $_POST['Correo'],
                $_POST['Password'],
                $_POST['Tel'],
                $_POST['Direccion'],
                $_POST['Rol'],
                $_POST['IdUsuario']
            );

            header("Location: index.php?action=listUser");
            exit;
        }
    }

    // ELIMINAR
    public function eliminarUsuario() {
        $id = $_GET['id'];
        $this->Usermodel->eliminarUsuario($id);
        header("Location: index.php?action=listUser");
        exit;
    }
}
