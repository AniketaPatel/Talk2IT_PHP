<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>

<?php
 $con=mysql_connect("localhost","root","");
 mysql_select_db("student");
 $rs= mysql_query("select * from abc order by uid desc",$con);
 $row=mysql_fetch_row($rs);
 $row[0]=$row[0]+1;
 echo $row[0];
 
 $rs1=mysql_query("insert into abc values(".$row[0].",'ww','ww')",$con); 
?>