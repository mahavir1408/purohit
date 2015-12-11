<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$cid=$_REQUEST['cid'];
	
	$sql = "select name, country, state, city, pin, contact, emailid, al1, al2  from company where cid='$cid'";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>