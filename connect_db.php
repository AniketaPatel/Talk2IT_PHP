<?php 
  $connection=mysql_connect("localhost","root","");

	if(!$connection)
	{
		die("database connection failed" . mysql_error());
	}

	$db_select=mysql_select_db("talk2it",$connection);

	if(!$db_select)
	{
		die("database selection failed" . mysql_error());
	}
?>