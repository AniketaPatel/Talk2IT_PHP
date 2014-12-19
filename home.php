<?php
	session_start();
	if(isset($_SESSION['uid']) || isset($_SESSION['email']) || isset($_SESSION['a_code']))
	{
	   $uid= $_SESSION['uid'];
	}
	if(isset($_SESSION['name'])){
		  //echo $_SESSION['name'];
		}
	else{
		header('location:index.php');	
	}
	
   include("connection/connection_class.php");
   		 $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
            //  echo "<br/>"; 
         $con->selectDatabase();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Home</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <!--<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css"> -->
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>

<body>

    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="" data-toggle="dropdown"/>
                            <i class="icon-user"></i><div style="float:right;width:auto;border:none;" id="login_msg"><div style="float:right;" id="logout_img"> <a href="logout.php" class="link" id="logout" title="LOGOUT"><img src="images/logout.png" alt="LOGOUT" /></a></div> </div>
                            
                        </a>
                         
                    </li>
            </ul>
                <a class="brand" href=""><img src="images/ttoit.png" /></a>
        </div>
    </div>
       
    <div class="sidebar-nav">
    <div class="photo">     
<?php
	$rs =$con->fetchRow($uid);
	if($rs){		
    	echo '<div align="center" id="profile_pic"><img src="images/user/'.$rs[5].'" alt="image" /></div>';	
	}	
?></div>
       
               <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="home.php">Home</a></li>
           <!-- <li ><a href="users.html">Sample List</a></li>
            <li ><a href="user.html">Sample Item</a></li>
            <li ><a href="media.html">Media</a></li>
            <li ><a href="calendar.html">Calendar</a></li>
            -->
        </ul>
                 <a href="home.php?fid=1" class="nav-header" ><i class="icon-comment"></i>Friends</a>
            
        <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Messages </a>
        <ul id="error-menu" class="nav nav-list collapse">
            <li ><a href="home.php?msg=1">Composed Message</span></a></li>
           <li ><a href="home.php?inbox=1">Inbox<span class="label label-info"><?php $rs=$con->fetchmsg($uid);
				echo $rs[0]+$rs[1]; ?></span></a></li>
            <li ><a href="inbox.php?sent=1">Sent<span class="label label-info"><?php 
				echo $rs[2]; ?></span></a></li>
            <li ><a href="inbox.php?archive=1">Archive<span class="label label-info"><?php 
				echo $rs[3]; ?></span></a></li>
            <li ><a href="trash.php">Trash<span class="label label-info"><?php 
				echo $rs[4]; ?></span></a></li>
        </ul>
        
                <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Account<!--<span class="label label-info">+3</span>--></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
            <li ><a href="home.php?profile=1">Edit Profile</a></li>
            <li ><a href="reset-password.html">Reset Password</a></li>
        </ul>
<!--
 <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Share</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="friends.php">Share Moment</a></li>
            <li ><a href="users.html">My Shared Moment</a></li>
        </ul>
-->
       <a href="help.html" class="nav-header" ><i class="icon-question-sign"></i>Help</a> 
    </div>
       <?php
	     	include 'connect_db.php';
	   $temp=mysql_query("SELECT f_list,r_receive,r_send FROM friends_tb WHERE uid=$uid;",$connection);
	if($temp)
	if($row=mysql_fetch_array($temp))
	{
		if($row['f_list']==$uid) $friends=0; 
		else $friends=count(explode(",",$row['f_list'])); 
		
		if($row['r_receive']==$uid) $req_receive=0; 
		else $req_receive=count(explode(",",$row['r_receive']));
		
		if($row['r_send']==$uid) $req_sent=0; 
		else $req_sent=count(explode(",",$row['r_send']));
		
		$f_req=$req_receive-$friends;
	}
