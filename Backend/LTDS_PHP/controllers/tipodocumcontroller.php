<?php

require_once __DIR__ . '/../model/tipodocummodel.php';
require_once __DIR__ . '/../config/database.php';

class tipodocumcontroller {
    private $db;
    private $tipodocummodel;

    public function __construct() 
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tipodocummodel = new tipodocummodel($this->db);
    }

    public function listTipoDocum() 
    {
        return $this->tipodocummodel->gettipodocum();
    }
}
?>