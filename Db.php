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

    public function connectDB() {       
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        return $conn;
    }

    function executeSelectQuery($query){
        $result = mysqli_query($this->conn, $query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
                $resultset[] = $row;
            return $resultset;
        } 
    }

    function executeQuery($query) {
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            //check for duplicate entry
            if($this->conn->errno == 1062)
                return false;
            else
                trigger_error (mysqli_error($this->conn),E_USER_NOTICE);            
        }       
        $affectedRows = mysqli_affected_rows($this->conn);
        return $affectedRows;        
    }
 
}
 
?>