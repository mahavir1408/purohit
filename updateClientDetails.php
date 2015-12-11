<?php
	include("config.inc");
	session_start();
	
	if (!isset($_SESSION['login_id']))
	{
		// not logged in, move to login page
		header('Location: index.php');
		exit;
	}
	else if (isset($_SESSION['login_id'])) 
		{
		$login_id = $_SESSION['login_id'];
		}
	
		
	$docketid = $_POST['hfDocNum'];
	$BilledStatus = $_POST['hfBilledStatus'];
	//$Billid = $_POST['hfBillNum'];
	//if bil
	
	$monthlyRate = $_POST["naMonthlyRate"];
	$tillkg = $_POST["naTillKg"];
	$tillkgrate = $_POST["naTillKgRate"];
	$kgRateabovetillkg = $_POST["naAboveTillKgRae"];

	$paybycid = $_POST['txPaybyCid'];
	$payBySnameConcat = $_POST['txShortName'].' - '.$_POST['txLocation']; 	//.'-'.'$_POST['txLocation']';
	
	$sqlUpdateClient = "UPDATE COMPANY SET 
	name = '{$_POST['txPayBy']}',
	sname = '$payBySnameConcat',
	state = '{$_POST['txState']}',
	city = '{$_POST['txCity']}',
	pin = '{$_POST['txPaybyPin']}',
	contact = '{$_POST['txPaybyCell']}',
	emailid = '{$_POST['txPaybyEmail']}',
	al1 = '{$_POST['txPaybyAl1']}',
	al2 = '{$_POST['txPaybyAl2']}',
	location = '{$_POST['txLocation']}',
	country = '{$_POST['sePaybyCountry']}',
	monthlyrate = '$monthlyRate',
	tillkg = '$tillkg',
	tillkgrate = '$tillkgrate',
	kgRateabovetillkg = '$kgRateabovetillkg' 
	where cid = '{$_POST['txPaybyCid']}' and pid= '{$_SESSION['cid']}' ";
	
	$qryUpdateClient = mysql_query($sqlUpdateClient)  or die(mysql_error());
	
	if ( $qryUpdateClient ) {
	header('Location: ListClients.php');
	}
	else {
	echo "Error adding Client";
	}
	
	mysql_close($connection);
			


?>
