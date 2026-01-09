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

    /* =========================
       LOGIN
       ========================= */
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=login");
            exit;
        }

        $correo   = $_POST['Correo'] ?? '';
        $password = $_POST['Password'] ?? '';

        $user = $this->userModel->login($correo, $password);

        if ($user) {

            // 🔐 SESIÓN (RESPETA TU BD)
            $_SESSION['usuario'] = [
                'NumDoc'  => $user['NumDoc'],
                'Nombre'  => $user['NombreCom'],
                'Rol'     => (int) $user['Rol'],   // 👈 CLAVE
                'NameRol' => $user['NameRol']
            ];


            // REDIRECCIÓN
            if ($user['Rol'] == 1) {
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

    /* =========================
       LOGOUT
       ========================= */
    public function logout() {

        session_destroy();
        session_start();

        $_SESSION['success'] = "Sesión cerrada correctamente";
        header("Location: index.php?action=login");
        exit;
    }

    /* =========================
       REGISTRO CLIENTE
       ========================= */
    public function register() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=crearCuenta");
            exit;
        }

        if (
            empty($_POST['NumDoc']) ||
            empty($_POST['TipoDoc']) ||
            empty($_POST['NombreCom']) ||
            empty($_POST['Correo']) ||
            empty($_POST['Password']) ||
            empty($_POST['Telefono']) ||
            empty($_POST['Direccion'])
        ) {
            $_SESSION['error'] = "Todos los campos son obligatorios";
            header("Location: index.php?action=crearCuenta");
            exit;
        }

        $passwordHash = password_hash($_POST['Password'], PASSWORD_DEFAULT);

        $ok = $this->userModel->registrarUsuario(
            $_POST['NumDoc'],
            $_POST['TipoDoc'],
            $_POST['NombreCom'],
            $_POST['Correo'],
            $passwordHash,
            $_POST['Telefono'],
            $_POST['Direccion'],
            2 // CLIENTE
        );

        if ($ok) {
            $_SESSION['success'] = "Cuenta creada correctamente";
            header("Location: index.php?action=login");
            exit;
        }

        $_SESSION['error'] = "El correo o documento ya existe";
        header("Location: index.php?action=crearCuenta");
        exit;
    }
}
