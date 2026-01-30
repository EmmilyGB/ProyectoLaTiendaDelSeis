<?php

/* =========================
    MODEL: MarcaModel
    ========================= */

class MarcaModel {
    private $conn;
    private $table_name = "marca";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getMarca() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertMarca($NomMarca) {
        $query = "INSERT INTO " . $this->table_name . " (NomMarca) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$NomMarca]);
        return $this->conn->lastInsertId();
    }

    public function deleteMarca($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdMarca = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>