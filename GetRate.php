<?php

	session_start();	
	include("config.inc");
	
	/* RECEIVE VALUE */
	$from=$_REQUEST['from'];
	$to=$_REQUEST['to'];
	
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];
	
	$sql = "select locationfrom, locationto from rate where fromid='$from' and toid='$to' and  pid='{$_SESSION['cid']}' " ;
	
	/* RETURN VALUE */
	$arrayToJs = array();
	
	$result = mysql_query($sql)  or die(mysql_error());
	$count = mysql_num_rows($result);
	
	if($count == 0){		// validate??
		$arrayToJs[] = array("status" => "true");			// RETURN TRUE 	// Rate not added is equal to true	
		echo json_encode($arrayToJs);			// RETURN ARRAY WITH success  
		}
	else {
		$arrayToJs[] = array("status" => "false");			// RETURN TRUE
		echo json_encode($arrayToJs);	
							
	}
		
	mysql_close($connection);
	
?>