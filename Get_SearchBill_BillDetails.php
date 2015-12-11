<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$option = $_REQUEST['option'];
	$value = $_REQUEST['value'];
	$all_data = array();
	
	if ( $option == 1 ) {
		
		$sql = "SELECT bid, Date_Format(date,'%d-%m-%Y') as idate, manualbillnum, paybyname, gt, payment, bankname, chequenum, paybyname, trantype, Date_Format(paydate,'%d-%m-%Y') as  paydate FROM `bill` where pid='{$_SESSION['cid']}' and manualbillnum='$value' ORDER BY date DESC ";
		
		$result = mysql_query($sql)  or die(mysql_error());
		
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}
		
		echo json_encode($all_data);
		
	}
	else if ( $option == 3 ) {
	
		$sql = "SELECT bid, Date_Format(date,'%d-%m-%Y') as idate, manualbillnum, paybyname, gt, payment, bankname, chequenum, paybyname, trantype, Date_Format(paydate,'%d-%m-%Y') as  paydate FROM `bill` where pid='{$_SESSION['cid']}' and paybyname='$value'  ORDER BY date DESC";
		
		$result = mysql_query($sql)  or die(mysql_error());
		
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}
		
		echo json_encode($all_data);
		
	}
	
	
	
		
	mysql_close($connection);
	
?>