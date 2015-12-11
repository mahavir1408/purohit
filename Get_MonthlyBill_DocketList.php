<?php
	include("config.inc");
	session_start();
	//sleep(5);
	$fromDt = $_REQUEST['from'];
	$toDt = $_REQUEST['to'];
	$payBy = $_REQUEST['payby'];
	
	// calc docket amt of all the dockets 
	
	$sqlGetDocketDid = "select did, date from docket where live=1 and deleted=1 and billed=2 and bid=0 and paybyid='$payBy' and trantype=2 and date BETWEEN STR_TO_DATE('$fromDt', '%d-%m-%Y') AND STR_TO_DATE('$toDt', '%d-%m-%Y')  and pid='{$_SESSION['cid']}' ORDER BY date DESC";
	$queryGetDocketDid = mysql_query($sqlGetDocketDid)  or die(mysql_error());

	while ( $fetchGetDocketDid = mysql_fetch_assoc($queryGetDocketDid) ) {
		
		$did = $fetchGetDocketDid['did'];
		
		$sqlGetDocketDidDetails = "select manualdocketnum, docId, date_format(date ,'%d-%m-%Y') as idate, Paybyname from docket where live=1 and deleted=1 and billed=2 and bid=0 and paybyid='$payBy' and trantype=2 and did=$did ORDER BY date DESC";
		$queryGetDocketDidDetails = mysql_query($sqlGetDocketDidDetails)  or die(mysql_error());
		$manualdocketnum =0;
		
		while ( $fetchGetDocketDetails = mysql_fetch_assoc($queryGetDocketDidDetails) ) {
			$manualdocketnum = $fetchGetDocketDetails['manualdocketnum'];
			$date = $fetchGetDocketDetails['idate'];
			$Paybyname = $fetchGetDocketDetails['Paybyname'];
			$idid = $fetchGetDocketDetails['docId'];
		}
		
		$sqlGetPartiDetails = "select amt from particular where live=1 and deleted=1 and did=$did ";
		$queryGetPartiDetails = mysql_query($sqlGetPartiDetails)  or die(mysql_error());
		$amount = 0;
		while ( $fetchGetPartiDetails = mysql_fetch_assoc($queryGetPartiDetails) ) {
				$amt = $fetchGetPartiDetails['amt'];
				$amount = $amount + $amt;
		}
		
		$all_data[] = array("did" => $did, "idid" => $idid, "manualdocketnum" => $manualdocketnum, "date" => $date, "Paybyname" => $Paybyname, "tot" => $amount);
		
	}
	
	echo json_encode($all_data);
		
	mysql_close($connection);

?>
