<?php
class Session_manager
{
	function create_session($username)
	{
		$checksum = hash_hmac('md5',$username.date("Y-m-d H:i:s"),"rizkyjejehendra");
		return $checksum;		
	}
	
}
?>