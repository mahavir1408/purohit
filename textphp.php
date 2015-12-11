<?php
	
include("config.inc");

$bid = 40;

$sqlGetDidParti ="SELECT distinct Fromname, toname FROM docket where bid='$bid'";
$queryGetDidParti = mysql_query($sqlGetDidParti)  or die(mysql_error());

while ( $fetchGetDidParti = mysql_fetch_array($queryGetDidParti) ) {

	echo $fetchGetDidParti['Fromname'];
	$from = $fetchGetDidParti['Fromname'];
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo $fetchGetDidParti['toname'];
	$to = $fetchGetDidParti['toname'];
	echo "<br/>";
	echo "<br/>";
	
	$sql1 = "SELECT did, docId, manualdocketnum, DATE_FORMAT(date, '%d-%m-%Y') as dt FROM `docket` where bid='$bid' and Fromname='$from' and toname='$to' ";
	$query1 = mysql_query($sql1)  or die(mysql_error());
	
	while ( $fetch1 = mysql_fetch_array($query1) ) {
		
		$did = $fetch1['did'];
		$docid = $fetch1['docId'];
		$manual = $fetch1['manualdocketnum'];
		$dt = $fetch1['dt'];
		
		
		$sqlGetPartiDetails = "select parti, qty, kg, rate, amt from particular where live=1 and deleted=1 and did='$did'";
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
		
		echo $dt;
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $particular;
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $qty;
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $rate;
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $amount;
		echo "<br/>";

		
		
	}
	

}


mysql_close($connection);


?>