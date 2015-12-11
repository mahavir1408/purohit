<?php

	session_start();	
	include("config.inc");
	
	$cid = $_REQUEST['cid'];

	$sql = "SELECT sum(amt) as g from accounts where namecustid='$cid' ";
	
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