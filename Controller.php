<?php
require_once("Users.php");
		

/*
controls the RESTful services
URL mapping
*/

	$users = new UserHandler();
	$users->getUsers();

?>