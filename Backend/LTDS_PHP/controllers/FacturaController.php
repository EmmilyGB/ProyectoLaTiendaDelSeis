<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/FacturaModel.php';
require_once __DIR__ . '/../model/DetalleFacturaModel.php';
require_once __DIR__ . '/../model/Produmodel.php';
require_once __DIR__ . '/../model/Usermodel.php';

class FacturaController {
    private $db;
    private $facturaModel;
    private $detalleModel;
    private $productoModel;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->facturaModel = new FacturaModel($this->db);
        $this->detalleModel = new DetalleFacturaModel($this->db);
        $this->productoModel = new Produmodel($this->db);
        $this->userModel = new Usermodel($this->db);
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // Mostrar formulario (carrito)
    public function formCrear() {
        // traer productos y clientes
        $productos = $this->productoModel->listarProductos();
        $clientes = $this->userModel->listarUsuariosWithDocAndRole();
        include __DIR__ . '/../views/insert_factura.php';
    }



    // Finalizar y guardar factura + detalles
    public function guardarFactura() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $NumDoc = $_POST['NumDoc'] ?? null;
            if (!$NumDoc) {
                $_SESSION['error'] = "Debes seleccionar un cliente";
                header("Location: index.php?action=insertFactura");
                exit;
            }
            $cart = $_SESSION['cart'] ?? [];
            if (empty($cart)) {
                $_SESSION['error'] = "El carrito está vacío";
                header("Location: index.php?action=insertFactura");
                exit;
            }

            // calcular total
            $total = 0;
            foreach ($cart as $item) $total += $item['Subtotal'];

            // Iniciar transacción
            try {
                $this->db->beginTransaction();

                // Insertar factura (Fecha actual)
                $idFactura = $this->facturaModel->crearFactura($NumDoc, $total);

                // Insertar cada detalle y actualizar stock
                foreach ($cart as $it) {
                    $this->detalleModel->insertDetalle($idFactura, $it['IdProducto'], $it['Cantidad'], $it['PrecioUnitario'], $it['Subtotal']);
                    // reducir stock
                    $this->productoModel->reduceStock($it['IdProducto'], $it['Cantidad']);
                }

                $this->db->commit();
                // limpiar carrito
                unset($_SESSION['cart']);
                header("Location: index.php?action=viewFactura&id=" . $idFactura);
                exit;
            } catch (Exception $e) {
                $this->db->rollBack();
                $_SESSION['error'] = "Error al guardar: " . $e->getMessage();
                header("Location: index.php?action=insertFactura");
                exit;
            }
        }
    }

    // Listar facturas
    public function listar() {
        $facturas = $this->facturaModel->listarFacturas();
        include __DIR__ . '/../views/list_factura.php';
    }

    // Ver factura completa con detalles
    public function verFactura() {
        $id = intval($_GET['id']);
        $factura = $this->facturaModel->getFacturaById($id);
        $detalles = $this->detalleModel->getDetallesByFactura($id);
        include __DIR__ . '/../views/view_factura.php';
    }

    public function eliminarFactura() {
    $id = intval($_GET['id'] ?? 0);

    if ($id <= 0) {
        $_SESSION['error'] = "ID de factura inválido.";
        header("Location: index.php?action=listFactura");
        exit;
    }

    try {
        // Primero borrar detalles
        $this->detalleModel->deleteDetallesByFactura($id);

        // Luego borrar factura
        $this->facturaModel->deleteFactura($id);

        $_SESSION['success'] = "Factura eliminada correctamente.";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error al eliminar: " . $e->getMessage();
    }

    header("Location: index.php?action=listFactura");
    exit;
}

public function verCarrito()
{
    $cart = $_SESSION['cart'] ?? [];
    include __DIR__ . '/../views_client/carrito.php';
}

public function addToCart()
{
    // Asegurar sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
    }

    // Obtener ID del producto
    $id = intval($_GET['id'] ?? 0);

    if ($id <= 0) {
        header("Location: index.php");
        exit;
    }

    // Obtener producto desde BD
    $p = $this->productoModel->getProductoById($id);

    if (!$p) {
        header("Location: index.php");
        exit;
    }

    // Inicializar carrito si no existe
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Si el producto ya está en el carrito
    if (isset($_SESSION['cart'][$id])) {

        $_SESSION['cart'][$id]['Cantidad']++;
        $_SESSION['cart'][$id]['Subtotal'] =
            $_SESSION['cart'][$id]['Cantidad'] * $_SESSION['cart'][$id]['PrecioUnitario'];

        // 🔥 Asegurar que la foto siempre esté
        $_SESSION['cart'][$id]['Foto'] = $p['Foto'];

    } else {

        // Agregar producto nuevo al carrito
        $_SESSION['cart'][$id] = [
            'IdProducto'      => $id,
            'Nombre'          => $p['Nombre'],
            'PrecioUnitario'  => $p['Precio'],
            'Cantidad'        => 1,
            'Foto'            => $p['Foto'],
            'Subtotal'        => $p['Precio']
        ];
    }

    // Redirigir al carrito
    header("Location: index.php?action=verCarrito");
    exit;
}

public function updateCart()
{
    $id = intval($_GET['id'] ?? 0);
    $op = $_GET['op'] ?? '';

    if ($id <= 0 || !isset($_SESSION['cart'][$id])) {
        header("Location: index.php?action=verCarrito");
        exit;
    }

    if ($op === 'plus') {
        $_SESSION['cart'][$id]['Cantidad']++;
    }

    if ($op === 'minus') {
        $_SESSION['cart'][$id]['Cantidad']--;
        if ($_SESSION['cart'][$id]['Cantidad'] <= 0) {
            unset($_SESSION['cart'][$id]);
            header("Location: index.php?action=verCarrito");
            exit;
        }
    }

    $_SESSION['cart'][$id]['Subtotal'] =
        $_SESSION['cart'][$id]['Cantidad'] *
        $_SESSION['cart'][$id]['PrecioUnitario'];

    header("Location: index.php?action=verCarrito");
    exit;
}

public function removeFromCart()
{
    $id = intval($_GET['id'] ?? 0);

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    header("Location: index.php?action=verCarrito");
    exit;
}





}
?>
