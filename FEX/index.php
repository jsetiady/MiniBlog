<?php 

include_once("src/controller/Controller.php");

$controller = new Controller();

$module = empty($_GET["module"]) ? "home" : $_GET['module'];
$controller->invoke($module);
