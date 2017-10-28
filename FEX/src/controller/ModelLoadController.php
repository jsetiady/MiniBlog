<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	
	require_once("{$base_dir}config{$ds}Connection.php");
	include_once("{$base_dir}model{$ds}PostModel.php");
?>