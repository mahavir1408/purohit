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
	$payBySnameConcat = $_POST['txShortName'].' - '.$_POST['txLocation']; 
	
	$monthlyRate = $_POST["naMonthlyRate"];
	$tillkg = $_POST["naTillKg"];
	$tillkgrate = $_POST["naTillKgRate"];
	$kgRateabovetillkg = $_POST["naAboveTillKgRae"];
	
	$sql = "INSERT INTO company VALUES ('', 2, '$monthlyRate', '$tillkg ', '$tillkgrate', '$kgRateabovetillkg', '{$_POST['txPayBy']}',
'$payBySnameConcat', '{$_POST['txState']}', '{$_POST['txCity']}', '{$_POST['txPaybyPin']}', '{$_POST['txPaybyCell']}',
'{$_POST['txPaybyEmail']}', '{$_POST['txPaybyAl1']}', '{$_POST['txPaybyAl2']}', '{$_SESSION['cid']}', '{$_POST['txLocation']}', '{$_POST['sePaybyCountry']}' )";
	
	$PayByQuery = mysql_query($sql)  or die(mysql_error());
	
	if ( $PayByQuery ) {
	//header('Location: companymaster.php');
	}
	else {
	echo "Error adding Client";
	}
	
	mysql_close($connection);
	
?>
