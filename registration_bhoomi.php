<html>
<head>  <Title> User Authentication </title>  </head>
<body>	
         <form action="" method="POST">

         <table border=2>

         <tr> <td colspan=4 align="center"> User Login  </td>   </tr>

          <tr> 
	<td> User Name </td> 
	<td> <input type=text name="txtuname"> </td> 
          </tr>
		
           <tr> 
	<td> Password </td> 
	<td> <input type=text name="txtpass"> </td> 
           </tr>

            <tr> 
	    <td colspan=4> 
	          <input type=submit value="Insert" name="Insert"> 
	                         </td> 		     
            </tr>

        </table>	
        </form>
</body>
</htm>


<?php

    include("connection/connection_class.php"); 

    $con = new createConnection(); // created a new object

    $con->connectToDatabase(); // connected to the database

    echo "<br />"; 

    $con->selectDatabase();

    echo "<br />";

   // Featching Data 
   
   $sql = "select * from users_tb order by uid desc"; 
   $rs = $con->fetchData($sql);
    
	  $Row=mysql_fetch_row($rs);
             echo $Row[0];  
    $Row[0]=$Row[0]+1;

    // Insert Record Into the Table
    if (isset($_POST['Insert']))
     {
          $message = $con->insertData($Row[0],$_POST[txtuname],$_POST[txtpass]);
          echo $message."<br>";
      }
$del=$con->deleteData($row[0]);
    $con->closeConnection();
?>