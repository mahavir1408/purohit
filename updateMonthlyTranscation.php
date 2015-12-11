<?php
	
	session_start();
	//echo $_SESSION['cid'];
	if (!isset($_SESSION['login_id']))
	{
		// not logged in, move to login page
		header('Location: index.php');
		exit;
	}
	else if (isset($_SESSION['login_id'])) 
	{
		$login_id = $_SESSION['login_id'];
		//echo "$login_id";	
	}
	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>

<div class="head1"> <span class="cname"> Purohit Transport Managment System </span> <a href="logout.php" class="logout" >Logout</a> </div>
<div class="header-wrapper">
	<div class="header">
		<h1> <?php  echo $_SESSION['companyname'];  ?></h1>
		<table class="menu">
		<tr>
        <td>
            <nav>
                <ul>
                	<li style=" width:50px;">&nbsp;</li>
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="#">Docket</a>
                        <ul>
                            <li><a href="MonthlyTranscation.php">Generate Docket</a></li>
                            <li><a href="SearchDocket.php">Search Docket</a></li>
                            <li><a href="UndeliveredDockets.php">Pending Delivery</a></li>
                            <li><a href="ListDockets.php">List Dockets</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Billing</a>
                        <ul>
                            <li><a href="SingleBill.php">Generate Single Bill</a></li>
                            <li><a href="MonthlyBill.php">Generate Monthly Bill</a></li>
                            <li><a href="SearchBill.php">Search Bill</a></li>
                            <li><a href="PendingPayments.php">Pending Payments</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Reports</a>
                        <ul>
                            <li><a href="#">Servcie Tax Report</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Accounts</a>
                    	<ul>
                            <li><a href="Accounts_NewTranscation.php">Add Transcation</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Master</a>
                    	<ul>
                            <li><a href="ClientMaster.php">Add Client Details</a></li>
                            <li><a href="ListClients.php">Edit Client Details</a></li>
                            <li><a href="List_Add_Rate.php">List/Add Rates</a></li>
                        </ul>
                    </li>
                    <li style=" width:50px;">&nbsp;</li>
                </ul>
            </nav>
        </td>
		</tr>
		</table>
	</div>
</div>


