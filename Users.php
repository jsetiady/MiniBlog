<?php
require_once("Db.php");

class UserHandler{
	private $httpVersion = "HTTP/1.1";

	function getUsers() {	
		$query = "SELECT * FROM users";
		$db = new Db();
	    $resultset = $db->executeSelectQuery($query);

		if(!empty($resultset))
		    $statusMessage = "200 OK";
		else {
		    $statusMessage = "404 Not Found";
			$resultset = array('error' => 'No users found!');
		}

		header($this->httpVersion. " ". $statusMessage);		
		header("Content-Type: application/json; charset=UTF-8");
				
		$response = json_encode($resultset);
		echo $response;
		$conn->close();
	}

	/*function createUsers() {
		$db = new Db();
		$conn = $db->getConnection();
	}*/

}

?>
