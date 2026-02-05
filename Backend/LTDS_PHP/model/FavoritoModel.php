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

    public function listByUserPaged($NumDoc, $limit, $offset) {
        $stmt = $this->conn->prepare("SELECT f.Id, f.IdProducto, p.Nombre, p.Precio, p.Foto
            FROM {$this->table} f
            JOIN producto p ON f.IdProducto = p.IdProducto
            WHERE f.NumDoc = ?
            LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $NumDoc, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByUser($NumDoc) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM {$this->table} WHERE NumDoc = ?");
        $stmt->execute([$NumDoc]);
        return (int)$stmt->fetchColumn();
    }
}

?>
