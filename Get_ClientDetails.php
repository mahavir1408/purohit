<?php

	session_start();	
	include("config.inc");
	
	/* RECEIVE VALUE */
	$cid=$_REQUEST['cid'];
	
	$sql = "select cid, name, sname, state, city, pin, contact, emailid, al1, al2, monthlyrate, tillkg, tillkgrate, kgRateabovetillkg from company where pid='{$_SESSION['cid']}' and cid='$cid' " ;
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}
	  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>