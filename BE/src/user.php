<?php 
	error_reporting(E_ERROR);
	include("../lib/security_lib.php");
	include("../lib/session_manager.php");
	include("../src/model/User_model.php");	
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
				echo json_encode(array('data'=>$return,'session_id'=>$session_id,'error_code'=>0));				
			}
			else
			{
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
					echo json_encode(array('data'=>$return,'error_code'=>0));				
				}
				else
				{
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($check));
					echo json_encode(array('data'=>$return,'error_code'=>1001));				
				}
			}
			else
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				echo json_encode(array('data'=>$return,'error_code'=>1001));				
			}
		}	
		
		else
		{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
			echo json_encode(array('data'=>null,'error_code'=>1001));
		}
	}
	else
	{
		$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
		echo json_encode(array('data'=>null,'error_code'=>1000));
	}
	
?>