<?php

/* =========================
    MODEL: FacturaModel
    ========================= */

class FacturaModel {
    private $conn;
    private $table = "factura";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearFactura($NumDoc, $Total) {
        $query = "INSERT INTO {$this->table} (FechaFactura, NumDoc, Total, Inhabilitado, Estado) VALUES (NOW(), ?, ?, 0, 'Pendiente')";
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

    public function listarFacturasPaged($limit, $offset) {
        $query = "SELECT f.*, u.NombreCom FROM {$this->table} f
                LEFT JOIN usuario u ON f.NumDoc = u.NumDoc
                ORDER BY f.IdFactura DESC
                LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countFacturas() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM {$this->table}");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getFacturaById($id) {
        $query = "SELECT f.*, u.NombreCom, u.Correo FROM {$this->table} f
                LEFT JOIN usuario u ON f.NumDoc = u.NumDoc
                WHERE f.IdFactura = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFacturaByIdAndCliente($id, $numDoc) {
        $query = "SELECT f.*, u.NombreCom, u.Correo FROM {$this->table} f
                LEFT JOIN usuario u ON f.NumDoc = u.NumDoc
                WHERE f.IdFactura = ? AND f.NumDoc = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id, $numDoc]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($idFactura, $estado) {
        $query = "UPDATE {$this->table} SET Estado = ? WHERE IdFactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$estado, $idFactura]);
    }

    public function listarPedidosByClientePaged($numDoc, $limit, $offset) {
        $query = "SELECT f.* FROM {$this->table} f
                WHERE f.NumDoc = ?
                ORDER BY f.IdFactura DESC
                LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $numDoc);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPedidosByCliente($numDoc) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM {$this->table} WHERE NumDoc = ?");
        $stmt->execute([$numDoc]);
        return (int)$stmt->fetchColumn();
    }

    public function deleteFactura($IdFactura) {
    $query = "DELETE FROM factura WHERE IdFactura = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$IdFactura]);
}

    public function inhabilitarFactura($IdFactura) {
        $query = "UPDATE {$this->table} SET Inhabilitado = 1 WHERE IdFactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$IdFactura]);
    }




}
?>
