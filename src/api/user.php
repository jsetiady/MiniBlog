<?php 
	error_reporting(E_ERROR);
	include("../../lib/security_lib.php");
	include("../../lib/session_manager.php");
	include("../model/User_model.php");	
	$securitylib = new Security_Lib();
	$data = $_POST['data'];
	$getdecodeddata = $data;	
	$getpostdata = $securitylib->decryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$getdecodeddata);
	$test = $getpostdata;
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
				$response = array('data'=> array('data'=>$return,'session_id'=>$session_id,'error_code'=>0),'status'=>200);				
			}
			else
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$response = array('data'=> array('data'=>$return,'session_id'=>null,'error_code'=>1007),'status'=>200);	
			}

		}
		else if($action == 'checksession')
		{
			$get = $user_model->check_session($username,$session_id);
			if(!empty($get))
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$response = array('data'=> array('data'=>$return,'error_code'=>0),'status'=>200);								
			}
			else
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$response = array('data'=> array('data'=>$return,'error_code'=>1005),'status'=>200);				
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
					$response = array('data'=> array('data'=>$return,'error_code'=>0),'status'=>200);				
				}
				else
				{
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($check));
					$response = array('data'=> array('data'=>$return,'error_code'=>1003),'status'=>200);				
				}
			}
			else
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$response = array('data'=>$return,'error_code'=>1001,'status'=>200);				
			}
		}	
		else if($action == 'getuser')
		{
			$get = $user_model->check_session($username,$session_id);
			$get = true;
			if(!empty($get))
			{			
				$check = $user_model->get_user();
				if(!empty($check))
				{
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($check));
					$response = array('data'=> array('data'=>$return,'error_code'=>0),'status'=>200);			
				}
				else
				{
					$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode(null,true));
					$response = array('data'=> array('data'=>$return,'error_code'=>1003),'status'=>200);				
				}
			}
			else
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode(null,true));
				$response = array('data'=>array('data'=>$return,'error_code'=>1001),'status'=>200);				
			}
		}	
		else
		{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode(null,true));
			$response = array('data'=> array('data'=>$return,'error_code'=>10010),'status'=>200);
		}
	}
	else
	{
		$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode(null,true));
		$response = array('data'=> array('data'=>$return,'error_code'=>1000),'status'=>200);
	}
?>