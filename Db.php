<?php
 
class Db {
 
    private $host = "ap-cdbr-azure-southeast-b.cloudapp.net";
    private $db_name = "rumaji";
    private $username = "baaafb453f5db3";
    private $password = "d2e42ccf";
    public $conn;
 
    // get the database connection
    public function getConnection() {
        $this->$conn->close();
        $conn = new mysqli($servername, $username, $password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        echo "Connected successfully";
 
        return $this->conn;
    }
 
}
 
?>