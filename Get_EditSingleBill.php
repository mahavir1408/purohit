<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$bid=$_REQUEST['bid'];
	
	$sql = "select payby, subtot, setax, educhess, higheduchess, laborcharges, waitingcharges, othercharges, gt, setaxrate, educhessrate, higheduchessrate, date_format(fromdate ,'%d-%m-%Y') as fromdate, date_format(todate ,'%d-%m-%Y') as todate, payment, bankname, chequenum, setaxrate,  educhessrate, higheduchessrate, date_format(date ,'%d-%m-%Y') as date, paybyname, sname, country, state, city, pin, al1, al2, contact, emailid, date_format(paydate ,'%d-%m-%Y') as paydate from bill where bid='$bid'";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>