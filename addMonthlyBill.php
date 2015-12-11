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
	
			
	
		
	$billDate=$_POST['txBillDt'];
	echo $billDate;
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
	
	if ( $date >= $fyDtApr and $date <= $fyDtMar ) {
	//echo "Fin Year current year";
	
		$billnum = $validateValue . ' / ' . $currentyear . ' - ' . $nextyear;
		$finYear = $currentyear;
	}
	
	else {
	//echo "Fin Year Last Year";
	
		$billnum = $validateValue . ' / ' . $lastyear . ' - ' . $currentyear;
		$finYear = $lastyear;
	}
	
	$sqlChkMaxBillNum = "select MAX(manualbillnum) AS maxbiinumb from bill where finyear='$finYear'  and pid='{$_SESSION['cid']}'";
	$queryChkMaxBillNum = mysql_query($sqlChkMaxBillNum)  or die(mysql_error());
	
	$countRow = mysql_num_rows($queryChkMaxBillNum);
	//echo $countRow;
	
	if( $countRow = 1 ) {
		
		$getMaxBillNum = mysql_fetch_array($queryChkMaxBillNum);	
		$maxBillNum = $getMaxBillNum['maxbiinumb'] + 1; 
		
	}
	else {
		$maxBillNum = 1;
	}
	
		
	
	
	// EXTRACT(YEAR FROM (STR_TO_DATE('{$_POST['txBilldt']}','%d-%m-%Y')))  extract year
	
	$insertBill = "INSERT INTO bill VALUES ( '', 1, 1, '{$_SESSION['cid']}', '{$_SESSION['uid']}', '$finYear' , '$maxBillNum', 2, '$paybycid', '{$_POST['txTot']}', '{$_POST['txServcieTax']}', '{$_POST['txEduChess']}',  '{$_POST['txHighEduChess']}',  '{$_POST['txLaboutCharges']}', '{$_POST['txWaitingCharges']}',  '{$_POST['txOtherCharges']}', '{$_POST['txGT']}', '{$_POST['sePayment']}', '{$_POST['txBankName']}', '{$_POST['txChequeNum']}', '{$_POST['txServcieTaxRate']}', '{$_POST['txEduChessRate']}', '{$_POST['txHighEduChessRate']}', STR_TO_DATE('{$_POST['txBillDt']}', '%d-%m-%Y') ,  '{$_POST['txPayBy']}', '$payBySnameConcat', '{$_POST['sePaybyCountry']}',  '{$_POST['txState']}', '{$_POST['txCity']}', '{$_POST['txPaybyPin']}', '{$_POST['txPaybyAl1']}', '{$_POST['txPaybyAl2']}', '{$_POST['txPaybyCell']}', '{$_POST['txPaybyEmail']}', STR_TO_DATE('{$_POST['txFromDt']}', '%d-%m-%Y'), STR_TO_DATE('{$_POST['txToDt']}', '%d-%m-%Y'), STR_TO_DATE('{$_POST['txPayDate']}', '%d-%m-%Y')  ) " ;
	
	$insertBillQuery = mysql_query($insertBill)  or die(mysql_error());
	
	$billId = mysql_insert_id();
	
	$_SESSION['Bnum'] = $maxBillNum;
	
	//$sqlGetDidForUpdate = "select did from docket where live=1 and deleted=1 and billed=2 and bid=0 and paybyid='$paybycid' and trantype=2 and date BETWEEN STR_TO_DATE('{$_POST['txFromDt']}', '%d-%m-%Y') AND STR_TO_DATE('{$_POST['txToDt']}', '%d-%m-%Y')" ;
//	
//	$queryGetDidForUpdate = mysql_query($sqlGetDidForUpdate)  or die(mysql_error());
//	
//	while ( $fetchGetDidForUpdate = mysql_fetch_assoc($queryGetDidForUpdate) ) {
//		
//		$did = $fetchGetDidForUpdate['did'];
//		$updateDocketStatus = "UPDATE Docket SET billed=1, bid='$billId' WHERE did='$did' " ;
//		$updateDocketStatusquery = mysql_query($updateDocketStatus)  or die(mysql_error());
//		
//	}
	
	$docketListCount = $_POST['hfDocketCount'];
	
	echo $docketListCount;
	echo "<br/>";
	
	for ($i = 1; $i <= $docketListCount; $i++) {
		
		if ( isset($_POST['ckSelect'.$i]) ) {
		 	$sqlUpdateBilledStatus = "UPDATE Docket SET billed=1, bid='$billId' WHERE did='{$_POST['ckSelect'.$i]}'";
			$queryUpdateBilledStatus = mysql_query($sqlUpdateBilledStatus)  or die(mysql_error());
			echo "chk<br/>";
		}
		else {
			$sqlUpdateBilledStatus = "UPDATE Docket SET billed=2, bid=0 WHERE did='{$_POST['hfSelect'.$i]}'";
			$queryUpdateBilledStatus = mysql_query($sqlUpdateBilledStatus)  or die(mysql_error());
			echo "notchk<br/>";
		}
	
	}

	
	if ( $insertBillQuery and $queryUpdateBilledStatus ) {
	
		mysql_query("COMMIT");
		header('Location: MonthlyBillSuccess.php');
		exit;

		
	} else {
	
	  	mysql_close($connection);
		mysql_query("ROLLBACK");
		$_SESSION['TranError'] = mysql_error();
		header('Location: Error.php');
		exit;
		
	}
	

	


	
	
	
?>
