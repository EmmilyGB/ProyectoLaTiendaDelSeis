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

    private function ensureOfertaTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `oferta_producto` (
            `Id` INT AUTO_INCREMENT PRIMARY KEY,
            `IdProducto` INT NOT NULL UNIQUE,
            `PrecioOferta` DECIMAL(10,2) NOT NULL,
            `ActualizadoEn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->conn->exec($sql);
    }

    // INSERTAR PRODUCTO
    public function InsertarProducto($Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $IdCategoria, $Marca, $Descripcion, $Foto)
    {
        $query = "INSERT INTO $this->table_name 
        (Nombre, Precio, Material, IdTalla, IdColor, Stock, IdCategoria, IdMarca, Descripcion, Foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $IdCategoria, $Marca, $Descripcion, $Foto
        ]);
        return (int)$this->conn->lastInsertId();
    }

    // TRAER UN PRODUCTO POR ID
    public function getProductoById($id)
    {
        $query = "SELECT * FROM $this->table_name WHERE IdProducto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNomTallaById($idTalla)
    {
        $stmt = $this->conn->prepare("SELECT NomTalla FROM talla WHERE IdTalla = ? LIMIT 1");
        $stmt->execute([$idTalla]);
        return $stmt->fetchColumn();
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
            MIN(p.IdProducto) AS IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            GROUP_CONCAT(CONCAT(t.NomTalla, ':', p.Stock)
                ORDER BY CAST(t.NomTalla AS UNSIGNED), t.NomTalla
                SEPARATOR ', ') AS TallasStock,
            c.NomColor AS Color,
            SUM(p.Stock) AS Stock,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto,
            MIN(p.IdTalla) AS IdTalla, p.IdColor, p.IdCategoria, p.IdMarca
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        WHERE p.Nombre LIKE ?
        GROUP BY p.Nombre, p.Precio, p.Material, c.NomColor, ca.NomCategoria, m.NomMarca,
                    p.Descripcion, p.Foto, p.IdColor, p.IdCategoria, p.IdMarca";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['%' . $Nombre . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ACTUALIZAR PRODUCTO
    public function actualizarProducto($Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $IdCategoria, $IdMarca, $Descripcion, $Foto, $id)
    {
        $query = "UPDATE $this->table_name SET 
            Nombre=?, Precio=?, Material=?, IdTalla=?, IdColor=?,
            Stock=?, IdCategoria=?, IdMarca=?, Descripcion=?, Foto=?
            WHERE IdProducto=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $Nombre, $Precio, $Material, $IdTalla, $IdColor,
            $Stock, $IdCategoria, $IdMarca, $Descripcion, $Foto, $id
        ]);
    }

    public function actualizarModeloCompartido($idProductoBase, $Nombre, $Precio, $Material, $IdColor, $IdCategoria, $IdMarca, $Descripcion, $Foto)
    {
        $sql = "UPDATE producto p2
                INNER JOIN producto pBase
                    ON p2.Nombre = pBase.Nombre
                    AND p2.Material = pBase.Material
                    AND p2.Precio = pBase.Precio
                    AND p2.IdColor = pBase.IdColor
                    AND p2.IdCategoria = pBase.IdCategoria
                    AND p2.IdMarca = pBase.IdMarca
                SET p2.Nombre = ?,
                    p2.Precio = ?,
                    p2.Material = ?,
                    p2.IdColor = ?,
                    p2.IdCategoria = ?,
                    p2.IdMarca = ?,
                    p2.Descripcion = ?,
                    p2.Foto = ?
                WHERE pBase.IdProducto = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $Nombre, $Precio, $Material, $IdColor, $IdCategoria, $IdMarca, $Descripcion, $Foto, $idProductoBase
        ]);
    }

    public function insertarFotoProducto($idProducto, $rutaFoto, $orden = 0, $esPrincipal = 0)
    {
        $sql = "INSERT INTO producto_foto (IdProducto, RutaFoto, Orden, EsPrincipal)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([(int)$idProducto, $rutaFoto, (int)$orden, (int)$esPrincipal]);
    }

    public function getFotosByProductoBase($idProductoBase)
    {
        $sql = "SELECT
                    MIN(pf.IdFoto) AS IdFoto,
                    pf.RutaFoto,
                    MAX(pf.EsPrincipal) AS EsPrincipal,
                    MIN(pf.Orden) AS Orden
                FROM producto pBase
                INNER JOIN producto p2
                    ON p2.Nombre = pBase.Nombre
                AND p2.Material = pBase.Material
                AND p2.Precio = pBase.Precio
                AND p2.IdColor = pBase.IdColor
                AND p2.IdCategoria = pBase.IdCategoria
                AND p2.IdMarca = pBase.IdMarca
                INNER JOIN producto_foto pf ON pf.IdProducto = p2.IdProducto
                WHERE pBase.IdProducto = ?
                GROUP BY pf.RutaFoto
                ORDER BY MAX(pf.EsPrincipal) DESC, MIN(pf.Orden) ASC, MIN(pf.IdFoto) ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([(int)$idProductoBase]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarFotoById($idFoto)
    {
        $stmt = $this->conn->prepare("DELETE FROM producto_foto WHERE IdFoto = ?");
        $stmt->execute([(int)$idFoto]);
    }

    public function setFotoPrincipalEnModelo($idProductoBase, $idFoto)
    {
        $sqlRuta = "SELECT pf.RutaFoto
                    FROM producto_foto pf
                    INNER JOIN producto p2 ON p2.IdProducto = pf.IdProducto
                    INNER JOIN producto pBase
                        ON p2.Nombre = pBase.Nombre
                    AND p2.Material = pBase.Material
                    AND p2.Precio = pBase.Precio
                    AND p2.IdColor = pBase.IdColor
                    AND p2.IdCategoria = pBase.IdCategoria
                    AND p2.IdMarca = pBase.IdMarca
                    WHERE pBase.IdProducto = ?
                    AND pf.IdFoto = ?
                    LIMIT 1";
        $stmtRuta = $this->conn->prepare($sqlRuta);
        $stmtRuta->execute([(int)$idProductoBase, (int)$idFoto]);
        $rutaFoto = $stmtRuta->fetchColumn();
        if (!$rutaFoto) {
            return null;
        }

        $sqlUpdateFotos = "UPDATE producto_foto pf
                        INNER JOIN producto p2 ON p2.IdProducto = pf.IdProducto
                        INNER JOIN producto pBase
                            ON p2.Nombre = pBase.Nombre
                            AND p2.Material = pBase.Material
                            AND p2.Precio = pBase.Precio
                            AND p2.IdColor = pBase.IdColor
                            AND p2.IdCategoria = pBase.IdCategoria
                            AND p2.IdMarca = pBase.IdMarca
                        SET pf.EsPrincipal = CASE WHEN pf.RutaFoto = ? THEN 1 ELSE 0 END
                        WHERE pBase.IdProducto = ?";
        $stmtUpdateFotos = $this->conn->prepare($sqlUpdateFotos);
        $stmtUpdateFotos->execute([$rutaFoto, (int)$idProductoBase]);

        $sqlUpdateProducto = "UPDATE producto p2
                            INNER JOIN producto pBase
                                ON p2.Nombre = pBase.Nombre
                                AND p2.Material = pBase.Material
                                AND p2.Precio = pBase.Precio
                                AND p2.IdColor = pBase.IdColor
                                AND p2.IdCategoria = pBase.IdCategoria
                                AND p2.IdMarca = pBase.IdMarca
                            SET p2.Foto = ?
                            WHERE pBase.IdProducto = ?";
        $stmtUpdateProducto = $this->conn->prepare($sqlUpdateProducto);
        $stmtUpdateProducto->execute([$rutaFoto, (int)$idProductoBase]);

        return $rutaFoto;
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
            MIN(p.IdProducto) AS IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            GROUP_CONCAT(CONCAT(t.NomTalla, ':', p.Stock)
                ORDER BY CAST(t.NomTalla AS UNSIGNED), t.NomTalla
                SEPARATOR ', ') AS TallasStock,
            c.NomColor AS Color,
            SUM(p.Stock) AS Stock,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        GROUP BY p.Nombre, p.Precio, p.Material, c.NomColor, ca.NomCategoria, m.NomMarca,
                p.Descripcion, p.Foto, p.IdColor, p.IdCategoria, p.IdMarca
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function listarProductosPaged($limit, $offset)
    {
        $query = "
        SELECT 
            MIN(p.IdProducto) AS IdProducto,
            p.Nombre,
            p.Precio,
            p.Material,
            GROUP_CONCAT(CONCAT(t.NomTalla, ':', p.Stock)
                ORDER BY CAST(t.NomTalla AS UNSIGNED), t.NomTalla
                SEPARATOR ', ') AS TallasStock,
            c.NomColor AS Color,
            SUM(p.Stock) AS Stock,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto
        FROM producto p
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        GROUP BY p.Nombre, p.Precio, p.Material, c.NomColor, ca.NomCategoria, m.NomMarca,
                p.Descripcion, p.Foto, p.IdColor, p.IdCategoria, p.IdMarca
        LIMIT ? OFFSET ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProductos()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(DISTINCT CONCAT_WS('|',
                Nombre, Material, Precio, IdColor, IdCategoria, IdMarca, COALESCE(Descripcion, ''), COALESCE(Foto, '')
            )) FROM {$this->table_name}"
        );
        $stmt->execute();
        return (int)$stmt->fetchColumn();
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
            c.NomColor AS Color,
            p.Stock,
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
            c.NomColor AS Color,
            p.Stock,
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
            c.NomColor AS Color,
            p.Stock,
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

    public function listarByFiltersPaged($idCategoria = null, $idColor = null, $idTalla = null, $onlyOferta = false, $limit = 30, $offset = 0, $orderBy = null)
{
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

    $sql = "SELECT
        MIN(p.IdProducto) AS IdProducto,
        p.Nombre,
        p.Precio,
        p.Material,
        MIN(t.NomTalla) AS Talla,
        c.NomColor AS Color,
        SUM(p.Stock) AS Stock,
        ca.NomCategoria AS Categoria,
        m.NomMarca AS Marca,
        p.Descripcion,
        p.Foto,
        MIN(p.IdTalla) AS IdTalla,
        p.IdColor, p.IdCategoria, p.IdMarca,
        COALESCE(SUM(dv.vendido), 0) AS total_vendido
    FROM producto p
    INNER JOIN talla t ON p.IdTalla = t.IdTalla
    INNER JOIN color c ON p.IdColor = c.IdColor
    INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
    INNER JOIN marca m ON p.IdMarca = m.IdMarca
    LEFT JOIN (
        SELECT IdProducto, SUM(Cantidad) AS vendido
        FROM detallefactura
        GROUP BY IdProducto
    ) dv ON p.IdProducto = dv.IdProducto
    WHERE 1=1";

    $params = [];

    if (!empty($idCategoria)) {
        $sql .= " AND p.IdCategoria = ?";
        $params[] = $idCategoria;
    }

    if (!empty($idColor)) {
        $sql .= " AND p.IdColor = ?";
        $params[] = $idColor;
    }

    if (!empty($idTalla)) {
        $sql .= " AND p.IdTalla = ?";
        $params[] = $idTalla;
    }

    $sql .= " GROUP BY p.Nombre, p.Precio, p.Material, c.NomColor, ca.NomCategoria, m.NomMarca,
                    p.Descripcion, p.Foto, p.IdColor, p.IdCategoria, p.IdMarca";
    
    $sql .= " $orderClause LIMIT ? OFFSET ?";

    $stmt = $this->conn->prepare($sql);
    $bindIndex = 1;
    foreach ($params as $value) {
        $stmt->bindValue($bindIndex, $value, PDO::PARAM_STR);
        $bindIndex++;
    }
    $stmt->bindValue($bindIndex, (int)$limit, PDO::PARAM_INT);
    $bindIndex++;
    $stmt->bindValue($bindIndex, (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function countByFilters($idCategoria = null, $idColor = null, $idTalla = null, $onlyOferta = false)
    {
        $sql = "SELECT COUNT(DISTINCT CONCAT_WS('|',
                    p.Nombre, p.Material, p.Precio, p.IdColor, p.IdCategoria, p.IdMarca,
                    COALESCE(p.Descripcion, ''), COALESCE(p.Foto, '')
                ))
                FROM producto p
                WHERE 1=1";
        $params = [];

        if (!empty($idCategoria)) {
            $sql .= " AND p.IdCategoria = ?";
            $params[] = $idCategoria;
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
        return (int)$stmt->fetchColumn();
    }

    public function getPrecioById($idProducto)
    {
        $stmt = $this->conn->prepare("SELECT Precio FROM {$this->table_name} WHERE IdProducto = ? LIMIT 1");
        $stmt->execute([(int)$idProducto]);
        return $stmt->fetchColumn();
    }

    public function listarOfertasPaged($idColor = null, $idTalla = null, $limit = 30, $offset = 0, $orderBy = null)
    {
        $this->ensureOfertaTable();

        $orderClause = "ORDER BY p.IdProducto DESC";
        switch ($orderBy) {
            case 'precio_asc':
                $orderClause = "ORDER BY o.PrecioOferta ASC";
                break;
            case 'precio_desc':
                $orderClause = "ORDER BY o.PrecioOferta DESC";
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

        $sql = "SELECT
            p.IdProducto,
            p.Nombre,
            p.Precio AS PrecioOriginal,
            o.PrecioOferta,
            p.Material,
            t.NomTalla AS Talla,
            c.NomColor AS Color,
            p.Stock,
            ca.NomCategoria AS Categoria,
            m.NomMarca AS Marca,
            p.Descripcion,
            p.Foto,
            p.IdTalla, p.IdColor, p.IdCategoria, p.IdMarca,
            COALESCE(dv.vendido, 0) AS total_vendido
        FROM oferta_producto o
        INNER JOIN producto p ON p.IdProducto = o.IdProducto
        INNER JOIN talla t ON p.IdTalla = t.IdTalla
        INNER JOIN color c ON p.IdColor = c.IdColor
        INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
        INNER JOIN marca m ON p.IdMarca = m.IdMarca
        LEFT JOIN (
            SELECT IdProducto, SUM(Cantidad) AS vendido
            FROM detallefactura
            GROUP BY IdProducto
        ) dv ON p.IdProducto = dv.IdProducto
        WHERE 1=1";

        $params = [];
        if (!empty($idColor)) {
            $sql .= " AND p.IdColor = ?";
            $params[] = $idColor;
        }
        if (!empty($idTalla)) {
            $sql .= " AND p.IdTalla = ?";
            $params[] = $idTalla;
        }

        $sql .= " $orderClause LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $bindIndex = 1;
        foreach ($params as $value) {
            $stmt->bindValue($bindIndex, $value, PDO::PARAM_INT);
            $bindIndex++;
        }
        $stmt->bindValue($bindIndex, (int)$limit, PDO::PARAM_INT);
        $bindIndex++;
        $stmt->bindValue($bindIndex, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countOfertas($idColor = null, $idTalla = null)
    {
        $this->ensureOfertaTable();

        $sql = "SELECT COUNT(*)
                FROM oferta_producto o
                INNER JOIN producto p ON p.IdProducto = o.IdProducto
                WHERE 1=1";
        $params = [];

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
        return (int)$stmt->fetchColumn();
    }

    public function getProductoByNombrePaged($Nombre, $limit, $offset, $orderBy = null)
{
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
        MIN(p.IdProducto) AS IdProducto,
        p.Nombre,
        p.Precio,
        p.Material,
        GROUP_CONCAT(CONCAT(t.NomTalla, ':', p.Stock)
            ORDER BY CAST(t.NomTalla AS UNSIGNED), t.NomTalla
            SEPARATOR ', ') AS TallasStock,
        c.NomColor AS Color,
        SUM(p.Stock) AS Stock,
        ca.NomCategoria AS Categoria,
        m.NomMarca AS Marca,
        p.Descripcion,
        p.Foto,
        MIN(p.IdTalla) AS IdTalla, p.IdColor, p.IdCategoria, p.IdMarca,
        COALESCE(SUM(dv.vendido), 0) AS total_vendido
    FROM producto p
    INNER JOIN talla t ON p.IdTalla = t.IdTalla
    INNER JOIN color c ON p.IdColor = c.IdColor
    INNER JOIN categoria ca ON p.IdCategoria = ca.IdCategoria
    INNER JOIN marca m ON p.IdMarca = m.IdMarca
    LEFT JOIN (
        SELECT IdProducto, SUM(Cantidad) AS vendido
        FROM detallefactura
        GROUP BY IdProducto
    ) dv ON p.IdProducto = dv.IdProducto
    WHERE p.Nombre LIKE ?
    GROUP BY p.Nombre, p.Precio, p.Material, c.NomColor, ca.NomCategoria, m.NomMarca,
            p.Descripcion, p.Foto, p.IdColor, p.IdCategoria, p.IdMarca
    $orderClause
    LIMIT ? OFFSET ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(1, '%' . $Nombre . '%', PDO::PARAM_STR);
    $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function countProductoByNombre($Nombre)
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(DISTINCT CONCAT_WS('|',
                Nombre, Material, Precio, IdColor, IdCategoria, IdMarca, COALESCE(Descripcion, ''), COALESCE(Foto, '')
            ))
            FROM producto
            WHERE Nombre LIKE ?"
        );
        $stmt->execute(['%' . $Nombre . '%']);
        return (int)$stmt->fetchColumn();
    }

    public function getVariantesByProductoBase($idProductoBase)
    {
        $sql = "SELECT
                    p2.IdProducto,
                    p2.IdTalla,
                    t.NomTalla,
                    p2.Stock
                FROM producto pBase
                INNER JOIN producto p2
                    ON p2.Nombre = pBase.Nombre
                AND p2.Material = pBase.Material
                AND p2.Precio = pBase.Precio
                AND p2.IdColor = pBase.IdColor
                AND p2.IdCategoria = pBase.IdCategoria
                AND p2.IdMarca = pBase.IdMarca
                INNER JOIN talla t ON t.IdTalla = p2.IdTalla
                WHERE pBase.IdProducto = ?
                ORDER BY CAST(t.NomTalla AS UNSIGNED), t.NomTalla";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idProductoBase]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStockById($idProducto, $stock)
    {
        $sql = "UPDATE {$this->table_name} SET Stock = ? WHERE IdProducto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$stock, $idProducto]);
    }

    public function existeVarianteTallaEnModelo($idProductoBase, $idTalla)
    {
        $sql = "SELECT COUNT(*)
                FROM producto pBase
                INNER JOIN producto p2
                    ON p2.Nombre = pBase.Nombre
                AND p2.Material = pBase.Material
                AND p2.Precio = pBase.Precio
                AND p2.IdColor = pBase.IdColor
                AND p2.IdCategoria = pBase.IdCategoria
                AND p2.IdMarca = pBase.IdMarca
                WHERE pBase.IdProducto = ?
                AND p2.IdTalla = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idProductoBase, $idTalla]);
        return ((int)$stmt->fetchColumn()) > 0;
    }

    public function crearVarianteDesdeBase($idProductoBase, $idTalla, $stock)
    {
        $sql = "INSERT INTO {$this->table_name}
                    (Nombre, Material, Precio, IdTalla, IdColor, Stock, Foto, IdCategoria, IdMarca, Descripcion)
                SELECT
                    Nombre, Material, Precio, ?, IdColor, ?, Foto, IdCategoria, IdMarca, Descripcion
                FROM {$this->table_name}
                WHERE IdProducto = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idTalla, $stock, $idProductoBase]);
    }


}
?>
