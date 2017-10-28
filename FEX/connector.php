<?php
class Connector
{
	function main_url()
	{
		return "http://localhost/S2/BE/src/";
	}

	function Login($username,$password)
	{
		include("lib/security_lib.php");	
		$securitylib = new Security_Lib();
		$data = json_encode(array('action'=>'login','username'=>$username,'password'=>$password),true);
		$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
		$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
		$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
		$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
		$url = $this->main_url()."user.php";	
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
		$return['session_id'] = $getsessionid;		
		return $return;
	}
	
	function Check_Session($username,$session_id)
	{
		include("lib/security_lib.php");	
		$securitylib = new Security_Lib();
		$data = json_encode(array('action'=>'checksession','username'=>$username,'session_id'=>$session_id),true);
		$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
		$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
		$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
		$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
		$url = $this->main_url()."user.php";	
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
	
	function Change_Password($username,$session_id,$oldpassword,$newpassword)
	{
		$securitylib = new Security_Lib();
		$data = json_encode(array('action'=>'changepassword','username'=>$username,'session_id'=>$session_id,'old_password'=>$oldpassword,'new_password'=>$newpassword),true);
		$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
		$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
		$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
		$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
		$url = $this->main_url()."user.php";	
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
}
	
?>