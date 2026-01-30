<?php

/* =========================
    MODEL: Produmodel
    ========================= */

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
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
        $query = "SELECT
            p.IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            t.NomTalla AS Talla,
            p.UdMedida,
            c.NomColor AS Color,
            p.Stock,
            p.Oferta,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto,
            p.IdTalla, p.IdColor, p.IdCategoria, p.IdMarca
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        WHERE p.Nombre LIKE ?";

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
    $query = "
        SELECT 
            p.IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            t.NomTalla AS Talla,
            p.UdMedida,
            c.NomColor AS Color,
            p.Stock,
            p.Oferta,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Obtener productos por un array de IDs (preserva el orden por IdProducto)
    public function getProductsByIds(array $ids)
    {
        if (empty($ids)) return [];
        // Construir placeholders seguros
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $query = "SELECT
            p.IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            t.NomTalla AS Talla,
            p.UdMedida,
            c.NomColor AS Color,
            p.Stock,
            p.Oferta,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        WHERE p.IdProducto IN (" . $placeholders . ")";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(array_values($ids));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // LISTAR POR CATEGORÍA Y FILTROS (color, talla, solo ofertas opcional)
    public function listarByCategory($categoriaName, $idColor = null, $idTalla = null, $onlyOferta = false)
    {
        $sql = "SELECT
            p.IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            t.NomTalla AS Talla,
            p.UdMedida,
            c.NomColor AS Color,
            p.Stock,
            p.Oferta,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        WHERE ca.NomCategoria = ?";

        $params = [$categoriaName];

        if ($onlyOferta) {
            $sql .= " AND p.Oferta > 0";
        }

        if (!empty($idColor)) {
            $sql .= " AND p.IdColor = ?";
            $params[] = $idColor;
        }

        if (!empty($idTalla)) {
            $sql .= " AND p.IdTalla = ?";
            $params[] = $idTalla;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Listar por filtros genéricos: por IdCategoria (opcional), color, talla y solo ofertas.
     */
    public function listarByFilters($idCategoria = null, $idColor = null, $idTalla = null, $onlyOferta = false)
    {
        $sql = "SELECT
            p.IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            t.NomTalla AS Talla,
            p.UdMedida,
            c.NomColor AS Color,
            p.Stock,
            p.Oferta,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        WHERE 1=1";

        $params = [];

        if (!empty($idCategoria)) {
            $sql .= " AND p.IdCategoria = ?";
            $params[] = $idCategoria;
        }

        if ($onlyOferta) {
            $sql .= " AND p.Oferta > 0";
        }

        if (!empty($idColor)) {
            $sql .= " AND p.IdColor = ?";
            $params[] = $idColor;
        }

        if (!empty($idTalla)) {
            $sql .= " AND p.IdTalla = ?";
            $params[] = $idTalla;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>