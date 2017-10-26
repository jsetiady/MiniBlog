<?php

class Controller {
	public $postModel;
	
	public function __construct()  
    {  
    	 session_start();
    } 
	
	public function invoke()
	{
		if(!isset($_SESSION['user']))
        {
		  	$this->showLogin();
		}
        else
        {
			echo "check role and show user dashboard";
		}
	}
	
	//login page
	public function showLogin($redirectVal = "false")
	{
        include "src/view/login.php";
	}
    
}
?>