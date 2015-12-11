<?php
	include("config.inc");
	session_start();
	
	$bid = $_REQUEST['bid'];
	$fromDt = $_REQUEST['from'];
	$toDt = $_REQUEST['to'];
	$payBy = $_REQUEST['pay'];
	//$did = "";
	
	$sqlGetDocketDid = "select did, date from docket where live=1 and deleted=1 and paybyid='$payBy' and trantype=2 and date BETWEEN STR_TO_DATE('$fromDt', '%d-%m-%Y') AND STR_TO_DATE('$toDt', '%d-%m-%Y') and ( bid=0 OR bid='$bid' ) and  pid='{$_SESSION['cid']}' ORDER BY date ASC";

	$queryGetDocketDid = mysql_query($sqlGetDocketDid)  or die(mysql_error());

	while ( $fetchGetDocketDid = mysql_fetch_assoc($queryGetDocketDid) ) {
		
		$did = $fetchGetDocketDid['did'];
		
		$sqlGetDocketDidDetails = "select  billed, docId, manualdocketnum, date, Paybyname from docket where live=1 and deleted=1 and paybyid='$payBy' and trantype=2 and did=$did ";
		$queryGetDocketDidDetails = mysql_query($sqlGetDocketDidDetails)  or die(mysql_error());
		$manualdocketnum =0;
		
		while ( $fetchGetDocketDetails = mysql_fetch_assoc($queryGetDocketDidDetails) ) {
			$manualdocketnum = $fetchGetDocketDetails['manualdocketnum'];
			$date = $fetchGetDocketDetails['date'];
			$Paybyname = $fetchGetDocketDetails['Paybyname'];
			$billed = $fetchGetDocketDetails['billed'];
			$idid = $fetchGetDocketDetails['docId'];
		}
		
		$sqlGetPartiDetails = "select amt from particular where live=1 and deleted=1 and did=$did ";
		$queryGetPartiDetails = mysql_query($sqlGetPartiDetails)  or die(mysql_error());
		$amount = 0;
		while ( $fetchGetPartiDetails = mysql_fetch_assoc($queryGetPartiDetails) ) {
				$amt = $fetchGetPartiDetails['amt'];
				$amount = $amount + $amt;
		}
		
		$all_data[] = array("did" => $did, "idid" => $idid, "billed" => $billed, "manualdocketnum" => $manualdocketnum, "date" => $date, "Paybyname" => $Paybyname, "tot" => $amount);
		
	}
	
	echo json_encode($all_data);
		
	mysql_close($connection);

?>
