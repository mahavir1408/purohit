<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];
	$finyeardt=$_REQUEST['idTxDocDt'];
	$validateError= "This username is already taken";
	$validateSuccess= "This username is available";
	
	$docketDate=$_REQUEST['idTxDocDt'];
	//$billDate = "01-04-2013";
	$split_DocDt = explode("-", $docketDate);
	$currentDocketyear = $split_DocDt[2];
	$nextDocketyear = $currentDocketyear + 1;
	$lastDocketyear = $currentDocketyear - 1;
	
	$dateDocket = DateTime::createFromFormat('d-m-Y', $docketDate);  // user date from form
	$date1Docket = '01-04-'.$currentDocketyear;   // extracted from user date
	$date2Docket = '31-03-'.$nextDocketyear;
	
	$fyDtDocketApr = DateTime::createFromFormat('d-m-Y', $date1Docket);
	$fyDtDocketMar = DateTime::createFromFormat('d-m-Y', $date2Docket);
	
	if ( $dateDocket >= $fyDtDocketApr and $date <= $fyDtDocketMar ) {
	//echo "Fin Year current year";
	$finYearDocket = $currentDocketyear;
	}
	
	else {
	//echo "Fin Year Last Year";
	
	$finYearDocket = $lastDocketyear;
	}
		
	
	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	//SELECT EXTRACT(YEAR FROM (STR_TO_DATE(user, '%d-%m-%Y'))) from users1 where uid=30;
	
	$sql = "SELECT manualdocketnum FROM docket WHERE finyear= '$finYearDocket' and manualdocketnum='$validateValue' and pid='{$_SESSION['cid']}' " ;
	
	$result = mysql_query($sql)  or die(mysql_error());
	$count = mysql_num_rows($result);
	
	if($count == 0){		// validate??
		$arrayToJs[1] = true;			// RETURN TRUE
		echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
	}else{
		for($x=0;$x<1000000;$x++){
			if($x == 990000){
				$arrayToJs[1] = false;
				echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
			}
		}
		
	}

?>