<?php
require_once("Users.php");
	
	if(isset($_POST["username"])){
		$userHandler = new UserHandler();
		$userHandler->createUsers();
	}
	else{
		$userHandler = new UserHandler();
		$userHandler->getUsers();
	}
	

?>