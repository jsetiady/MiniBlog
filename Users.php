<?php

include_once '../Db.php';
class Users {
 
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
}



class UserHandler{

	private $httpVersion = "HTTP/1.1";

	function getUsers() {	
		$database = new Db();
		$db = $database->getConnection();
		 
		// initialize object
		$users = new Users($db);
		 
		// query users
		$stmt = $users->read();
		$num = $stmt->rowCount();
		 
	    // users array
	    $users_arr = array();
	    $users_arr["records"] = array();

		// check if more than 0 record found
		if ($num > 0) {
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

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		header($this->httpVersion. " ". $statusMessage);		
		header("Content-Type:". $requestContentType);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = json_encode($users_arr);
			echo $response;
		}
	}
}

?>
