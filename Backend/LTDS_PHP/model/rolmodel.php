<?php

/* =========================
    MODEL: RolModel
    ========================= */

class RolModel {

    private $conn;
    private $table_name = "rol";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getRoles() {
        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>