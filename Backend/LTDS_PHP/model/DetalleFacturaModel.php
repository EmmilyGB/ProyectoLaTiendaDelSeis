<?php

/* =========================
    MODEL: DetalleFacturaModel
    ========================= */

class DetalleFacturaModel {
    private $conn;
    private $table = "detallefactura";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insertDetalle($IdFactura, $IdProducto, $Cantidad, $PrecioUnitario, $Subtotal) {
        $query = "INSERT INTO {$this->table} (IdFactura, IdProducto, Cantidad, PrecioUnitario, Subtotal)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$IdFactura, $IdProducto, $Cantidad, $PrecioUnitario, $Subtotal]);
    }

    public function getDetallesByFactura($IdFactura) {
        $query = "SELECT d.*, p.Nombre, p.Precio, t.NomTalla AS Talla, c.NomColor AS Color FROM {$this->table} d
                LEFT JOIN producto p ON d.IdProducto = p.IdProducto
                LEFT JOIN talla t ON p.IdTalla = t.IdTalla
                LEFT JOIN color c ON p.IdColor = c.IdColor
                WHERE d.IdFactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$IdFactura]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteDetallesByFactura($IdFactura) {
    $query = "DELETE FROM detallefactura WHERE IdFactura = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$IdFactura]);
}

    public function countDetallesByFactura($IdFactura) {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE IdFactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$IdFactura]);
        return (int)$stmt->fetchColumn();
    }

}
?>
