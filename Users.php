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
		// $conn->close();
	}

	function createUsers() {
		$db = new Db();
		if(isset($_POST["username"], $_POST["name"], $_POST["password"])){			
			$username = $_POST["username"];
			$name = $_POST["name"];
			$password = base64_encode($_POST["password"]);
			$role = "user";
			
			$query = "INSERT INTO users (username, name, password, role) VALUES('".$username."','".$name."','".$password."','".$role."')";
			$result = $db->executeQuery($query);

			if(!empty($result))
				$statusMessage = "200 OK";
			else {
			    $statusMessage = "404 Not Found";
				$resultset = array('error' => 'Cant create user!');
			}
		}
	}

}

?>
