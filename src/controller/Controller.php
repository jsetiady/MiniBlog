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
        $args = explode("/", $module);
        if(!isset($_SESSION['user']) && $args[0] == "blog") {
            if($args[1]!="") {
                $this->showBlog($args[1], $args[2]);
            }
            else {
                $this->showLogin();
            }
        }
        else
        if(!isset($_SESSION['user']) && $module == "register") 
        {
            $this->showRegister();
        }
        else 
        if(!isset($_SESSION['user']) && $module == "forgotpassword") 
        {
            $this->showForgotPassword();
        }
        else 
        if(!isset($_SESSION['user']) && $module == "validatelogin") 
        {
            $this->validateLogin();
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
                        case "addPost" :
                            $this->addPost();
                            break;
                        case "updatePost" :
                            $this->updatePost();
                            break;
                        case "editpost" :
                            if( !isset($_GET['postId'])) {
                               $this->showUserDashboard();
                            } else {
                                // check whether author has permission to update the post
                                $this->editPost($_GET['postId']);
                            }
                            break;
                        case "logout":
                            session_unset();
                            session_destroy();
                            echo '<script>window.location.replace("index.php");</script>';
                            break;
                        default:
                            $args = explode("/", $module);
                            switch($args[0]) {
                                case "blog": 
                                    if($args[1]=="") {
                                        $args[1] = $_SESSION["user_username"];
                                    }
                                    $this->showBlog($args[1], $args[2]);
                                    break;
                            }
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
    
    //authorization
    public function validateLogin($redirectVal = "false")
	{
        session_start();
        $_SESSION['user'] = array('temp');
        $_SESSION['user_name'] = "Tara Basro";
        $_SESSION['user_username'] = "sadasdsa";
        $_SESSION['username'] = "sadasdsa";
        echo '<script>window.location.replace("index.php");</script>';
	}
    
    //register page
	public function showRegister($redirectVal = "false")
	{
        include "src/view/register.php";
	}
    
    //forgot password page
	public function showForgotPassword($redirectVal = "false")
	{
        include "src/view/forgotpassword.php";
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
    
    function httpPost($url, $data)
    {
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
          $result = curl_exec($ch);
          curl_close($ch);  
          return $result;
    }

    
    public function addPost() {
        $url = API_URL . 'api/v1/posts/add';
        $data = array(
            'postTitle' => $_POST['postTitle'],
            'postAuthor' => $_POST['postAuthor'],
            'postDate' => $_POST['postDate'] . " " . $_POST['postTime'],
            'postContent' => $_POST['postContent']
        );
        
        $result = json_decode($this->httpPost($url, $data));
        if($result->message=="Success") {
           echo '<script>window.location.replace("index.php");</script>';
        }
    }
    
    public function editPost($postId) {
        $result = file_get_contents( API_URL . "api/v1/posts/" . $_SESSION["username"] ."/" .$postId);
        
        $arr = json_decode($result);
        $data = $arr[0];
        if( $_SESSION['username'] != $data->postAuthor ) {
            echo '<script>window.location.replace("index.php");</script>';
        } else {
            include "src/view/editPost.php";
        }
        
    }
    
    public function updatePost() {
        $url = API_URL . 'api/v1/posts/update';
        $data = array(
            'postId' => $_POST['postId'],
            'postTitle' => $_POST['postTitle'],
            'postAuthor' => $_POST['postAuthor'],
            'postContent' => $_POST['postContent']
        );
        $result = json_decode($this->httpPost($url, $data));
        
        if($result->message->affected_row==1) {
           echo '<script>window.location.replace("index.php");</script>';
        }
    }
    
    public function showBlog($author, $postId = "") {
        $arr = json_decode(file_get_contents( API_URL . "api/v1/posts/" . $author . "/" . $postId));
        $arr = array_chunk($arr, 3, true);
        
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
        include "src/view/blog.php";
    }
    
    // -- Admin Modules --
    public function showAdminDashboard() {
        
    }
    
}
?>