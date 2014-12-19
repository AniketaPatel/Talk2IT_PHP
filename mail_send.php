<?php

if(!$_POST) exit;

$email = $_POST['email'];


//$error[] = preg_match('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $_POST['email']) ? '' : 'INVALID EMAIL ADDRESS';
if(!eregi("@",$email )){
    $error.="Invalid email address entered";
    $errors=1;
}
if($errors==1) echo $error;
else{
    $values = array ('name','email','telephone','message');
    $required = array('name','email','telephone','message');

    $your_email = "xxx@xxx.com";
    $email_subject = "New Messag: ".$_POST['subject'];
    $email_content = "New message:\n";

    foreach($values as $key => $value){
      if(in_array($value,$required)){
        if ($key != 'subject' && $key != 'telephone') {
          if( empty($_POST[$value]) ) { echo 'PLEASE FILL IN REQUIRED FIELDS'; exit; }
        }
        $email_content .= $value.': '.$_POST[$value]."\n";
      }
    }

    if(@mail($your_email,$email_subject,$email_content)) {
        echo 'Message sent!'; 
    } else {
        echo 'ERROR!';
    }
}

$mail->Mailer = "smtp";  
$mail->Host = "ssl://smtp.gmail.com";  
$mail->Port = 465;  
$mail->SMTPAuth = true; // turn on SMTP authentication  
$mail->Username = "user@gmail.com"; // SMTP username  
$mail->Password = "password"; // SMTP password 

?>