<?php
require_once __DIR__ . '/../model/ColorModel.php';
require_once __DIR__ . '/../config/database.php';

class ColorController {
    private $colorModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->colorModel = new ColorModel($this->db);
    }

    public function listColor() {
        return $this->colorModel->getColor();
    }
}
?>
