<?php
	
	include("config.inc");
	session_start();
	
	$bid = $_REQUEST['bid'];
		
	$sqlGetDidParti ="SELECT distinct Fromname, toname FROM docket where bid='$bid' and live=1 and deleted=1 and trantype=2 and pid='{$_SESSION['cid']}'";
	$queryGetDidParti = mysql_query($sqlGetDidParti)  or die(mysql_error());
		
	$all_data = array();
	$from = "";
	$to = "";
	
	while($row = mysql_fetch_assoc($queryGetDidParti))
	{
		//$all_data[] = $row;
		$from = $row['Fromname'];
		$to = $row['toname'];
		$all_data[] = array(  "from_name" => $from,  "to_name" => $to );
		
		$sqlGetDocketDid = "select did, date from docket where live=1 and deleted=1 and billed=1 and trantype=2 and ( bid=0 OR bid='$bid' )  and  pid='{$_SESSION['cid']}' and Fromname='$from' and toname='$to' ORDER BY date, did ASC ";

	$queryGetDocketDid = mysql_query($sqlGetDocketDid)  or die(mysql_error());
	
	while ( $fetchGetDocketDid = mysql_fetch_assoc($queryGetDocketDid) ) {
		
		$did = $fetchGetDocketDid['did'];
		
		$sqlGetDocketDidDetails = "select manualdocketnum, docId, DATE_FORMAT(date,'%d-%m-%Y') as idate from docket where live=1 and deleted=1 and trantype=2 and did='$did' ORDER BY date ASC " ;
		$queryGetDocketDidDetails = mysql_query($sqlGetDocketDidDetails)  or die(mysql_error());
		
		while ( $fetchGetDocketDetails = mysql_fetch_assoc($queryGetDocketDidDetails) ) {
			$manualdocketnum = $fetchGetDocketDetails['manualdocketnum'];
			$docId = $fetchGetDocketDetails['docId'];
			$date = $fetchGetDocketDetails['idate'];
			//$counter = $counter + 1;
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
		
		$all_data[] = array(  "date" => $date,  "did" => $did, "docId" => $docId, "manualdocketnum" => $manualdocketnum, "particular" => $particular, "quantity" => $qty, "kg" => $weight, "rate" => $rate, "tot" => $amount );
		
	}
		
		
	}
	
	
	
	echo json_encode($all_data);
		
	mysql_close($connection);
	

?>
