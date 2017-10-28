<?php
class Security_Lib
{
	function __construct() 
	{
		$this->secret_key = "09d284m0934809v2gn4802m02f93492n";
		$this->secret_iv = "09c482930fh8na90f0a987df0920mr98";
		$this->encrypt_key = "092gr4523pj23po23pof22fo2p3pofk2";
		$this->checksum_salt = "f483f093f489f34jf03io4fjiodsdf8h";		
	}

	public function secret_key()
	{
		return $this->secret_key;
	}
	
	public function secret_iv()
	{
		return $this->secret_iv;
	}	
	
	public function encrypt_key()
	{
		return $this->encrypt_key;
	}

	public function checksum_salt()
	{
		return $this->checksum_salt;
	}	
	
	public static function encryptdata($key,$iv,$string)
	{		
		$en = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_CBC, $iv);
		$en = base64_encode($en);
		return($en);
	}		
	public static function decryptdata($key,$iv,$decrypteddata)
	{
		$decrypteddata = base64_decode($decrypteddata);
		$en = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decrypteddata, MCRYPT_MODE_CBC, $iv);
		$en = rtrim($en, "\0\4");
		return($en);
	}
	public function generate_checksum($data_str, $key)
	{	
		$checksum = hash_hmac('md5',$data_str,$key);
		return $checksum;
	}	
	public function validate_checksum($checksum, $string, $key)
	{
		if(empty($checksum) || empty($string) || empty($key))
		{
			return false;
		}
		$generatedchecksum = hash_hmac('md5',$string,$key);		
		if($generatedchecksum != $checksum)
		{
			return false;
		}		
		return true;	
	}	
} 
?>