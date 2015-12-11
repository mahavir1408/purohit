<?php
	
	// 1 = id
	// 2 = Docket No.
	// 3 = Date
	// 4 = Client Name
	// no Single bill docket
		
		
	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$option = $_REQUEST['option'];
	$value = $_REQUEST['value'];
	
	if ( $option == 3 ) {
	
		$sql = "SELECT did, docId, manualdocketnum, Date_Format(date,'%d-%m-%Y') as date, Paybyname, delivered, Fromname, toname FROM docket  where pid='{$_SESSION['cid']}' and  date=STR_TO_DATE('$value', '%d-%m-%Y') and trantype <> 1 ORDER BY Paybyname ";
	
		$result = mysql_query($sql)  or die(mysql_error());
		$all_data = array();
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}  
		echo json_encode($all_data);
		
	}
	else if ( $option == 2 ) {
	
		$sql = "SELECT did, docId, manualdocketnum, Date_Format(date,'%d-%m-%Y') date, Paybyname, delivered, Fromname, toname FROM docket  where pid='{$_SESSION['cid']}' and  manualdocketnum='$value' and trantype <> 1 ORDER BY Paybyname ";
	
		$result = mysql_query($sql)  or die(mysql_error());
		$all_data = array();
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}  
		echo json_encode($all_data);
	}
	else if ( $option == 1 ) {
	
		$sql = "SELECT did, docId, manualdocketnum, Date_Format(date,'%d-%m-%Y') date, Paybyname, delivered, Fromname, toname FROM docket  where pid='{$_SESSION['cid']}' and  docId='$value' and trantype <> 1 ORDER BY Paybyname ";
	
		$result = mysql_query($sql)  or die(mysql_error());
		$all_data = array();
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}  
		echo json_encode($all_data);
	}
	else if ( $option == 4 ) {
	
		$sql = "SELECT did, docId, manualdocketnum, Date_Format(date,'%d-%m-%Y') date, Paybyname, delivered, Fromname, toname FROM docket  where pid='{$_SESSION['cid']}' and  Paybyname='$value' and trantype <> 1 ORDER BY date ";
	
		$result = mysql_query($sql)  or die(mysql_error());
		$all_data = array();
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}  
		echo json_encode($all_data);
	}
		
	mysql_close($connection);
	
?>