<?php
 
class Db {

    private $servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
    private $username = "baaafb453f5db3";
    private $password = "d2e42ccf";
    private $dbname = "rumaji";
    private $conn;

    // get the database connection
    public function getConnection() {       
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } 

        return $this->conn;
    }

    // function executeSelectQuery($query) {}
 
}
 
?>