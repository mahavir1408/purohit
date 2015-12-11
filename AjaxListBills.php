<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$option = $_REQUEST['option'];
	$value = $_REQUEST['value'];
	
	$sql = "SELECT bid, Date_Format(date,'%d-%m-%Y') as date, manualbillnum, paybyname, gt, payment, sname, trantype FROM `bill` where pid='{$_SESSION['cid']}' and  date=STR_TO_DATE('$value', '%d-%m-%Y')";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>