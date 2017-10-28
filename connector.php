<?php
error_reporting(E_ERROR);
include("lib/security_lib.php");

//------------------------------------------//
$username = $_POST['username'];
$password = $_POST['password'];
$code = $_POST['code'];
if($code == "login")
{
	if(!empty($username) && !empty($password))
	$get = login($username,$password);	
}

//-----------------------------------------//
function login($username,$password)
{
	$securitylib = new Security_Lib();
	$data = json_encode(array('action'=>'login','username'=>$username,'password'=>$password),true);
	$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
	$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
	$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
	$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
	//$jsondata = json_encode(array('data'=>$jsondata),true);
	$url = "http://localhost/hendra/new/be/src/user.php";	
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
	//------------------------
	$decode = json_decode($response,true);
	$getdecodeddata = $decode['data'];	
	$getsessionid = $decode['session_id'];
	$errorcode = $decode['error_code'];
	$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
	$return = json_decode($getpostdata,true);
	$return['session_id'] = $getsessionid;
	return $return;
}

//------------------------------------------//
$username = $_POST['username'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

$code = $_POST['code'];
if($code == "adduser")
{
	if(!empty($username) && !empty($name) && !empty($password) && !empty($email))
	$get = adduser($username,$name,$password,$email);	
}
//------------------------------------------//
function adduser($username,$name,$password,$email)
{
	$securitylib = new Security_Lib();
	$data = json_encode(array('action'=>'adduser','username'=>$username,'name'=>$name, 'password'=>$password,'email'=>$email),true);
	$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
	$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
	$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
	$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
	//$jsondata = json_encode(array('data'=>$jsondata),true);
	$url = "http://localhost/hendra/new/be/src/user.php";	
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
	//------------------------
	$decode = json_decode($response,true);
	$getdecodeddata = $decode['data'];	
	$getsessionid = $decode['session_id'];
	$errorcode = $decode['error_code'];
	$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
	$return = json_decode($getpostdata,true);
	$return['session_id'] = $getsessionid;
	return $return;
}

$code = $_GET['code'];
if($code == "getuser")
{
	$get = getuser('sdsadasd',0);
	echo $get;
}

function getuser($session_id,$role)
{
	$securitylib = new Security_Lib();
	$data = json_encode(array('action'=>'getuser','session_id'=>$session_id,'role'=>$role),true);
	$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
	$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
	$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
	$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
	//$jsondata = json_encode(array('data'=>$jsondata),true);
	$url = "http://localhost/hendra/new/kelompok-4/be/src/user.php";	
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
	//------------------------
	$decode = json_decode($response,true);
	$getdecodeddata = $decode['data'];	
	$getsessionid = $decode['session_id'];
	$errorcode = $decode['error_code'];
	$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
	// $return = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($getpostdata), ENT_NOQUOTES));
	$return = json_decode($getpostdata,true);
	$return['session_id'] = $getsessionid;
	return $getpostdata;
}




//------------------------------------------//
$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];

$code = $_POST['code'];
if($code == "addcomment")
{
	if(!empty($name) && !empty($email) && !empty($comment))
	$get = addcomment($name,$email,$comment,1);	
}
//------------------------------------------//
function addcomment($name,$email,$comment,$post_id)
{
	$securitylib = new Security_Lib();
	$data = json_encode(array('action'=>'addcomment','name'=>$name,'email'=>$email, 'comment'=>$comment,'post_id'=>$post_id),true);
	$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
	$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
	$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
	$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
	//$jsondata = json_encode(array('data'=>$jsondata),true);
	$url = "http://localhost/hendra/new/be/src/comment.php";	
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
	//------------------------
	$decode = json_decode($response,true);
	$getdecodeddata = $decode['data'];	
	$getsessionid = $decode['session_id'];
	$errorcode = $decode['error_code'];
	$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
	$return = json_decode($getpostdata,true);
	$return['session_id'] = $getsessionid;
	return $return;
}

$code = $_GET['code'];
if($code == "getcomment")
{
	$get = getcomment(1);
	echo $get;
}

function getcomment($post_id)
{
	$securitylib = new Security_Lib();
	$data = json_encode(array('action'=>'getcomment','post_id'=>$post_id),true);
	$encryptdata = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$data);
	$getchecksum = $securitylib->generate_checksum($encryptdata.$securitylib->checksum_salt(),$securitylib->secret_key());
	$postdata = json_encode(array('post_data'=>$encryptdata,'checksum'=>$getchecksum),true);
	$jsondata = $securitylib->encryptdata($securitylib->secret_key(),$securitylib->secret_iv(),$postdata);
	//$jsondata = json_encode(array('data'=>$jsondata),true);
	$url = "https://kelompok-4.herokuapp.com/be/api/comment.php";	
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$jsondata));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
	//------------------------
	$decode = json_decode($response,true);
	$getdecodeddata = $decode['data'];	
	$getsessionid = $decode['session_id'];
	$errorcode = $decode['error_code'];
	$getpostdata = $securitylib->decryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),$getdecodeddata);
	// $return = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($getpostdata), ENT_NOQUOTES));
	$return = json_decode($getpostdata,true);
	$return['session_id'] = $getsessionid;
	return $getpostdata;
}
?>