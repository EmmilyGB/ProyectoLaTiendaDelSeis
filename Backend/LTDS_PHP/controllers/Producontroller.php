<?php

require_once 'config/database.php';
require_once 'model/Produmodel.php';

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
                $fotoNombre = time() . "_" . basename($_FILES['Foto']['name']);
                $ruta = "uploads/" . $fotoNombre;
                move_uploaded_file($_FILES['Foto']['tmp_name'], $ruta);
            }

            // DATOS
            $this->Produmodel->InsertarProducto(
                $_POST['Nombre'],
                $_POST['Precio'],
                $_POST['Material'],
                $_POST['Talla_unidadMedida'],
                $_POST['Color'],
                $_POST['Stock'],
                $_POST['Oferta'],
                $_POST['Categoria'],
                $_POST['Marca'],
                $_POST['Descripcion'],
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

    // FORMULARIO EDITAR
    public function editarFormulario() {
        $id = $_GET['id'];
        $producto = $this->Produmodel->getProductoById($id);
        include 'views/edit_product.php';
    }

    // ACTUALIZAR
    public function actualizarProducto() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['IdProducto'];

            // FOTO
            $fotoFinal = $_POST['Foto_actual'];

            if (!empty($_FILES['Foto']['name'])) {
                $fotoFinal = time() . "_" . basename($_FILES['Foto']['name']);
                move_uploaded_file($_FILES['Foto']['tmp_name'], "uploads/" . $fotoFinal);
            }

            $this->Produmodel->actualizarProducto(
                $_POST['Nombre'],
                $_POST['Precio'],
                $_POST['Material'],
                $_POST['Talla_unidadMedida'],
                $_POST['Color'],
                $_POST['Stock'],
                $_POST['Oferta'],
                $_POST['Categoria'],
                $_POST['Marca'],
                $_POST['Descripcion'],
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
        header("Location: index.php?action=listProduct");
        exit;
    }
}
