<?php 
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create New Account</title>

     <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
      <script type="text/javascript" src="js/validation.js"></script>
  
<style>
	.error
	{
		border:1px solid red;
	}
	.error_msg
	{
		color:white;
		background-color:#CCCCCC;
		font-size:14px;
		width:auto;
		height:auto;
		padding:7px;
		padding-left:20px;
		text-align:left;
		letter-spacing:1.5px;
		word-wrap:break-word;
	}
	#pass1_status
	{
		color:white;
		font-size:12px;
	}
	
#passwordStrength
{
	height:10px;
	display:block;
	float:left;
}

.strength0
{
	width:250px;
	background:#cccccc;
}

.strength1
{
	width:50px;
	background:#ff0000;
}

.strength2
{
	width:100px;	
	background:#ff5f5f;
}

.strength3
{
	width:150px;
	background:#56e500;
}

.strength4
{
	background:#4dcd00;
	width:200px;
}

.strength5
{
	background:#399800;
	width:250px;
}
</style>
</head>
<body class="body3">
<div class="navbar">
        <div class="navbar-inner">
               <img src="images/ttoit.png">
        </div>
    </div>
      
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading" align="center">Sign Up</p>
            <div class="block-body">
                <form action="create_AC.php" method="post">
                    &nbsp;&nbsp;
                    <input type="text"  name="fname" id="fname" placeholder="First Name" onblur="focusOut(this.id)" onfocus="focusIn(this.id)" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                  &nbsp;
                    <input type="text"  name="lname" id="lname" placeholder="Last Name" onblur="focusOut(this.id)" onfocus="focusIn(this.id)" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
       
              <input type="text"  placeholder="Email ID" name="email" id="email" class="span12" onblur="focusOut(this.id),emailid(this.id),exists_email(this.id)" onfocus="focusIn(this.id)" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"><label id="email-id"></label>
       &nbsp;&nbsp;       <input type="password" placeholder="Password" name="pass1" id="pass1" onKeyUp="passwordStrength(this.value)" onblur="focusOut(this.id)" onfocus="focusIn(this.id)"> 
             &nbsp;    <input type="password" name="pass2" id="pass2" placeholder="ReEnter Password" onblur="focusOut(this.id)" onfocus="focusIn(this.id)">
                   
            <p> <div id="passwordDescription">Password not entered</div>
			<div id="passwordStrength" class="strength0"></div></p><br />
		  
           	   &nbsp;&nbsp;      <select name="year" id="year" onChange="checkYear()" value="<?php if(isset($_POST['year'])) echo $_POST['year']; ?>">
			<option value="0"> &nbsp; YEAR  &nbsp; </option>
			<?php
				for($i=1940;$i<=2013;$i++)
					echo "<option value='".$i."'>". $i."</option>";
			?>
		         </select> &nbsp;&nbsp;
		          <select name="month" id="month" onChange="checkMonth()" disabled>
			<option value="0" selected>  &nbsp;  MONTH </option> 
			<option value="01"> January </option> 
			<option value="02"> February </option> 
			<option value="03"> March </option> 
			<option value="04"> April </option> 
			<option value="05"> May </option> 
			<option value="06"> June </option> 
			<option value="07"> July </option>
			<option value="08"> August </option> 
			<option value="09"> September </option> 
			<option value="10"> October </option> 
			<option value="11"> November </option> 
			<option value="12"> December </option>  
		        </select> &nbsp;&nbsp;
			
		       <select name="day" id="day" disabled>
			<option value=0>  &nbsp;  DAY  &nbsp; </option>
		       </select> &nbsp;&nbsp; 
	                      
           <label> <input type="radio" name="gender" value="male" >Male</label>
           <label> <input type="radio" name="gender" value="female" >Female</label>
                           <label id="error_msg"></label>     
                    <input type="submit" class="btn btn-primary pull-right" name="submit" value="Sign Up!"/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
        include("connection/connection_class.php");
		
	if(isset($_POST['submit']))
	{
     //echo strlen(sha1($_POST['pass1']));
		$fname =trim($_POST['fname']);
		$lname =trim($_POST['lname']);
		$email =trim($_POST['email']);
		$gender=trim($_POST['gender']);	
		$pass1 =$_POST['pass1'];
		$pass2 =$_POST['pass2'];	
		$year  =$_POST['year'];
		$month =$_POST['month'];
		$day   =$_POST['day'];
		$bdate =$year."-".$month."-".$day;
		 
		 $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
              echo "<br/>"; 
         $con->selectDatabase();
              echo "<br/>";		
		if((empty($fname)) || (empty($lname)) || (empty($email)) || (empty($gender)) || (empty($pass1)) || (empty($pass2)) || (empty($year)) || (empty($month)) || (empty($day)))	
		{
		  	 $error[]= '&nbsp;All fields are required';					
		}
		else
		{
			 if( (strlen($pass1)<9) && (strlen($pass1)>13)  )
			{
				 $error[]='&nbsp;password lenght must be between 9 to 13';
			}
			if(strcmp($pass1,$pass2))
			{
				 $error[]='&nbsp;retyped password donot match' ;
			}			
				 
	 	}
		if(empty($error))
		{
			$activate_code = md5(uniqid(rand(),true));
			$pass=sha1($pass1);			
			
			$all = $con->fetchData("SELECT uid FROM users_tb order by uid desc");
			
			if($row=mysql_fetch_row($all)){
				$total=$row[0];		
				$total=$total+1;
			}
			else{
				$total=1;	
			}
			$result=$con->insertData($total,$fname,$lname,$email,$pass,$bdate,$gender,$activate_code);		
			if(!$result)
			{
				die("database query failed" . mysql_error());
			}
			else
			{
				//echo $result;
				echo "Thank you for joining to IT.<br>";
				echo "<a href='http://localhost:81/Talk2IT/activate.php?email=".$email."&key=".$activate_code."' >Activate Your A/C</a>";
		/*		session_start();
				$_SESSION['email']=$email;
				$_SESSION['a_code']=$activate_code;
				$message  = " To activate your account, please click on this link:\n\n";
                $message .= "http://localhost/talk2it/activation.php?email=" . urlencode($email_id) . "&key=$activate_code";
				$subject  ='Registration Confirmation';
				$header    ='From: aniketa27patel@gmail.com';
				if(@mail($email_id, $subject, $message,$header)){
                	echo '<br>Thank you for registering! A confirmation email has been sent to ' . $email_id .
                         ' Please click on the Activation Link to Activate your account.';
                }				
				else{
					echo 'Registration failed.';	
				}   
				$mail->Mailer = "smtp";  
                $mail->Host = "https://www.gmail.com";  
				$mail->Port = 465;     */
			}			
		}
		else
		{		
				foreach ($error as $value) 
              		{
					   echo"<script>
						  document.getElementById('error_msg').style.color='#FF0000';
		             	  document.getElementById('error_msg').style.backgroundColor='rgba(255, 6, 2, 0.2)';
		 		   		  document.getElementById('error_msg').innerHTML='".$value."<br/>';	</script>";
					}
		}
	}
?>                 