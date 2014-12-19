// JavaScript Document
function passwordStrength(password)
{
	var desc = new Array();
	desc[0] = "Very Weak";
	desc[1] = "Weak";
	desc[2] = "Better";
	desc[3] = "Medium";
	desc[4] = "Strong";
	desc[5] = "Strongest";
	var score   = 0;

	//if password bigger than 6 give 1 point
	if (password.length > 6) score++;

	//if password has both lower and uppercase characters give 1 point	
	if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;

	//if password has at least one number give 1 point
	if (password.match(/\d+/)) score++;

	//if password has at least one special caracther give 1 point
	if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score++;

	//if password bigger than 12 give another 1 point
	if (password.length > 12) score++;

	 document.getElementById("passwordDescription").innerHTML = desc[score];
	 document.getElementById("passwordStrength").className = "strength" + score;
}

///////////////////////////////////////////////////////////////////
function validate_login_page()
    	{		    		
		var email=document.getElementById('email').value;
		var pass=document.getElementById('pass').value;
		var flag=0;
		if(email=="" || pass=="" || (email=="" & pass==""))
		{
		   document.getElementById("error_msg").style.backgroundColor="rgba(255, 6, 2, 0.2)";
		   document.getElementById("error_msg").style.color='#FF0000';
		   document.getElementById("error_msg").innerHTML="Don't keep blanks...";
		      document.getElementById("email").style.borderColor="#FF0000";
			     document.getElementById("pass").style.borderColor="#FF0000";
		   return false;
		   flag=1;
		}
	   }
///////////////////////////////////////////////////////////////////
exists_email(id)
{
  var email=document.getElementById(id).value;
var xmlreq;
//alert(email);
if (window.XMLHttpRequest)
  xmlreq=new XMLHttpRequest();
else
    xmlreq=new ActiveXObject("Microsoft.XMLHTTP");

xmlreq.onreadystatechange=function()
  {
  if(xmlreq.readyState==4 && xmlreq.status==200)
    {
   	document.getElementById("email-id").innerHTML=xmlreq.responseText;
    }
  }
xmlreq.open("POST","email_exists.php?email="+email,true);
xmlreq.send();  
}	   
///////////////////////////////////////////////////////////////////
function emailid(id)
{
	var email=document.getElementById(id).value;
	//alert(email);
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if ((!document.getElementById(id).value.match(mailformat)) && (document.getElementById(id).value!=""))
			{
    		      document.getElementById(id).style.borderColor="#FF0000";
	    		  document.getElementById("email-id").style.color="#FF0000";
		    	  document.getElementById("email-id").style.backgroundColor="rgba(255, 6, 2, 0.2)";
   				  document.getElementById("email-id").innerHTML=" The email address is not valid";
			}	
			else
			  document.getElementById("email-id").innerHTML="";
}	   
///////////////////////////////////////////////////////////////////
 function focusOut(id)
    {
	  if(document.getElementById(id).value=="")
	         {
		      document.getElementById(id).style.borderColor="#FF0000";
			  document.getElementById("error_msg").style.color="#FF0000";
			  document.getElementById("error_msg").style.backgroundColor="rgba(255, 6, 2, 0.2)";
			  document.getElementById("error_msg").innerHTML="Don't keep blanks...";
	         }
		else
		{
		 document.getElementById("error_msg").innerHTML="";	
    	 document.getElementById(id).style.borderColor='rgba(82, 168, 236, 0.8)';
		}	 
    }
///////////////////////////////////////////////////////////////////
function focusIn(id)
{
			 document.getElementById(id).style.borderColor='rgba(82, 168, 236, 0.8)';
}
//////////////////////////////////////////////////////////////////
function checkYear()
	{
		var year=document.getElementById('year');
		var month=document.getElementById('month');
		var day=document.getElementById('day');

		if(year.value!="0")
			month.disabled=false;
		if(year.value=="0"){
			month.disabled=true;
			day.disabled=true;
		}

		if(month.value=="2"){
			var n=((year.value % 4) == 0)?29:28;

			var temp=day.length;
			for(i=1;i<=temp;i++)
			{
				day.options[i]=null;	
			}
			for(i=1;i<=n;i++)
			{
				var myNewOption = new Option(i,i);
				day.options[i] = myNewOption;
			}
		}		
	}
///////////////////////////////////////////////////////
	function checkMonth()
	{
		var year=document.getElementById('year');
		var month=document.getElementById('month');
		var day=document.getElementById('day');
		
		if(month.value!="0")
			day.disabled=false;
		if(month.value=="0")
			day.disabled=true;
			
		if(month.value=="02"){
			var n=((year.value % 4) == 0)?29:28;
		}
		else if(month.value=="04" || month.value=="06" || month.value=="09" || month.value=="11"){
			var n=30;
		}
		else if(month.value=="01" || month.value=="03" || month.value=="05" || month.value=="07" || month.value=="08" || month.value=="10" || month.value=="12")	{
			var n=31;
		}
		var temp=day.length;
			for(i=1;i<=temp;i++)
			{
				day.options[i]=null;	
			}
		for(i=1;i<=n;i++)
		{
			var myNewOption = new Option(i,i);
			day.options[i] = myNewOption;
		} 
	}