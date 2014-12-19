<?php
	session_start();
	
	if(isset($_SESSION['uid']) || isset($_SESSION['name'])  || isset($_SESSION['email']))
	{
		unset($_SESSION['id']);
		unset($_SESSION['name']);
		unset($_SESSION['email']);		
		session_destroy();
		header("location:index.php");
		exit;	
	}	
?>