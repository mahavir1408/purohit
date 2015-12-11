<?php

	session_start();	
	include("config.inc");
	
	$fromdt = $_REQUEST['fromdt'];
	$todt = $_REQUEST['todt'];
	
	$mydate = date("d-m-Y");
	$month = date("m");
	$year = date("Y");
	
	//$days_in_month = cal_days_in_month (CAL_GREGORIAN, $month, $year);
	
	$sql = "select atid, trantype, date_format(date ,'%d-%m-%Y') as date, des, amt, paymode, name from accounts where date BETWEEN STR_TO_DATE('$fromdt', '%d-%m-%Y') AND STR_TO_DATE('$todt', '%d-%m-%Y') AND  pid='{$_SESSION['cid']}' ORDER BY  date ASC" ;
	
	/* RETURN VALUE */
	$all_data = array();
	
	$result = mysql_query($sql)  or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>