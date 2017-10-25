<?php
require_once("Users.php");
		

/*
controls the RESTful services
URL mapping
*/

	$userHandler = new UserHandler();
	$userHandler->getUsers();

?>