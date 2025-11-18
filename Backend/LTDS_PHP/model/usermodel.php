<?php

//conectar a la base de datos, y tabla usuarios

class usermodel {
    private $conn;
    private $table_name = "usuario";

//constructor con la conexion a la base de datos

    public function __construct($db) {
        $this->conn = $db;
    }

//insertar usuario

    public function insertuser($NumDoc, $TipoDoc, $NombreCom, $Correo, $Password,
        $Tel, $Direccion, $Rol)
    {

//insertar datos en la tabla
        $query = "INSERT INTO " . $this->table_name . "(NumDoc, TipoDoc, NombreCom, Correo, Password,
        Tel, Direccion, Rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$NumDoc, $TipoDoc, $NombreCom, $Correo, $Password,
        $Tel, $Direccion, $Rol]);
    }
}
