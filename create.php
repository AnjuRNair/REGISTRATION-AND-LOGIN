<?php


if (isset($_POST['submit']))
{
	require "../config.php";
    require "../common.php";
	
	$uname = $_POST['uname'];
	if(empty($uname))
	{
		$error= "enter your Username ";
		
	}
	$name = $_POST['name'];
	if(empty($name))
	{
		$error = "enter your Name ";
		
	}
	$email = $_POST['email'];
	if(empty($email))
	{
		$error = "enter your email ";
		
	}
	$pwd = $_POST['pwd'];
	if(empty($pwd))
	{
		$error = "enter your Password ";
		
	}
	$mobile = $_POST['mobile'];
	if(empty($mobile))
	{
		$error = "enter your mobile_no";
		
	}
	
	
	if(($uname!="") and ($name!="")and ($email!="") and ($pwd!="")and ($mobile!=""))
	{
			try  {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * 
                        FROM users
                        WHERE username = :uname";

        $uname = $_POST['uname'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':uname', $uname, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
		if ($result && $statement->rowCount() > 0) 
			{
			$error = "User already exist ";
		}
		else
		{
			
        $new_user = array(
            "username" => $_POST['uname'],
            "name"  => $_POST['name'],
            "email"     => $_POST['email'],
            "password"       => $_POST['pwd'],
            "mobile"  => $_POST['mobile']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
			} }catch(PDOException $error) 
	{
        echo $sql . "<br>" . $error->getMessage();
    }
	}
	else
	{ $error1=" error";
	}
}
?>




<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['uname']; ?> successfully added.</blockquote>
<?php } ?>





<script>
function validate()
{
	var uname=document.forms["create"]["uname"].value;
	
	if(uname=="")
	{
		alert("enter Username");
		document.forms["create"]["uname"].focus();
		return false;
	}
	
	var name=document.forms["create"]["name"].value;
	if(name=="")
	{
		alert("enter Name");
		document.forms["create"]["name"].focus();
		return false;
	}
	var email=document.forms["create"]["email"].value;
	if(email=="")
	{
		alert("enter email");
		document.forms["create"]["email"].focus();
		return false;
	}
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
	{
		alert("enter a valid email");
		document.forms["create"]["email"].focus();
		return false;
		
	}
	
	var password=document.forms["create"]["pwd"].value;
	if(password=="")
	{
		alert("enter Password");
		document.forms["create"]["pwd"].focus();
		return false;
	}
	
	var mobile=document.forms["create"]["mobile"].value;
	if(mobile=="")
	{
		alert("enter Mobile_no");
		document.forms["create"]["mobile"].focus();
		return false;
	}
	
	if(mobile.length<10)
		{
		alert("enter a valid mobile_no");
		document.forms["create"]["mobile"].focus();
		return false;
		}
	}
	




</script>


<center>
<div style="width:30%;
					height:350px;
					margin:50px;
					border:1px solid;
					padding:20px">
<h2>Registration</h2>
<form method="post" name="create" onsubmit="return validate();">
<?php
if(isset($error))
{
 ?>
 
    <id="error" style="color:black; "><?php echo $error.$error1; 
    
}
?>
<table style="padding:20px;">
			<tr>
				<td>USERNAME</td>
				<td><input type="text" name="uname" id="uname" value="<?php if(isset($uname)){echo $uname;}?>"></td>
			</tr>
			<tr>
				<td>NAME</td>
				<td><input type="text" name="name" id="name" value="<?php if(isset($name)){echo $name;}?>"></td>
			</tr>
			<tr>
				<td>EMAIL</td>
   
   <td> <input type="text" name="email" id="email" value="<?php if(isset($email)){echo $email;}?>"></td>
   <tr>
				<td>PASSWORD</td>
    <td><input type="password" name="pwd" id="pwd" value="<?php if(isset($pwd)){echo $pwd;}?>"></td></tr>
    <tr>
				<td>MOBILE</td>
    <td><input type="number" name="mobile" id="mobile" value="<?php if(isset($mobile)){echo $mobile;}?>"></td></tr>
    <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
	</table>
</form><br><br>

<a href="index.php">Back to home</a>
</div>
</center>
<?php require "templates/footer.php"; ?>
