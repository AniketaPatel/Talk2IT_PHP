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
	
 /*  include("connection/connection_class.php");
   		 $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
         $con->selectDatabase();
	*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Inbox</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <!--<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css"> -->
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>

<body>
<form action="" method="post">
          <?php
	//     $rs=$con->fetchfriends($uid);
?> 
       
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Archive Message</a>
        <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
   <td>
	 
	 
	 
	 
	 
	   <?php
	
	include 'connect_db.php';
//	---------------------------------code for archived messages-------------------------------------------
	
	//$query ="SELECT $tables[1].$messages_cols[2],$tables[0].$login_cols[1],$tables[1].$messages_cols[5],$tables[1].$messages_cols[0] ";
	//$query.="FROM $tables[0],$tables[1] ";
	//$query.="WHERE messages_tb.receiver_id='$uid' AND messages_tb.sender_id=login_tb.uid AND messages_tb.archive_status=1;";
	
	//$result=mysql_query($query ,$connection);  // message retrieving query
	
	//if(!$result)
	//{
		//die("database query failed" . mysql_error());
	//}
	//$i=1;

	//echo  '<div class="title"> &nbsp; ARCHIVE MESSAGES </div><br/>';
	echo  "<form id='form2' name='form2' method='post' action='received_msg_operations.php'>";
	echo  '<div id="table_wrapper" >';
		
	//if(mysql_num_rows($result)> 0)
	{
		echo '<div class="column_header"> 
				<div style="width:10%;float:left"> no. </div>
				<div style="width:40%;float:left"> messages </div>
				<div style="width:15%;float:left"> sender </div>
				<div style="width:25%;float:left"> on </div>
				<div style="width:10%;float:left"> select </div>
			  <div style="clear:both"></div></div>';
			
		//while($row=mysql_fetch_array($result))
		{
			echo '<div class="row"> 
					<div style="width:10%;float:left"> &nbsp; '.$i.'</div>
					<div style="width:40%;float:left"> &nbsp; '. $row[0] . '</div>
					<div style="width:15%;float:left">'. $row[1] . '</div>
					<div style="width:25%;float:left">'. $row[2] . '</div>
					<div style="width:10%;float:left"><input name="check'.$row[3].'" type="checkbox" value="'.$row[3].'"></div>
				  <div style="clear:both"></div></div>';
			$i++;		
		}
		echo "<p></p>";
	
		echo '<select name="operation_archive">';
		echo '<option value="0" selected="selected"></option>';
		echo '<option value="1">Delete</option>';
		echo '<option value="2">Restore</option>';
   		echo  '</select>';

		echo  '<input name="apply_archive" type="submit" value="Apply" onclick="javascript:return confirm(\'Are you sure you want to apply this action?\')"/>';
	}
	//else
	{
		echo '<div class="row"> No message archived! <div style="clear:both"></div></div>';
	}
	echo '<div style="clear:both"></div></div>
		  </form>';
	?>
	<br /><a href="inbox.php".php"><< INBOX </a>
  </td>     
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
?>