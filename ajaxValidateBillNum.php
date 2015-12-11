<?php


	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];
	
	$validateError= "This username is already taken";
	$validateSuccess= "This username is available";

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	
	$billDate=$_REQUEST['idTxBilldt'];
	//$billDate = "01-04-2013";
	$split_date = explode("-", $billDate);
	$currentyear = $split_date[2];
	$nextyear = $currentyear + 1;
	$lastyear = $currentyear - 1;
	
	$date = DateTime::createFromFormat('d-m-Y', $billDate);  // user date from form
	$date1 = '01-04-'.$currentyear;   // extracted from user date
	$date2 = '31-03-'.$nextyear;
	
	$fyDtApr = DateTime::createFromFormat('d-m-Y', $date1);
	$fyDtMar = DateTime::createFromFormat('d-m-Y', $date2);
	
	//echo $fyDtMar->format('d-m-Y'); ;
	
	
	
	if ( $date >= $fyDtApr and $date <= $fyDtMar ) {
	//echo "Fin Year current year";
	
	$billnum = $validateValue . ' / ' . $currentyear . ' - ' . $nextyear;
	$finYear = $currentyear;
	
	$sql = "SELECT manualbillnum FROM bill WHERE finyear='$finYear' and manualbillnum='$validateValue' and pid='{$_SESSION['cid']}' " ;
	
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

	
	
	}
	else {
	//echo "Fin Year Last Year";
	
	$billnum = $validateValue . ' / ' . $lastyear . ' - ' . $currentyear;
	$finYear = $lastyear;
	
	$sql = "SELECT manualbillnum FROM bill WHERE finyear='$finYear' and manualbillnum='$validateValue' and pid='{$_SESSION['cid']}' " ;
	
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
	
	
	
} // end else
	
	
	//SELECT EXTRACT(YEAR FROM (STR_TO_DATE(user, '%d-%m-%Y'))) from users1 where uid=30;
	
	
?>