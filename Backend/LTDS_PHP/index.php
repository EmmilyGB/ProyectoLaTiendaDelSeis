<?php
ob_start();

require_once __DIR__ . '/bootstrap.php';

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/olvidarController.php';
require_once __DIR__ . '/controllers/Usercontroller.php';
require_once __DIR__ . '/controllers/Tipodocumcontroller.php';
require_once __DIR__ . '/controllers/RolController.php';
require_once __DIR__ . '/controllers/Producontroller.php';
require_once __DIR__ . '/controllers/CategoriaController.php';
require_once __DIR__ . '/controllers/ColorController.php';
require_once __DIR__ . '/controllers/MarcaController.php';
require_once __DIR__ . '/controllers/TallaController.php';
require_once __DIR__ . '/controllers/FavoritoController.php';
require_once __DIR__ . '/controllers/FacturaController.php';
require_once __DIR__ . '/controllers/OfertaController.php';

$authController = new AuthController();
$olvidarController = new olvidarController((new Database())->getConnection());
$userController = new Usercontroller();
$tipodocumController = new Tipodocumcontroller();
$rolController = new RolController();
$produController = new Producontroller();
$categoriaController = new CategoriaController();
$colorController = new ColorController();
$marcaController = new MarcaController();
$tallaController = new TallaController();
$favoritoController = new FavoritoController();
$facturaController = new FacturaController();

$action = $_GET['action'] ?? 'home';

$adminActions = [
    'dashboard',
    'insertuser', 'listUser', 'UsersByName', 'editUser', 'updateUser', 'deleteUser',
    'insertProdu', 'listProduct', 'ProductsByName', 'editProduct', 'updateProduct',
    'updateProductTallas', 'deleteProduct', 'deleteProductVariante', 'deleteProductFoto',
    'setProductFotoPrincipal',
    'manageCategorias', 'insertCategoria', 'listCategoriaAdmin', 'editCategoria',
    'updateCategoria', 'deleteCategoria',
    'manageMarcas', 'insertMarca', 'deleteMarca',
    'manageCarrusel', 'saveCarrusel', 'manageOfertas', 'saveOfertas',
    'listFactura', 'viewFactura', 'viewFacturaPdf', 'deleteFactura',
    'inhabilitarFactura', 'updatePedidoEstado'
];

$authActions = [
    'verCarrito', 'addToCart', 'updateCart', 'removeFromCart', 'finalizarCompra',
    'misFavoritos', 'addFavorite', 'removeFavorite',
    'logout', 'insertFactura', 'saveFactura', 'misPedidos', 'verMiPedido', 'verMiPedidoPdf'
];

if (!isset($_SESSION['usuario']) && (in_array($action, $adminActions, true) || in_array($action, $authActions, true))) {
    header('Location: index.php?action=login');
    exit;
}

if (isset($_SESSION['usuario'])) {
    $rolUsuario = (int)($_SESSION['usuario']['Rol'] ?? 0);
    if (in_array($action, $adminActions, true) && $rolUsuario !== 1) {
        header('Location: index.php?action=home');
        exit;
    }
}

$loadCatalogPage = function (?string $categoriaNombre, bool $soloOferta, string $viewPath) use (
    $colorController,
    $tallaController,
    $categoriaController,
    $produController,
    $favoritoController
) {
    $colores = $colorController->listColor();
    $tallas = $tallaController->listTalla();

    $catId = null;
    if ($categoriaNombre !== null) {
        $cat = $categoriaController->getCategoriaByName($categoriaNombre);
        $catId = $cat ? $cat['IdCategoria'] : null;
    }

    $page = max(1, (int)($_GET['page'] ?? 1));
    $perPage = 30;
    $orderBy = $_GET['orderBy'] ?? null;

    $result = $produController->listarByFiltersPaged(
        $catId,
        $_GET['IdColor'] ?? null,
        $_GET['IdTalla'] ?? null,
        $soloOferta,
        $page,
        $perPage,
        $orderBy
    );

    $productos = $result['items'];
    $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];

    include $viewPath;
};

