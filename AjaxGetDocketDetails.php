<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$did=$_REQUEST['id'];
	
	$sql = "SELECT did, docId, manualdocketnum, Date_Format(date,'%d-%m-%Y') as date, invnum, invamt, octrinum, octriamt, Fromname, Fromal1, Fromal2, Frompin, Fromcity, Fromstate,Fromcountry, Fromcontact, Fromemailid, toname, tocountry, tostate, tocity, topin, toal1, toal2, tocontact, toemailid, Paybyname, Paybycountry, Paybystate, Paybycity, Paybypin, Paybyal1, Paybyal2, Paybycontact, Paybyemailid  from Docket where live=1 and deleted=1 and did='$did' ";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>

 	