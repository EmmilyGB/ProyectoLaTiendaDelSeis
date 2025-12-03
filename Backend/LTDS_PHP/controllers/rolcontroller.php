<?php
require_once __DIR__ . '/../model/rolmodel.php';
require_once __DIR__ . '/../config/database.php';

class RolController {
    private $model;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->model = new RolModel($this->db);
    }

    public function listRoles() {
        return $this->model->getRoles();
    }
}
?>