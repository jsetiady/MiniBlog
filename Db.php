<?php
 
class Db {

    public $conn;
    // get the database connection
    public function getConnection() {
         $servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
         $username = "baaafb453f5db3";
         $password = "d2e42ccf";
         $dbname = "rumaji";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        // echo "Connected successfully";
 
        return $conn;
    }
 
}
 
?>