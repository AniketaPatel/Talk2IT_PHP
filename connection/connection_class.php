<?php

class createConnection 
{
    var $host="localhost";
    var $username="root";    
    var $password="";
    var $database="talk2it";
    var  $rs;
    var $msg;
    var $mycon;
    var $SQL,$SQL1;
    var $row,$friends,$req_receive,$req_send,$f_req;
	var $unread,$trash,$archived,$sent,$read;
    // connect with Talk2IT db
    function connectToDatabase() 
    {
        $con= mysql_connect($this->host,$this->username,$this->password);
        if (!$con)   {    die ("Cannot connect to the database");    }
        else             {
            $this->mycon = $con;
            //echo "Connection established";
        }
        return $this->mycon;
    }

    // select database Talk2IT
    function selectDatabase() 
    {
        mysql_select_db($this->database);  

        if (mysql_error())      {  echo "Cannot find the database ".$this->database;   }

      //  echo "Database selected..";       
     }
   
    function login($email,$pass)
    {
           $this->SQL = "select * from users_tb where email='".$email."' and password='".$pass."'";
		  // echo $this->SQL;
           $this->rs =mysql_query($this->SQL,$this->mycon);
		   //echo $this->rs;
   if($this->rs)
		{
			//echo".....hiiiiiiiiii";
			
				if($this->row=mysql_fetch_array($this->rs))
				{
					echo $this->row['status'];
					
					if($this->row['status']==1 && $this->row['email']=="admin@gmail.com")
					{
						session_start();
					
						$_SESSION['uid']=$this->row['uid'];
					    $_SESSION['name']=$this->row[1]." ".$this->row[2];
						
						header("location:admin_home.php");
				    }
					else	if($this->row['isActive'] == 1  &&  $this->row['isBlocked']==0)
					{
						session_start();
					
						$_SESSION['uid']=$this->row['uid'];
					    $_SESSION['name']=$this->row[1]." ".$this->row[2];
						
						$this->closeConnection();
						header("location:home.php");
					}
					else
						echo "Your A/c may be blocked or Not Activated";
					$this->closeConnection();	
				}
		}
		else
		echo "EmailID or password Don't match.Please signup to login.";
//			echo 'Login failed';
    }
     // Fetching Data from the Table
     function fetchData ($sql)
    {
           $this->SQL = $sql;
           $this->rs =mysql_query($this->SQL);
              return $this->rs;
    }

   // Fetching Data from the Table
     function fetchRow ($uid)
    {
           $this->SQL = "SELECT * FROM users_tb WHERE uid=".$uid;
           $this->rs =mysql_query($this->SQL);
		   if($this->rs)
		       if($this->row=mysql_fetch_array($this->rs))
			       $my_array=array($this->row['fname'],$this->row['lname'],$this->row['email'],$this->row['bdate'],$this->row['gender'],$this->row['image']);
			      return $my_array;
           }
      
	  //////////////////////////////////////////////////////////////
	  function fetchmsg($uid)
	  {
		  $this->rs=mysql_query("SELECT rid FROM messages_tb WHERE rid=$uid AND read_status=0 AND delete_status=0 AND archive_status=0 AND trash_status=0 ;",$this->mycon);
		$this->unread=mysql_affected_rows($this->mycon);
		
		$this->rs=mysql_query("SELECT rid FROM messages_tb WHERE rid=$uid AND delete_status=0 AND trash_status=0 AND archive_status=0 AND read_status=1;",$this->mycon);
		$this->read=mysql_affected_rows($this->mycon);
		
		$this->rs=mysql_query("SELECT sid FROM messages_tb WHERE sid=$uid;",$this->mycon);
		$this->sent=mysql_affected_rows($this->mycon);
		
		$this->rs=mysql_query("SELECT rid FROM messages_tb WHERE rid=$uid AND archive_status=1;",$this->mycon);
		$this->archived=mysql_affected_rows($this->mycon);
		
		$this->rs=mysql_query("SELECT rid FROM messages_tb WHERE rid=$uid AND trash_status=1;",$this->mycon);
		$this->trash=mysql_affected_rows($this->mycon);  
		$my_array=array($this->unread,$this->read,$this->sent,$this->archived,$this->trash);
		return $my_array;
	  }
	  //////////////////////////////////////////////////////////////
	  function fetchfriends($uid)
	  {
		  $this->rs=mysql_query("SELECT f_list,r_receive,r_send FROM friends_tb WHERE uid=".$uid,$this->mycon);
	if(!$this->rs)
       echo "Friends are not found";
	   else
     	if($this->row=mysql_fetch_array($this->rs))
	{
		if($this->row['f_list']==$uid) $this->friends=0; 
		else $this->friends=count(explode(",",$this->row['f_list'])); 
		
		if($this->row['r_receive']==$uid) $this->req_receive=0; 
		else $this->req_receive=count(explode(",",$this->row['r_receive']));
		
		if($this->row['r_send']==$uid) $this->req_send=0; 
		else $this->req_send=count(explode(",",$this->row['r_send']));
		
		$this->f_req=$this->req_receive-$this->friends;
		
		$my_array=array($this->friends,$this->req_receive,$this->req_send,$this->f_req);
		  }
	  }
     // Insert Data into the Table
     function insertData ($total,$fname,$lname,$email,$pass,$bdate,$gender,$activate_code)
    {
		if($gender=="male")
         $this->SQL = "INSERT INTO users_tb (uid,fname,lname,email,password,bdate,gender,image,status,a_code)
		 VALUES (".$total.",'".$fname."','".$lname."','".$email."','".$pass."','".$bdate."','M','default.png',0,'".$activate_code."');";
		 else
		$this->SQL = "INSERT INTO users_tb (uid,fname,lname,email,password,bdate,gender,image,status,a_code)
		 VALUES (".$total.",'".$fname."','".$lname."','".$email."','".$pass."','".$bdate."','F','default.png',0,'".$activate_code."');";
            mysql_query($this->SQL,$this->mycon);

         $this->SQL1="INSERT INTO friends_tb VALUES(".$total.",0,0,".$total.")";
		    mysql_query($this->SQL1,$this->mycon);
			$this->msg = "Record Successfully Inserted"; 
           return $this->msg;
    }
	///////////////////////////////////////////////////
	
	  function updateData ($uid,$uname,$pass)
    {
		   $this->SQL = "update users_tb set uid=".$uid.",fname='aa','".$uname."','aa@gmail.com','','M','image.png',1,'',0,0)";
            mysql_query($this->SQL,$this->mycon);
            $this->msg = "Record Successfully updated"; 

           return $this->msg;
    }
	  function deleteData ($uid)
    {
		   $this->SQL = "delete from users_tb where uid=".$uid;
            mysql_query($this->SQL,$this->mycon);
            $this->msg = "Record Successfully Deleted"; 

           return $this->msg;
    }

     // close the connection
    function closeConnection() 
    {
        mysql_close($this->mycon);
//        echo "Connection closed";
    }
}

?>