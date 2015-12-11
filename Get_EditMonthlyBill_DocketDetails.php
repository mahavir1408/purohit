<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$bid = $_REQUEST['bid'];
	$fromDt = $_REQUEST['fromDt'];
	$toDt = $_REQUEST['toDt'];
	
	$sqlGetDocketDetails = "select did, billed, manualdocketnum, date_format(date ,'%d-%m-%Y') as date, Paybyname from docket where bid='$bid' ";
	$queryGetDocketDetails = mysql_query($sqlGetDocketDetails)  or die(mysql_error());
				 
	$subtot = 0;
				 
	while(  $fetchArrarGetDidForParti = mysql_fetch_array($queryGetDidForParti)  )
	{	 
	$did = $fetchArrarGetDidForParti['did'];
	
	$sqlGetParti ="select parti, qty, kg, rate, amt from particular where did='$did' ";
	$queryGetPartii = mysql_query($sqlGetParti)  or die(mysql_error());
	 
		while($fetchAssocParti = mysql_fetch_assoc($queryGetPartii))
		{
			 $qty = $qty + $fetchAssocParti['qty'];
			 $weight = $weight + $fetchAssocParti['kg'];
			 $rate = $rate + $fetchAssocParti['rate'];
			 $amount = $amount + $fetchAssocParti['amt'];
		} 
	
	$subtot = $subtot + $amount;
	
	$Labour = $resultRow['laborcharges'];
	$Waiting = $resultRow['waitingcharges'];
	$Other = $resultRow['othercharges'];
	
	$sTaxRate = $resultRow['setaxrate'];
	$sEduRate = $resultRow['educhessrate'];
	$sHeduRate = $resultRow['higheduchessrate'];
	
	$sTax = $subtot * $sTaxRate / 100;
	$sEdu = $sTax * $sEduRate / 100;
	$sHedu = $sTax * $sHeduRate / 100;
	
	$preGt = $subtot + $sTax + $sEdu +$sHedu + $Labour + $Waiting + $Other;
	$Gt = round($preGt);
	
	
	
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>