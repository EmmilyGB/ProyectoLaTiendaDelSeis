<?php
require_once __DIR__ . '/../model/TallaModel.php';
require_once __DIR__ . '/../config/database.php';

class TallaController {
    private $tallaModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tallaModel = new TallaModel($this->db);
    }

    public function listTalla() {
        return $this->tallaModel->getTalla();
    }
}
?>
