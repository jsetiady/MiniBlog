<?php

// require_once("Db.php");
/*class Users {
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
    // object properties
    public $username;
    public $name;
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }
}*/



class UserHandler{

	private $httpVersion = "HTTP/1.1";

	function getUsers() {	
		$servername = "ap-cdbr-azure-southeast-b.cloudapp.net";
		$username = "baaafb453f5db3";
		$password = "d2e42ccf";
		$dbname = "rumaji";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);

		// users array
	    $users_arr = array();
	    $users_arr["records"] = array();


		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	extract($row);
		        $users_item = array(
		            "username" => $row['username'],
		            "name" => $row['name']
		        );
		        array_push($users_arr["records"], $users_item);
		    }

		     $statusMessage = "200 OK";
		} else {
		    $statusMessage = "400 Not Found";
			$users_arr = array('error' => 'No users found!');
		}
		// check if more than 0 record found
		/*if ($num > 0) {
		    // retrieve table contents
		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		        // extract row
		        extract($row);
		        $users_item = array(
		            "username" => $row['username'],
		            "name" => $row['name']
		        );
		        array_push($users_arr["records"], $users_item);
		    }
		    // assign status code
		    $statusMessage = "200 OK";
		} else {
		    $statusMessage = "404 Not Found";
			$users_arr = array('error' => 'No users found!');
		}
*/
		header($this->httpVersion. " ". $statusMessage);		
		header("Content-Type: application/json; charset=UTF-8");
				
		$response = json_encode($users_arr);
		echo $response;
	}
}

?>
