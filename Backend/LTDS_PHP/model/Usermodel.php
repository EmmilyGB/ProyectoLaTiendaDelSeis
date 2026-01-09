<?php
class Usermodel {

    private $conn;
    private $table = "usuario";

    public function __construct($db) {
        $this->conn = $db;
    }

    /* ======================
    REGISTRO
    ====================== */
    public function InsertarUsuario($NumDoc, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol) {

        // verificar duplicado
        $check = $this->conn->prepare("SELECT NumDoc FROM usuario WHERE NumDoc = ?");
        $check->execute([$NumDoc]);

        if ($check->rowCount() > 0) {
            return "duplicate";
        }

        $hash = password_hash($Password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario 
                (NumDoc, IdTipoDocum, NombreCom, Correo, Password, Tel, Direccion, Rol)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $NumDoc,
            $IdTipoDocum,
            $NombreCom,
            $Correo,
            $hash,
            $Tel,
            $Direccion,
            $Rol
        ]);

        return true;
    }

    /* ======================
    LOGIN
    ====================== */
    public function login($correo, $password) {

        $sql = "SELECT u.*, r.NameRol 
                FROM usuario u
                INNER JOIN rol r ON u.Rol = r.Rol
                WHERE u.Correo = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$correo]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }

        return false;
    }

    /* ======================
    LISTADOS
    ====================== */
    public function listarUsuariosWithDocAndRole() {
        $sql = "SELECT u.*, r.NameRol, t.TipoDoc
                FROM usuario u
                INNER JOIN rol r ON u.Rol = r.Rol
                INNER JOIN tipodocum t ON u.IdTipoDocum = t.IdTipoDocum";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE NumDoc = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($NumDoc, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol, $NumDocOriginal) {

        $hash = password_hash($Password, PASSWORD_DEFAULT);

        $sql = "UPDATE usuario SET
                NumDoc = ?, IdTipoDocum = ?, NombreCom = ?, Correo = ?, Password = ?, 
                Tel = ?, Direccion = ?, Rol = ?
                WHERE NumDoc = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $NumDoc,
            $IdTipoDocum,
            $NombreCom,
            $Correo,
            $hash,
            $Tel,
            $Direccion,
            $Rol,
            $NumDocOriginal
        ]);
    }

    public function eliminarUsuario($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuario WHERE NumDoc = ?");
        $stmt->execute([$id]);
    }



}
