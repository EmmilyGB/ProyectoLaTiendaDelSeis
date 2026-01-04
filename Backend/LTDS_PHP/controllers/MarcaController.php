<?php
require_once __DIR__ . '/../model/MarcaModel.php';
require_once __DIR__ . '/../config/database.php';

class MarcaController {
    private $MarcaModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->MarcaModel = new MarcaModel($this->db);
    }

    public function listMarca() {
        return $this->MarcaModel->getMarca();
    }
}
?>