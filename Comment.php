<?php
require_once("Db.php");

class CommentHandler{
	private $httpVersion = "HTTP/1.1";

	function getComment() {	
		$db = new Db();
		$conn = $db->connectDB();

		if(isset($_GET['post_id'])){
			$post_id = mysqli_real_escape_string($conn,$_POST["post_id"]);
			$query = "SELECT 'name', 'date', 'comment' FROM 'comment' WHERE 'post_id' = '".$post_id."'";
			$resultset = $db->executeSelectQuery($query);

			if(!empty($resultset))
			    $statusMessage = "200 OK";
			else {
			    $statusMessage = "404 Not Found";
				$resultset = array('error' => 'No Comment found!');
			}
		}
	    
		header($this->httpVersion. " ". $statusMessage);		
		header("Content-Type: application/json; charset=UTF-8");
				
		$response = json_encode($resultset);
		echo $response;
		// $conn->close();
	}

	function addComment() {
		$db = new Db();
		$conn = $db->connectDB();
		
		if(isset($_GET['name'], $_GET['username'], $_GET['email'])){
			$name = mysqli_real_escape_string($conn,$_GET["name"]);
			$username = mysqli_real_escape_string($conn,$_GET["username"]);
			$email = mysqli_real_escape_string($conn,$_GET["email"]);
		}
		else {
			if(isset($_POST["name"], $_POST["email"], $_POST["comment"])){			
				$name = mysqli_real_escape_string($conn,$_POST["username"]);
				$email = mysqli_real_escape_string($conn,$_POST["name"]);
				$username = "guest";
			}
		}
		$post_id = mysqli_real_escape_string($conn,$_GET["post_id"]);
		$date = date("d/m/Y h:i:s");
		$comment = mysqli_real_escape_string($conn,$_POST["comment"]);

		$query = "INSERT INTO 'comment' ('post_id', 'username', 'name', 'email', 'comment', 'date') VALUES('".$post_id."','".$username."','".$name."','".$email."','".$comment."','".$date."')";
		$result = $db->executeQuery($query);

		if(!empty($result))
			$statusMessage = "200 OK";
		else {
		    $statusMessage = "404 Not Found";
			$resultset = array('error' => 'Cant add comment!');
		}
	}

}

?>
