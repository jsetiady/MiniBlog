<?php
 
class Db {

    private $servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
    private $username = "baaafb453f5db3";
    private $password = "d2e42ccf";
    private $dbname = "rumaji";
    private $conn;

    function __construct() {
        $conn = $this->connectDB();
        if(!empty($conn)) {
            $this->conn = $conn;            
        }
    }
    // get the database connection
    public function connectDB() {       
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        return $conn;
    }

    // function executeSelectQuery($query) {}
 
}
 
?>