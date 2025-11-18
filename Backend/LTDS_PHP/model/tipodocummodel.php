<?php

class tipodocummodel {
    private $conn;
    private $table_name = "tipodocum";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function gettipodocum() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>   