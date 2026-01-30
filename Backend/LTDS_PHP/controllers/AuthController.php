<?php
require_once __DIR__ . '/../model/Usermodel.php';
require_once __DIR__ . '/../model/TipoDocModel.php';  // Agregado para incluir la clase

/* =========================
    CONTROLLER: AuthController
    ========================= */

class AuthController {

    private $db;
    private $userModel;
    private $tipoDocModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tipoDocModel = new TipoDocModel($this->db);
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

        $correo   = trim(strtolower($_POST['Correo'] ?? ''));
        $password = $_POST['Password'] ?? '';

        // Obtener usuario por correo para distinguir ausencia de usuario vs contraseña incorrecta
        $user = $this->userModel->getUsuarioByCorreo($correo);

        if (!$user) {
            error_log(date('[Y-m-d H:i:s]') . " LOGIN: no user for {$correo}\n", 3, __DIR__ . '/../logs/login_debug.log');
            $_SESSION['error'] = "Correo o contraseña incorrectos";
            header("Location: index.php?action=login");
            exit;
        }

        if (!password_verify($password, $user['Password'])) {
            // No registramos la contraseña, solo el intento
            $partialHash = substr($user['Password'], 0, 12);
            error_log(date('[Y-m-d H:i:s]') . " LOGIN: password mismatch for {$correo} hash_prefix={$partialHash}\n", 3, __DIR__ . '/../logs/login_debug.log');
            $_SESSION['error'] = "Correo o contraseña incorrectos";
            header("Location: index.php?action=login");
            exit;
        }

        // Éxito: establecer sesión
        $_SESSION['usuario'] = [
            'NumDoc'  => $user['NumDoc'],
            'Nombre'  => $user['NombreCom'],
            'Rol'     => (int) $user['Rol'],
            'NameRol' => $user['NameRol']
        ];

        session_regenerate_id(true);
        $role = isset($user['Rol']) ? (int)$user['Rol'] : (int)($_SESSION['usuario']['Rol'] ?? 0);
        $_SESSION['usuario']['Rol'] = $role;
        session_write_close();

        if ($role === 1) {
            header("Location: index.php?action=dashboard");
        } else {
            header("Location: index.php?action=home");
        }
        exit;
    }

    /* =========================
       LOGOUT
       ========================= */
    public function logout() {

        // Limpiar y destruir sesión
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        // Iniciar nueva sesión para mensajes flash
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
        if ($_POST['Password'] !== $_POST['PasswordConfirm']) {
            $_SESSION['error'] = "Las contraseñas no coinciden";
            header("Location: index.php?action=crearCuenta");
            exit;
        }

        $ok = $this->userModel->InsertarUsuario(
            $_POST['NumDoc'],
            $_POST['TipoDoc'],
            $_POST['NombreCom'],
            $_POST['Correo'],
            $_POST['Password'],  // Pasa sin hash
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

    public function crearCuenta() {
        $tipoDocs = $this->tipoDocModel->gettipodocum();

        include __DIR__ . '/../views_client/crearCuenta.php';
    }

    public function inicioSesion() {
        include __DIR__ . '/../views_client/inicioSesion.php';
    }
}