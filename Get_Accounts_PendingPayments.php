<?php

	session_start();	
	include("config.inc");
	
	$cid = $_REQUEST['cid'];
	//echo $cid;
	//$days_in_month = cal_days_in_month (CAL_GREGORIAN, $month, $year);
	
	$sql = "select SUM(gt) as g from bill where payby='$cid' ";
	
	/* RETURN VALUE */
	$all_data = array();
	
	$result = mysql_query($sql)  or die(mysql_error());
	
	//while($row = mysql_fetch_assoc($result))
//	{
//		echo $row['g'];
//	}  
	//echo json_encode($all_data);
	
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>