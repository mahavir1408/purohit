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
		
		$Billid = $_REQUEST['hfBillNum'];
		
		$paybycid = $_POST['txPaybyCid'];
		$payBySnameConcat = $_POST['txShortName'].' - '.$_POST['txLocation']; 	//.'-'.'$_POST['txLocation']';
		
		$fromcid = $_POST['txFromCid'];
		$fromSnameConcat = $_POST['txFromShortName'].' - '.$_POST['txFromLocation'];
		
		$tocid = $_POST['txToCid'];
		$toSnameConcat = $_POST['txToShortName'].' - '.$_POST['txToLocation'];
		
		
		//$docketDate=$_POST['txDocDt'];
//		//$billDate = "01-04-2013";
//		$split_DocDt = explode("-", $docketDate);
//		$currentDocketyear = $split_DocDt[2];
//		$nextDocketyear = $currentDocketyear + 1;
//		$lastDocketyear = $currentDocketyear - 1;
//		
//		$dateDocket = DateTime::createFromFormat('d-m-Y', $docketDate);  // user date from form
//		$date1Docket = '01-04-'.$currentDocketyear;   // extracted from user date
//		$date2Docket = '31-03-'.$nextDocketyear;
//		
//		$fyDtDocketApr = DateTime::createFromFormat('d-m-Y', $date1Docket);
//		$fyDtDocketMar = DateTime::createFromFormat('d-m-Y', $date2Docket);
//		
//		if ( $dateDocket >= $fyDtDocketApr and $date <= $fyDtDocketMar ) {
//		//echo "Fin Year current year";
//		$finYearDocket = $currentDocketyear;
//		}
//		
//		else {
//		//echo "Fin Year Last Year";
//		
//		$finYearDocket = $lastDocketyear;
//		}
//		
//	// Update Docket Details
//		
//	    $SqlUpdateDocket ="UPDATE docket SET 
//		paybyid = '$paybycid',
//		manualdocketnum = '{$_POST['txDocNum']}',
//		date = STR_TO_DATE('{$_POST['txDocDt']}', '%d-%m-%Y'),
//		frm = '$fromcid',
//		invnum = '{$_POST['txFromInvNum']}',
//		invamt = '{$_POST['txFromInvAmt']}',
//		grnnum = '{$_POST['txFromGrnNum']}',
//		octrinum = '{$_POST['txFromOctriNum']}',
//		octriamt = '{$_POST['txFromOctriAmt']}',
//		too = '$tocid',
//		delivered = '{$_POST['seDelivery']}',
//		delivereddt = STR_TO_DATE('{$_POST['txDeliveryDt']}','%d-%m-%Y'),
//		receivername = '{$_POST['txRecieverName']}',
//		receivercontactdetail = '{$_POST['txRecieverDetail']}',
//		notice = '{$_POST['taNotice']}',
//		finyear = '$finYearDocket',
//		
//		Paybyname = '{$_POST['txPayBy']}',
//		Paybysname = '$payBySnameConcat',
//		Paybycountry = '{$_POST['sePaybyCountry']}',
//		Paybystate = '{$_POST['txState']}',
//		Paybycity = '{$_POST['txCity']}',
//		Paybypin = '{$_POST['txPaybyPin']}',
//		Paybyal1 = '{$_POST['txPaybyAl1']}',
//		Paybyal2 = '{$_POST['txPaybyAl2']}',
//		Paybycontact = '{$_POST['txPaybyCell']}',
//		Paybyemailid = '{$_POST['txPaybyEmail']}',
//		
//		Fromname = '{$_POST['txFrom']}',
//		Fromsname = '$fromSnameConcat',
//		Fromcountry = '{$_POST['seFromCountry']}',
//		Fromstate = '{$_POST['txFromState']}',
//		Fromcity = '{$_POST['txFromCity']}',
//		Frompin = '{$_POST['txFromPin']}',
//		Fromal1 = '{$_POST['txFromAd1']}',
//		Fromal2 = '{$_POST['txFromAd2']}',
//		Fromcontact = '{$_POST['txFromCell']}',
//		Fromemailid = '{$_POST['txFromEmail']}',
//		
//		toname = '{$_POST['txTo']}',
//		tosname = '$toSnameConcat',
//		tocountry = '{$_POST['seToCountry']}',
//		tostate = '{$_POST['txTOState']}',
//		tocity = '{$_POST['txTOCity']}',
//		topin = '{$_POST['txToPin']}',
//		toal1 = '{$_POST['txToAd1']}',
//		toal2 = '{$_POST['txToAd2']}',
//		tocontact = '{$_POST['txToCell']}',
//		toemailid = '{$_POST['txToEmail']}' where did = '$docketid' ";
// 		
//		$queryDocketUpdate = mysql_query($SqlUpdateDocket) or die (mysql_error());
//		
//		$count = $_POST['hiRowCount'];
//
//		for ($i = 1; $i <= $count; $i++) {
//			 if ( isset($_POST['txParti'.$i]) and isset($_POST['txQty'.$i]) and isset($_POST['txWeight'.$i]) and isset($_POST['txRate'.$i]) and isset($_POST['txAmount'.$i]) ) {
//				
//				$sqlUpdateParti = " UPDATE PARTICULAR SET
//				parti = '{$_POST['txParti'.$i]}',
//				qty = '{$_POST['txQty'.$i]}',
//				kg = '{$_POST['txWeight'.$i]}',
//				rate = '{$_POST['txRate'.$i]}',
//				amt = '{$_POST['txAmount'.$i]}' where pid='{$_POST['hfPid'.$i]}' " ;
//				
//				$queryPartiUpdate = mysql_query($sqlUpdateParti)  or die(mysql_error());
//				
//			 }
//			 else {
//			
//			
//			 }
//		}	

	$docketListCount = $_POST['hfDocketCount'];
	
	//echo $docketListCount;
	
	for ($i = 1; $i <= $docketListCount; $i++) {
		//echo $_POST['ckSelect'.$i];
		
		if ( isset($_POST['ckSelect'.$i]) ) {
			
		 	$sqlUpdateBilledStatus = "UPDATE docket SET billed=1, bid='$Billid' WHERE did='{$_POST['ckSelect'.$i]}'";
			$queryUpdateBilledStatus = mysql_query($sqlUpdateBilledStatus)  or die(mysql_error());
		}
		else
		{

			$sqlUpdateBilledStatus = "UPDATE docket SET billed=2, bid=0 WHERE did='{$_POST['hfSelect'.$i]}'";
			$queryUpdateBilledStatus = mysql_query($sqlUpdateBilledStatus)  or die(mysql_error());
		}
	
	}
	
	
	
	
	
	$billDate=$_POST['txBillDt'];
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

	$sqlUpdateBill = "UPDATE BILL SET 
	finyear = '$finYear',
	payby = '$paybycid',
	subtot = '{$_POST['txTot']}',
	setax = '{$_POST['txServcieTax']}',
	educhess = '{$_POST['txEduChess']}',
	higheduchess = '{$_POST['txHighEduChess']}',
	laborcharges = '{$_POST['txLaboutCharges']}',
	waitingcharges = '{$_POST['txWaitingCharges']}',
	othercharges = '{$_POST['txOtherCharges']}',
	gt = '{$_POST['txGT']}',
	
	payment = '{$_POST['sePayment']}',
	bankname = '{$_POST['txBankName']}',
	chequenum = '{$_POST['txChequeNum']}',
	setaxrate = '{$_POST['txServcieTaxRate']}',
	educhessrate = '{$_POST['txEduChessRate']}',
	higheduchessrate = '{$_POST['txHighEduChessRate']}',
	date = STR_TO_DATE('{$_POST['txBillDt']}', '%d-%m-%Y'),
	paybyname = '{$_POST['txPayBy']}',
	sname = '$payBySnameConcat',
	country = '{$_POST['sePaybyCountry']}',
	state = '{$_POST['txState']}',
	city = '{$_POST['txCity']}',
	pin = '{$_POST['txPaybyPin']}',
	al1 = '{$_POST['txPaybyAl1']}',
	al2 = '{$_POST['txPaybyAl2']}',
	contact = '{$_POST['txPaybyCell']}',
	emailid = '{$_POST['txPaybyEmail']}',
	paydate = STR_TO_DATE('{$_POST['txPayDate']}', '%d-%m-%Y') ,
	fromdate = STR_TO_DATE('{$_POST['txFromDt']}', '%d-%m-%Y'),
	todate = STR_TO_DATE('{$_POST['txToDt']}', '%d-%m-%Y')
	Where bid = '$Billid ' ";
	
	$queryBillUpdate = mysql_query($sqlUpdateBill)  or die(mysql_error());
	
	

	if ( $queryBillUpdate and $queryUpdateBilledStatus ) {
	
		mysql_query("COMMIT");
		$_SESSION['Bnum'] = "Bill Updated Successfully.";
		header('Location: MonthlyBillSuccess.php');
		//echo "Database transaction was successful";

		
	} else {      
	  
		mysql_query("ROLLBACK");
		$_SESSION['TranError'] = mysql_error();
		header('Location: Error.php');

	}
	

	mysql_close($connection);


	
	
	
?>
