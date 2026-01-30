<?php
/* Model para manejar productos del carrusel */
class CarruselModel {
    private $conn;
    private $table = 'carrusel';

    public function __construct($db) {
        $this->conn = $db;
        $this->ensureTable();
    }

    // Aseguramos que la tabla exista (creación inicial si es necesario)
    private function ensureTable() {
        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->table . "` (
            `Id` INT AUTO_INCREMENT PRIMARY KEY,
            `IdProducto` INT NOT NULL UNIQUE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->conn->exec($sql);
    }

    public function getAll() {
        $query = "SELECT IdProducto FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function isInCarrusel($idProducto) {
        $query = "SELECT 1 FROM " . $this->table . " WHERE IdProducto = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idProducto]);
        return (bool) $stmt->fetchColumn();
    }

    public function add($idProducto) {
        $query = "INSERT IGNORE INTO " . $this->table . " (IdProducto) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idProducto]);
    }

    public function remove($idProducto) {
        $query = "DELETE FROM " . $this->table . " WHERE IdProducto = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idProducto]);
    }

    // Reemplaza la lista completa por los ids proporcionados
    public function setAll(array $ids) {
        // Usamos transacción
        $this->conn->beginTransaction();
        try {
            $this->conn->exec("DELETE FROM " . $this->table);
            if (!empty($ids)) {
                $query = "INSERT INTO " . $this->table . " (IdProducto) VALUES (?)";
                $stmt = $this->conn->prepare($query);
                foreach ($ids as $id) {
                    $stmt->execute([$id]);
                }
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}

?>
