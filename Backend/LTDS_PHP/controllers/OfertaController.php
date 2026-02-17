<?php
require_once __DIR__ . '/../model/OfertaModel.php';
require_once __DIR__ . '/../model/Produmodel.php';

class OfertaController
{
    private $ofertaModel;
    private $productoModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->ofertaModel = new OfertaModel($db);
        $this->productoModel = new Produmodel($db);
    }

    public function manageOfertas()
    {
        $q = trim($_GET['q'] ?? '');
        if ($q !== '') {
            $productos = $this->productoModel->getProductoByNombre($q);
        } else {
            $productos = $this->productoModel->listarProductos();
        }

        $ofertasMap = $this->ofertaModel->getAllMap();
        include __DIR__ . '/../views/manage_ofertas.php';
    }

    public function saveOfertas()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=manageOfertas');
            exit;
        }

        $selected = $_POST['productos'] ?? [];
        $precios = $_POST['precio_oferta'] ?? [];
        $cleanOffers = [];

        foreach ($selected as $rawId) {
            $idProducto = (int)$rawId;
            if ($idProducto <= 0) {
                continue;
            }

            $rawPrecio = trim((string)($precios[$idProducto] ?? ''));
            $rawPrecio = str_replace(',', '.', $rawPrecio);
            if ($rawPrecio === '' || !is_numeric($rawPrecio)) {
                $_SESSION['error'] = 'Cada producto en oferta debe tener un precio de oferta valido.';
                header('Location: index.php?action=manageOfertas');
                exit;
            }

            $precioOferta = (float)$rawPrecio;
            if ($precioOferta <= 0) {
                $_SESSION['error'] = 'El precio de oferta debe ser mayor a 0.';
                header('Location: index.php?action=manageOfertas');
                exit;
            }

            $precioOriginal = (float)$this->productoModel->getPrecioById($idProducto);
            if ($precioOriginal <= 0) {
                $_SESSION['error'] = 'No se pudo validar el precio original de un producto seleccionado.';
                header('Location: index.php?action=manageOfertas');
                exit;
            }

            if ($precioOferta >= $precioOriginal) {
                $_SESSION['error'] = 'El precio de oferta debe ser menor al precio original.';
                header('Location: index.php?action=manageOfertas');
                exit;
            }

            $cleanOffers[$idProducto] = $precioOferta;
        }

        $ok = $this->ofertaModel->setAll($cleanOffers);
        if ($ok) {
            $_SESSION['success'] = 'Ofertas actualizadas correctamente.';
        } else {
            $_SESSION['error'] = 'No se pudieron guardar las ofertas.';
        }

        header('Location: index.php?action=manageOfertas');
        exit;
    }
}

