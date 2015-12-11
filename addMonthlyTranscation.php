<?php
	include("config.inc");
	session_start();
	
	if (!isset($_SESSION['login_id']))
	{
		// not logged in, move to login page
		header('Location: index.php');
		exit;
	}
	else if (isset($_SESSION['login_id'])) 
		{
		$login_id = $_SESSION['login_id'];
		}
		
	
	mysql_query("SET AUTOCOMMIT=0");
	mysql_query("START TRANSACTION");
	
	// add payby user
			
		$paybycid = $_POST['txPaybyCid'];
		$payBySnameConcat = $_POST['txShortName'].' - '.$_POST['txLocation']; 	//.'-'.'$_POST['txLocation']';
		
		if ( $paybycid == 0 ) {
	
		//$snameconcat = '{$_POST['txShortName']}'-'{$_POST['txLocation']}'
		
		 
	
			$sql = "INSERT INTO company VALUES ('',2,1,1,1,1,'{$_POST['txPayBy']}','$payBySnameConcat', '{$_POST['txState']}','{$_POST['txCity']}','{$_POST['txPaybyPin']}','{$_POST['txPaybyCell']}','{$_POST['txPaybyEmail']}','{$_POST['txPaybyAl1']}','{$_POST['txPaybyAl2']}','{$_SESSION['cid']}','{$_POST['txLocation']}', '{$_POST['sePaybyCountry']}' )";
			
			$PayByQuery = mysql_query($sql)  or die(mysql_error());
			
			$paybycid = mysql_insert_id();
			
			}
			else {
			// do someting
			}
		
	
	// Addd from user
	
	$fromcid = $_POST['txFromCid'];
	$fromSnameConcat = $_POST['txFromShortName'].' - '.$_POST['txFromLocation'];
	
	if ( $payBySnameConcat != $fromSnameConcat ) {
	
		if ( $fromcid == 0 ) {
			
			
			
			$fromSql = "INSERT INTO company VALUES ('',2,1,1,1,1,'{$_POST['txFrom']}','$fromSnameConcat','{$_POST['txFromState']}','{$_POST['txFromCity']}','{$_POST['txFromPin']}','{$_POST['txFromCell']}','{$_POST['txFromEmail']}','{$_POST['txFromAd1']}','{$_POST['txFromAd2']}','{$_SESSION['cid']}','{$_POST['txFromLocation']}', '{$_POST['seFromCountry']}' )";
			
			$FromQuery = mysql_query($fromSql)  or die(mysql_error());
			$fromcid = mysql_insert_id();
			
			}
			else {
			// do someting
			}
	
	}
	
	// Addd to user

	$tocid = $_POST['txToCid'];
	$toSnameConcat = $_POST['txToShortName'].' - '.$_POST['txToLocation'];
	
	if ( $payBySnameConcat != $toSnameConcat and $payBySnameConcat != $fromSnameConcat ) {
	
	if ( $tocid == 0 ) {
		
		$toSql = "INSERT INTO company VALUES ('',2,1,1,1,1,'{$_POST['txTo']}','$toSnameConcat','{$_POST['txTOState']}','{$_POST['txToCity']}','{$_POST['txToPin']}' , '{$_POST['txToCell']}','{$_POST['txToEmail']}','{$_POST['txToAd1']}' , '{$_POST['txToAd2']}','{$_SESSION['cid']}','{$_POST['txToLocation']}', '{$_POST['seToCountry']}' )";
		
		$ToQuery = mysql_query($toSql)  or die(mysql_error());
		$tocid = mysql_insert_id();
		
		}
			else {
			// do someting
			} 
	
	
	}
	// Insert Docket Details
	
	$docketDate=$_POST['txDocDt'];
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
		
	$sqlChkMaxDocNum = "select MAX(docId) AS docId from Docket where finyear='$finYearDocket'  and pid='{$_SESSION['cid']}'";
	$queryChkMaxDocNum = mysql_query($sqlChkMaxDocNum)  or die(mysql_error());
	
	$countDocRow = mysql_num_rows($queryChkMaxDocNum);
	
	$maxDocNum = 0;
	//echo $countRow;
	
	if( $countDocRow == 1 ) {
		
		$getMaxDocNum = mysql_fetch_array($queryChkMaxDocNum);	
		$maxDocNum = $getMaxDocNum['docId'] + 1; 
		
	}
	else {
		$maxDocNum = 1;
	}
	
	
	
	$SqlDocketInsert = "INSERT INTO docket VALUES('', 1, 1, 2, 0, '$paybycid', '{$_SESSION['uid']}', 2, '{$_POST['txDocNum']}',  STR_TO_DATE('{$_POST['txDocDt']}', '%d-%m-%Y'), '$fromcid', '{$_POST['txFromInvNum']}', '{$_POST['txFromInvAmt']}', '{$_POST['txFromGrnNum']}',
 '{$_POST['txFromOctriNum']}', '{$_POST['txFromOctriAmt']}', '$tocid', '{$_POST['seDelivery']}', STR_TO_DATE('{$_POST['txDeliveryDt']}','%d-%m-%Y'), '{$_POST['txRecieverName']}', '{$_POST['txRecieverDetail']}', '{$_POST['taNotice']}', '$finYearDocket', '{$_SESSION['cid']}', '{$_POST['txPayBy']}', '$payBySnameConcat', '{$_POST['sePaybyCountry']}', '{$_POST['txState']}', '{$_POST['txCity']}', '{$_POST['txPaybyPin']}', '{$_POST['txPaybyAl1']}', '{$_POST['txPaybyAl2']}', '{$_POST['txPaybyCell']}', '{$_POST['txPaybyEmail']}', 
