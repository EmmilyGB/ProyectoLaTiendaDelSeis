<?php
require_once __DIR__ . '/../model/CategoriaModel.php';
require_once __DIR__ . '/../config/database.php';

class CategoriaController {
    private $CategoriaModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->CategoriaModel = new CategoriaModel($this->db);
    }

    public function listCategoria() {
        return $this->CategoriaModel->getCategoria();
    }
}
?>