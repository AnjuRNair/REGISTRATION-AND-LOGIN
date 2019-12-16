<?php
session_start();
$uname=$_POST['uname'];
$_SESSION['user']=$uname;
if(isset($_POST['login']))
{
	if(isset($_POST['uname']) and isset($_POST['pwd']))
	{
		
$host="localhost";
$username="root";
$password="";
$dbname="reg1";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

$connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * 
                        FROM users
                        WHERE username = :uname and password=:pwd";

        $uname = $_POST['uname'];
		$pwd=$_POST['pwd'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':uname', $uname, PDO::PARAM_STR);
		$statement->bindParam(':pwd', $pwd, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
		if ($result && $statement->rowCount() > 0) 
			{
				echo $_SESSION['user'];
			echo "logged in successfully";
		}
		else
		{
			echo "incorrect password or username";
		}	
	}
}	

?>