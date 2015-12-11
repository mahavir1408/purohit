<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$fromDt = $_REQUEST['from'];
	$toDt = $_REQUEST['to'];
	
	$sql = "SELECT bid, Date_Format(date,'%d-%m-%Y') as date, manualbillnum, paybyname, gt, payment, bankname, chequenum, paybyname, trantype, Date_Format(paydate,'%d-%m-%Y') as  paydate FROM `bill` where pid='{$_SESSION['cid']}' and date BETWEEN STR_TO_DATE('$fromDt', '%d-%m-%Y') AND STR_TO_DATE('$toDt', '%d-%m-%Y') ORDER BY date DESC";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>