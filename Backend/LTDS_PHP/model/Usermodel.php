<?php

class Usermodel {

    private $conn;
    private $table_name = "usuario";

    public function __construct($db) {
        $this->conn = $db;
    }

    // INSERTAR USUARIO
    public function InsertarUsuario($NumDoc, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol)
    {
        try {
            $query = "INSERT INTO $this->table_name 
            (NumDoc, IdTipoDocum, NombreCom, Correo, Password, Tel, Direccion, Rol)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                $NumDoc, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol
            ]);

            return true;

        } catch (PDOException $e) {

            if ($e->getCode() == "23000") { // Duplicado PK
                return "duplicate";
            }

            return false;
        }
    }

    // LISTAR USUARIOS (con JOIN para mostrar TipoDoc y NameRol)
    public function listarUsuariosWithDocAndRole()
    {
        $query = "SELECT u.*, t.TipoDoc, r.NameRol FROM $this->table_name u
                LEFT JOIN tipodocum t ON u.IdTipoDocum = t.IdTipoDocum
                  +LEFT JOIN rol r ON u.Rol = r.Rol";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER USUARIO POR NUMDOC
    public function getUsuarioById($id)
    {
        $query = "SELECT * FROM $this->table_name WHERE NumDoc = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // BUSCAR USUARIO POR NOMBRE (con JOIN)
    public function getUsuarioByNombreWithDocAndRole($NombreCom)
    {
        $query = "SELECT u.*, t.TipoDoc, r.NameRol FROM $this->table_name u
                  LEFT JOIN tipodocum t ON u.IdTipoDocum = t.IdTipoDocum
                  LEFT JOIN rol r ON u.Rol = r.Rol
                WHERE u.NombreCom LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['%' . $NombreCom . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ACTUALIZAR USUARIO
    public function actualizarUsuario($NumDocNuevo, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol, $NumDocOriginal)
    {
        $query = "UPDATE $this->table_name SET
            NumDoc=?, IdTipoDocum=?, NombreCom=?, Correo=?, Password=?, Tel=?, Direccion=?, Rol=?
            WHERE NumDoc=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $NumDocNuevo, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol,
            $NumDocOriginal
        ]);
    }

    // ELIMINAR USUARIO
    public function eliminarUsuario($NumDoc)
    {
        $query = "DELETE FROM $this->table_name WHERE NumDoc=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$NumDoc]);
    }

}
?>