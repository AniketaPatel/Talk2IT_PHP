<?php
if(isset($_POST['email']))
{
	$email=$_POST['email'];
	echo $email;
 	include "connection/connection_class.php";
	 $con = new createConnection(); // created a new object
         $con->connectToDatabase(); // connected to the database
              echo "<br/>"; 
         $con->selectDatabase();
              echo "<br/>";		
		$result=$con->fetchData("SELECT * FROM users_tb WHERE email=".$email);
				if($result)	
				{
					
					echo "Error: Email is Exists..";
				echo "<script>
					
						  document.getElementById('email-id').style.color='#FF0000';
		             	  document.getElementById('email-id').style.backgroundColor='rgba(255, 6, 2, 0.2)';
                          document.getElementById('email-id').innerHTML='Email ID is already Exists !';	               </script>
               ";		
				
		        
				}	
}
?>