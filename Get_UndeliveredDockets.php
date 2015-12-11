<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
//	$bid=$_REQUEST['bid'];
	
	$sql = "select did, docId, trantype, manualdocketnum, date_format(date ,'%d-%m-%Y') as  idate, Paybyname, Fromname, toname, delivered, trantype from docket where delivered='NO' and pid='{$_SESSION['cid']}' ORDER BY date DESC " ; 
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>