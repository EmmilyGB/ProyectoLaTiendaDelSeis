<?php
class FacturaModel {
    private $conn;
    private $table = "factura";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearFactura($NumDoc, $Total) {
        $query = "INSERT INTO {$this->table} (FechaFactura, NumDoc, Total) VALUES (NOW(), ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$NumDoc, $Total]);
        return $this->conn->lastInsertId();
    }

    public function listarFacturas() {
        $query = "SELECT f.*, u.NombreCom FROM {$this->table} f
                LEFT JOIN usuario u ON f.NumDoc = u.NumDoc
                ORDER BY f.IdFactura DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFacturaById($id) {
        $query = "SELECT f.*, u.NombreCom, u.Correo FROM {$this->table} f
                LEFT JOIN usuario u ON f.NumDoc = u.NumDoc
                WHERE f.IdFactura = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteFactura($IdFactura) {
    $query = "DELETE FROM factura WHERE IdFactura = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$IdFactura]);
}




}
?>
