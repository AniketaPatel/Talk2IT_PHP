<?php

	include 'connect_db.php';
     
	if (isset($_GET['email']))
	{
		$email = $_GET['email'];
	}
	if (isset($_GET['key']) && (strlen($_GET['key']) == 32)) //The Activation key will always be 32 since it is MD5 Hash
 	{
 		$key = $_GET['key'];
	}
	if (isset($email) && isset($key)) 
	{ 			
 		// Update the database to set the "activation" field to null
       
 		$query = "UPDATE users_tb SET isActive=1 WHERE email='".$email."' AND a_code='".$key."'";
		$result_activate_account = mysql_query($query,$connection);
		//echo $result_activate_account;
		 // Print a customized message:
		 
 		//if (mysql_affected_rows($connection)) //if update query was successfull
 		if ($result_activate_account) //if update query was successfull
 		{
		echo '<div align="center" style="padding:50px"><h2> User Activation successful !
						You can now login into the system.</h2>
						<a href="index.php"> << HOME </a></div>';
		}
		else 
		{
 	                header("location:404.html");
 		}
 		//mysqli_close($connection);
	}
 	else 
	{
 		 	                header("location:404.html");
	}
?>
