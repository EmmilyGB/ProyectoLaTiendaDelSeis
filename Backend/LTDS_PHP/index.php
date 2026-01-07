<?php
session_start();

require_once __DIR__ . '/controllers/usercontroller.php';
require_once __DIR__ . '/controllers/tipodocumcontroller.php';
require_once __DIR__ . '/controllers/Producontroller.php';
require_once __DIR__ . '/controllers/rolcontroller.php';
require_once __DIR__ . '/controllers/CategoriaController.php';
require_once __DIR__ . '/controllers/ColorController.php';
require_once __DIR__ . '/controllers/MarcaController.php';
require_once __DIR__ . '/controllers/TallaController.php';
require_once __DIR__ . '/controllers/FacturaController.php';
require_once __DIR__ . '/controllers/AuthController.php';

// Controllers
$authController = new AuthController();
$userController      = new Usercontroller();
$tipodocumController = new Tipodocumcontroller();
$Producontroller     = new Producontroller();
$rolController       = new RolController();
$categoriaController = new CategoriaController();
$colorController     = new ColorController();
$marcaController     = new MarcaController();
$tallaController     = new TallaController();
$facturaController   = new FacturaController();

// Acción
$action = $_GET['action'] ?? 'home';

switch ($action) {

    /* =====================
    CLIENTE / PUBLICO
    ====================== */

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

    /* =====================
    LOGIN
    ====================== */
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            include 'views_client/inicioSesion.php';
        }
        break;

    case 'logout':
        $authController->logout();
        break;



    /* =====================
    ADMIN
    ====================== */

    case 'dashboard':
        include 'views/dashboard.php';
        break;

    /* ===== USUARIOS ===== */

    case 'insertuser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->insertuser();
        } else {
            $docums = $tipodocumController->listTipoDocum();
            $roles  = $rolController->listRoles();
            include 'views/insert_user.php';
        }
        break;

    case 'listUser':
        $usuarios = $userController->listar();
        include 'views/list_user.php';
        break;

    case 'UsersByName':
        $usuarios = $userController->UsersByName();
        include 'views/list_UserByName.php';
        break;

    case 'editUser':
        $userController->editarFormulario();
        break;

    case 'updateUser':
        $userController->actualizarUsuario();
        break;

    case 'deleteUser':
        $userController->eliminarUsuario();
        break;

    case 'error_duplicate':
        include 'views/error_duplicate.php';
        break;

    /* ===== PRODUCTOS ===== */

    case 'insertProdu':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Producontroller->insertProdu();
        } else {
            $categorias = $categoriaController->listCategoria();
            $colores    = $colorController->listColor();
            $marcas     = $marcaController->listMarca();
            $tallas     = $tallaController->listTalla();
            include 'views/insert_product.php';
        }
        break;

    case 'listProduct':
        $productos = $Producontroller->listar();
        include 'views/list_product.php';
        break;

    case 'ProductsByName':
        $productos = $Producontroller->ProductsByName();
        include 'views/list_ProduByName.php';
        break;

    case 'editProduct':
        $Producontroller->editarFormulario();
        break;

    case 'updateProduct':
        $Producontroller->actualizarProducto();
        break;

    case 'deleteProduct':
        $Producontroller->eliminarProducto();
        break;

    /* ===== FACTURAS ===== */

    case 'insertFactura':
        $facturaController->formCrear();
        break;

    case 'saveFactura':
        $facturaController->guardarFactura();
        break;

    case 'listFactura':
        $facturaController->listar();
        break;

    case 'viewFactura':
        $facturaController->verFactura();
        break;

    case 'deleteFactura':
        $facturaController->eliminarFactura();
        break;

    /* =====================
    DEFAULT
    ====================== */

    default:
        header("Location: index.php?action=home");
        exit;
}
