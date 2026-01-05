<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/CategoriaModel.php';
require_once __DIR__ . '/../model/ColorModel.php';
require_once __DIR__ . '/../model/TallaModel.php';
require_once __DIR__ . '/../model/MarcaModel.php';
require_once __DIR__ . '/../model/Produmodel.php';

class Producontroller {

    private $db;
    public  $Produmodel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->Produmodel = new Produmodel($this->db);
    }

    // INSERTAR
    public function insertProdu() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // FOTO
            $fotoNombre = null;

            if (!empty($_FILES['Foto']['name'])) {
                $allowed = ['jpg','jpeg','png','gif','webp'];
                $ext = strtolower(pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed)) {
                    $_SESSION['error'] = 'Formato de imagen no permitido.';
                    header('Location: index.php?action=insertProdu');
                    exit;
                }
                $fotoNombre = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['Foto']['name']));
                $ruta = __DIR__ . '/../uploads/' . $fotoNombre;
                move_uploaded_file($_FILES['Foto']['tmp_name'], $ruta);
            }

            // DATOS
            
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
    }

    // LISTAR
    public function listar() {
        return $this->Produmodel->listarProductos();
    }

    public function ProductsByName() {
        $Nombre = $_GET['Nombre'] ?? '';
        return $this->Produmodel->getProductoByNombre($Nombre);
    }

    // FORMULARIO EDITAR
    public function editarFormulario() {
        $id = $_GET['id'];
        $producto = $this->Produmodel->getProductoById($id);

        $CategoriaModel = new CategoriaModel($this->db);
        $categorias = $CategoriaModel->getCategoria();

        $ColorModel = new ColorModel($this->db);
        $colores = $ColorModel->getColor();

        $MarcaModel = new MarcaModel($this->db);
        $marcas = $MarcaModel->getMarca();

        $tallas = $TallaModel->getTalla();


        include __DIR__ . '/../views/edit_product.php';
    }

    // ACTUALIZAR
    public function actualizarProducto() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['IdProducto'];

            // FOTO
            $fotoFinal = $_POST['Foto_actual'];

            if (!empty($_FILES['Foto']['name'])) {
                $allowed = ['jpg','jpeg','png','gif','webp'];
                $ext = strtolower(pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION));
                if (in_array($ext, $allowed)) {
                    $fotoFinal = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['Foto']['name']));
                    move_uploaded_file($_FILES['Foto']['tmp_name'], __DIR__ . '/../uploads/' . $fotoFinal);
                }
            }

            $this->Produmodel->actualizarProducto(
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
                $fotoFinal,
                $id
            );

            header("Location: index.php?action=listProduct");
            exit;
        }
    }

    // ELIMINAR
    public function eliminarProducto() {
        $id = $_GET['id'];
        $this->Produmodel->eliminarProducto($id);
        // Si viene de búsqueda por nombre, regresar a esa búsqueda
        if (isset($_GET['from']) && $_GET['from'] === 'ProductsByName') {
            $nombre = $_GET['Nombre'] ?? '';
            header("Location: index.php?action=ProductsByName&Nombre=" . urlencode($nombre));
            exit;
        }
        header("Location: index.php?action=listProduct");
        exit;
    }

    public function verProducto()
    {
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

        include __DIR__ . '/../views_client/vistaproducto.php';
    }

}
?>