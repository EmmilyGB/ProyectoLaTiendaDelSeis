<?php

class ColorModel {
    private $conn;
    private $table_name = "color";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getColor() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>