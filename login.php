<?php
	session_start();
	include("config.inc");
	unset($_SESSION['cid']); 
	$username = $_POST["login_id"];
	$password = $_POST["password"];
	$icid = $_POST["selectcompany"];
	
	$_SESSION['cid'] = $_POST["selectcompany"];   // Current users Company id stored in this variable.
	
	$_SESSION['Dnum'] = 0;
	$_SESSION['Cnum'] = 0;
	$_SESSION['Bnum'] = 0;
	$_SESSION['TranError'] = "";
	
	$dbselect = mysql_select_db("purohit",$connection);
	$sql = "SELECT uid, user, pass, role FROM users WHERE BINARY user='$username' and BINARY pass='$password' and BINARY cid='$icid'";
	$result = mysql_query($sql)  or die(mysql_error());
	$count = mysql_num_rows($result);
	
	$rolerow = mysql_fetch_array($result);
	
	$_SESSION['role'] = $rolerow['role']; // Current users Role id stored in this variable.
	$_SESSION['uid'] = $rolerow['uid'];  // Current users uid stored in this variable.
	
	$comid = $_SESSION['cid'];
		 
	$sql1 = "select name from company where cid = '$comid' ";
	$result1 = mysql_query($sql1)  or die(mysql_error());
	$row1 = mysql_fetch_row($result1);
	
	$_SESSION['companyname'] = $row1[0];  // Current users Company Name stored in this variable.
	
	
	if ($count==1) 
		{
			//echo "update is done";
			 $_SESSION['login_id'] = $_POST['login_id'];

			if (!isset($_SESSION['login_id'])) 
			{
				header('Location: index.php');
			}
			else
			{
				
				echo "<script>window.location = ('welcome.php');</script>";
			}
		}
	else 
		{
			//header("location:index.php");
			$_SESSION['login_page_error'] = "Invalid user or password";
			
			unset($_SESSION['cid']);    // Destroy Session cid value if login fails
			
			header('Location: index.php');
			
			//echo "<script>alert('Invalid User')</script>";
			//echo "<script>window.location = ('index.php');</script>";
		} 		
        
        mysql_close($connection);
?>