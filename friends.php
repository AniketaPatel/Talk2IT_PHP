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
<title>Friends</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <!--<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css"> -->
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">
  <?php
	//     $rs=$con->fetchfriends($uid);
?> 
       
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Friends</a>
        <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                    <?php 
					include("connect_db.php");
			$temp=mysql_query("SELECT f_list FROM friends_tb WHERE fid=$uid;",$connection);
		if($temp)
	if($row=mysql_fetch_array($temp))
	{
		if($row['f_list']==$uid){
			echo 'You have no friends'; }
		else{
			$flist=$row['f_list'];
		$query =" SELECT f.f_list,u.uid,u.fname,u.lname,u.image FROM friends_tb f,users_tb u WHERE f.fid=$uid AND u.uid IN ($flist) ";
	
			$result=mysql_query($query,$connection);
			if(!$result){
			die("query for retrieving friends failed".mysql_error()); }
    		      echo'  <table class="table">    <thead>';
			while($row=mysql_fetch_array($result))
			{
				if($row[1]!=$uid)
				{
		      echo' <tr>
                  <td><div> 
					   <img src="images/user/'.$row[4].'"  width="50px" height="50px" alt="image"/> </div>
					  <div class="user_name"> '.$row['2']." ".$row[3].'</div>
				      </div><br/>
					  <div class="friends_link"><a  class="btn btn-primary" href="friends.php?id='.$row[0].'&code=2" onclick="javascript:return confirm(\'Are you sure you want to unfriend this friend?\')">unfriend</a></div><br></td>   </tr>
           ';		
				}
				
			}
			echo'   </thead>   </table>   ';
		}	
	}
	?>  
			   
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
//echo $_SESSION['uid'];
if($_POST['code']==2)
{
	$temp1=mysql_query("SELECT f_list FROM friends_tb WHERE fid=$uid;",$connection);   // updation at user side
	if($row=mysql_fetch_array($temp1))
	{
		$flist=$row['f_list'];
		$list=explode(",",$flist);
		
		foreach(array_keys($list,$id) as $key){
			unset($list[$key]); }

		$flist=implode(",",$list);
		
		if($flist==''){
			$flist=$uid; }
		
		$result1=mysql_query("UPDATE friends_tb SET f_list='$flist' WHERE fid=$uid;",$connection);
		if(!$result1){
			die("ERROR :cannot update flist field of current user : ".mysql_error());
		}
	}
	$temp2=mysql_query("SELECT f_list FROM friends_tb WHERE fid=$id;",$connection);   // updation at user side
	if($row2=mysql_fetch_array($temp2))
	{
		$flist=$row2['f_list'];
		$list=explode(",",$flist);
		
		foreach(array_keys($list,$uid) as $key){
			unset($list[$key]); }

		$flist=implode(",",$list);
		
		if($flist==''){
			$flist=$id; }
		
		$result1=mysql_query("UPDATE friends_tb SET f_list='$flist' WHERE fid=$id;",$connection);
		if(!$result1){
			die("ERROR :cannot update flist field of current user : ".mysql_error());
		}
	}

}
?>