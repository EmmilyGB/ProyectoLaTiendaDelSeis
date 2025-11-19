<?php

class Produmodel {

    private $conn;
    private $table_name = "producto";

    public function __construct($db) {
        $this->conn = $db;
    }

    // INSERTAR PRODUCTO
    public function InsertarProducto($Nombre, $Precio, $Material, $Talla_unidadMedida, $Color,
        $Stock, $Oferta, $Categoria, $Marca, $Descripcion, $Foto)
    {
        $query = "INSERT INTO $this->table_name 
        (Nombre, Precio, Material, Talla_unidadMedida, Color, Stock, Oferta, Categoria, Marca, Descripcion, Foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $Nombre, $Precio, $Material, $Talla_unidadMedida, $Color,
            $Stock, $Oferta, $Categoria, $Marca, $Descripcion, $Foto
        ]);
    }

    // TRAER UN PRODUCTO POR ID
    public function getProductoById($id)
    {
        $query = "SELECT * FROM $this->table_name WHERE IdProducto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ACTUALIZAR PRODUCTO
    public function actualizarProducto($Nombre, $Precio, $Material, $Talla_unidadMedida, $Color,
        $Stock, $Oferta, $Categoria, $Marca, $Descripcion, $Foto, $id)
    {
        $query = "UPDATE $this->table_name SET 
            Nombre=?, Precio=?, Material=?, Talla_unidadMedida=?, Color=?,
            Stock=?, Oferta=?, Categoria=?, Marca=?, Descripcion=?, Foto=?
            WHERE IdProducto=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $Nombre, $Precio, $Material, $Talla_unidadMedida, $Color,
            $Stock, $Oferta, $Categoria, $Marca, $Descripcion, $Foto, $id
        ]);
    }

    // ELIMINAR
    public function eliminarProducto($id)
    {
        $query = "DELETE FROM $this->table_name WHERE IdProducto=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    // LISTAR
    public function listarProductos()
    {
        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
