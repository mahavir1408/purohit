<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$did=$_REQUEST['bid'];
	
	$sql = "select billed, bid, manualdocketnum, date_format(date ,'%d-%m-%Y') as date, invnum, invamt, grnnum, octrinum, octriamt, delivered,  date_format(delivereddt ,'%d-%m-%Y') as delivereddt, receivername, 	receivercontactdetail, notice, finyear, paybyid, Paybyname, Paybysname, Paybycountry, Paybystate, Paybycity, Paybypin, Paybyal1, Paybyal2, Paybycontact, Paybyemailid, frm, Fromname, Fromsname, Fromcountry, Fromstate, Fromcity,	Frompin, Fromal1, Fromal2, 	Fromcontact, Fromemailid, too, toname, tosname,	tocountry, tostate,	tocity,	topin, toal1, toal2, tocontact,	toemailid from docket where did='$did' ";
		
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>