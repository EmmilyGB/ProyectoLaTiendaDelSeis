<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Usermodel.php';

class AuthController {

    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new Usermodel($this->db);
    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $correo   = $_POST['Correo'] ?? '';
            $password = $_POST['Password'] ?? '';

            $user = $this->userModel->login($correo, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'NumDoc' => $user['NumDoc'],
                    'Nombre' => $user['NombreCom'],
                    'Rol'    => $user['NameRol']
                ];

                // RESPETAR MAYÚSCULAS DE TU BD
                if ($user['NameRol'] === 'Admin') {
                    header("Location: index.php?action=dashboard");
                } else {
                    header("Location: index.php?action=home");
                }
                exit;
            }

            $_SESSION['error'] = "Correo o contraseña incorrectos";
            header("Location: index.php?action=login");
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
