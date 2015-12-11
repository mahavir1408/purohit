<?php

	session_start();	
	include("config.inc");
	
	/* RECEIVE VALUE */
	$from=$_POST['from'];
	$to=$_REQUEST['to'];
	$tillkg=$_REQUEST['tillkg'];
	$tillkgrate=$_REQUEST['tillkgrate'];
	$abovetillkgrate=$_REQUEST['abovetillkgrate'];
	$toid = $_REQUEST['toid'];
	$fromid = $_REQUEST['fromid'];
	
	$sql = "INSERT INTO RATE VALUES ('', '$from', '$to', '$tillkg', '$tillkgrate', '$abovetillkgrate', '{$_SESSION['cid']}', '$fromid', '$toid' )";
	
	$result = mysql_query($sql)  or die(mysql_error());
	
	if ( $result ) {
		echo "true";
	}
	else {
		echo "false";
	}
	
	mysql_close($connection);
	
?>