'{$_POST['txFrom']}', '$fromSnameConcat', '{$_POST['seFromCountry']}', '{$_POST['txFromState']}','{$_POST['txFromCity']}',
'{$_POST['txFromPin']}', '{$_POST['txFromAd1']}', '{$_POST['txFromAd2']}', '{$_POST['txFromCell']}','{$_POST['txFromEmail']}', 
'{$_POST['txTo']}', '$toSnameConcat', '{$_POST['seToCountry']}', '{$_POST['txTOState']}', '{$_POST['txToCity']}', '{$_POST['txToPin']}', '{$_POST['txToAd1']}', '{$_POST['txToAd2']}', '{$_POST['txToCell']}', '{$_POST['txToEmail']}', '$maxDocNum' ) " ;
	
	
	
	$DocketQuery = mysql_query($SqlDocketInsert) or die (mysql_error());
	$docketid = mysql_insert_id();
	
	$_SESSION['Dnum'] = $maxDocNum;
	$_SESSION['Cnum'] = $_POST['txDocNum'];
	
	$count = $_POST['hiRowCount'];

	for ($i = 1; $i <= $count; $i++) {
		 if ( isset($_POST['txParti'.$i]) and isset($_POST['txQty'.$i]) and isset($_POST['txWeight'.$i]) and isset($_POST['txRate'.$i]) and isset($_POST['txAmount'.$i]) ) {
		 	
			$sqlInsertParti = "INSERT INTO PARTICULAR VALUES ('', '$docketid', 1, 1, '{$_SESSION['uid']}',  '{$_POST['txParti'.$i]}', '{$_POST['txQty'.$i]}', '{$_POST['txWeight'.$i]}', '{$_POST['txRate'.$i]}', '{$_POST['txAmount'.$i]}' ) " ;
			
			$insertPartiQuery = mysql_query($sqlInsertParti)  or die(mysql_error());
			
		 }
		 else {
		 // ok
		 }
	}	
	
	
	
	
	if ( $DocketQuery and $insertPartiQuery ) {
	
		mysql_query("COMMIT");
		$_SESSION['Derror'] = "Docket Successfully Added";
		header('Location: SearchDocket.php');
		exit;
		
	} else {      
	  
		mysql_query("ROLLBACK");
		$_SESSION['TranError'] = mysql_error();
		header('Location: Error.php');
		exit;

	}
	

	mysql_close($connection);


	
	
	
?>
