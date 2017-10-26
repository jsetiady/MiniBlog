<?php

class Controller {
	public $postModel;
	
	public function __construct()  
    {  
    	 session_start();
    } 
	
	public function invoke($module)
	{
        $_SESSION['user'] = array('temp'); // Please remove when session already implemented
        
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
                    }
                    
                    
                } else {
                    
                    $this->showAdminDashboard();
                }
                echo "check role and show user dashboard";
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
    public function showAdminDashboard() {
        
    }
    
}
?>