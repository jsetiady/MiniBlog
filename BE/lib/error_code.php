<?php
function get_error_code($errorcode)
{
		$error_code_list = array(
			'1000'=>'ini 1000',
			'1001'=>'ini 1001',
			'1002'=>'ini 1002',
			'1003'=>'ini 1003',
			'1004'=>'ini 1004',
			'1005'=>'ini 1005',
			'1006'=>'ini 1006',			
		);
		if(!empty($error_code_list[$errorcode]))
		{
			return $error_code_list[$errorcode];
		}
		else
		{
			return "error not registered";
		}	
		
}

?>