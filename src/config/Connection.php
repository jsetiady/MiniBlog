<?php

require_once("db.config.php");

class Connection {
	static $link;
	
	static function connect(){
		if(self::$link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME)){
			return self::$link;
		} else {
			die('could not connect to db');
		}
	}
	
	static function getCon()
	{
		return isset(self::$link) ? self::$link : self::connect();
	}
	
	static function closeCon()
	{
		return mysqli_close(self::$link);
	}
}
