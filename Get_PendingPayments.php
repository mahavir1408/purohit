<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
//	$bid=$_REQUEST['bid'];
	
	$sql = "select bid, manualbillnum, trantype, payment, paybyname, date_format(date ,'%d-%m-%Y') as  date, gt from Bill where payment='NOT PAID' and pid='{$_SESSION['cid']}'  ORDER BY paybyname, date DESC  " ;
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>