<?php
require_once './controllers/usercontroller.php';
require_once './controllers/tipodocumcontroller.php';
require_once './controllers/Producontroller.php';
require_once './controllers/rolcontroller.php';



$userController = new usercontroller();
$tipodocumController = new tipodocumcontroller();
$Producontroller = new Producontroller();
$rolController = new RolController();


$action = $_GET['action'] ?? 'dashboard';

switch ($action) {

    case 'insertuser':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userController->insertuser();
            include 'views/dashboard.php';
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

    case 'editUser':
    $userController->editarFormulario();
    break;

    case 'updateUser':
    $userController->actualizarUsuario();
    break;

    case 'deleteUser':
    $userController->eliminarUsuario();
    break;


}
