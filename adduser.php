<?php
	include("config.inc");
	session_start();
	//echo $_SESSION['selectcompany'];
	if (!isset($_SESSION['login_id']))
	{
		// not logged in, move to login page
		header('Location: index.php');
		exit;
	}
	else if (isset($_SESSION['login_id'])) 
		{
						$login_id = $_SESSION['login_id'];
						//echo "$login_id";	
		}
	$comid = $_SESSION['cid'];
	$username = $_POST["userid"];
	$password = $_POST["password"];
	$role = $_POST['selectrole'];
	
	/*
		1  super admin
		2  admin	
		3  user
	
	if ($role == 2) {
	}
	*/
	
	$sql = "INSERT INTO users VALUES ('','$comid','$username','$password','$role')";
	if ($result = mysql_query($sql)) { 
	header('Location: welcome.php');
	}
	else {
	echo "error adding user";
	}
	
	mysql_close($connection);
	
?>
