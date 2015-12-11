<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$did=$_REQUEST['id'];
	
	$sql = "SELECT parti, qty, kg, rate, amt from particular where did='$did' ";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>