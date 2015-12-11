<?php
	session_start();
	include("config.inc");
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
	
	$bid = $_REQUEST['bid'];
	
	$sqlReadBill = "Select paybyname, sname, country, state, city, pin, al1, al2, contact, emailid, finyear, manualbillnum, DATE_FORMAT(date, '%d-%m-%Y') as dt,subtot, setax, educhess, higheduchess, laborcharges, waitingcharges, othercharges, gt from bill where bid='$bid' and live=1 and deleted=1 and trantype=1";
	
	$resultReadBill = mysql_query($sqlReadBill)  or die(mysql_error());
	
	$resultRow = mysql_fetch_array($resultReadBill);
	
	
	$sqlParentDetails= "Select name, state, city, pin, contact, emailid, al1, al2 from company where name='{$_SESSION['companyname']}'";
	
	$resultParentDetails = mysql_query($sqlParentDetails)  or die(mysql_error());
	
	$resultParentDetails = mysql_fetch_array($resultParentDetails);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link  rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" language="javascript" src="js/purl.js"></script>
 <script type="text/javascript">
    	function PrintTbl(TblDiv) {
			//var qs = $.url();
    		var printContents = document.getElementById(TblDiv).innerHTML;
    		var originalContents = document.body.innerHTML;
    		document.body.innerHTML = printContents;
			document.body.style.backgroundColor="#FFFFFF"; 
    		window.print();
    		document.body.innerHTML = originalContents;
    		location = location;
    		}
       </script>
       

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
                            <li><a href="Report_ServiceTax.php">Servcie Tax Report</a></li>
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
		                
                 <br />
                 <div class="pagehead">
                 <a href="#">View Bill</a>
                 <a href="#" onclick="PrintTbl('printDiv')" style="float:right; color:#0000FF; margin-right:10px; text-decoration:underline;">Print</a>
                 </div>
                 <br />
                 
                 <div id="printDiv">
                 
                 <table id="idTblBillFormat">
                 
                 <tr><td id="idTdParetName" colspan="11"> 
                 <div style="line-height: 45px; font-size: 30px; font-weight: bold; color: rgb(255, 69, 0);"> 
				 <?php echo($resultParentDetails['name']); echo("<br/>"); ?> </div>
				 
