<?php

include_once("api.config.php");

class Controller {
    public function __construct()  
    {  
    	 session_start();
    } 
	
	public function invoke($module)
	{
        //$_SESSION['user'] = array('temp'); // Please remove when session already implemented
        
        if(!isset($_SESSION['user']) && $module == "register") 
        {
            $this->showRegister();
        }
        else {
            
            if(!isset($_SESSION['user']))
            {
                $this->showLogin();
            }
            
            else
            {
                
                $role = "admin";
                $role = "user";
                
                if ($role == "user") {
                    switch ($module) {
                        case "home": 
                            $this->showUserDashboard();
                            break;
                        case "newpost" :
                            $this->addNewPost();
                            break;
                    }
                    
                    
                } else {
                    
                    $this->showAdminDashboard();
                }
            }
        }
	}
	
	//login page
	public function showLogin($redirectVal = "false")
	{
        include "src/view/login.php";
	}
    
    //register page
	public function showRegister($redirectVal = "false")
	{
        include "src/view/register.php";
	}
    
    
    // -- Blog Owner  --
    public function showUserDashboard() 
    {
        $arr = json_decode(file_get_contents( API_URL . "api/v1/posts/sadasdsa")); // TODO: change to session[username]
        $arr = array_chunk($arr, 10, true);
        
        $pg = $_GET['page'];
        if( empty($pg))
        {
            $data = $arr[0];
            $pg = 1;
        }
        else {
            if((int)$pg > count($arr))
            {
                $data = $arr[0];
            }
            else
            {
                $data = $arr[ ((int) $pg)-1];
            }
        }
        $page = count($arr);
        include "src/view/dashboard.php";
    }
    
    public function addNewPost() {
        include "src/view/addPost.php";
    }
    
    // -- Admin Modules --
    public function showAdminDashboard() {
        include "src/view/home.php";
    }
    
}
?>