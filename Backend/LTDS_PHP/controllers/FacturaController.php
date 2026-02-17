<?php
require_once __DIR__ . '/../model/FacturaModel.php';
require_once __DIR__ . '/../model/DetalleFacturaModel.php';
require_once __DIR__ . '/../model/Produmodel.php';
require_once __DIR__ . '/../model/Usermodel.php';

/* =========================
    CONTROLLER: FacturaController
    ========================= */
class FacturaController {
    private $db;
    private $facturaModel;
    private $detalleModel;
    private $productoModel;
    private $userModel;
    private $estadosPedido = ['Pendiente', 'En proceso', 'Enviado', 'Finalizado', 'Cancelado', 'Devuelto'];

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->facturaModel = new FacturaModel($this->db);
        $this->detalleModel = new DetalleFacturaModel($this->db);
        $this->productoModel = new Produmodel($this->db);
        $this->userModel = new Usermodel($this->db);
    }

    private function wantsJson() {
        return isset($_SERVER['HTTP_ACCEPT']) && stripos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;
    }

    private function sendJson($payload) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload);
        exit;
    }

    private function getFacturaPdfPath($idFactura) {
        return __DIR__ . '/../storage/facturas/factura_' . $idFactura . '.pdf';
    }

    private function buildFacturaPdf($factura, $detalles, $stream = true, $savePath = null) {
        require_once __DIR__ . '/../fpdf/fpdf.php';
        if (ob_get_length()) {
            ob_end_clean();
        }

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $logoPath = __DIR__ . '/../img/logo.png';
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 10, 8, 25);
        }

        $pdf->SetY(30);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('Factura de compra'), 0, 1, 'C');
        $pdf->Ln(4);

        $clienteNombre = $factura['NombreCom'] ?? 'Cliente';
        $clienteCorreo = $factura['Correo'] ?? '';
        $clienteTel = $factura['Tel'] ?? '';
        $clienteDireccion = $factura['Direccion'] ?? '';

        if (!$clienteTel || !$clienteDireccion) {
            $user = $this->userModel->getUsuarioById($factura['NumDoc'] ?? 0);
            if ($user) {
                $clienteTel = $clienteTel ?: ($user['Tel'] ?? '');
                $clienteDireccion = $clienteDireccion ?: ($user['Direccion'] ?? '');
            }
        }

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, utf8_decode('Factura #: ' . $factura['IdFactura']), 0, 1);
        $pdf->Cell(0, 6, utf8_decode('Fecha: ' . $factura['FechaFactura']), 0, 1);
        $pdf->Cell(0, 6, utf8_decode('Estado pedido: ' . ($factura['Estado'] ?? 'Pendiente')), 0, 1);
        $pdf->Cell(0, 6, utf8_decode('Cliente: ' . $clienteNombre), 0, 1);
        if ($clienteCorreo) {
            $pdf->Cell(0, 6, utf8_decode('Correo: ' . $clienteCorreo), 0, 1);
        }
        if ($clienteTel) {
            $pdf->Cell(0, 6, utf8_decode('Tel: ' . $clienteTel), 0, 1);
        }
        if ($clienteDireccion) {
            $pdf->MultiCell(0, 6, utf8_decode('Dirección: ' . $clienteDireccion));
        }
        $pdf->Ln(4);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(65, 8, utf8_decode('Producto'), 1, 0, 'L', true);
        $pdf->Cell(25, 8, utf8_decode('Talla/Color'), 1, 0, 'L', true);
        $pdf->Cell(20, 8, utf8_decode('Cant.'), 1, 0, 'C', true);
        $pdf->Cell(35, 8, utf8_decode('Precio'), 1, 0, 'R', true);
        $pdf->Cell(35, 8, utf8_decode('Subtotal'), 1, 1, 'R', true);

        $pdf->SetFont('Arial', '', 11);
        $subtotal = 0;
        foreach ($detalles as $item) {
            $nombre = $item['Nombre'] ?? '';
            $cantidad = $item['Cantidad'] ?? 0;
            $precio = $item['PrecioUnitario'] ?? 0;
            $sub = $item['Subtotal'] ?? ($precio * $cantidad);
            $talla = $item['Talla'] ?? '-';
            $color = $item['Color'] ?? '-';
            $subtotal += $sub;

            $pdf->Cell(65, 8, utf8_decode($nombre), 1);
            $pdf->Cell(25, 8, utf8_decode($talla . ' / ' . $color), 1);
            $pdf->Cell(20, 8, $cantidad, 1, 0, 'C');
            $pdf->Cell(35, 8, number_format($precio, 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(35, 8, number_format($sub, 0, ',', '.'), 1, 1, 'R');
        }

        $total = $factura['Total'] ?? $subtotal;
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(145, 8, utf8_decode('Subtotal'), 0, 0, 'R');
        $pdf->Cell(35, 8, number_format($subtotal, 0, ',', '.'), 0, 1, 'R');
        $pdf->Cell(145, 8, utf8_decode('Total'), 0, 0, 'R');
        $pdf->Cell(35, 8, number_format($total, 0, ',', '.'), 0, 1, 'R');

        if ($savePath) {
            $dir = dirname($savePath);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $pdf->Output('F', $savePath);
        }

        if ($stream) {
            $pdf->Output('I', 'factura_' . $factura['IdFactura'] . '.pdf');
            exit;
        }
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

                $factura = $this->facturaModel->getFacturaById($idFactura);
                $detalles = $this->detalleModel->getDetallesByFactura($idFactura);
                $pdfPath = $this->getFacturaPdfPath($idFactura);
                $this->buildFacturaPdf($factura, $detalles, true, $pdfPath);
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
        $perPage = 20;
        $page = max(1, (int)($_GET['page'] ?? 1));
        $total = $this->facturaModel->countFacturas();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $facturas = $this->facturaModel->listarFacturasPaged($perPage, $offset);
        $pagination = ['page' => $page, 'totalPages' => $totalPages];
        $estadosPedido = $this->estadosPedido;
        include __DIR__ . '/../views/list_factura.php';
    }

    public function actualizarEstadoPedido() {
        $id = (int)($_POST['IdFactura'] ?? 0);
        $estado = trim($_POST['Estado'] ?? '');
        if ($id <= 0 || !in_array($estado, $this->estadosPedido, true)) {
            $_SESSION['error'] = 'Datos de estado inválidos';
            header("Location: index.php?action=listFactura");
            exit;
        }
        $this->facturaModel->actualizarEstado($id, $estado);
        $_SESSION['success'] = 'Estado del pedido actualizado';
        header("Location: index.php?action=listFactura");
        exit;
    }

    // Ver factura completa con detalles
    public function verFactura() {
        $id = intval($_GET['id']);
        $factura = $this->facturaModel->getFacturaById($id);
        if (!$factura) {
            $_SESSION['error'] = "Factura no encontrada.";
            header("Location: index.php?action=listFactura");
            exit;
        }
        if (!empty($factura['Inhabilitado'])) {
            include __DIR__ . '/../views/factura_inhabilitada.php';
            return;
        }
        $detalles = $this->detalleModel->getDetallesByFactura($id);
        include __DIR__ . '/../views/view_factura.php';
    }

    public function verFacturaPdf() {
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?action=listFactura");
            exit;
        }

        $factura = $this->facturaModel->getFacturaById($id);
        if (!$factura) {
            header("Location: index.php?action=listFactura");
            exit;
        }
        if (!empty($factura['Inhabilitado'])) {
            include __DIR__ . '/../views/factura_inhabilitada.php';
            return;
        }

        $detalles = $this->detalleModel->getDetallesByFactura($id);
        $pdfPath = $this->getFacturaPdfPath($id);

        $this->buildFacturaPdf($factura, $detalles, false, $pdfPath);

        if (file_exists($pdfPath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="factura_' . $id . '.pdf"');
            readfile($pdfPath);
            exit;
        }

        $this->buildFacturaPdf($factura, $detalles, true, null);
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

public function inhabilitarFactura() {
    $id = intval($_GET['id'] ?? 0);

    if ($id <= 0) {
        $_SESSION['error'] = "ID de factura inválido.";
        header("Location: index.php?action=listFactura");
        exit;
    }

    try {
        $factura = $this->facturaModel->getFacturaById($id);
        if (!$factura) {
            $_SESSION['error'] = "Factura no encontrada.";
            header("Location: index.php?action=listFactura");
            exit;
        }

        if (!empty($factura['Inhabilitado'])) {
            $_SESSION['success'] = "La factura ya está inhabilitada.";
            header("Location: index.php?action=listFactura");
            exit;
        }

        $detallesCount = $this->detalleModel->countDetallesByFactura($id);
        if ($detallesCount > 0) {
            $this->facturaModel->inhabilitarFactura($id);
            $_SESSION['success'] = "Factura inhabilitada correctamente.";
        } else {
            $this->facturaModel->deleteFactura($id);
            $pdfPath = $this->getFacturaPdfPath($id);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
            $_SESSION['success'] = "Factura eliminada correctamente.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error al inhabilitar: " . $e->getMessage();
    }

    header("Location: index.php?action=listFactura");
    exit;
}

public function verCarrito()
{
    $cart = $_SESSION['cart'] ?? [];
    include __DIR__ . '/../views_client/Carrito.php';
}

public function addToCart()
{
    // Asegurar sesión
    // session started in bootstrap

    // Obtener ID del producto y cantidad (aceptamos GET o POST)
    $id = intval($_REQUEST['id'] ?? ($_REQUEST['IdProducto'] ?? 0));
    $cantidad = max(1, intval($_REQUEST['cantidad'] ?? ($_REQUEST['Cantidad'] ?? 1)));
    $selectedTalla = $_REQUEST['IdTalla'] ?? null;
    $selectedColor = $_REQUEST['IdColor'] ?? null;

    if ($id <= 0) {
        if ($this->wantsJson()) {
            $this->sendJson(['ok' => false, 'msg' => 'Producto inválido']);
        }
        header("Location: index.php");
        exit;
    }

    // Obtener producto desde BD
    $p = $this->productoModel->getProductoById($id);

    if (!$p) {
        if ($this->wantsJson()) {
            $this->sendJson(['ok' => false, 'msg' => 'Producto no encontrado']);
        }
        header("Location: index.php");
        exit;
    }

    if ($selectedTalla === null && isset($p['IdTalla'])) {
        $selectedTalla = $p['IdTalla'];
    }
    if ($selectedColor === null && isset($p['IdColor'])) {
        $selectedColor = $p['IdColor'];
    }
    $nomTalla = $selectedTalla ? $this->productoModel->getNomTallaById((int)$selectedTalla) : null;

    // Inicializar carrito si no existe
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Si el producto ya está en el carrito
    if (isset($_SESSION['cart'][$id])) {
        $currentQty = $_SESSION['cart'][$id]['Cantidad'];
        // Comprobar stock antes de aumentar
        if (isset($p['Stock']) && $currentQty + $cantidad > (int)$p['Stock']) {
            $_SESSION['error'] = 'No hay suficiente stock disponible';
            if ($this->wantsJson()) {
                $this->sendJson(['ok' => false, 'msg' => $_SESSION['error']]);
            }
            header("Location: index.php?action=verCarrito");
            exit;
        }

        $_SESSION['cart'][$id]['Cantidad'] = $currentQty + $cantidad;
        $_SESSION['cart'][$id]['Subtotal'] =
            $_SESSION['cart'][$id]['Cantidad'] * $_SESSION['cart'][$id]['PrecioUnitario'];

        // Asegurar que la foto y atributos siempre estén
        $_SESSION['cart'][$id]['Foto'] = $p['Foto'];
        if ($selectedTalla) $_SESSION['cart'][$id]['IdTalla'] = $selectedTalla;
        if ($nomTalla) $_SESSION['cart'][$id]['NomTalla'] = $nomTalla;
        if ($selectedColor) $_SESSION['cart'][$id]['IdColor'] = $selectedColor;

    } else {

        // Si no hay stock, no agregar
        if (isset($p['Stock']) && (int)$p['Stock'] < $cantidad) {
            $_SESSION['error'] = 'Cantidad solicitada excede el stock disponible';
            if ($this->wantsJson()) {
                $this->sendJson(['ok' => false, 'msg' => $_SESSION['error']]);
            }
            header('Location: index.php');
            exit;
        }

        // Agregar producto nuevo al carrito
        $_SESSION['cart'][$id] = [
            'IdProducto'      => $id,
            'Nombre'          => $p['Nombre'],
            'PrecioUnitario'  => $p['Precio'],
            'Cantidad'        => $cantidad,
            'Foto'            => $p['Foto'],
            'Subtotal'        => $p['Precio'] * $cantidad,
            'IdTalla'         => $selectedTalla,
            'NomTalla'        => $nomTalla,
            'IdColor'         => $selectedColor
        ];
    }

    if ($this->wantsJson()) {
        $this->sendJson(['ok' => true, 'cart' => $_SESSION['cart']]);
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
        // comprobar stock
        $p = $this->productoModel->getProductoById($id);
        $current = $_SESSION['cart'][$id]['Cantidad'];
        if (isset($p['Stock']) && $current + 1 > (int)$p['Stock']) {
            $_SESSION['error'] = 'No hay suficiente stock disponible';
            header("Location: index.php?action=verCarrito");
            exit;
        }
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
    $id = intval($_REQUEST['id'] ?? ($_REQUEST['IdProducto'] ?? 0));

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    if ($this->wantsJson()) {
        $this->sendJson(['ok' => true, 'cart' => $_SESSION['cart'] ?? []]);
    }

    header("Location: index.php?action=verCarrito");
    exit;
}





public function finalizarCompra()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?action=verCarrito");
        exit;
    }

    $cart = $_SESSION['cart'] ?? [];
    if (empty($cart)) {
        $_SESSION['error'] = "El carrito está vacío";
        header("Location: index.php?action=verCarrito");
        exit;
    }

    $sessionUser = $_SESSION['usuario'] ?? null;
    if (!$sessionUser) {
        header("Location: index.php?action=login");
        exit;
    }

    $numDoc = $sessionUser['NumDoc'];
    $user = $this->userModel->getUsuarioById($numDoc);

    $clienteNombre = $user['NombreCom'] ?? ($sessionUser['Nombre'] ?? 'Cliente');
    $clienteCorreo = $user['Correo'] ?? '';
    $clienteDireccion = $user['Direccion'] ?? '';
    $clienteTel = $user['Tel'] ?? '';

    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['Subtotal'];
    }
    $total = $subtotal;

    try {
        $this->db->beginTransaction();
        $idFactura = $this->facturaModel->crearFactura($numDoc, $total);

        foreach ($cart as $it) {
            $this->detalleModel->insertDetalle(
                $idFactura,
                $it['IdProducto'],
                $it['Cantidad'],
                $it['PrecioUnitario'],
                $it['Subtotal']
            );
            $this->productoModel->reduceStock($it['IdProducto'], $it['Cantidad']);
        }

        $this->db->commit();
    } catch (Exception $e) {
        $this->db->rollBack();
        $_SESSION['error'] = "Error al guardar: " . $e->getMessage();
        header("Location: index.php?action=verCarrito");
        exit;
    }

    unset($_SESSION['cart']);

    $factura = $this->facturaModel->getFacturaById($idFactura);
    $detalles = $this->detalleModel->getDetallesByFactura($idFactura);
    $pdfPath = $this->getFacturaPdfPath($idFactura);
    $this->buildFacturaPdf($factura, $detalles, true, $pdfPath);
    exit;
}

public function misPedidos()
{
    $sessionUser = $_SESSION['usuario'] ?? null;
    if (!$sessionUser) {
        header("Location: index.php?action=login");
        exit;
    }
    $numDoc = $sessionUser['NumDoc'];
    $perPage = 10;
    $page = max(1, (int)($_GET['page'] ?? 1));
    $total = $this->facturaModel->countPedidosByCliente($numDoc);
    $totalPages = max(1, (int)ceil($total / $perPage));
    $page = max(1, min($page, $totalPages));
    $offset = ($page - 1) * $perPage;
    $pedidos = $this->facturaModel->listarPedidosByClientePaged($numDoc, $perPage, $offset);
    $pagination = ['page' => $page, 'totalPages' => $totalPages];
    include __DIR__ . '/../views_client/mis_pedidos.php';
}

public function verMiPedido()
{
    $sessionUser = $_SESSION['usuario'] ?? null;
    if (!$sessionUser) {
        header("Location: index.php?action=login");
        exit;
    }
    $id = intval($_GET['id'] ?? 0);
    $numDoc = $sessionUser['NumDoc'];
    $factura = $this->facturaModel->getFacturaByIdAndCliente($id, $numDoc);
    if (!$factura) {
        $_SESSION['error'] = "Pedido no encontrado.";
        header("Location: index.php?action=misPedidos");
        exit;
    }
    $detalles = $this->detalleModel->getDetallesByFactura($id);
    include __DIR__ . '/../views_client/ver_mi_pedido.php';
}

public function verMiPedidoPdf()
{
    $sessionUser = $_SESSION['usuario'] ?? null;
    if (!$sessionUser) {
        header("Location: index.php?action=login");
        exit;
    }
    $id = intval($_GET['id'] ?? 0);
    $numDoc = $sessionUser['NumDoc'];
    $factura = $this->facturaModel->getFacturaByIdAndCliente($id, $numDoc);
    if (!$factura) {
        header("Location: index.php?action=misPedidos");
        exit;
    }
    $detalles = $this->detalleModel->getDetallesByFactura($id);
    $pdfPath = $this->getFacturaPdfPath($id);
        $this->buildFacturaPdf($factura, $detalles, false, $pdfPath);
    if (file_exists($pdfPath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="factura_' . $id . '.pdf"');
        readfile($pdfPath);
        exit;
    }
    $this->buildFacturaPdf($factura, $detalles, true, null);
}

}
?>
