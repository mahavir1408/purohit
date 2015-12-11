<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$bid=$_REQUEST['bid'];
	
	$sql = "select setaxrate, educhessrate, higheduchessrate, laborcharges, waitingcharges, othercharges from bill where bid='$bid' ";
	$result = mysql_query($sql)  or die(mysql_error());

	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>