<span style="font-weight:bold;">PUNE TO MUMBAI TO PUNE & GUJARAT DAILY CARGO & PARCEL SERVICES</span> <br />
                 <?php echo($resultParentDetails['al1']); echo("<br/>"); ?>
                 <?php echo($resultParentDetails['al2']); echo("<br/>");  ?>
                 <?php echo($resultParentDetails['state']); echo("&nbsp;");  echo($resultParentDetails['city']); echo("&nbsp;");  echo($resultParentDetails['pin']); echo("<br/>"); ?>
                 <?php echo( "Phone - " . $resultParentDetails['contact'] . "&nbsp;&nbsp;&nbsp;Email - " . $resultParentDetails['emailid']); echo("<br/>");  ?>
                 
                 </td></tr>
                 
                 <tr>
                 <td colspan="7" style="border-right:none;">
                 <div class="clDivPayby">                       
                 <span style="font-weight:bold;">TO,<br /><?php  echo($resultRow['paybyname'])  ?></span><br />
                 <?php  echo($resultRow['al1'])  ?>,<br />
                 <?php  echo($resultRow['al2'])  ?>,<br />
                 <?php  echo($resultRow['state'])  ?>&nbsp;
                 <?php  echo($resultRow['city'])  ?>&nbsp;-&nbsp;
                 <?php  echo($resultRow['pin'])  ?>,<br />
                 Mobile : <?php  echo($resultRow['contact'])  ?><br />
                 Email : <?php  echo($resultRow['emailid'])  ?>
                 </div>
                 </td>
                 <td colspan="4" valign="top" style="text-align:left; padding-left:5px; border-left:none;">
                 Bill Num - <?php  echo($resultRow['manualbillnum'].' / '. $resultRow['finyear'].' - '. ($resultRow['finyear']+1) )  ?> <br />
                 Bill Date - <?php  echo($resultRow['dt'])  ?>
              
                 </td>
                 </tr>

                 <tr id="idtdPartiRow">
                 <td class="cltdPartiHead">Date</td>
                 <td class="cltdPartiHead">Id</td>
                 <td class="cltdPartiHead">D No.</td>
                 <td class="cltdPartiHead">Octri No.</td>
                 <td class="cltdPartiHead">From</td>
                 <td class="cltdPartiHead">To</td>
                 <td class="cltdPartiHead">Particular</td>
                 <td class="cltdPartiHead">Qty</td>
                 <td class="cltdPartiHead">Weight</td>
                 <td class="cltdPartiHead">Rate</td>
                 <td class="cltdPartiHead">Amount</td>
                 </tr>
                 <?php  
				 $sqlGetDidForParti ="select did, docId, manualdocketnum, octrinum, DATE_FORMAT(date, '%d-%m-%Y') as dt, Fromsname, tosname from docket where bid='$bid'";
				 $queryGetDidForParti = mysql_query($sqlGetDidForParti)  or die(mysql_error());
				 $fetchArrarGetDidForParti = mysql_fetch_array($queryGetDidForParti);

				 $did = $fetchArrarGetDidForParti['did'];
				 $docId = $fetchArrarGetDidForParti['docId'];
				 $docDt = $fetchArrarGetDidForParti['dt'];
				 $fromName = $fetchArrarGetDidForParti['Fromsname'];
				 $toName = $fetchArrarGetDidForParti['tosname'];
				 $manualdocketnum = $fetchArrarGetDidForParti['manualdocketnum'];
				 $octrinum = $fetchArrarGetDidForParti['octrinum'];
				 //echo $did;
				 
				 $sqlGetParti ="select parti, qty, kg, rate, amt from particular where did='$did' ";
				 
				 //and live=1 and deleted=1 and pid='{$_SESSION['cid']}'
				 
				 $queryGetPartii = mysql_query($sqlGetParti)  or die(mysql_error());
				 
				while($fetchAssocParti = mysql_fetch_assoc($queryGetPartii))
				{
				?>
                
				<tr>
                <td> <?php echo($docDt) ?> </td>
                <td> <?php echo($docId) ?> </td>
                <td> <?php echo($manualdocketnum) ?> </td>
                <td> <?php echo($octrinum) ?> </td>
                <td> <?php echo($fromName) ?> </td>
                <td> <?php echo($toName) ?> </td>
				<td> <?php echo($fetchAssocParti['parti']) ?> </td>
				<td> <?php echo($fetchAssocParti['qty']) ?> </td>
				<td> <?php echo($fetchAssocParti['kg']) ?> </td>
				<td> <?php echo($fetchAssocParti['rate']) ?> </td>
				<td> <?php echo($fetchAssocParti['amt']) ?> </td>
				</tr>
				<?php
				}   
				
				?>
                
                <?php
				
				$num_rows = mysql_num_rows($queryGetPartii);
				$leftRows = 36 - $num_rows;
				
				//echo $leftRows;
				
				for ( $z=0; $z<$leftRows; $z++ ) {
					echo "<tr><td colspan=" . "11" . " style=" . "border:none;" . ">&nbsp;</td></tr>" ;
				}
				
				?>
              
                 <tr>
                 <td id="" colspan="7" rowspan="9" style="text-align:left; vertical-align:top; padding-top:5px; padding-left:5px;">
                 <?php 
					if ($_SESSION['cid'] == 2) {
					echo "Service Tax No. - AGQPR7717PSD001"; 
					}
				 ?>
                 <br/> <br/> Notice :- <br/> All Legal will be subject to Pune Jurisdiction. <br/>  Interest will be recovered @ 24% p. a. on overdue of unpaid bills.</td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Sub Total </td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['subtot'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Service Tax </td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['setax'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Edu Chess </td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['educhess'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">High Edu Chess </td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['higheduchess'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Labour Charges  </td>
                  <td id=""  style="text-align:left;"><?php echo($resultRow['laborcharges'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Waiting Charges </td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['waitingcharges'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Other Charges </td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['othercharges'])  ?> </td>
                 </tr>
                 
                 <tr>
                 <td id="" colspan="3" style="text-align:left;">Grand Total</td>
                 <td id=""  style="text-align:left;"><?php echo($resultRow['gt'])  ?> </td>
				 </tr>
    			
                 <tr>
                 <td id="" colspan="7">Terms and Condition</td>
                 <td id="" colspan="4">
                 For &nbsp; <?php  echo $_SESSION['companyname'];  ?> <br /> <br /> <br />
                 
                 Authorised Signatory
                 </td>
                 </tr>
                 
                 </table>
                 
                 </div>
                 
                 
                 <br />
                 

	</div>    <!--END MID-->
</div>		 <!--END MID WRAPPER-->



	

		
<div id="footer">
	<p>Powered by iSAM IT</p>
</div>


</body>
</html>