<div class="mid-wrapper">
	<div class="mid">
		
		    <div class="pagehead">
            <a href="#"></a>
            </div>
            <br />


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
	
		
		$docketid = $_POST['hfDocNum'];
		$BilledStatus = $_POST['hfBilledStatus'];
		//$Billid = $_POST['hfBillNum'];
		//if bil

		$paybycid = $_POST['txPaybyCid'];
		$payBySnameConcat = $_POST['txShortName'].' - '.$_POST['txLocation']; 	//.'-'.'$_POST['txLocation']';
	
		$fromcid = $_POST['txFromCid'];
		$fromSnameConcat = $_POST['txFromShortName'].' - '.$_POST['txFromLocation'];
		
		$tocid = $_POST['txToCid'];
		$toSnameConcat = $_POST['txToShortName'].' - '.$_POST['txToLocation'];
		
		
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
		
		if ( $dateDocket >= $fyDtDocketApr and $dateDocket <= $fyDtDocketMar ) {
		//echo "Fin Year current year";
		$finYearDocket = $currentDocketyear;
		}
		
		else {
		//echo "Fin Year Last Year";
		
		$finYearDocket = $lastDocketyear;
		}
		
		// Update Docket Details
		
	if ( $BilledStatus == 2 ) {
		
	    $SqlUpdateDocket ="UPDATE docket SET 
		paybyid = '$paybycid',
		manualdocketnum = '{$_POST['txDocNum']}',
		date = STR_TO_DATE('{$_POST['txDocDt']}', '%d-%m-%Y'),
		frm = '$fromcid',
		invnum = '{$_POST['txFromInvNum']}',
		invamt = '{$_POST['txFromInvAmt']}',
		grnnum = '{$_POST['txFromGrnNum']}',
		octrinum = '{$_POST['txFromOctriNum']}',
		octriamt = '{$_POST['txFromOctriAmt']}',
		too = '$tocid',
		delivered = '{$_POST['seDelivery']}',
		delivereddt = STR_TO_DATE('{$_POST['txDeliveryDt']}','%d-%m-%Y'),
		receivername = '{$_POST['txRecieverName']}',
		receivercontactdetail = '{$_POST['txRecieverDetail']}',
		notice = '{$_POST['taNotice']}',
		finyear = '$finYearDocket',
		
		Paybyname = '{$_POST['txPayBy']}',
		Paybysname = '$payBySnameConcat',
		Paybycountry = '{$_POST['sePaybyCountry']}',
		Paybystate = '{$_POST['txState']}',
		Paybycity = '{$_POST['txCity']}',
		Paybypin = '{$_POST['txPaybyPin']}',
		Paybyal1 = '{$_POST['txPaybyAl1']}',
		Paybyal2 = '{$_POST['txPaybyAl2']}',
		Paybycontact = '{$_POST['txPaybyCell']}',
		Paybyemailid = '{$_POST['txPaybyEmail']}',
		
		Fromname = '{$_POST['txFrom']}',
		Fromsname = '$fromSnameConcat',
		Fromcountry = '{$_POST['seFromCountry']}',
		Fromstate = '{$_POST['txFromState']}',
		Fromcity = '{$_POST['txFromCity']}',
		Frompin = '{$_POST['txFromPin']}',
		Fromal1 = '{$_POST['txFromAd1']}',
		Fromal2 = '{$_POST['txFromAd2']}',
		Fromcontact = '{$_POST['txFromCell']}',
		Fromemailid = '{$_POST['txFromEmail']}',
		
		toname = '{$_POST['txTo']}',
		tosname = '$toSnameConcat',
		tocountry = '{$_POST['seToCountry']}',
		tostate = '{$_POST['txTOState']}',
		tocity = '{$_POST['txTOCity']}',
		topin = '{$_POST['txToPin']}',
		toal1 = '{$_POST['txToAd1']}',
		toal2 = '{$_POST['txToAd2']}',
		tocontact = '{$_POST['txToCell']}',
		toemailid = '{$_POST['txToEmail']}' where did='$docketid' ";
 		
		$queryDocketUpdate = mysql_query($SqlUpdateDocket) or die (mysql_error());

		$count = $_POST['hiRowCount'];

		for ($i = 1; $i <= $count; $i++) {
			 if ( isset($_POST['txParti'.$i]) and isset($_POST['txQty'.$i]) and isset($_POST['txWeight'.$i]) and isset($_POST['txRate'.$i]) and isset($_POST['txAmount'.$i]) ) {
				
			$dynPid = $_POST['hfPid'.$i];
			
			if ( $dynPid == 0 ) {
				
				$sqlUpdateParti = "INSERT INTO PARTICULAR VALUES ('', '$docketid', 1, 1, '{$_SESSION['uid']}',  '{$_POST['txParti'.$i]}', '{$_POST['txQty'.$i]}', '{$_POST['txWeight'.$i]}', '{$_POST['txRate'.$i]}', '{$_POST['txAmount'.$i]}' ) ";
				
			}
			else {
				$sqlUpdateParti = " UPDATE PARTICULAR SET
				parti = '{$_POST['txParti'.$i]}',
				qty = '{$_POST['txQty'.$i]}',
				kg = '{$_POST['txWeight'.$i]}',
				rate = '{$_POST['txRate'.$i]}',
				amt = '{$_POST['txAmount'.$i]}' where pid='{$_POST['hfPid'.$i]}' " ;
			}
				
				$queryPartiUpdate = mysql_query($sqlUpdateParti)  or die(mysql_error());	
				
			 }
			 else {
			 // else nothing
			 }
		}	
		
		$_SESSION['Dnum'] = "ok";
		$_SESSION['Cnum'] = $_POST['txDocNum'];
	
		
		if ( $queryDocketUpdate and $queryPartiUpdate ) {
	
		mysql_query("COMMIT");
		//header('Location: DocketSuccess.php');
		$_SESSION['Derror'] = "Docket Successfully Updated";
		header('Location: SearchDocket.php');
		exit;

		
		} 
		else {      
		  
		mysql_query("ROLLBACK");
		$_SESSION['TranError'] = mysql_error();
		header('Location: Error.php');
		exit;
	
		}
		
		mysql_close($connection);
		
		
		
	
	} 
	else if ( $BilledStatus == 1 )  {
	
		$SqlUpdateDocket ="UPDATE docket SET 
		paybyid = '$paybycid',
		manualdocketnum = '{$_POST['txDocNum']}',
		date = STR_TO_DATE('{$_POST['txDocDt']}', '%d-%m-%Y'),
		frm = '$fromcid',
		invnum = '{$_POST['txFromInvNum']}',
		invamt = '{$_POST['txFromInvAmt']}',
		grnnum = '{$_POST['txFromGrnNum']}',
		octrinum = '{$_POST['txFromOctriNum']}',
		octriamt = '{$_POST['txFromOctriAmt']}',
		too = '$tocid',
		delivered = '{$_POST['seDelivery']}',
		delivereddt = STR_TO_DATE('{$_POST['txDeliveryDt']}','%d-%m-%Y'),
		receivername = '{$_POST['txRecieverName']}',
		receivercontactdetail = '{$_POST['txRecieverDetail']}',
		notice = '{$_POST['taNotice']}',
		finyear = '$finYearDocket',
		
		Paybyname = '{$_POST['txPayBy']}',
		Paybysname = '$payBySnameConcat',
		Paybycountry = '{$_POST['sePaybyCountry']}',
		Paybystate = '{$_POST['txState']}',
		Paybycity = '{$_POST['txCity']}',
		Paybypin = '{$_POST['txPaybyPin']}',
		Paybyal1 = '{$_POST['txPaybyAl1']}',
		Paybyal2 = '{$_POST['txPaybyAl2']}',
		Paybycontact = '{$_POST['txPaybyCell']}',
		Paybyemailid = '{$_POST['txPaybyEmail']}',
		
		Fromname = '{$_POST['txFrom']}',
		Fromsname = '$fromSnameConcat',
		Fromcountry = '{$_POST['seFromCountry']}',
		Fromstate = '{$_POST['txFromState']}',
		Fromcity = '{$_POST['txFromCity']}',
		Frompin = '{$_POST['txFromPin']}',
		Fromal1 = '{$_POST['txFromAd1']}',
		Fromal2 = '{$_POST['txFromAd2']}',
		Fromcontact = '{$_POST['txFromCell']}',
		Fromemailid = '{$_POST['txFromEmail']}',
		
		toname = '{$_POST['txTo']}',
		tosname = '$toSnameConcat',
		tocountry = '{$_POST['seToCountry']}',
		tostate = '{$_POST['txTOState']}',
		tocity = '{$_POST['txTOCity']}',
		topin = '{$_POST['txToPin']}',
		toal1 = '{$_POST['txToAd1']}',
		toal2 = '{$_POST['txToAd2']}',
		tocontact = '{$_POST['txToCell']}',
		toemailid = '{$_POST['txToEmail']}' where did = '$docketid' ";
 		
		$queryDocketUpdate = mysql_query($SqlUpdateDocket) or die (mysql_error());
		
		$sum = 0;    // sum of newly add particualr rate
		
		$count = $_POST['hiRowCount'];

		for ($i = 1; $i <= $count; $i++) {
			 if ( isset($_POST['txParti'.$i]) and isset($_POST['txQty'.$i]) and isset($_POST['txWeight'.$i]) and isset($_POST['txRate'.$i]) and isset($_POST['txAmount'.$i]) ) {
				
				//$sqlUpdateParti = " UPDATE PARTICULAR SET
//				parti = '{$_POST['txParti'.$i]}',
//				qty = '{$_POST['txQty'.$i]}',
//				kg = '{$_POST['txWeight'.$i]}',
//				rate = '{$_POST['txRate'.$i]}',
//				amt = '{$_POST['txAmount'.$i]}' where pid='{$_POST['hfPid'.$i]}' " ;

				$dynPid = $_POST['hfPid'.$i];
			
				if ( $dynPid == 0 ) {
						
						$sqlUpdateParti = "INSERT INTO PARTICULAR VALUES ('', '$docketid', 1, 1, '{$_SESSION['uid']}',  		'{$_POST['txParti'.$i]}', '{$_POST['txQty'.$i]}', '{$_POST['txWeight'.$i]}', '{$_POST['txRate'.$i]}', '{$_POST['txAmount'.$i]}' ) ";
						
						$sum = $sum + $_POST['txAmount'.$i];
						
				}
				else {
						$sqlUpdateParti = " UPDATE PARTICULAR SET
						parti = '{$_POST['txParti'.$i]}',
						qty = '{$_POST['txQty'.$i]}',
						kg = '{$_POST['txWeight'.$i]}',
						rate = '{$_POST['txRate'.$i]}',
						amt = '{$_POST['txAmount'.$i]}' where pid='{$_POST['hfPid'.$i]}' " ;
						
						$sum = $sum + $_POST['txAmount'.$i];
				}
				
				$queryPartiUpdate = mysql_query($sqlUpdateParti)  or die(mysql_error());
				
			 }
			 else {
			 // else
			 }
		}
		
		$bidnum = $_POST['hfBillId'];    //  Bill number
		
		//echo $sum;
		$oldsum = $_POST['hfDocketSum'];  // total sum of docket amount in database
		
		$sqlBillTot = "select subtot from bill where bid='$bidnum'"; 
		$queryBillTot = mysql_query($sqlBillTot)  or die(mysql_error());
		while($rowBillTot = mysql_fetch_assoc($queryBillTot))
		{
			$Dockettot = $rowBillTot['subtot'];  // subtotal of the bill
		}  
		
		$newDocketTot = 0;       // docket total to be updated
		
		if ( $oldsum > $sum ) {
			$diff = $oldsum - $sum;
			$newDocketTot = $Dockettot - $diff;
		}
		else if ( $oldsum < $sum ) {
			$diff = $sum - $oldsum;
			$newDocketTot = $Dockettot + $diff;
			//add difference
		}
		else if ( $oldsum == $sum ) {
		//add difference
		}
		
		$Labour = $_POST['hfLabout'];
		$Waiting = $_POST['hfWaiting'];
		$Other = $_POST['hfOther'];
		
		$sTaxRate = $_POST['hfServcieTaxRate'];
		$sEduRate = $_POST['hfEduChessRate'];
		$sHeduRate = $_POST['hfHighEduChessRate'];
		
		$sTax = $newDocketTot * $sTaxRate / 100;
		$sEdu = $sTax * $sEduRate / 100;
		$sHedu = $sTax * $sHeduRate / 100;
		
		$preGt = $newDocketTot + $sTax + $sEdu +$sHedu + $Labour + $Waiting + $Other;
		$Gt = round($preGt);
		
		
		$sqlUpdateBill = "UPDATE BILL SET 
		subtot = '$newDocketTot',
		setax = '$sTax',
		educhess = '$sEdu',
		higheduchess = '$sHedu',
		laborcharges = '$Labour',
		waitingcharges = '$Waiting',
		othercharges = '$Other',
		gt = '$Gt'
		Where bid ='$bidnum' ";
		
		$queryBillUpdate = mysql_query($sqlUpdateBill)  or die(mysql_error());
		
		$_SESSION['Dnum'] = "ok";
		$_SESSION['Cnum'] = $_POST['txDocNum'];
		
		if ( $queryDocketUpdate and $queryPartiUpdate and $queryBillUpdate ) {   //and $queryBillUpdate
	
		mysql_query("COMMIT");
		//header('Location: DocketSuccess.php');
		$_SESSION['Derror'] = "Docket Successfully Updated";
		header('Location: SearchDocket.php');
		exit;

		
		} 
		else {      
		  
		mysql_query("ROLLBACK");
		$_SESSION['TranError'] = mysql_error();
		header('Location: Error.php');
		exit;

	
		}
		
		mysql_close($connection);
		
	
	}
	else {
	
	}


	// and $queryBillUpdate
	
	
		


?>


	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>


</body>
</html>