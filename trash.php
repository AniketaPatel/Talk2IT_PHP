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
//		header('location:index.php');	
	}
	
  /* include("connection/connection_class.php");
   		 $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
            //  echo "<br/>"; 
         $con->selectDatabase();
	*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Trash Messages</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <!--<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css"> -->
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">
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
    <a href="friends.php"><p class="stat"><span class="number"></span></p></a>
    <a href=""><p class="stat"><span class="number"><?php 
			$result=mysql_query("SELECT rid FROM messages_tb WHERE rid=$uid AND delete_status=0 AND trash_status=0 AND archive_status=0 AND read_status=1;",$connection);
		$read=mysql_affected_rows($connection);
		echo $read; ?></span>UnRead Messages</p></a>
</div>
           <h1 class="page-title">Trash</h1>     
             </div>
        <div class="container-fluid">
            <div class="row-fluid">

<div class="row-fluid">
    <div class="block">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Profile Info
        <!--<span class="label label-warning">+10</span>--></a>
        <div id="tablewidget" class="block-body collapse in">
           <?php include 'connect_db.php'; ?>
<?php		
	//   -------------------------code for sent messages ---------------------------------

	 $query ="SELECT users_tb.uid,users_tb.fname,users_tb.lname,messages_tb.* FROM users_tb ,messages_tb WHERE  messages_tb.rid=".$uid." AND messages_tb.sid=users_tb.uid AND messages_tb.trash_status=1 ORDER BY messages_tb.date_time DESC";
	$result=mysql_query($query ,$connection);  // message retrieving query
	if(!$result)
	{
		die("database query failed" . mysql_error());
	}
  	$count=mysql_num_rows($result);
	$i=1;
	
	echo  '<div class="title"> &nbsp; Trash MESSAGES </div><br/>';	
	//if($count > 0)
	{
		echo '<div id="table_wrapper">';
		echo '<div class="column_header"> <div style="width:10%;float:left">&nbsp;no. </div>
			  		<div style="width:25%;float:left"> subject </div>
			  		<div style="width:35%;float:left"> to </div>
					<div style="width:30%;float:left"> at </div>					
					<div style="clear:both"></div>
			 </div>';
	
		while($row=mysql_fetch_array($result))
		{
			if($i%2==0) $color='rgba(227,224,224,0.5)';
			else $color='rgba(250,250,250,1)';
			
			echo '<div style="background-color:'.$color.';padding-top:10px;padding-bottom:10px;" class="row">
			 	<div style="width:10%;" class="cell"> &nbsp; '. $i 	   . '</div>
			    <div style="width:25%;" class="cell"><a href="inbox.php?mid='.$row[3].'&code=sent" title="click to see full message">'. $row[0] . '</a></div>
			 	<div style="width:35%;" class="cell">'. $row[1] . '</div>
				<div style="width:30%;" class="cell">'. $row[2] . '</div>
				<div></div></div>';
			$i++;		
		}
		echo '<div style="clear:both"></div></div>';
	}
	//else
	{
		echo "<div> No message sent! </div>";

	}
?>
          
            <!--   <p><a href="users.html">More...</a></p>-->
        </div>
    </div>
    
</div>         
            </div>
        </div>
    </div>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
 </form>
</body>
</html>

<?php
	session_start();
	if(isset($_SESSION['uid']) || isset($_SESSION['email']) || isset($_SESSION['a_code']))
	{
	   $uid= $_SESSION['uid'];
	}
	if(isset($_SESSION['name'])){
		echo $_SESSION['name'];
		
		}
	else{
		header('location:index.php');	
	}
	
 /*  include("connection/connection_class.php");
   		 $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
         $con->selectDatabase();
	*/
?>
