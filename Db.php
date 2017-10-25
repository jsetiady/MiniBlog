<?php
 
class Db {

     
    public $conn;

    // get the database connection
    public function getConnection() {     
    $servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
     $username = "baaafb453f5db3";
     $password = "d2e42ccf";
     $dbname = "rumaji";  
        $conn = new mysqli($this->$servername, $this->$username, $this->$password, $this->$dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        return $conn;
    }

    // function executeSelectQuery($query) {}
 
}
 
?>