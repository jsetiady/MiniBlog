<?php
 
class Db {
     $servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
     $username = "baaafb453f5db3";
     $password = "d2e42ccf";
     $dbname = "rumaji";


    // get the database connection
    public function getConnection() {
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