switch ($action) {
    case 'home':
        require_once __DIR__ . '/model/CarruselModel.php';
        $carruselModel = new CarruselModel((new Database())->getConnection());
        $ids = $carruselModel->getAll();
        $productos = !empty($ids) ? $produController->getProductsByIds($ids) : $produController->listar();
        include 'views_client/home.php';
        break;

    case 'homeAlt':
        require_once __DIR__ . '/model/CarruselModel.php';
        $carruselModel = new CarruselModel((new Database())->getConnection());
        $ids = $carruselModel->getAll();
        $productos = !empty($ids) ? $produController->getProductsByIds($ids) : $produController->listar();
        include 'views_client/home_alt.php';
        break;

    case 'verProducto':
        $produController->verProducto();
        break;

    case 'misFavoritos':
        $favoritoController->showFavorites();
        break;

    case 'addFavorite':
        $favoritoController->add();
        break;

    case 'removeFavorite':
        $favoritoController->remove();
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

    case 'finalizarCompra':
        $facturaController->finalizarCompra();
        break;

    case 'misPedidos':
        $facturaController->misPedidos();
        break;

    case 'verMiPedido':
        $facturaController->verMiPedido();
        break;

    case 'verMiPedidoPdf':
        $facturaController->verMiPedidoPdf();
        break;

    case 'faq':
        include 'views_client/FAQ.php';
        break;

    case 'guiaTallas':
        include 'views_client/guiaTallas.php';
        break;

    case 'hombre':
        $loadCatalogPage('Hombre', false, 'views_client/hombre.php');
        break;

    case 'mujer':
        $loadCatalogPage('Mujer', false, 'views_client/mujer.php');
        break;

    case 'unisex':
        $loadCatalogPage('Unisex', false, 'views_client/unisex.php');
        break;

    case 'ofertas':
        $colores = $colorController->listColor();
        $tallas = $tallaController->listTalla();
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 30;
        $orderBy = $_GET['orderBy'] ?? null;
        $result = $produController->listarOfertasPaged(
            $_GET['IdColor'] ?? null,
            $_GET['IdTalla'] ?? null,
            $page,
            $perPage,
            $orderBy
        );
        $productos = $result['items'];
        $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];
        include 'views_client/ofertas.php';
        break;

    case 'buscarProductos':
        $busqueda = $_GET['busqueda'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 30;
        $orderBy = $_GET['orderBy'] ?? null;
        $result = $produController->ProductsByNamePaged($busqueda, $page, $perPage, $orderBy);
        $productos = $result['items'];
        $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];
        include 'views_client/buscar.php';
        break;

    case 'manageCarrusel':
        require_once __DIR__ . '/controllers/CarruselController.php';
        (new CarruselController())->manageCarrusel();
        break;

    case 'saveCarrusel':
        require_once __DIR__ . '/controllers/CarruselController.php';
        (new CarruselController())->saveCarrusel();
        break;

    case 'manageOfertas':
        (new OfertaController())->manageOfertas();
        break;

    case 'saveOfertas':
        (new OfertaController())->saveOfertas();
        break;

    case 'perfil':
        $authController->perfil();
        break;

    case 'updatePerfil':
        $authController->actualizarPerfil();
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            include 'views_client/inicioSesion.php';
        }
        break;

    case 'crearCuenta':
        $authController->crearCuenta();
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->crearCuenta();
        }
        break;

    case 'insertuser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->insertuser();
        } else {
            $roles = $rolController->listRoles();
            $docums = $tipodocumController->listTipoDocum();
            include 'views/insert_user.php';
        }
        break;

    case 'UsersByName':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $NombreCom = $_GET['NombreCom'] ?? '';
        $result = $userController->UsersByNamePaged($NombreCom, $page, $perPage);
        $usuarios = $result['items'];
        $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];
        include 'views/list_UserByName.php';
        break;

    case 'editUser':
        $userController->editarFormulario();
        break;

    case 'updateUser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->actualizarUsuario();
        } else {
            header('Location: index.php?action=listUser');
        }
        break;

    case 'deleteUser':
        $userController->eliminarUsuario();
        break;

    case 'listUser':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $result = $userController->listarPaged($page, $perPage);
        $usuarios = $result['items'];
        $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];
        include 'views/list_user.php';
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'olvido':
        $olvidarController->mostrarFormulario();
        break;

    case 'enviar-reset':
        $olvidarController->enviarEmail();
        break;

    case 'reset':
        $olvidarController->mostrarReset();
        break;

    case 'cambiar-password':
        $olvidarController->cambiarPassword();
        break;

    case 'dashboard':
        include 'views/dashboard.php';
        break;

    case 'insertProdu':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produController->insertProdu();
        } else {
            $categorias = $categoriaController->listCategoria();
            $colores = $colorController->listColor();
            $tallas = $tallaController->listTalla();
            $marcas = $marcaController->listMarca();
            include 'views/insert_product.php';
        }
        break;

    case 'manageCategorias':
        $categoriaController->manageCategorias();
        break;

    case 'manageMarcas':
        $marcaController->manageMarcas();
        break;

    case 'deleteMarca':
        $marcaController->deleteMarca();
        break;

    case 'insertCategoria':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriaController->insertCategoria();
        } else {
            $categoriaController->insertForm();
        }
        break;

    case 'listCategoriaAdmin':
        $categoriaController->listCategoriaAdmin();
        break;

    case 'editCategoria':
        $categoriaController->editForm();
        break;

    case 'updateCategoria':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriaController->updateCategoria();
        } else {
            header('Location: index.php?action=listCategoriaAdmin');
        }
        break;

    case 'deleteCategoria':
        $categoriaController->deleteCategoria();
        break;

    case 'insertMarca':
        $marcaController->insertMarca();
        break;

    case 'listProduct':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $result = $produController->listarPaged($page, $perPage);
        $productos = $result['items'];
        $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];
        include 'views/list_product.php';
        break;

    case 'ProductsByName':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $Nombre = $_GET['Nombre'] ?? '';
        $result = $produController->ProductsByNamePaged($Nombre, $page, $perPage);
        $productos = $result['items'];
        $pagination = ['page' => $result['page'], 'totalPages' => $result['totalPages']];
        include 'views/list_ProduByName.php';
        break;

    case 'editProduct':
        $produController->editarFormulario();
        break;

    case 'updateProduct':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produController->actualizarProducto();
        } else {
            header('Location: index.php?action=listProduct');
        }
        break;

    case 'updateProductTallas':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produController->actualizarTallasStock();
        } else {
            header('Location: index.php?action=listProduct');
        }
        break;

    case 'deleteProduct':
        $produController->eliminarProducto();
        break;

    case 'deleteProductVariante':
        $produController->eliminarVarianteDesdeEdicion();
        break;

    case 'deleteProductFoto':
        $produController->eliminarFotoProducto();
        break;

    case 'setProductFotoPrincipal':
        $produController->marcarFotoPrincipal();
        break;

    case 'insertFactura':
        $facturaController->formCrear();
        break;

    case 'saveFactura':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $facturaController->guardarFactura();
        } else {
            header('Location: index.php?action=insertFactura');
        }
        break;

    case 'listFactura':
        $facturaController->listar();
        break;

    case 'viewFactura':
        $facturaController->verFactura();
        break;

    case 'viewFacturaPdf':
        $facturaController->verFacturaPdf();
        break;

    case 'deleteFactura':
        $facturaController->eliminarFactura();
        break;

    case 'inhabilitarFactura':
        $facturaController->inhabilitarFactura();
        break;

    case 'updatePedidoEstado':
        $facturaController->actualizarEstadoPedido();
        break;

    default:
        header('Location: index.php?action=home');
        exit;
}
