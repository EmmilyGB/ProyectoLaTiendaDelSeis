<?php

class Usermodel {

    private $conn;
    private $table_name = "usuario";

    public function __construct($db) {
        $this->conn = $db;
    }

    // INSERTAR USUARIO
    public function InsertarUsuario($NumDoc, $TipoDoc, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol)
    {
        $query = "INSERT INTO $this->table_name 
        (NumDoc, TipoDoc, NombreCom, Correo, Password, Tel, Direccion, Rol)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $NumDoc, $TipoDoc, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol
        ]);
    }

    // LISTAR
    public function listarUsuarios()
    {
        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER USUARIO POR ID
    public function getUsuarioById($id)
    {
    $query = "SELECT * FROM $this->table_name WHERE IdUsuario = ? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // OBTENER USUSARIO POR NOMBRE
    public function getUsuarioByNombre($NombreCom)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE NombreCom LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['%' . $NombreCom . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ACTUALIZAR
    public function actualizarUsuario($NumDoc, $TipoDoc, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol, $id)
    {
        $query = "UPDATE $this->table_name SET
            NumDoc=?, TipoDoc=?, NombreCom=?, Correo=?, Password=?, Tel=?, Direccion=?, Rol=?
            WHERE IdUsuario=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $NumDoc, $TipoDoc, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol, $id
        ]);
    }

    // ELIMINAR
    public function eliminarUsuario($id)
    {
        $query = "DELETE FROM $this->table_name WHERE IdUsuario=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }


}
