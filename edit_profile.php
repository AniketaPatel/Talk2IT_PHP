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
            //  echo "<br/>"; 
         $con->selectDatabase();
	*/
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
<form action="" method="post" enctype="multipart/form-data">
  <!--     <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active"></li>
        </ul>   -->
       
               <div class="block">
                 <a href="#page-stats" class="block-heading" data-toggle="collapse">Edit  Profile </a>
                 <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                     <div id="tablewidget" class="block-body collapse in">
          
			<?php 
			
	            $rs =$con->fetchRow($uid);
	if($rs){	
	echo'  <table class="table">
              <thead>
                <tr>
                  <th>';	
    	echo '<div align="center" id="profile_pic"><img src="images/user/'.$rs[3].'" alt="image" /></div>';	
	      echo'            </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Name</td><td>';
		  echo $_SESSION['name'];
		  echo'</td></tr>             <tr><td>Email ID</td><td>';
		  echo $rs[0];
		  echo'</td></tr>            <tr><td>Birth Date</td><td>';
		  echo $rs[1];
		  echo'</td></tr>            <tr><td>Gender</td><td>';
			 if($rs[2]=="M")
			  echo "Male";
			  else
			   echo "Female";		  
   	      echo'</td></tr>          </tbody></table>';
		  }			   
			?>
            <!--   <p><a href="users.html">More...</a></p>-->
        </div>
		
                     <br />  <input type="submit"  class="btn btn-primary pull-right" name="Submit" value="Submit"/>
                     <br />
                    </div>
                </div>
            </div>
        </div>
  </div>

    <div class="block">
        <p><a href="#tablewidget" class="block-heading" data-toggle="collapse">Reset Password</a></p>
        <table width="35%" height="95" border="0" align="center">
          <tr>
            <td width="35%"><br />
              Password</td>
            <td width="65%"><input type="text" name="pass" size="20">&nbsp;</td>
          </tr>
          <tr>
            <td>Confirm Password </td>
            <td><input type="text" name="cpass" size="20"   /></td>
          </tr>
          <tr>
            <td colspan="2">  <span class="stat-widget">
              
            </span>&nbsp;<input type="submit"  class="btn btn-primary pull-right" name="Submit2" value="Submit"/></td>
            </tr>
        </table>
        <p>&nbsp;</p>
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
	if(isset($_POST['upload']))
	{	
	 if(!isset($_POST['image']))
	{
		/*echo"<script>alert('Please Select the photo');</script>";*/
		echo'please select photo';
	}
	 else{
	include 'connect_db.php';
		$file = $_FILES ['image'];
		$name1 = $file ['name'];
		$tmppath = $file ['tmp_name'];
	//	$title=$_POST['title'];
	//	$date=date('y-m-d h:i:s', time());
		$tmp1 = explode(".",$name1);
		$name=$tmp1[0];
		$file_ext=$tmp1[1];
		if($file_ext=='jpg'){
    		$ext=1;
		}
		else if ($file_ext=='gif'){
		    $ext=2;
		}
		else if ($file_ext=='png'){
    		$ext=3;
		}
		$name1=$_SESSION['uid'];
   		$name1.='.jpg';
		$target = 'images/users/'.$name1;
        if(!(@move_uploaded_file($tmppath,$target)))
        {
		   	$msg= 'The image could not be uploaded, please try again!';
		}
		else
		{
          		$newImg=resize110($target,$ext);
            //echo '<img src="'.$newImg.'"/>';
            echo"<script>alert('hiiiiiiii');</script>";
			$result=mysql_query("update users_tb set image=".$name1." where uid=".$uid,$connection);
			
			if($result){
				if(mysql_affected_rows($connection)==1){
					$msg="Image uploaded successfully";
				}
			}
			else{
					$msg=mysql_error()." Image cannot be uploaded....";
			}
		}
	}
	function getHeight($image) 
    {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
    }

    function getWidth($image) 
    {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
    }


    function resize110($image,$ext) 
    {
        chmod($image, 0777);
        $oldHeight=getHeight($image);
        $oldWidth=getWidth($image);
        switch ($ext)
        {
            case 1;
                $source = imagecreatefromjpeg($image);
            break;

            case 2;
                $source = imagecreatefromgif($image);
            break;

            case 3;
                $source = imagecreatefrompng($image);
            break;
        }
        $newImage = imagecreatetruecolor(310,310);
        $bgcolor = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $bgcolor);       // use this if you want to have a white background instead of black


        // we check tha width and height and then we crop the image to the center
        if($oldHeight<$oldWidth)
        {
            $newImageHeight = 310;
            $newImageWidth = ceil((310*$oldWidth)/$oldHeight);
            imagecopyresampled($newImage,$source,-ceil(($newImageWidth-310)/2),0,0,0,$newImageWidth,$newImageHeight,$oldWidth,$oldHeight);
        }
        else
        {
            $newImageHeight = ceil((310*$oldHeight)/$oldWidth);
            $newImageWidth = 310; 
            imagecopyresampled($newImage,$source,0,-ceil(($newImageHeight-310)/2),0,0,$newImageWidth,$newImageHeight,$oldWidth,$oldHeight);
        }

        //we save the image as jpg resized to 110x110 px and cropped to the center. the old image will be replaced
        imagejpeg($newImage,$image,90);

        return $image;
	}
    }
?>