<?php

/* =========================
    MODEL: Usermodel
    ========================= */

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

        // verificar duplicados
        $dupDoc = $this->conn->prepare("SELECT 1 FROM usuario WHERE NumDoc = ? LIMIT 1");
        $dupDoc->execute([$NumDoc]);
        $docExists = $dupDoc->rowCount() > 0;

        $dupCorreo = $this->conn->prepare("SELECT 1 FROM usuario WHERE Correo = ? LIMIT 1");
        $dupCorreo->execute([$Correo]);
        $correoExists = $dupCorreo->rowCount() > 0;

        if ($docExists && $correoExists) {
            return "duplicate_both";
        }
        if ($docExists) {
            return "duplicate_doc";
        }
        if ($correoExists) {
            return "duplicate_email";
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

    /**
     * Obtener usuario por correo (sin verificar contraseña)
     */
    public function getUsuarioByCorreo($correo) {
        $sql = "SELECT u.*, r.NameRol 
                FROM usuario u
                INNER JOIN rol r ON u.Rol = r.Rol
                WHERE u.Correo = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function listarUsuariosWithDocAndRolePaged($limit, $offset) {
        $sql = "SELECT u.*, r.NameRol, t.TipoDoc
                FROM usuario u
                INNER JOIN rol r ON u.Rol = r.Rol
                INNER JOIN tipodocum t ON u.IdTipoDocum = t.IdTipoDocum
                LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUsuarios() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuario");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function listarUsuariosByNamePaged($NombreCom, $limit, $offset) {
        $sql = "SELECT u.*, r.NameRol, t.TipoDoc
                FROM usuario u
                INNER JOIN rol r ON u.Rol = r.Rol
                INNER JOIN tipodocum t ON u.IdTipoDocum = t.IdTipoDocum
                WHERE u.NombreCom LIKE ?
                LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, '%' . $NombreCom . '%', PDO::PARAM_STR);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUsuariosByName($NombreCom) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuario WHERE NombreCom LIKE ?");
        $stmt->execute(['%' . $NombreCom . '%']);
        return (int)$stmt->fetchColumn();
    }

    public function getUsuarioById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE NumDoc = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($NumDoc, $IdTipoDocum, $NombreCom, $Correo, $Password, $Tel, $Direccion, $Rol, $NumDocOriginal) {
        if (!empty($Password)) {
            $hash = password_hash($Password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET
                    NumDoc = ?, IdTipoDocum = ?, NombreCom = ?, Correo = ?, Password = ?, 
                    Tel = ?, Direccion = ?, Rol = ?
                    WHERE NumDoc = ?";
            $params = [
                $NumDoc,
                $IdTipoDocum,
                $NombreCom,
                $Correo,
                $hash,
                $Tel,
                $Direccion,
                $Rol,
                $NumDocOriginal
            ];
        } else {
            $sql = "UPDATE usuario SET
                    NumDoc = ?, IdTipoDocum = ?, NombreCom = ?, Correo = ?, 
                    Tel = ?, Direccion = ?, Rol = ?
                    WHERE NumDoc = ?";
            $params = [
                $NumDoc,
                $IdTipoDocum,
                $NombreCom,
                $Correo,
                $Tel,
                $Direccion,
                $Rol,
                $NumDocOriginal
            ];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
    }

    public function eliminarUsuario($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuario WHERE NumDoc = ?");
        $stmt->execute([$id]);
    }
 /* ======================
    ACTULIZAR PERFIL
    ====================== */
    
    /**
     * Verificar si un correo está disponible para un usuario específico
     * (excluyendo su propio NumDoc)
     */
    public function correoDisponiblePara($correo, $numDocActual) {
        $sql = "SELECT COUNT(*) as count FROM usuario 
                WHERE Correo = ? AND NumDoc != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$correo, $numDocActual]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0; // true si está disponible
    }

    /**
     * Actualizar perfil de usuario
     */
    public function actualizarPerfil($numDoc, $nombreCom, $correo, $passwordNueva, $tel, $direccion) {
        if (!empty($passwordNueva)) {
            // Si hay nueva contraseña, actualizarla también
            $hash = password_hash($passwordNueva, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET 
                    NombreCom = ?, 
                    Correo = ?, 
                    Password = ?, 
                    Tel = ?, 
                    Direccion = ?
                    WHERE NumDoc = ?";
            $params = [$nombreCom, $correo, $hash, $tel, $direccion, $numDoc];
        } else {
            // Sin cambio de contraseña
            $sql = "UPDATE usuario SET 
                    NombreCom = ?, 
                    Correo = ?, 
                    Tel = ?, 
                    Direccion = ?
                    WHERE NumDoc = ?";
            $params = [$nombreCom, $correo, $tel, $direccion, $numDoc];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return true;
    }


}


