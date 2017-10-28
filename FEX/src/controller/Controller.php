<?php
error_reporting(E_ERROR);
include_once("api.config.php");
class Controller {
    public function __construct()  
    {  
    	 session_start();
    } 
	
	public function invoke($module,$post)
	{        
        if(empty($_SESSION['session_id']) && $module == "register") 
        {
            $this->showRegister();
        }
        else 
        if(empty($_SESSION['session_id']) && $module == "forgotpassword") 
        {
            $this->showForgotPassword();
        }
        else 
        if(empty($_SESSION['session_id']) && $module == "validatelogin") 
        {
            $this->validateLogin();
        }
        else {
            
            if(empty($_SESSION['session_id']))
            {
                $this->showLogin();
            }
            
            else
            {
                
                $role = "admin"; //?
                $role = "user";
                
                if ($role == "user") {
                    switch ($module) {
                        case "home": 
                            $this->showUserDashboard();
                            break;
                        case "newpost" :
                            $this->addNewPost();
                            break;
                        case "editpost" :
                            if( !isset($_GET['postId'])) {
                               $this->showUserDashboard();
                            } else {
                                // check whether author has permission to update the post
                                $this->editPost($_GET['postId']);
                            }
                            break;
                        case "changepassword" :
							$checksession = $this->checkSession();
                            if( !$checksession) {
                               $this->showUserDashboard();
                            } else {
								if(!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['renew_password']))
								{
									$check = $this->changePassword();
									if($check)
									{
										echo '<script>window.alert("Success to change password");</script>';
										echo '<script>window.location.replace("index.php");</script>';										
									}
									else
									{
										echo '<script>window.alert("Failed to change password");</script>';
										echo '<script>window.location.replace("index.php");</script>';										
									}
								}
                                $this->showChangePassword();
                            }
                            break;							
                        case "logout":
                            session_unset();
                            session_destroy();
                            echo '<script>window.location.replace("index.php");</script>';
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
    
    //authorization / login
    public function validateLogin($redirectVal = "false")
	{
		include("lib/security_lib.php");	
		$securitylib = new Security_Lib();
		$username = $_POST['username'];
		$password = $_POST['password'];
		$data = json_encode(array('action'=>'login','username'=>$username,'password'=>$password),true);
		$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
		$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
		$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
		$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
		$url = API_URL . "user.php";	
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		$decode = json_decode($response,true);
		$getdecodeddata = $decode['data'];	
		$getsessionid = $decode['session_id'];
		$errorcode = $decode['error_code'];
		$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
		$return = json_decode($getpostdata,true);
		if(!empty($getsessionid))
		{
			$_SESSION['session_id'] = $getsessionid;				
			$_SESSION['name'] = $return['name'];
			$_SESSION['role'] = $return['role'];
			$_SESSION['username'] = $username;				
		}
        echo '<script>window.location.replace("index.php");</script>';
	}
	
	public function checkSession($redirectVal = "false")
	{
		include("lib/security_lib.php");	
		$securitylib = new Security_Lib();
		$username = $_SESSION['username'];
		$session_id = $_SESSION['session_id'];	
		$data = json_encode(array('action'=>'checksession','username'=>$username,'session_id'=>$session_id),true);
		$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
		$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
		$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
		$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
		$url = API_URL . "user.php";	
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		$decode = json_decode($response,true);
		$getdecodeddata = $decode['data'];	
		$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
		$return = json_decode($getpostdata,true);
		return $return;
	}	
	
	public function changePassword($redirectVal = "false")
	{
		$securitylib = new Security_Lib();
		$username = $_SESSION['username'];
		$session_id = $_SESSION['session_id'];		
		$oldpassword = $_POST['old_password'];
		$newpassword = $_POST['new_password'];		
		$data = json_encode(array('action'=>'changepassword','username'=>$username,'session_id'=>$session_id,'old_password'=>$oldpassword,'new_password'=>$newpassword),true);
		$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
		$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
		$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
		$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
		$url = API_URL . "user.php";	
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		$decode = json_decode($response,true);
		$getdecodeddata = $decode['data'];	
		$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
		$return = json_decode($getpostdata,true);
		return $return;
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
	
    public function showChangePassword() {
        include "src/view/changePassword.php";
    }	
    
    public function editPost() {
        include "src/view/editPost.php";
    }
    
    // -- Admin Modules --
    public function showAdminDashboard() {
        
    }
    
}
?>