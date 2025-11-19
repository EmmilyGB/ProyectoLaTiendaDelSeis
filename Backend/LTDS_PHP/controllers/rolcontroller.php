<?php
require_once './model/rolmodel.php';

class RolController {
    private $model;

    public function __construct() {
        require_once './config/database.php';
        $database = new Database();
        $db = $database->getConnection();

        $this->model = new RolModel($db);
    }

    public function listRoles() {
        return $this->model->getRoles();
    }
}
