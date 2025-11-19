<?php
class database {
    private $host = 'localhost';
    private $db_name = 'latiendadelseis';
    private $username = 'root';
    private $password = '';
    public $conn;
    
    public function getConnection() 
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . 
            $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            echo "CONECTADO CON EXITO :)  ";
        } catch(PDOException $exception) {
            echo "ERROR DE CONEXION :(   " . $exception->getMessage();
        }
        return $this->conn;
    }

}
?>