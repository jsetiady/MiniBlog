<?php 
	include("../lib/security_lib.php");
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
		if($action == 'addcomment')
		{
			$get = addcomment($decryptdata['name'],$decryptdata['email'],$decryptdata['comment'],$decryptdata['post_id']);
			if(!empty($get))
			{
				$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
				$session_id = "asdasdasdad";
				echo json_encode(array('data'=>$return,'session_id'=>$session_id,'error_code'=>0));				
			}
			else
			{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($get));
			echo json_encode(array('data'=>$return,'session_id'=>null,'error_code'=>1001));				
			}

		}
		else if($action == 'getcomment')
		{
			$get = getcomment($decryptdata['post_id']);
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
		else
		{
			$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
			echo json_encode(array('data'=>null,'session_id'=>null,'error_code'=>1000));
		}
	}
	else
	{
		$return = $securitylib->encryptdata($securitylib->encrypt_key(),$securitylib->secret_iv(),json_encode($errorreturn,true));
			echo json_encode(array('data'=>null,'session_id'=>null,'error_code'=>1000));
	}	


function addcomment($name,$email,$comment,$post_id)
{
	$link = mysqli_connect('us-cdbr-iron-east-05.cleardb.net', 'b2c5ed21dfce0a', '6a04153a', 'heroku_ed26df38dd95e64');
	mysqli_set_charset($link,'utf8');	 
	$date = date("Y-m-d H:i:s");
	$username = "guest";

	$sql = "INSERT INTO comment (post_id, username, name, email, comment, date) VALUES($post_id,'$username','$name','$email','$comment','$date')";	 
	$result = mysqli_query($link,$sql);
	if ($result) 
	{
		return  "comment created!";
	} 
	else
	{		
		return null;			
	}

}

function getcomment($post_id) {
	$link = mysqli_connect('us-cdbr-iron-east-05.cleardb.net', 'b2c5ed21dfce0a', '6a04153a', 'heroku_ed26df38dd95e64');
	mysqli_set_charset($link,'utf8');	
	$sql = "SELECT name, date, comment FROM comment WHERE post_id='$post_id'";
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
?>
