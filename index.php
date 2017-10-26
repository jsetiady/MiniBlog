<?php 
	include_once("controller/Controller.php");
	$controller = new Controller();
	
	if(isset($_GET['cont']) && isset($_GET['action']))
	{
		$cont = $_GET['cont'];
		$action = $_GET['action'];
		if($cont == "api")
		{
			switch($action)
			{
				case "posts" :
					$controller->posts();
					break;
			}
		}
	}
	else
	{
		$controller->invoke();
	}
?>