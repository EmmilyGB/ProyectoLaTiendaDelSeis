<?php
require_once './controllers/usercontroller.php';
require_once './controllers/tipodocumcontroller.php';

$userController = new usercontroller();
$tipodocumController = new tipodocumcontroller();

$action = $_GET['action'] ?? 'dashboard';
// echo "Action: " . $action . "<br>";ed

switch ($action) {
    case 'insertuser':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userController->insertuser();
            include 'views/dashboard.php';
        }else {
            $docums = $tipodocumController->listTipoDocum();
            include 'views/insert_user.php';
        }
        break;

    case 'dashboard':
    default:
        include 'views/dashboard.php';
        break;
}