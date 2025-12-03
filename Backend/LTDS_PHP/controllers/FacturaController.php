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

    // Añadir ítem al "cart" (AJAX / POST from form JS)
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['IdProducto']);
            $qty = intval($_POST['Cantidad']);
            if ($id <= 0 || $qty <= 0) {
                echo json_encode(['ok' => false, 'msg' => 'Producto o cantidad inválida']);
                return;
            }
            // get product
            $p = $this->productoModel->getProductoById($id);
            if (!$p) {
                echo json_encode(['ok' => false, 'msg' => 'Producto no existe']);
                return;
            }
            // build cart in session
            if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
            // if exists, accumulate
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['Cantidad'] += $qty;
                $_SESSION['cart'][$id]['Subtotal'] = $_SESSION['cart'][$id]['Cantidad'] * $p['Precio'];
            } else {
                $_SESSION['cart'][$id] = [
                    'IdProducto' => $id,
                    'Nombre' => $p['Nombre'],
                    'PrecioUnitario' => $p['Precio'],
                    'Cantidad' => $qty,
                    'Subtotal' => $qty * $p['Precio']
                ];
            }
            echo json_encode(['ok' => true, 'cart' => $_SESSION['cart']]);
        }
    }

    // Remover item del carrito (POST)
    public function removeFromCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['IdProducto']);
            if (isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
            }
            echo json_encode(['ok' => true, 'cart' => $_SESSION['cart'] ?? []]);
        }
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


}
?>
