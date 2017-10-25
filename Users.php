<?php
require_once("Db.php");

class UserHandler{

	private $httpVersion = "HTTP/1.1";

	function getUsers() {	


		$sql = "SELECT * FROM users";
	    $result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$resultset[] = $row;
		    }

		     $statusMessage = "200 OK";
		} else {
		    $statusMessage = "404 Not Found";
			$users_arr = array('error' => 'No users found!');
		}

		header($this->httpVersion. " ". $statusMessage);		
		header("Content-Type: application/json; charset=UTF-8");
				
		$response = json_encode($resultset);
		echo $response;
		$conn->close();
	}

	function createUsers() {
		$db = new Db();
		$conn = $db->getConnection();
	}

}

?>
