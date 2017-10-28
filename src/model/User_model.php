<?php
class User_Model
{	
	function GetTable()
	{
		return "user";
	}

	function login($username,$password)
	{
        
        $mysqli = Connection::getCon();

        $sql = "SELECT name, role FROM ".$this->GetTable()." WHERE username= ? AND password= md5( ? ) ";	 

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $s = "21dbd9ee5a8e54ec3157e76b32ce450c";

        if (!$stmt->bind_param("ss", $username,$password)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if (!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $results = $res->fetch_object();
        return $results;
        
        
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

	function get_user()
	{
		$link = Connection::getCon();	 
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
}
?>