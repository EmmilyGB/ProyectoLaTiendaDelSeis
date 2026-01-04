<?php

class TallaModel {
    private $conn;
    private $table_name = "talla";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTalla() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>