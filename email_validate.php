<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Friends...</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type='text/javascript'>
function emailValidator(element, alertMsg){
    var emailvalid = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(element.value.match(emailvalid))
    {
        alert("Email Validation: Successful.");
        return true;
    }else{
        alert(alertMsg);
        element.focus();
        return false;
    }
}
function onlyalphabate(element, AlertMessage){
    var regexp = /^[a-zA-Z]+$/;
    if(element.value.match(regexp))
    {
    alert("Letter Validation: Successful.");
    return true;
    }else{
        alert(AlertMessage);
        element.focus();
        return false;
    }
}
window.addEvent("domready", function(e){
 $("#confirm").addEvent("click", function(e){
    e.stop();
    var SM = new SimpleModal({"btn_ok":"Confirm button"});
        SM.show({
          "model":"confirm",
          "callback": function(){
            alert("Action confirm!");
          },
          "title":"Confirm Modal Title",
          "contents":"Ushma is a nice girl..."
        });
  })
 });
  $(document).ready(function() {
$('#clickMe').click(function() {
	$('body').showMessage({thisMessage: ['Hey! Something bit me!']});
	return false;
});
}

$('#confirm').click(function(){ alert('Hey!!!');});

</script>
</head>
<body>
<input name="Submit1" type="button" id="confirm" value="click me!" />

<form method="post">
Enter Your Email or put any value: <input type='text' id='emailid'/>
<input type='button' 
    onclick="emailValidator(document.getElementById('emailid'), 'This is Not a Valid Email')"
    value='Validate Email ID' />
    
    <select name="uname" >
    	<option value="1" selected="selected" disabled="disabled">A</option>
    	<option value="2">A</option>
		<option value="3">A</option>

    </select>
    <input name="Submit1" type="submit" value="submit" />
</form>
<?php
	if(isset($_POST['Submit1']))
	{
		echo "<br/>".$_POST['uname'] ;
	}
?>

<a href="" onlclick="alert();">delete</a>
</body>
</html>