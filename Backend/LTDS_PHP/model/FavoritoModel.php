<?php
/* =========================
    MODEL: FavoritoModel
    ========================= */
class FavoritoModel {
    private $conn;
    private $table = 'favoritos';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function isFavorito($NumDoc, $IdProducto) {
        $stmt = $this->conn->prepare("SELECT 1 FROM {$this->table} WHERE NumDoc = ? AND IdProducto = ? LIMIT 1");
        $stmt->execute([$NumDoc, $IdProducto]);
        return $stmt->fetchColumn() ? true : false;
    }

    public function addFavorito($NumDoc, $IdProducto) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (NumDoc, IdProducto, created_at) VALUES (?, ?, NOW())");
        return $stmt->execute([$NumDoc, $IdProducto]);
    }

    public function removeFavorito($NumDoc, $IdProducto) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE NumDoc = ? AND IdProducto = ?");
        return $stmt->execute([$NumDoc, $IdProducto]);
    }

    public function listByUser($NumDoc) {
        $stmt = $this->conn->prepare("SELECT f.Id, f.IdProducto, p.Nombre, p.Precio, p.Foto FROM {$this->table} f JOIN producto p ON f.IdProducto = p.IdProducto WHERE f.NumDoc = ?");
        $stmt->execute([$NumDoc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>