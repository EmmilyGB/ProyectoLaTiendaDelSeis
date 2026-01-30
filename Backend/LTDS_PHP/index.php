<?php
ob_start();  // Buffering para evitar output antes de headers

/* =========================
    BOOTSTRAP
    ========================= */
require_once __DIR__ . '/bootstrap.php';

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
    require_once __DIR__ . '/controllers/FavoritoController.php';

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
    $favoritoController  = new FavoritoController();

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
        'manageCategorias','insertCategoria','listCategoriaAdmin','editCategoria','updateCategoria','deleteCategoria',
        'manageMarcas','insertMarca','deleteMarca',
        'listFactura','viewFactura','deleteFactura'
    ];

    // REQUIEREN LOGIN
    $authActions = [
        'verCarrito','addToCart','updateCart','removeFromCart','logout','insertFactura','saveFactura'
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
            // Intent: mostrar productos del carrusel si existen, si no usar listado general
            require_once __DIR__ . '/model/CarruselModel.php';
            $carruselModel = new CarruselModel((new Database())->getConnection());
            $ids = $carruselModel->getAll();
            if (!empty($ids)) {
                $productos = $Producontroller->getProductsByIds($ids);
            } else {
                $productos = $Producontroller->listar();
            }
            include 'views_client/home.php';
            break;

        case 'verProducto':
            $Producontroller->verProducto();
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

        case 'faq':
            include 'views_client/FAQ.php';
            break;

        case 'guiaTallas':
            include 'views_client/guiaTallas.php';
            break;

        case 'hombre':
            $colores = $colorController->listColor();
            $tallas = $tallaController->listTalla();
            // Mapeo por nombre de categoría: 'Hombre'
            $cat = $categoriaController->getCategoriaByName('Hombre');
            $catId = $cat ? $cat['IdCategoria'] : null;
            $productos = $Producontroller->listarByFilters($catId, $_GET['IdColor'] ?? null, $_GET['IdTalla'] ?? null, false);
            include 'views_client/hombre.php';
            break;

        case 'mujer':
            $colores = $colorController->listColor();
            $tallas = $tallaController->listTalla();
            // Mapeo por nombre de categoría: 'Mujer'
            $cat = $categoriaController->getCategoriaByName('Mujer');
            $catId = $cat ? $cat['IdCategoria'] : null;
            $productos = $Producontroller->listarByFilters($catId, $_GET['IdColor'] ?? null, $_GET['IdTalla'] ?? null, false);
            include 'views_client/mujer.php';
            break;

        case 'unisex':
            $colores = $colorController->listColor();
            $tallas = $tallaController->listTalla();
            // Mapeo por nombre de categoría: 'Unisex' (si existe)
            $cat = $categoriaController->getCategoriaByName('Unisex');
            $catId = $cat ? $cat['IdCategoria'] : null;
            $productos = $Producontroller->listarByFilters($catId, $_GET['IdColor'] ?? null, $_GET['IdTalla'] ?? null, false);
            include 'views_client/unisex.php';
            break;

        case 'ofertas':
            $colores = $colorController->listColor();
            $tallas = $tallaController->listTalla();
            // Ofertas: mostrar productos con oferta en cualquier categoría
            $productos = $Producontroller->listarByFilters(null, $_GET['IdColor'] ?? null, $_GET['IdTalla'] ?? null, true);
            include 'views_client/ofertas.php';
            break;

        /* ===== CARRUSEL ===== */
        case 'manageCarrusel':
            require_once __DIR__ . '/controllers/CarruselController.php';
            $carruselCtrl = new CarruselController();
            $carruselCtrl->manageCarrusel();
            break;

        case 'saveCarrusel':
            require_once __DIR__ . '/controllers/CarruselController.php';
            $carruselCtrl = new CarruselController();
            $carruselCtrl->saveCarrusel();
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
            $authController->crearCuenta();
            break;

        case 'register' :
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $authController->register();     
            }else {
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
            $usuarios = $userController->UsersByName();
            include 'views/list_UserByName.php';
            break;

        case 'editUser':
            $userController->editarFormulario();
            break;

        case 'updateUser':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userController->actualizarUsuario();
            } else {
                header("Location: index.php?action=listUser");
            }
            break;

        case 'deleteUser':
            $userController->eliminarUsuario();
            break;

        case 'listUser':
            $usuarios = $userController->listar();
            include 'views/list_user.php';
            break;

        case 'logout':
            $authController->logout();
            break;

        /* ===== ADMIN ===== */
        case 'dashboard':
            include 'views/dashboard.php';
            break;

        // === PRODUCTOS ===
        case 'insertProdu':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $Producontroller->insertProdu();
            } else {
                $categorias = $categoriaController->listCategoria();
                $colores = $colorController->listColor();
                $tallas = $tallaController->listTalla();
                $marcas = $marcaController->listMarca();
                include 'views/insert_product.php';
            }
            break;

        // Gestión unificada de categorías y marcas desde el panel de producto
        case 'manageCategorias':
            $categoriaController->manageCategorias();
            break;

        case 'manageMarcas':
            $marcaController->manageMarcas();
            break;

        case 'deleteMarca':
            $marcaController->deleteMarca();
            break;

        /* ===== CATEGORÍAS (ADMIN) ===== */
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $marcaController->insertMarca();
            } else {
                $marcaController->insertMarca();
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $Producontroller->actualizarProducto();
            } else {
                header("Location: index.php?action=listProduct");
            }
            break;

        case 'deleteProduct':
            $Producontroller->eliminarProducto();
            break;

        // === FACTURAS ===
        case 'insertFactura':
            $facturaController->formCrear();
            break;

        case 'saveFactura':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $facturaController->guardarFactura();
            } else {
                header("Location: index.php?action=insertFactura");
            }
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

        default:
            header("Location: index.php?action=home");
            exit;
    }
