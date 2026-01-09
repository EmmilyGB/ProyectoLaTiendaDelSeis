<?php
session_start();

/* =========================
   REQUIRES
   ========================= */
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/Usercontroller.php';
require_once __DIR__ . '/controllers/Tipodocumcontroller.php';
require_once __DIR__ . '/controllers/RolController.php';

require_once __DIR__ . '/controllers/Producontroller.php';
require_once __DIR__ . '/controllers/CategoriaController.php';
require_once __DIR__ . '/controllers/ColorController.php';
require_once __DIR__ . '/controllers/MarcaController.php';
require_once __DIR__ . '/controllers/TallaController.php';

require_once __DIR__ . '/controllers/FacturaController.php';

/* =========================
   CONTROLADORES
   ========================= */
$authController      = new AuthController();
$userController      = new Usercontroller();
$tipodocumController = new Tipodocumcontroller();
$rolController       = new RolController();

$Producontroller     = new Producontroller();
$categoriaController = new CategoriaController();
$colorController     = new ColorController();
$marcaController     = new MarcaController();
$tallaController     = new TallaController();

$facturaController   = new FacturaController();

/* =========================
   ACCIÓN
   ========================= */
$action = $_GET['action'] ?? 'home';

/* =========================
   PROTECCIÓN DE RUTAS
   ========================= */

// SOLO ADMIN
$adminActions = [
    'dashboard',
    'insertuser','listUser','UsersByName','editUser','updateUser','deleteUser',
    'insertProdu','listProduct','ProductsByName','editProduct','updateProduct','deleteProduct',
    'insertFactura','saveFactura','listFactura','viewFactura','deleteFactura'
];

// REQUIEREN LOGIN
$authActions = [
    'verCarrito','addToCart','updateCart','removeFromCart','logout'
];

// NO LOGUEADO
if (!isset($_SESSION['usuario'])) {
    if (in_array($action, $adminActions) || in_array($action, $authActions)) {
        header("Location: index.php?action=login");
        exit;
    }
}

// LOGUEADO PERO NO ADMIN
if (isset($_SESSION['usuario'])) {

    $rolUsuario = (int) $_SESSION['usuario']['Rol'];

    if (in_array($action, $adminActions) && $rolUsuario !== 1) {
        header("Location: index.php?action=home");
        exit;
    }
}


/* =========================
   ROUTER
   ========================= */
switch ($action) {

    /* ===== CLIENTE / PÚBLICO ===== */
    case 'home':
        $productos = $Producontroller->listar();
        include 'views_client/home.php';
        break;

    case 'verProducto':
        $Producontroller->verProducto();
        break;

    case 'verCarrito':
        $facturaController->verCarrito();
        break;

    case 'addToCart':
        $facturaController->addToCart();
        break;

    case 'updateCart':
        $facturaController->updateCart();
        break;

    case 'removeFromCart':
        $facturaController->removeFromCart();
        break;

    case 'faq':
        include 'views_client/faq.php';
        break;

    case 'guiaTallas':
        include 'views_client/guia_tallas.php';
        break;

    case 'devoluciones':
        include 'views_client/devoluciones.php';
        break;

    /* ===== LOGIN / REGISTRO ===== */
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            include 'views_client/inicioSesion.php';
        }
        break;

    case 'crearCuenta':
        include 'views_client/crearCuenta.php';
        break;

    case 'register':
        $authController->register();
        break;

    case 'logout':
        $authController->logout();
        break;

    /* ===== ADMIN ===== */
    case 'dashboard':
        include 'views/dashboard.php';
        break;

    default:
        header("Location: index.php?action=home");
        exit;
}
