<?php
 
class Db {
 
    private $host = "ap-cdbr-azure-southeast-b.cloudapp.net";
    private $db_name = "rumaji";
    private $username = "baaafb453f5db3";
    private $password = "d2e42ccf";
    public $conn;
 
    // get the database connection
    public function getConnection() {
        $this->conn = null;
 
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Database connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
 
}
 
?>