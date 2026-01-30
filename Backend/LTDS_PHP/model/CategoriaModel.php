<?php
/* =========================
    MODEL: CategoriaModel
   ========================= */

class CategoriaModel {
    private $conn;
    private $table_name = "categoria";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCategoria() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertCategoria($Nombre) {
        $query = "INSERT INTO " . $this->table_name . " (NomCategoria) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$Nombre]);
        return $this->conn->lastInsertId();
    }

    public function getCategoriaById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdCategoria = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCategoriaByName($name) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE LOWER(NomCategoria) = LOWER(?) LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategoria($id, $Nombre) {
        $query = "UPDATE " . $this->table_name . " SET NomCategoria = ? WHERE IdCategoria = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$Nombre, $id]);
    }

    public function deleteCategoria($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdCategoria = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>