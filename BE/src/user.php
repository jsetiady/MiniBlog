<?php 
<<<<<<< HEAD
	include("../lib/security_lib.php");
=======
	error_reporting(E_ERROR);
	include("../lib/security_lib.php");
	include("../lib/session_manager.php");
	include("../src/model/User_model.php");	
>>>>>>> 23517004
	$securitylib = new Security_Lib();
	$data = $_POST['data'];
	$getdecodeddata = $data;	
	$getpostdata = $securitylib->decryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$getdecodeddata);
	$getpostdata = json_decode($getpostdata,true);
	$postdata = $getpostdata['post_data'];
	$checksum = $getpostdata['checksum'];
	$checksumnow = $securitylib->validate_checksum($checksum,$postdata.$securitylib->checksum_salt(),$securitylib->secret_key());	
	if($checksumnow)
	{
		$decryptdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$postdata);
		$decryptdata = json_decode($decryptdata,true);
		$action = $decryptdata['action'];
<<<<<<< HEAD
		if($action == 'login')
		{
			$get = login($decryptdata['username'],$decryptdata['password']);
			if(!empty($get))
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$session_id = "asdasdasdad";
=======
		$username = $decryptdata['username'];		
		$password = $decryptdata['password'];
		$session_id = $decryptdata['session_id'];
		$oldpassword = $decryptdata['old_password'];
		$newpassword = $decryptdata['new_password'];		
		$user_model = new User_Model();		
		if($action == 'login')
		{
			$get = $user_model->login($username,$password);
			if(!empty($get))
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$session = new Session_Manager();				
				$session_id = $session->create_session($username);
				$user_model->update_session($username,$session_id);
>>>>>>> 23517004
				echo json_encode(array('data'=>$return,'session_id'=>$session_id,'error_code'=>0));				
			}
			else
			{
<<<<<<< HEAD
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
			echo json_encode(array('data'=>$return,'session_id'=>null,'error_code'=>1001));				
			}

		}
		else if($action == 'adduser')
		{
			$get = adduser($decryptdata['username'],$decryptdata['name'],$decryptdata['password'],$decryptdata['email']);
			if(!empty($get))
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				echo json_encode(array('data'=>$return,'error_code'=>0));	
			}
			else
			{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
			echo json_encode(array('data'=>$return,'error_code'=>1001));				
			}
		}
		else if($action == 'getuser')
		{
			//validasi session
			//checksession = blabla->validate_session
			//if($decryptdata['role'] == 0 && checksession)
			if($decryptdata['role'] == 0)
			{
				$get = getuser();
				if(!empty($get))
				{
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
=======
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				echo json_encode(array('data'=>$return,'session_id'=>null,'error_code'=>1001));				
			}

		}
		else if($action == 'checksession')
		{
			$get = $user_model->check_session($username,$session_id);
			if(!empty($get))
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				echo json_encode(array('data'=>$return,'error_code'=>0));				
			}
			else
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				echo json_encode(array('data'=>$return,'error_code'=>1001));				
			}
		}	
		else if($action == 'changepassword')
		{
			$get = $user_model->check_session($username,$session_id);
			if(!empty($get))
			{			
				$check = $user_model->change_password($username,$oldpassword,$newpassword);
				if(!empty($check))
				{
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($check));
>>>>>>> 23517004
					echo json_encode(array('data'=>$return,'error_code'=>0));				
				}
				else
				{
<<<<<<< HEAD
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
=======
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($check));
>>>>>>> 23517004
					echo json_encode(array('data'=>$return,'error_code'=>1001));				
				}
			}
			else
			{
<<<<<<< HEAD
				//error 1002 unauthorize
				echo json_encode(array('data'=>null,'error_code'=>1002));
			}
		}		
		else
		{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
			echo json_encode(array('data'=>null,'session_id'=>null,'error_code'=>1000));
=======
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				echo json_encode(array('data'=>$return,'error_code'=>1001));				
			}
		}	
		
		else
		{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
			echo json_encode(array('data'=>null,'error_code'=>1001));
>>>>>>> 23517004
		}
	}
	else
	{
		$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
<<<<<<< HEAD
			echo json_encode(array('data'=>null,'session_id'=>null,'error_code'=>1000));
	}	

function login($username,$password)
{
	$link = mysqli_connect('localhost', 'root', '', 'simple_blog');
	mysqli_set_charset($link,'utf8');	 
	$password = md5($password);
	$sql = "SELECT name,role FROM user WHERE username='$username' AND password='$password'";	 
	$result = mysqli_query($link,$sql);	 
	if (!$result) 
	{
		return null;
	} 
	else
	{		
		return mysqli_fetch_object($result);			
	}

}

function adduser($username,$name,$password,$email)
{
	$link = mysqli_connect('localhost', 'root', '', 'simple_blog');
	mysqli_set_charset($link,'utf8');	 
	$password = md5($password);
	$sql = "INSERT INTO user (username, name, password, email, role) VALUES('$username','$name','$password','$email','1')";	 
	$result = mysqli_query($link,$sql);	 
	if ($result) 
	{
		return  "user created!";
	} 
	else
	{		
		return null;			
	}

}

function getuser() {
	$link = mysqli_connect('localhost', 'root', '', 'simple_blog');
	mysqli_set_charset($link,'utf8');	
	$sql = "SELECT username, name, email, role FROM user";
	$result = mysqli_query($link,$sql);	 
	$i=0;
	while($row=mysqli_fetch_assoc($result)) {
		$resultset[$i] = $row;
		$i++;
	}

	if(!empty($resultset))
	{
	    // return mysqli_fetch_object($result);
	    return $resultset;
	}
	else 
	{
	    return null;
	}
}

=======
		echo json_encode(array('data'=>null,'error_code'=>1000));
	}
	
?>
>>>>>>> 23517004
