
<?php
session_start();
?>
<!DOCTYPE html>
<head>
	<title>LOGIN</title>
</head>
<body>
	<script>
	function validate()
	{
		
		var uname=document.forms["create"]["uname"].value;
		
		var pwd=document.forms["create"]["pwd"].value;
		
		if(uname=="")
		{
			alert("Enter username");
			document.forms["create"]["uname"].focus();
			return false;
		}
		if(pwd=="")
		{
			alert("Enter password");
			document.forms["create"]["pwd"].focus();
			return false;
		}
		
	}
	</script>

	<center>
		<div style="width:30%;
					height:250px;
					margin:50px;
					border:1px solid;
					padding:20px">
		<form name="create"
			  action="logindb.php"
			  method="POST" 
			  onsubmit="return validate()">

		<h2 style="text-align:center">LOGIN</h2>
		<table style="padding:20px;">
			<tr>
				<td>USERNAME</td><td><input type="text" name="uname"></td>
			</tr>
            
		    <tr>
				<td>PASSWORD</td><td><input type="password" name="pwd"></td>
		    </tr>
			
			<tr>
				<td><input  type="submit" name="login" value="login"></td>
			</tr>
			
		</table>

		</form>
		</div>
	</center>
</body>
</html>


	