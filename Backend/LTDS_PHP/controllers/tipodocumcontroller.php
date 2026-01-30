<?php

require_once __DIR__ . '/../model/TipoDocModel.php';

/* =========================
    CONTROLLER: Tipodocumcontroller
    ========================= */

class tipodocumcontroller {
    private $db;
    private $TipoDocModel;

    public function __construct() 
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->TipoDocModel = new TipoDocModel($this->db);
    }

    public function listTipoDocum() 
    {
        return $this->TipoDocModel->gettipodocum();
    }
}
?>