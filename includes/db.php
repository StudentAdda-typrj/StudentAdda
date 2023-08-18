<?php
	
	if(session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}
	
	$db = "";
	
	try
	{
		$db = new PDO("mysql:host=localhost;dbname=studentadda;port=3306;charset=utf8", "root", "");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec("SET time_zone='+5:30';");
	}
	catch(PDOException $error)
	{
		echo "Connection failed: ".$error->getMessage();
		exit(0);
	}

?>