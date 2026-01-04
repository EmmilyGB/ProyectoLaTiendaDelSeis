<?php

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
}
?>