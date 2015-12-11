<?php
	include("config.inc");
	session_start();
	
	$fromDt = $_REQUEST['from'];
	$toDt = $_REQUEST['to'];
	$payBy = $_REQUEST['payby'];
	// calc docket amt of all the dockets 
	
			$sqlGetDidForParti = "select did from docket where live=1 and deleted=1 and billed=2 and bid=0 and paybyid='$payBy' and trantype=2 and date BETWEEN STR_TO_DATE('$fromDt', '%d-%m-%Y') AND STR_TO_DATE('$toDt', '%d-%m-%Y') ";
			$amt = 0;
			$queryGetDidForParti = mysql_query($sqlGetDidForParti)  or die(mysql_error());
			
			while ( $fetchGetDidForParti = mysql_fetch_assoc($queryGetDidForParti) ) {
				
				$did = $fetchGetDidForParti['did'];
				//echo $did;
				//echo "<br/>";
				$sqlGetParti = "select amt from particular where did='$did'";
				$queryGetParti = mysql_query($sqlGetParti)  or die(mysql_error());
				
				while ( $fetchGetParti= mysql_fetch_assoc($queryGetParti) ) {
						$amt += $fetchGetParti['amt'];    // total at for all the particulars
						
				}
			}
			
			$all_data[] = array("amount" => $amt);
			echo json_encode($all_data);
		
			mysql_close($connection);

?>
