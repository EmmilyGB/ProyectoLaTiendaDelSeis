<?php

require_once 'config/database.php';
require_once 'model/usermodel.php';

class usercontroller {
    private $db;
    private $usermodel;

    public function __construct() 
    {
        $database = new database();
        $this->db = $database->getConnection();
        $this->usermodel = new usermodel($this->db);
    }
    public function insertuser() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $NumDoc = $_POST['NumDoc'];
            $TipoDoc = $_POST['TipoDoc'];
            $NombreCom = $_POST['NombreCom'];
            $Correo = $_POST['Correo'];
            $Password = $_POST['Password'];
            $Tel = $_POST['Tel'];
            $Direccion = $_POST['Direccion'];
            $Rol = $_POST['Rol'];

            $this->usermodel->insertuser($NumDoc, $TipoDoc, $NombreCom, $Correo, $Password,
        $Tel, $Direccion, $Rol);

        }
    }
}