?>
    <div class="content">
           <div class="header">
            <div class="stats">
    <a href="friends.php"><p class="stat"></p></a>
    <a href=""><p class="stat"><span class="number"><?php 
			$result=mysql_query("SELECT rid FROM messages_tb WHERE rid=$uid AND delete_status=0 AND trash_status=0 AND archive_status=0 AND read_status=1;",$connection);
		$read=mysql_affected_rows($connection);
		echo $read; ?></span>UnRead Messages</p></a>
</div>
<?php  
           if($_GET['msg'])
		   {
			    echo'<h1 class="page-title">Send Message</h1>';
		      echo'</div>';
			   include("compose.php");
		   }
		   else
         if($_GET['fid']==1)
	          {
		       echo'<h1 class="page-title">Friends List</h1>';
		      echo'</div>';
			   include("friends.php");
			  } 
	        else
			if($_GET['inbox']==1)
	          {
		       echo'<h1 class="page-title">Messages List</h1>';
		      echo'</div>';
		       include("inbox.php");
			  } 
	        else
			 if($_GET['profile']==1)
	          {
		       echo'<h1 class="page-title">Edit Profile And Reset Password</h1>';
		      echo'</div>';
			   include("edit_profile.php");
			  } 
	        else
			
			 if($_GET['sent']==1)
	          {
		       echo'<h1 class="page-title">Sent Messages</h1>';
		      echo'</div>';
			   include("sent.php");
			  } 
		else
			{
		  ?>
           <h1 class="page-title">Home</h1>     
             </div>
        <div class="container-fluid">
            <div class="row-fluid">
             <div class="">
           <div class="alert alert-info">
       <!-- <button type="button" class="close" data-dismiss="alert">×</button>-->
        <strong><img src="images/w.png" />elcome &nbsp;</strong> <?php echo $_SESSION['name'];?>
    </div>

    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Change Profile picture</a>
        <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                    <form action="home.php" method="post" enctype="multipart/form-data">
                     <input type="file" name="file1" />
                     <br />  
                       <input type="submit"  class="btn btn-primary pull-right" name="upload" value="Upload"/>
                     <br />
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Profile Info
        <!--<span class="label label-warning">+10</span>--></a>
        <div id="tablewidget" class="block-body collapse in">
          
			<?php 
			
	            $rs =$con->fetchRow($uid);
	if($rs){	
	echo'  <table class="table">
              <thead>
                <tr>
                  <th>';	
    	echo '<div align="center" id="profile_pic"><img src="images/user/'.$rs[5].'" alt="image" /></div>';	
	      echo'            </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Name</td><td>';
		  echo $rs[0]." ".$rs[1];
		  echo'</td></tr>             <tr><td>Email ID</td><td>';
		  echo $rs[2];
		  echo'</td></tr>            <tr><td>Birth Date</td><td>';
		  echo $rs[3];
		  echo'</td></tr>            <tr><td>Gender</td><td>';
			 if($rs[4]=="M")
			  echo "Male";
			  else
			   echo "Female";		  
   	      echo'</td></tr>          </tbody></table>';
		  }			   
			?>
            <!--   <p><a href="users.html">More...</a></p>-->
        </div>
    </div>
    
</div>         
            </div>
        </div>
   <?php } ?> </div>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
 
</body>
</html>
<?php 
if(isset($_POST['upload']))
	
	{	   
	  $arc="images/user/";
	  print_r($_FILES);
     $ffile=$_FILES['file1'];
	 $filename=$ffile['name'];
     $filetmp=$ffile['tmp_name'];
  
		
		echo $filetmp;
        if(move_uploaded_file($filetmp,$arc.$filename))
        {
			$result=mysql_query("update users_tb set image='".$filename."' where uid=".$uid.";",$connection);
			
			if($result){
				if(mysql_affected_rows($connection)==1){
					$msg="Image uploaded successfully";
					header("location:home.php");
				}
			}
			else{
					$msg=mysql_error()." Image cannot be uploaded....";
			} 
		}
		else
		{         		
				$msg= 'The image could not be uploaded, please try again!';
					}
		echo $msg;
	}
	  
?>