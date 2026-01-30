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
        $query = "SELECT d.*, p.Nombre, p.Precio FROM {$this->table} d
                LEFT JOIN producto p ON d.IdProducto = p.IdProducto
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

}
?>
