<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$frmdt=$_REQUEST['fromdate'];
	$todt=$_REQUEST['todate'];
	
	$sql = "SELECT paybyname, manualbillnum, Date_Format(date,'%d-%m-%Y') as idate, subtot, setax, educhess, higheduchess, gt FROM bill WHERE pid='{$_SESSION['cid']}' and date BETWEEN STR_TO_DATE('$frmdt', '%d-%m-%Y') AND STR_TO_DATE('$todt', '%d-%m-%Y') and paybyname<>'CANCEL ACCOUNT'";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		$all_data[] = $row;
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>