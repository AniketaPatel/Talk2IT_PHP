<?php
	session_start();
	if(isset($_SESSION['uid']) || isset($_SESSION['email']) || isset($_SESSION['a_code']))
	{
		unset($_SESSION['a_code']);
		unset($_SESSION['email']);
		unset($_SESSION['uid']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Sign In</title>
     <script src="js/validation.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <!-- Demo page code -->
    <script language="JavaScript" >
  
   </script>
 
   <style>
   .error {
     border:2px solid red;
      }
   </style>
 
   </head>

<body>
      
      <div class="row-fluid">
             <div class="dialog">
          <div class="block">
            <p class="block-heading" align="center">Get in Touch with Us </p>
            <div class="block-body">
                <form action="login.php" method="post" onsubmit="return validate_login_page()"> 
                                  <label id="error_msg"> </label>           
              <input type="text" class="span12" name="email" id="email" placeholder="Enter EmailID" style="background-image:url('images/user.png');background-repeat: no-repeat;padding-left:30px;" onblur="focusOut(this.id)" onfocus="focusIn(this.id)">
                    <input type="password" class="span12" id="pass" placeholder="Enter Password" name="pass" style="background-image:url('images/pass.png');background-repeat: no-repeat;padding-left:30px;" onblur="focusOut(this.id)" onfocus="focusIn(this.id)">
                    <br/>
                       <input type="submit" value="Sign In" name="submit" class="btn btn-primary pull-right" />
                     <p><a href="reset-password.php">Forgot your password?</a></p>
                </form>
            </div>            </div>
              <p class="pull-right"><a href="create_AC.php">Create New Account</a></p>
       </div>
   </div>
</body>
</html>

<?php 
//echo sha1("admin");
include("connection/connection_class.php");
 if(isset($_POST['submit']))
 {
	 if($_POST['error_msg']=="") 	
	  {
		 // echo "....................";
		 $email=$_POST['email'];
		 $pass=sha1($_POST['pass']);
	    // echo $pass;
	     $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
         echo "<br/>"; 
         $con->selectDatabase();
         echo "<br/>";

   // Featching Data 
   $sql = "select * from users_tb where email='".$email."' and password='".$pass."'";
    //echo $sql;
    $rs = $con->login($email,$pass);
    if(!$rs)
	   echo "Error: You are not Registered User ";
	   
	 //mysql_close($connection);
     $con->closeConnection();
  
	  }
 }
?>