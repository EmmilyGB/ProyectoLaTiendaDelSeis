<?php
require_once __DIR__ . '/controllers/usercontroller.php';
require_once __DIR__ . '/controllers/tipodocumcontroller.php';
require_once __DIR__ . '/controllers/Producontroller.php';
require_once __DIR__ . '/controllers/rolcontroller.php';
require_once __DIR__ . '/controllers/CategoriaController.php';
require_once __DIR__ . '/controllers/ColorController.php';
require_once __DIR__ . '/controllers/MarcaController.php';
require_once __DIR__ . '/controllers/TallaController.php';
require_once __DIR__ . '/controllers/FacturaController.php';

$facturaController = new FacturaController();
$userController = new usercontroller();
$tipodocumController = new tipodocumcontroller();
$Producontroller = new Producontroller();
$rolController = new RolController();
$categoriaController = new CategoriaController();
$colorController = new ColorController();
$marcaController = new MarcaController();
$tallaController = new TallaController();

$action = $_GET['action'] ?? 'dashboard';

switch ($action) {

    case 'insertuser':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userController->insertuser();
        } else {
            $docums = $tipodocumController->listTipoDocum();
            $roles = $rolController->listRoles();
            include 'views/insert_user.php';
        }
        break;

    case 'insertProdu':
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Producontroller->insertProdu();
    } else {
        $categorias = $categoriaController->listCategoria();
        $colores = $colorController->listColor();
        $marcas = $marcaController->listMarca();
        $tallas = $tallaController->listTalla();
        include 'views/insert_product.php';
    }
    break;


    case 'dashboard':
    default:
        include 'views/dashboard.php';
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

    case 'insertFactura':
        $facturaController->formCrear();
        break;

    case 'addToCart':
        $facturaController->addToCart();
        break;

    case 'removeFromCart':
        $facturaController->removeFromCart();
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

    case 'verProducto':
    $Producontroller->verProducto();
    break;

}
