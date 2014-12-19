<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login page</title>

</head>

<body>
 <form action="" method="post" >    
                <label id="error_msg"></label>           
                    <input type="text" name="email" id="email" placeholder="Enter EmailID"  onblur="focusOut(this.id)" onfocus="focusIn(this.id)">
                    <input type="password" id="pass" placeholder="Enter Password" name="pass"  onblur="focusOut(this.id)" onfocus="focusIn(this.id)">
                    <br/>
                      <input type="submit" value="Sign In" name="submit"/>       
                               </form>
</body>
</html>
<?php 
include("connection/connection_class.php");
 if(isset($_POST['submit']))
 {
	 $email=$_POST['email'];
	 $con = new createConnection(); // created a new object
     $con->connectToDatabase(); // connected to the database
    echo "<br/>"; 
    $con->selectDatabase();
    echo "<br/>";

   // Featching Data 
   $sql = "select * from users_tb";
   if(!$sql)
      die ("enter valid email id"); 
  
   $rs = $con->fetchData($sql);

    while ($Row=mysql_fetch_row($rs))
    {
		if($Row[3]==$email)
		    {
				session_start();
				$_SESSION['uid']=$Row[0];
				$_SESSION['email']=$Row[3];
			 header("Location:home.php");
			}//echo $Row[0];  
     }
	 
     $con->closeConnection();
 }

/*
$connection=mysql_connect('localhost','root','');
	mysql_select_db('talk2it',$connection);
   $sql = "select * from users_tb ";
    $rs = mysql_query($sql,$connection);
    if(!$rs)
	   echo "Error: You are not Registered User ";
    while($Row=mysql_fetch_row($rs))
    {
		echo $row;
		if($Row[3]==$email && $Row[4]==$pass)
		    {
		       echo".........";		
				session_start();
				$_SESSION['uid']=$Row[0];
				$_SESSION['name']=$Row[1]." ".$Row[2];
			 header("location: home.php");
			}//echo $Row[0];  
     }
	
*/
?>
