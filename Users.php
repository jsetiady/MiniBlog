<?php

require_once("Db.php");




class UserHandler{

	private $httpVersion = "HTTP/1.1";

	function getUsers() {	
		$db = new Db();
		$conn = $db->getConnection();

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

		header($this->httpVersion. " ". $statusMessage);		
		header("Content-Type: application/json; charset=UTF-8");
				
		$response = json_encode($users_arr);
		echo $response;
	}
}

?>
