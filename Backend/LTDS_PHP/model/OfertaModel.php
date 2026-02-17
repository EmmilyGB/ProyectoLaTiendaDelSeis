<?php
class OfertaModel
{
    private $conn;
    private $table = 'oferta_producto';

    public function __construct($db)
    {
        $this->conn = $db;
        $this->ensureTable();
    }

    private function ensureTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->table . "` (
            `Id` INT AUTO_INCREMENT PRIMARY KEY,
            `IdProducto` INT NOT NULL UNIQUE,
            `PrecioOferta` DECIMAL(10,2) NOT NULL,
            `ActualizadoEn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->conn->exec($sql);
    }

    public function getAllMap()
    {
        $stmt = $this->conn->prepare("SELECT IdProducto, PrecioOferta FROM " . $this->table);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $map = [];
        foreach ($rows as $row) {
            $map[(int)$row['IdProducto']] = (float)$row['PrecioOferta'];
        }
        return $map;
    }

    public function setAll(array $offersByProductId)
    {
        $this->conn->beginTransaction();
        try {
            $this->conn->exec("DELETE FROM " . $this->table);
            if (!empty($offersByProductId)) {
                $stmt = $this->conn->prepare(
                    "INSERT INTO " . $this->table . " (IdProducto, PrecioOferta) VALUES (?, ?)"
                );
                foreach ($offersByProductId as $idProducto => $precioOferta) {
                    $stmt->execute([(int)$idProducto, (float)$precioOferta]);
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

