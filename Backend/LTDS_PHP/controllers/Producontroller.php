<?php
require_once __DIR__ . '/../model/Produmodel.php';
require_once __DIR__ . '/../model/CategoriaModel.php';
require_once __DIR__ . '/../model/ColorModel.php';
require_once __DIR__ . '/../model/TallaModel.php';
require_once __DIR__ . '/../model/MarcaModel.php';

class Producontroller {

    private $db;
    private $Produmodel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->Produmodel = new Produmodel($this->db);
    }

    /* =========================
    INSERTAR PRODUCTO
    ========================== */
    public function insertProdu() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        // VALIDACIONES BÁSICAS
        if (
            empty($_POST['Nombre']) ||
            empty($_POST['Precio']) ||
            empty($_POST['Stock'])
        ) {
            $_SESSION['error'] = "Todos los campos obligatorios deben estar llenos";
            header("Location: index.php?action=insertProdu");
            exit;
        }

        if ($_POST['Stock'] < 0) {
            $_SESSION['error'] = "El stock no puede ser negativo";
            header("Location: index.php?action=insertProdu");
            exit;
        }

        /* ===== FOTO ===== */
        $fotoNombre = null;

        if (!empty($_FILES['Foto']['name'])) {
            $allowed = ['jpg','jpeg','png','gif','webp'];
            $ext = strtolower(pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                $_SESSION['error'] = 'Formato de imagen no permitido';
                header('Location: index.php?action=insertProdu');
                exit;
            }

            $fotoNombre = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['Foto']['name']);
            move_uploaded_file(
                $_FILES['Foto']['tmp_name'],
                __DIR__ . '/../uploads/' . $fotoNombre
            );
        }

        // VALIDACIONES
            $precio = $_POST['Precio'];
            $stock  = $_POST['Stock'];
            $oferta = $_POST['Oferta'] ?? 0;

            if ($precio <= 0) {
                $_SESSION['error'] = 'El precio debe ser mayor a 0';
                header('Location: index.php?action=insertProdu');
                exit;
            }

            if ($stock < 0) {
                $_SESSION['error'] = 'El stock no puede ser negativo';
                header('Location: index.php?action=insertProdu');
                exit;
            }

            if ($oferta < 0) {
                $_SESSION['error'] = 'La oferta no puede ser negativa';
                header('Location: index.php?action=insertProdu');
                exit;
            }

            if ($oferta > $precio) {
                $_SESSION['error'] = 'La oferta no puede ser mayor que el precio';
                header('Location: index.php?action=insertProdu');
                exit;
            }


        /* ===== INSERTAR ===== */
        $this->Produmodel->InsertarProducto(
            $_POST['Nombre'],
            $_POST['Precio'],
            $_POST['Material'],
            $_POST['IdTalla'],
            $_POST['IdColor'],
            $_POST['Stock'],
            $_POST['Oferta'] ?? 0,
            $_POST['IdCategoria'],
            $_POST['IdMarca'],
            $_POST['Descripcion'],
            $_POST['UdMedida'],
            $fotoNombre
        );

        header("Location: index.php?action=listProduct");
        exit;
    }

    /* =========================
    LISTAR PRODUCTOS
    ========================== */
    public function listar() {
        return $this->Produmodel->listarProductos();
    }

    // Wrapper para obtener productos por una lista de ids
    public function getProductsByIds(array $ids) {
        return $this->Produmodel->getProductsByIds($ids);
    }

    public function listarByCategory($categoriaName, $idColor = null, $idTalla = null, $onlyOferta = false) {
        $productos = $this->Produmodel->listarByCategory($categoriaName, $idColor, $idTalla, $onlyOferta);

        // Log para depuración: categoría y cantidad devuelta
        $logLine = date('[Y-m-d H:i:s]') . " LISTAR_BY_CAT: categoria={$categoriaName} color={$idColor} talla={$idTalla} onlyOferta=" . ($onlyOferta?"1":"0") . " count=" . count($productos) . "\n";
        @file_put_contents(__DIR__ . '/../logs/product_debug.log', $logLine, FILE_APPEND);

        return $productos;
    }

    /**
     * Wrapper para listar usando filtros (IdCategoria numérico en lugar de nombre)
     */
    public function listarByFilters($idCategoria = null, $idColor = null, $idTalla = null, $onlyOferta = false) {
        $productos = $this->Produmodel->listarByFilters($idCategoria, $idColor, $idTalla, $onlyOferta);
        $logLine = date('[Y-m-d H:i:s]') . " LISTAR_BY_FILTERS: categoria_id=" . ($idCategoria ?? 'null') . " color={$idColor} talla={$idTalla} onlyOferta=" . ($onlyOferta?"1":"0") . " count=" . count($productos) . "\n";
        @file_put_contents(__DIR__ . '/../logs/product_debug.log', $logLine, FILE_APPEND);
        return $productos;
    }

    public function ProductsByName() {
        $Nombre = $_GET['Nombre'] ?? '';
        return $this->Produmodel->getProductoByNombre($Nombre);
    }

    /* =========================
    FORMULARIO EDITAR
    ========================== */
    public function editarFormulario() {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?action=listProduct");
            exit;
        }

        $producto = $this->Produmodel->getProductoById($id);

        $categoriaModel = new CategoriaModel($this->db);
        $categorias = $categoriaModel->getCategoria();

        $colorModel = new ColorModel($this->db);
        $colores = $colorModel->getColor();

        $marcaModel = new MarcaModel($this->db);
        $marcas = $marcaModel->getMarca();

        // ✅ CORRECCIÓN DE TALLAS
        $tallaModel = new TallaModel($this->db);
        $tallas = $tallaModel->getTalla();


        include __DIR__ . '/../views/edit_product.php';
    }

            /* ========================= 
        ACTUALIZAR PRODUCTO
        ========================== */
        public function actualizarProducto() {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return;
            }

            $id = $_POST['IdProducto'];

            // =========================
            // VALIDACIONES
            // =========================
            $precio = $_POST['Precio'];
            $stock  = $_POST['Stock'];
            $oferta = $_POST['Oferta'] ?? 0;

            if ($precio <= 0) {
                $_SESSION['error'] = 'El precio debe ser mayor a 0';
                header("Location: index.php?action=editProduct&id=$id");
                exit;
            }

            if ($stock < 0) {
                $_SESSION['error'] = 'El stock no puede ser negativo';
                header("Location: index.php?action=editProduct&id=$id");
                exit;
            }

            if ($oferta < 0) {
                $_SESSION['error'] = 'La oferta no puede ser negativa';
                header("Location: index.php?action=editProduct&id=$id");
                exit;
            }

            if ($oferta > $precio) {
                $_SESSION['error'] = 'La oferta no puede ser mayor que el precio';
                header("Location: index.php?action=editProduct&id=$id");
                exit;
            }

            // =========================
            // FOTO
            // =========================
            $fotoFinal = $_POST['Foto_actual'];

            if (!empty($_FILES['Foto']['name'])) {
                $allowed = ['jpg','jpeg','png','gif','webp'];
                $ext = strtolower(pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION));

                if (in_array($ext, $allowed)) {
                    $fotoFinal = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['Foto']['name']);
                    move_uploaded_file(
                        $_FILES['Foto']['tmp_name'],
                        __DIR__ . '/../uploads/' . $fotoFinal
                    );
                }
            }

            // =========================
            // ACTUALIZAR EN BD
            // =========================
            $this->Produmodel->actualizarProducto(
                $_POST['Nombre'],
                $precio,
                $_POST['Material'],
                $_POST['IdTalla'],
                $_POST['IdColor'],
                $stock,
                $oferta,
                $_POST['IdCategoria'],
                $_POST['IdMarca'],
                $_POST['Descripcion'],
                $_POST['UdMedida'],
                $fotoFinal,
                $id
            );

            header("Location: index.php?action=listProduct");
            exit;
        }


    /* =========================
    ELIMINAR PRODUCTO
    ========================== */
    public function eliminarProducto() {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?action=listProduct");
            exit;
        }

        $this->Produmodel->eliminarProducto($id);

        if (isset($_GET['from']) && $_GET['from'] === 'ProductsByName') {
            $nombre = $_GET['Nombre'] ?? '';
            header("Location: index.php?action=ProductsByName&Nombre=" . urlencode($nombre));
            exit;
        }

        header("Location: index.php?action=listProduct");
        exit;
    }

    /* =========================
    VER PRODUCTO (CLIENTE)
    ========================== */
    public function verProducto() {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php");
            exit;
        }

        $producto = $this->Produmodel->getProductoById($id);

        if (!$producto) {
            echo "Producto no encontrado";
            exit;
        }

        // obtener lista de tallas y colores para el selector
        $tallaModel = new TallaModel($this->db);
        $tallas = $tallaModel->getTalla();

        $colorModel = new ColorModel($this->db);
        $colores = $colorModel->getColor();

        // estado favorito si hay sesión
        $isFavorito = false;
        if (isset($_SESSION['usuario'])) {
            require_once __DIR__ . '/FavoritoController.php';
            $favCtrl = new FavoritoController();
            $isFavorito = $favCtrl->isFavorito($id);
        }

        include __DIR__ . '/../views_client/vistaproducto.php';
    }
}
