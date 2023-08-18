<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/db.php");
	$_SESSION = array();
	session_destroy();
	header("Location: /");
	exit(0);
?>