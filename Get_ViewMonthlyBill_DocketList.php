<?php
	
	include("config.inc");
	session_start();
	
	$bid = $_REQUEST['bid'];
	$clientname = $_REQUEST['clientname'];
	
	//if ($bid == 0 or $bid == '') {
	//exit;
	//}
	
	$sqlGetDocketDid = "select did, date from docket where live=1 and deleted=1 and billed=1 and trantype=2 and ( bid=0 OR bid='$bid' )  and  pid='{$_SESSION['cid']}' and Paybyname='$clientname' ORDER BY did ASC, date DESC";

	$queryGetDocketDid = mysql_query($sqlGetDocketDid)  or die(mysql_error());
	
	while ( $fetchGetDocketDid = mysql_fetch_assoc($queryGetDocketDid) ) {
		
		$did = $fetchGetDocketDid['did'];
		
		$sqlGetDocketDidDetails = "select manualdocketnum, docId, DATE_FORMAT(date,'%d-%m-%Y') as idate, Fromsname, tosname from docket where live=1 and deleted=1 and trantype=2 and did='$did' " ;
		$queryGetDocketDidDetails = mysql_query($sqlGetDocketDidDetails)  or die(mysql_error());
		
		while ( $fetchGetDocketDetails = mysql_fetch_assoc($queryGetDocketDidDetails) ) {
			$manualdocketnum = $fetchGetDocketDetails['manualdocketnum'];
			$docId = $fetchGetDocketDetails['docId'];
			$date = $fetchGetDocketDetails['idate'];
			$FromSname = $fetchGetDocketDetails['Fromsname'];
			$ToSname = $fetchGetDocketDetails['tosname'];
		}
		$sqlGetPartiDetails = "select parti, qty, kg, rate, amt from particular where live=1 and deleted=1 and did=$did ";
		$queryGetPartiDetails = mysql_query($sqlGetPartiDetails)  or die(mysql_error());
		
		$amount = 0;
		$qty = 0;
		$weight = 0;
		$rate = 0;
		$particular = "";
		
		while ( $fetchGetPartiDetails = mysql_fetch_assoc($queryGetPartiDetails) ) {
				$amt = $fetchGetPartiDetails['amt'];
				$amount = $amount + $amt;
				
				$Quantity = $fetchGetPartiDetails['qty'];
				$qty = $qty + $Quantity;
				
				$kg = $fetchGetPartiDetails['kg'];
				$weight = $weight + $kg;
				
				$rate = $fetchGetPartiDetails['rate'];
				
				$partiii = $fetchGetPartiDetails['parti'];
				$particular = $particular ."-". $partiii ;
		}
		
		$all_data[] = array(  "date" => $date, "did" => $did, "docId" => $docId, "manualdocketnum" => $manualdocketnum, "from" => $FromSname, "to" => $ToSname, "particular" => $particular, "quantity" => $qty, "kg" => $weight, "rate" => $rate, "tot" => $amount );
		
	}
	
	echo json_encode($all_data);

	mysql_close($connection);

?>
