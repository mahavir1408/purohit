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
		
	$Pid = $_SESSION['cid'];	
	//$comid = $_POST["naSelectCompany"];
	$clienttype =$_POST["selectclient"];             //1 =Parent( company who will operate  this software )  2 = client ( companies under Parent
	$monthlyRate = $_POST["naMonthlyRate"];
	$tillkg = $_POST["naTillKg"];
	$tillkgrate = $_POST["naTillKgRate"];
	$kgRateabovetillkg = $_POST["naAboveTillKgRae"];
	$name = $_POST["userid"];
	$sname = $_POST["snameid"];
	
	$state = $_POST["naSelectStat"];
	$city = $_POST["naCity"];
	$pin = $_POST["naPin"];
	$contact = $_POST["naContact"];
	$emailid = $_POST["naEmail"];
	$al1 = $_POST["naAd1"];
	$al2 = $_POST["naAd2"];
	$pid = $_POST["naSelectCompany"];
	
	/*  
		Type of users
		
		1  super admin
		2  admin	
		3  user
		
		Company/parent and Client
		1 company
		2 client
	
	if ($role == 2) {
	}
	*/
	
	$sql = "INSERT INTO company VALUES ('','$clienttype','$monthlyRate','$tillkg','$tillkgrate','$kgRateabovetillkg','$name','$sname','$state','$city','$pin','$contact','$emailid','$al1','$al2','$pid', '$Pid','$fromLocation'  )";
	if ($result = mysql_query($sql)) { 
	header('Location: welcome.php');
	}
	else {
	echo "error adding Company";
	}
	
	mysql_close($connection);
	
?>
