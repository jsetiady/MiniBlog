<?php
 
class Db {
    private $servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
    private $username = "baaafb453f5db3";
    private $password = "d2e42ccf";
    private $dbname = "rumaji";
    public $conn;

    // Create connection
    




 
    // get the database connection
    public function getConnection() {
        $this->$conn->close();
        $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        echo "Connected successfully";
 
        return $this->conn;
    }
 
}
 
?>