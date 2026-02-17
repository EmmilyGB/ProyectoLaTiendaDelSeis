<?php
// models/OlvidarModel.php
class OlvidarModel {
    private $conn;
    private $table = 'password_resets';
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Buscar usuario por correo
    public function findByEmail($correo) {
        $query = "SELECT * FROM usuario WHERE Correo = :correo LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Crear token de recuperación
    public function createToken($numDoc) {
        // Generar token único
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Primero eliminar tokens anteriores del mismo usuario
        $deleteQuery = "DELETE FROM " . $this->table . " WHERE NumDoc = :num_doc";
        $deleteStmt = $this->conn->prepare($deleteQuery);
        $deleteStmt->execute(['num_doc' => $numDoc]);
        
        // Insertar nuevo token
        $query = "INSERT INTO " . $this->table . " (NumDoc, Token, ExpiresAt) 
                  VALUES (:num_doc, :token, :expires_at)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'num_doc' => $numDoc,
            'token' => hash('sha256', $token),
            'expires_at' => $expiresAt
        ]);
        
        return $token; // Retorna sin hashear para enviar por email
    }
    
    // Validar token
    public function validateToken($token) {
        $hashedToken = hash('sha256', $token);
        
        $query = "SELECT pr.*, u.Correo, u.NombreCom 
                  FROM " . $this->table . " pr
                  INNER JOIN usuario u ON pr.NumDoc = u.NumDoc
                  WHERE pr.Token = :token 
                  AND pr.ExpiresAt > NOW()";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['token' => $hashedToken]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Eliminar token usado
    public function deleteToken($token) {
        $hashedToken = hash('sha256', $token);
        
        $query = "DELETE FROM " . $this->table . " WHERE Token = :token";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['token' => $hashedToken]);
    }
    
    // Actualizar contraseña
    public function updatePassword($numDoc, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $query = "UPDATE usuario SET Password = :password WHERE NumDoc = :num_doc";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'password' => $hashedPassword,
            'num_doc' => $numDoc
        ]);
    }
    
    // Limpiar tokens expirados (mantenimiento)
    public function deleteExpiredTokens() {
        $query = "DELETE FROM " . $this->table . " WHERE ExpiresAt < NOW()";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
}
?>