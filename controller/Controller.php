<?php
include_once("ModelLoadController.php");
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']."/MiniBlog/view/");
define("ABS_PATH_ROOT", $_SERVER['DOCUMENT_ROOT']."/MiniBlog/");

class Controller {
	public $postModel;
 	public $baseurl = "http://localhost:8888/MiniBlog";
	
	public function __construct()  
    {  
    	 session_start();
         $this->postModel = new PostModel();
    } 
	
	public function invoke()
	{
		if(isset($_SESSION['userMiniBlog'])) {
		  	//show login page
			//include 'view/loginUser.php';
		} else {
			$title = "Home - MiniBlog";
			include 'view/home.php';
		}
	}
	
	//login page
	public function showLogin($redirectVal = "false")
	{
		$title = "Login - MiniBlog";
		//include 'view/login/loginUser.php';
	}
	//end of login
	
	
	// API function
	public function posts()
	{
		$posts = $this->postModel->getAllPosts();
		echo json_encode($posts);
	}
    
}
?>