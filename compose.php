<?php
	session_start();
	if(isset($_SESSION['uid'])  || isset($_SESSION['a_code']))
	{
	   $uid= $_SESSION['uid'];
	}
	if(isset($_SESSION['name'])){
		  //echo $_SESSION['name'];
		}
	else{
		header('location:index.php');	
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Compose Msg</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <!--<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css"> -->
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>

<body>

  <?php
	
?> 
       <form method="post">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Compose Message </a>
        <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                  <div id="table_wrapper" >
                    <div align="right">
                      <table width="483" align="center" >
                        <tr>
                          <td width="196" height="53"><label style="color:red;">*</label>To :</td>
                          <td width="271"><label>
                           <input type="text" name="to" id="to" style="width: 226px" placeholder="Enter Email Id">
                          </label></td>
                        </tr>
                        <tr>
                          <td height="60"><div align="left">Subject :</div></td>
                          <td><input type="text" name="subject" id="subject" style="width: 226px" /></td>
                        </tr>
                        <tr>
                          <td style="height: 87px"><label style="color:red;">*</label>Message :</td>
                          <td style="height: 87px">
                    <textarea name="message" id="message1" style="height: 77px; width: 228px" ></textarea></td>
                        </tr>
                        <tr>
                          <td height="60"><div align="center">
                       <input type="reset"  class="btn btn-primary pull-right" name="Reset" value="Reset"/>
                            </div></td>
                          <td><div align="center">
                       <input type="submit"  class="btn btn-primary pull-right" name="Send" value="Send"/>
                            </div></td>
                        </tr>
                                                                  </table>
                      </div>
                    <div style="clear:both"></div>
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
     include 'connect_db.php'; 

	if(isset($_POST['Send']))
	{
		$emailid= $_POST['to'];
		$message=$_POST['message'];
		$subject=$_POST['subject'];
		$datetime=date('y/m/d h:i:s', time());
		
		if(empty($subject)){
			$subject='no subject';	}
    $sql1=mysql_query("select mid from messages_tb order by mid desc");
      if($row=mysql_fetch_array($sql1))
	  {
	    $mid=$row['mid'];
		echo $mid;
	  }
	  echo $emailid.'<br>'.$message."<br>";
	  
	 // $f=0;
	  $sq=mysql_query("select uid from users_tb where email='".$emailid."'");
	  if($row=mysql_fetch_row($sq))
	  {
		  $rid=$row[0];
		  //echo "INSERT INTO messages_tb values($mid,$uid,'$subject','$message',".$_SESSION['uid'].",$rid,'$datetime',0,0,0,0);";
		 /* echo "INSERT INTO messages_tb values($mid,$uid,'$subject','$message',".$_SESSION['uid'].",$rid,'$datetime',0,0,0,0);";*/
	$sql=mysql_query("INSERT INTO messages_tb values($mid,$uid,'$subject','$message',".$_SESSION['uid'].",$rid,'$datetime',0,0,0,0);",$connection);
/*	$temp1=mysql_query("SELECT f_list FROM friends_tb WHERE fid=$uid;",$connection);   // updation at user side
	if($row=mysql_fetch_array($temp1))
	{
		$flist=$row['f_list'];
		$list=explode(",",$flist);
		if($list!=$rid)
		{
		 $flist=implode(",",$rid);		
		$result1=mysql_query("UPDATE friends_tb SET f_list='$flist' WHERE fid=$uid;",$connection);
		if(!$result1){
			die("ERROR :cannot update flist field of current user : ".mysql_error());
		}
	}
		foreach(array_keys($list,$id) as $key){
			unset($list[$key]); }

		$flist=implode(",",$list);
		
		if($flist==''){
			$flist=$uid; }
		
      $sql2=mysql_query("UPDATE friends_tb SET f_list='$flist' ");  
	*/	//	mysql_query($sql);
			if(!$sql)
				echo"<script>alert('ERROR :Message sending failed');</script>";
				else
				echo"<script>alert('Your message has been successfully sent!');</script>";	
				}
				// Message sending failed
	}

?>