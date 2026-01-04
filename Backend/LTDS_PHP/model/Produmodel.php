<?php

class Produmodel {

    private $conn;
    private $table_name = "producto";

    public function __construct($db) {
        $this->conn = $db;
    }

    // INSERTAR PRODUCTO
    public function InsertarProducto($Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $Oferta, $IdCategoria, $Marca, $Descripcion, $UdMedida, $Foto)
    {
        $query = "INSERT INTO $this->table_name 
        (Nombre, Precio, Material, IdTalla, IdColor, Stock, Oferta, IdCategoria, IdMarca, Descripcion, UdMedida, Foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $Oferta, $IdCategoria, $Marca, $Descripcion, $UdMedida, $Foto
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

     // Reducir stock al vender
    public function reduceStock($id, $cantidad) {
        $query = "UPDATE $this->table_name SET Stock = Stock - ? WHERE IdProducto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$cantidad, $id]);
    }

    // OBTENER PRODUCTO POR NOMBRE
    public function getProductoByNombre($Nombre)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Nombre LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['%' . $Nombre . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ACTUALIZAR PRODUCTO
    public function actualizarProducto($Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $Oferta, $IdCategoria, $Marca, $Descripcion, $UdMedida, $Foto, $id)
    {
        $query = "UPDATE $this->table_name SET 
            Nombre=?, Precio=?, Material=?, IdTalla=?, IdColor=?,
            Stock=?, Oferta=?, IdCategoria=?, Marca=?, Descripcion=?, UdMedida=?, Foto=?
            WHERE IdProducto=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $Oferta, $IdCategoria, $Marca, $Descripcion, $UdMedida, $Foto, $id
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
?>