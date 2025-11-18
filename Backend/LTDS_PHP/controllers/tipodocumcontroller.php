<?php

require_once 'model/tipodocummodel.php';
require_once 'config/database.php';

class tipodocumcontroller {
    private $db;
    private $tipodocummodel;

    public function __construct() 
    {
        $database = new database();
        $this->db = $database->getConnection();
        $this->tipodocummodel = new tipodocummodel($this->db);
    }

    public function listTipoDocum() 
    {
        return $this->tipodocummodel->gettipodocum();
    }
}
?>