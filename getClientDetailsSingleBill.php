<?php
	include("config.inc");
	session_start();
	
	$cid = $_REQUEST['cid'];
	
	$sql = "SELECT sname, country, location, state, city, pin, al1, al2, contact, emailid, tillkg, tillkgrate, kgRateabovetillkg from company WHERE clienttype=2 and cid='$cid' ";
	$query = mysql_query($sql)  or die(mysql_error());
	
	$all_data = array();
	
	while($row = mysql_fetch_assoc($query))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);

?>
