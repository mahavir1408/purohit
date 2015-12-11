<?php
	include("config.inc");
	session_start();
	
	$fromDt = $_REQUEST['from'];
	$toDt = $_REQUEST['to'];
	
	$sqlGetDocketDetails = "select did, docId, trantype, manualdocketnum, date_format(date ,'%d-%m-%Y') as  date, Paybyname, Fromname, toname, delivered, trantype from docket where live=1 and deleted=1 and date BETWEEN STR_TO_DATE('$fromDt', '%d-%m-%Y') AND STR_TO_DATE('$toDt', '%d-%m-%Y') and pid='{$_SESSION['cid']}' ORDER BY date DESC";
	
	$queryGetDocketDetails = mysql_query($sqlGetDocketDetails)  or die(mysql_error());

	while ( $fetchGetDocketDetails = mysql_fetch_assoc($queryGetDocketDetails) ) {
		
		$did = $fetchGetDocketDetails['did'];
		$docId = $fetchGetDocketDetails['docId'];
		$trantype = $fetchGetDocketDetails['trantype'];
		$manualdocketnum = $fetchGetDocketDetails['manualdocketnum'];
		$date = $fetchGetDocketDetails['date'];
		$Paybyname = $fetchGetDocketDetails['Paybyname'];
		$Fromname = $fetchGetDocketDetails['Fromname'];
		$toname = $fetchGetDocketDetails['toname'];
		$trantype = $fetchGetDocketDetails['trantype'];
				
		$sqlGetPartiDetails = "select amt from particular where live=1 and deleted=1 and did=$did ";
		$queryGetPartiDetails = mysql_query($sqlGetPartiDetails)  or die(mysql_error());
		$amount = 0;
		while ( $fetchGetPartiDetails = mysql_fetch_assoc($queryGetPartiDetails) ) {
				$amt = $fetchGetPartiDetails['amt'];
				$amount = $amount + $amt;
		}
		
		$all_data[] = array("did" => $did, "docId" => $docId, "tran" => $trantype, "manualdocketnum" => $manualdocketnum, "date" => $date, "Paybyname" => $Paybyname, "Fromname" => $Fromname, "toname" => $toname, "tot" => $amount);
		
	}
	
	echo json_encode($all_data);
		
	mysql_close($connection);

?>
