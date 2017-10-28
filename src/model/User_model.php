<?php
include("Database_Model.php");
class User_Model
{	
	function GetTable()
	{
		return "user";
	}

	function login($username,$password)
	{
		$link = Connection::getCon();
		$password = md5($password);
		$sql = "SELECT name,role FROM ".$this->GetTable()." WHERE username='$username' AND password='$password'";	 
		$result = mysqli_query($link,$sql);	 
		if (!$result) 
		{
			return array();
		} 
		else
		{		
			return mysqli_fetch_object($result);			
		}
	}

	function update_session($username,$session_id)
	{
		$link = Connection::getCon();
		$now = date("Y-m-d H:i:s");
		$sql = "UPDATE ".$this->GetTable()." SET session_id = '$session_id',last_login ='$now' where username='$username'";	 
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
	
	function check_session($username,$session_id)
	{
		$link = Connection::getCon();
		$sql = "SELECT session_id FROM ".$this->GetTable()." WHERE session_id = '$session_id' AND  username='$username'";	 
		$result = mysqli_query($link,$sql);	 
		if (!$result) 
		{
			return null;
		} 
		else
		{		
			$check = mysqli_fetch_object($result);
			if(count($check) > 0)
			{
				return true;
			}
			else
			{
				return false;							
			}
		}
	}
	
	function change_password($username,$oldpassword,$newpassword)
	{
		$link = Connection::getCon();	 
		$oldpassword = md5($oldpassword);
		$newpassword = md5($newpassword);		
		$sql = "SELECT password FROM ".$this->GetTable()." where username='$username'";	 
		$result = mysqli_query($link,$sql);	 
		if (!$result) 
		{			
			return false;
		} 
		else
		{	
			$get = mysqli_fetch_object($result);
			if($get->password == $oldpassword)
			{
				$sql = "UPDATE ".$this->GetTable()." SET password = '$newpassword' where username='$username'";	 
				$result = mysqli_query($link,$sql);	 
				if (!$result) 
				{
					return false;
				} 
				else
				{		
					return true;
				}	
			}
			else
			{
				return false;
			}
		}
	}	
}
?>