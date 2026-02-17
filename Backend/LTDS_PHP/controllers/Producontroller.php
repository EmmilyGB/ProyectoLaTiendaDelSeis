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

    private function procesarFotosExtra($filesFotos)
    {
        $nombres = [];
        if (empty($filesFotos) || !isset($filesFotos['name']) || !is_array($filesFotos['name'])) {
            return $nombres;
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $total = count($filesFotos['name']);

        for ($i = 0; $i < $total; $i++) {
            if (empty($filesFotos['name'][$i])) {
                continue;
            }
            $ext = strtolower(pathinfo($filesFotos['name'][$i], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed, true)) {
                continue;
            }
            $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filesFotos['name'][$i]);
            $destName = time() . "_{$i}_" . $safeName;
            if (move_uploaded_file($filesFotos['tmp_name'][$i], __DIR__ . '/../uploads/' . $destName)) {
                $nombres[] = $destName;
            }
        }
        return $nombres;
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
            empty($_POST['Precio'])
        ) {
            $_SESSION['error'] = "Todos los campos obligatorios deben estar llenos";
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
        $precio = (int)$_POST['Precio'];
        if ($precio <= 0) {
            $_SESSION['error'] = 'El precio debe ser mayor a 0';
            header('Location: index.php?action=insertProdu');
            exit;
        }

        $tallas = $_POST['IdTallaMulti'] ?? [];
        $stocks = $_POST['StockMulti'] ?? [];
        if (empty($tallas) || empty($stocks)) {
            $_SESSION['error'] = 'Debes agregar al menos una talla con stock';
            header('Location: index.php?action=insertProdu');
            exit;
        }

        $pairs = [];
        $seenTallas = [];
        foreach ($tallas as $idx => $idTalla) {
            $idTalla = (int)$idTalla;
            $stock = isset($stocks[$idx]) ? (int)$stocks[$idx] : 0;
            if ($idTalla <= 0) {
                continue;
            }
            if ($stock < 0) {
                $_SESSION['error'] = 'El stock no puede ser negativo';
                header('Location: index.php?action=insertProdu');
                exit;
            }
            if (isset($seenTallas[$idTalla])) {
                $_SESSION['error'] = 'No repitas la misma talla en el ingreso';
                header('Location: index.php?action=insertProdu');
                exit;
            }
            $seenTallas[$idTalla] = true;
            $pairs[] = ['IdTalla' => $idTalla, 'Stock' => $stock];
        }

        if (empty($pairs)) {
            $_SESSION['error'] = 'Debes agregar al menos una talla válida';
            header('Location: index.php?action=insertProdu');
            exit;
        }

        $firstProductId = null;
        foreach ($pairs as $pair) {
            $newId = $this->Produmodel->InsertarProducto(
                $_POST['Nombre'],
                $_POST['Precio'],
                $_POST['Material'],
                $pair['IdTalla'],
                $_POST['IdColor'],
                $pair['Stock'],
                $_POST['IdCategoria'],
                $_POST['IdMarca'],
                $_POST['Descripcion'],
                $fotoNombre
            );
            if ($firstProductId === null) {
                $firstProductId = $newId;
            }
        }

        if ($firstProductId) {
            $fotosExtra = $this->procesarFotosExtra($_FILES['Fotos'] ?? null);
            foreach ($fotosExtra as $idx => $rutaFoto) {
                $this->Produmodel->insertarFotoProducto($firstProductId, $rutaFoto, $idx + 1, 0);
            }
        }

        header("Location: index.php?action=listProduct");
        exit;
    }

    /* =========================
    LISTAR PRODUCTOS
    ========================== */
    public function listar() {
        return $this->Produmodel->listarProductos();
    }

    public function listarPaged($page, $perPage) {
        $total = $this->Produmodel->countProductos();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $items = $this->Produmodel->listarProductosPaged($perPage, $offset);
        return ['items' => $items, 'total' => $total, 'page' => $page, 'totalPages' => $totalPages];
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
      
    public function listarByFiltersPaged($idCategoria = null, $idColor = null, $idTalla = null, $onlyOferta = false, $page = 1, $perPage = 30, $orderBy = null) {
    $total = $this->Produmodel->countByFilters($idCategoria, $idColor, $idTalla, $onlyOferta);
    $totalPages = max(1, (int)ceil($total / $perPage));
    $page = max(1, min($page, $totalPages));
    $offset = ($page - 1) * $perPage;
    $items = $this->Produmodel->listarByFiltersPaged($idCategoria, $idColor, $idTalla, $onlyOferta, $perPage, $offset, $orderBy);
    return ['items' => $items, 'total' => $total, 'page' => $page, 'totalPages' => $totalPages];
}

    public function listarOfertasPaged($idColor = null, $idTalla = null, $page = 1, $perPage = 30, $orderBy = null) {
    $total = $this->Produmodel->countOfertas($idColor, $idTalla);
    $totalPages = max(1, (int)ceil($total / $perPage));
    $page = max(1, min($page, $totalPages));
    $offset = ($page - 1) * $perPage;
    $items = $this->Produmodel->listarOfertasPaged($idColor, $idTalla, $perPage, $offset, $orderBy);
    return ['items' => $items, 'total' => $total, 'page' => $page, 'totalPages' => $totalPages];
}

private function listarByFiltersPaged_Internal($idCategoria = null, $idColor = null, $idTalla = null, $onlyOferta = false, $limit = 30, $offset = 0, $orderBy = null) {
    $where = [];
    $params = [];

    if ($idCategoria !== null) {
        $where[] = "p.IdCategoria = ?";
        $params[] = $idCategoria;
    }
    if ($idColor !== null) {
        $where[] = "p.IdColor = ?";
        $params[] = $idColor;
    }
    if ($idTalla !== null) {
        $where[] = "p.IdTalla = ?";
        $params[] = $idTalla;
    }
    $whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

    // Determinar ORDER BY
    $orderClause = "ORDER BY p.IdProducto DESC"; // Por defecto
    switch ($orderBy) {
        case 'precio_asc':
            $orderClause = "ORDER BY p.Precio ASC";
            break;
        case 'precio_desc':
            $orderClause = "ORDER BY p.Precio DESC";
            break;
        case 'nombre_asc':
            $orderClause = "ORDER BY p.Nombre ASC";
            break;
        case 'nombre_desc':
            $orderClause = "ORDER BY p.Nombre DESC";
            break;
        case 'mas_vendido':
            $orderClause = "ORDER BY total_vendido DESC";
            break;
    }

    $query = "SELECT 
        p.IdProducto,
        p.Nombre,
        p.Precio,
        p.Material,
        t.NomTalla AS Talla,
        c.NomColor AS Color,
        p.Stock,
        ca.NomCategoria AS Categoria,
        m.NomMarca AS Marca,
        p.Descripcion,
        p.Foto,
        p.IdTalla, p.IdColor, p.IdCategoria, p.IdMarca,
        COALESCE(SUM(df.Cantidad), 0) AS total_vendido
    FROM producto p
    INNER JOIN talla t ON p.IdTalla = t.IdTalla
    INNER JOIN color c ON p.IdColor = c.IdColor
    INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
    INNER JOIN marca m ON p.IdMarca = m.IdMarca
    LEFT JOIN detallefactura df ON p.IdProducto = df.IdProducto
    $whereClause
    GROUP BY p.IdProducto, p.Nombre, p.Precio, p.Material, t.NomTalla,
             c.NomColor, p.Stock, ca.NomCategoria, m.NomMarca,
             p.Descripcion, p.Foto, p.IdTalla, p.IdColor, p.IdCategoria, p.IdMarca
    $orderClause
    LIMIT ? OFFSET ?";

    $stmt = $this->conn->prepare($query);
    foreach ($params as $i => $param) {
        $stmt->bindValue($i + 1, $param);
    }
    $stmt->bindValue(count($params) + 1, (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(count($params) + 2, (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function ProductsByName() {
        $Nombre = $_GET['Nombre'] ?? '';
        return $this->Produmodel->getProductoByNombre($Nombre);
    }

    public function ProductsByNamePaged($Nombre, $page, $perPage, $orderBy = null) {
    $total = $this->Produmodel->countProductoByNombre($Nombre);
    $totalPages = max(1, (int)ceil($total / $perPage));
    $page = max(1, min($page, $totalPages));
    $offset = ($page - 1) * $perPage;
    $items = $this->Produmodel->getProductoByNombrePaged($Nombre, $perPage, $offset, $orderBy);
    return ['items' => $items, 'total' => $total, 'page' => $page, 'totalPages' => $totalPages];
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

        $variantes = $this->Produmodel->getVariantesByProductoBase($id);
        $fotosProducto = $this->Produmodel->getFotosByProductoBase($id);

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
            $this->Produmodel->actualizarModeloCompartido(
                $id,
                $_POST['Nombre'],
                $precio,
                $_POST['Material'],
                $_POST['IdColor'],
                $_POST['IdCategoria'],
                $_POST['IdMarca'],
                $_POST['Descripcion'],
                $fotoFinal
            );
            $this->Produmodel->updateStockById((int)$id, (int)$stock);

            $fotosExtra = $this->procesarFotosExtra($_FILES['Fotos'] ?? null);
            foreach ($fotosExtra as $idx => $rutaFoto) {
                $this->Produmodel->insertarFotoProducto((int)$id, $rutaFoto, $idx + 1, 0);
            }

            header("Location: index.php?action=listProduct");
            exit;
        }

        public function actualizarTallasStock() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return;
            }

            $idBase = $_POST['IdProducto'] ?? null;
            if (!$idBase) {
                header("Location: index.php?action=listProduct");
                exit;
            }

            $stocksActuales = $_POST['stock_variante'] ?? [];
            foreach ($stocksActuales as $idProductoVariante => $stock) {
                $stock = (int)$stock;
                if ($stock < 0) {
                    $_SESSION['error'] = 'El stock no puede ser negativo';
                    header("Location: index.php?action=editProduct&id=$idBase");
                    exit;
                }
                $this->Produmodel->updateStockById((int)$idProductoVariante, $stock);
            }

            $nuevaTalla = $_POST['NuevaIdTalla'] ?? '';
            $nuevoStock = $_POST['NuevoStock'] ?? '';
            if ($nuevaTalla !== '' && $nuevoStock !== '') {
                $nuevoStock = (int)$nuevoStock;
                if ($nuevoStock < 0) {
                    $_SESSION['error'] = 'El stock de la nueva talla no puede ser negativo';
                    header("Location: index.php?action=editProduct&id=$idBase");
                    exit;
                }

                if ($this->Produmodel->existeVarianteTallaEnModelo((int)$idBase, (int)$nuevaTalla)) {
                    $_SESSION['error'] = 'Esa talla ya existe para este modelo';
                    header("Location: index.php?action=editProduct&id=$idBase");
                    exit;
                }

                $this->Produmodel->crearVarianteDesdeBase((int)$idBase, (int)$nuevaTalla, $nuevoStock);
            }

            header("Location: index.php?action=editProduct&id=$idBase");
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

        // obtener lista de tallas/colores
        $tallaModel = new TallaModel($this->db);
        $tallas = $tallaModel->getTalla();

        $colorModel = new ColorModel($this->db);
        $colores = $colorModel->getColor();

        // variantes del mismo modelo (una fila por talla)
        $variantes = $this->Produmodel->getVariantesByProductoBase($id);
        $fotosProducto = $this->Produmodel->getFotosByProductoBase($id);

        // estado favorito si hay sesión
        $isFavorito = false;
        if (isset($_SESSION['usuario'])) {
            require_once __DIR__ . '/FavoritoController.php';
            $favCtrl = new FavoritoController();
            $isFavorito = $favCtrl->isFavorito($id);
        }

        include __DIR__ . '/../views_client/vistaproducto.php';
    }

    public function eliminarFotoProducto() {
        $idBase = (int)($_GET['idBase'] ?? 0);
        $idFoto = (int)($_GET['idFoto'] ?? 0);
        if ($idBase <= 0 || $idFoto <= 0) {
            header("Location: index.php?action=listProduct");
            exit;
        }
        $this->Produmodel->eliminarFotoById($idFoto);
        header("Location: index.php?action=editProduct&id=$idBase");
        exit;
    }

    public function marcarFotoPrincipal() {
        $idBase = (int)($_GET['idBase'] ?? 0);
        $idFoto = (int)($_GET['idFoto'] ?? 0);
        if ($idBase <= 0 || $idFoto <= 0) {
            header("Location: index.php?action=listProduct");
            exit;
        }
        $ruta = $this->Produmodel->setFotoPrincipalEnModelo($idBase, $idFoto);
        if (!$ruta) {
            $_SESSION['error'] = 'No se pudo establecer la foto principal';
        }
        header("Location: index.php?action=editProduct&id=$idBase");
        exit;
    }

    public function eliminarVarianteDesdeEdicion() {
        $idBase = (int)($_GET['idBase'] ?? 0);
        $idVariante = (int)($_GET['idVariante'] ?? 0);

        if ($idBase <= 0 || $idVariante <= 0) {
            header("Location: index.php?action=listProduct");
            exit;
        }

        if ($idBase === $idVariante) {
            $_SESSION['error'] = 'No puedes eliminar la variante base desde esta acción';
            header("Location: index.php?action=editProduct&id=$idBase");
            exit;
        }

        $this->Produmodel->eliminarProducto($idVariante);
        header("Location: index.php?action=editProduct&id=$idBase");
        exit;
    }
}
