<?php

	session_start();	
	include("config.inc");
	
	/* RECEIVE VALUE */
	$rid = $_REQUEST['rid'];
	$from=$_POST['from'];
	$to=$_REQUEST['to'];
	$tillkg=$_REQUEST['tillkg'];
	$tillkgrate=$_REQUEST['tillkgrate'];
	$abovetillkgrate=$_REQUEST['abovetillkgrate'];
	$fromid=$_REQUEST['fromid'];
	$toid=$_REQUEST['toid'];
	
	$sql = "UPDATE RATE SET
	locationfrom = '$from',
	locationto = '$to',
	tillkg  = '$tillkg',
	tillkgrate = '$tillkgrate',
	abovetillkgrate = '$abovetillkgrate',
	fromid = '$fromid',
	toid = '$toid'
	where rid='$rid' ";
		
	$result = mysql_query($sql)  or die(mysql_error());
	
	if ( $result ) {
		echo "true";
	}
	else {
		echo "false";
	}
		
	mysql_close($connection);
	
?>