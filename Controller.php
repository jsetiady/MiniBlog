<?php
require_once("Users.php");
	
	if(isset($_POST["username"])){
		echo "berhasil cuk";
	}
	else{
		$userHandler = new UserHandler();
		$userHandler->getUsers();
	}
	

?>