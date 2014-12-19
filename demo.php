<?php
	session_start();
	if(isset($_SESSION['uid']) || isset($_SESSION['email']) )
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
<div class="container-fluid">
          <div class="row-fluid">
            <div class="row-fluid">

              <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Inbox</a>
        <div id="tablewidget" class="block-body collapse in">
      <?php 
	  include("connect_db.php");
   
 $query ="SELECT users_tb.uid,users_tb.fname,users_tb.lname,messages_tb.* FROM users_tb ,messages_tb WHERE  messages_tb.rid=".$uid." AND messages_tb.sid=users_tb.uid AND messages_tb.delete_status=0  AND messages_tb.archive_status=0 AND messages_tb.trash_status=0 ORDER BY messages_tb.date_time DESC";
	$result=mysql_query($query ,$connection);  // message retrieving query
	
	if(!$result){
		die("database query failed" . mysql_error());	}
	  
  	$count=mysql_num_rows($result);
	$i=0;

if($count){
	echo'  <table class="table">
              <thead>
                <tr>
                  <th> NO </th>
				  <th> Subject </th>
				  <th> From </th>
				  <th> Action </th>
                </tr>
              </thead>
              <tbody>';
	
		while($row=mysql_fetch_array($result))
		{
			if($i%2==0) $color='rgba(227,224,224,0.5)';
			else $color='rgba(250,250,250,1)';
			
			if($row[13]==0){                        
				$unread='font-style:italic;font-weight:bold;';
				$code='&code=unread';
			}
			else {
				$unread='font-style:normal;	font-weight:normal;';	
				$code='&code=received';	
			}
	
		$i=$i+1;
		  echo'<tr style="background-color:'.$color.';'.$unread.'">
                  <td>'.$i.'</td><td>
		<a href="home.php?inbox=1&uid='.$row[0].'&mid='.$row[3].''.$code.'" title="click to see full message" >
				  ';
		  echo $row[5];
		  echo'</a></td><td>';
		  $to=$row[1]." ".$row[2];
		  $msg=$row[6];
		  $sub=$row[5];
		   echo $row[1]." ".$row[2];
		  //echo $result[4];
		  echo'</td>';
		  echo'<td><a href="home.php?inbox=1&a=delete&mid='.$row[3].'" type="submit" class="btn btn-primary" name="delete" value="'.$row[3].'" title="DELETE" onclick="javascript:return confirm(\'Are you sure you want to send this message to trash?\')" id="delete"><b> X </b></a>
		    <a href="home.php?inbox=1&a=archive&mid='.$row[3].'" type="submit" class="btn btn-primary" name="archive" value="'.$row[3].'" title="ARCHIVE" onclick="javascript:return confirm(\'Are you sure you want to archive this message?\')"><b> A </b></a></td></tr>  ';
		  }			 	  	
} 
?>
        </div>
    </div>
    <div class="block span6">
       <a href="#widget1container" class="block-heading" data-toggle="collapse"><div id="error_msg1"></div></a>
        <div id="widget1container" class="block-body collapse in">
         <?php 
			      echo'  <table class="table">    <thead>';
			
		           echo' <tr>
                  <td>From</td>
				  <td>'.$row[0].' '.$row[1].'</td>   </tr>
				   <tr>
                  <td>Subject</td>
				  <td>'.$row[4].'</td>   </tr>
                  <td>Message</td>
				  <td>'.$row[5].'</td>   </tr>
                  ';		
			
		     	echo'   </thead>   </table>   ';
			
			  if($_GET['code']="unread")
			 {
			   
           $query =" UPDATE messages_tb SET read_status=1 WHERE mid=".$_GET['mid']; 
           	$re=mysql_query($query ,$connection);  // message retrieving query
	 	if($re){
			/*document.getElementById("error_msg1").style.backgroundColor="rgba(6, 255, 2, 0.2)";*/
		 echo('<script>
		   document.getElementById("error_msg1").style.color="#099904";
		   document.getElementById("error_msg1").innerHTML="Message Shown Here...";
		   </script>');            			 
		}
		}
	
	?> 
        </div>
    </div>
   
    <div id="error_msg"></div>
    <?php 
	      if(isset($_GET['a']) && isset($_GET['index']))
		 {
		  	 if($_GET['a']=="archive")
			 {  			
		    
 $query =" UPDATE messages_tb SET archive_status=1 WHERE mid=".$_GET['mid'];
	$re1=mysql_query($query ,$connection);  // message retrieving query
	 	if($re1)
		   echo('<script>
		   	   document.getElementById("error_msg").style.backgroundColor="rgba(6, 255, 2, 0.2)";
		   document.getElementById("error_msg").style.color="#099904";
		   document.getElementById("error_msg").innerHTML="Message is Moved to Archive...";
	
		 </script>');
			 }
			 
		 else     if($_GET['a']=="delete")
		 {             			   
 $query =" UPDATE messages_tb SET trash_status=1 WHERE mid=".$_GET['mid'];
	$re=mysql_query($query ,$connection);  // message retrieving query
	
	 	if($re)			
		   echo('<script>
		   	   document.getElementById("error_msg").style.backgroundColor="rgba(6, 255, 2, 0.2)";
		   document.getElementById("error_msg").style.color="#099904";
		   document.getElementById("error_msg").innerHTML="Message is Moved to Trash...";
	
		   </script>');            			 
			
		  }
	}
		 else
	     if(isset($_GET['mid']) && isset($_GET['inbox']) && isset($_GET['code']))
		 {
		     
 $query ="SELECT users_tb.fname,users_tb.lname,messages_tb.* FROM messages_tb,users_tb WHERE users_tb.uid=".$_GET['uid']." AND messages_tb.mid=".$_GET['mid'];
	$re=mysql_query($query ,$connection);  // message retrieving query
	
	if(!$re){
		die("database query failed" . mysql_error());	}
	  	if($row=mysql_fetch_array($re)) {
			 ?>
          
			  <div class="block">
	   <a href="#widget1container" class="block-heading" data-toggle="collapse"><div id="error_msg1"></div></a>
        <div id="widget1container" class="block-body collapse in">
              
	  </div>
        </div>
        
        
        	 <?php
			 }
		 }
	?>
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