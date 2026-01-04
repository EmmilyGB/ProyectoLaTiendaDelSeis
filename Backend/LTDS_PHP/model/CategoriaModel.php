<?php

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
}
?>