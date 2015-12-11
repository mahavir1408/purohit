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
	
$sqlParentDetails= "Select name, state, city, pin, contact, emailid, al1, al2 from company where name='{$_SESSION['companyname']}'";
	
	$resultParentDetails = mysql_query($sqlParentDetails)  or die(mysql_error());
	
	$resultParentDetails = mysql_fetch_array($resultParentDetails);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />

<link  rel="stylesheet" type="text/css" href="css/default.css" />

<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="js/purl.js"></script>
<script type="text/javascript">
    //alert( $.url().param('id') );
</script>

<script type="text/javascript" language="javascript">

$(document).ready(function () {
	var qs = $.url().param('id');
	$.ajax({
		type:"POST",
		url: "AjaxGetDocketDetails.php?id="+qs,
		datatype: "json",
		data: "{}",
		async: false,
		contentType: "application/json; charset=utf-8",
		success: function(data,textStatus,xhr) {
		   data = JSON.parse(xhr.responseText);
		   var i = 0;
		   
		   // Invno InvAmt OctriNo
		   		   
		   
		   var invno = data[i].invnum;
		   var invamt = data[i].invamt;
		   var octrino = data[i].octrinum;
		   
		   if (invno == 0 || invno == "" ) {
		   var invno = "Invoice No. -";
		   }
		   else {
		   var invno = "Invoice No. -&nbsp;" + data[i].invnum;
		   }
		   
		   if (invamt == 0 || invamt == "" ) {
		   var invamt = "Invoice Amount -";
		   }
		   else {
		   var invamt = "Invoice Amount -&nbsp;" + data[i].invamt;
		   }
		   
		   if (octrino == 0 || octrino == "" ) {
		   var octrino = "Octri No. -";
		   }
		   else {
		   var octrino = "Octri No. -&nbsp;" + data[i].octrinum;
		   }
		   
		   // From Details
		   
		   var Fromname = data[i].Fromname;
		   var Fromal1 = data[i].Fromal1;
		   var Fromal2 = data[i].Fromal2;
		   var Frompin = data[i].Frompin;
		   var Fromcity = data[i].Fromcity;
		   var Fromstate = data[i].Fromstate;
		   var Fromcountry = data[i].Fromcountry;
		   var Fromcontact = data[i].Fromcontact;
		   var Fromemailid = data[i].Fromemailid;
		   
		   if (Fromal1 == 0 || Fromal1 == "" ) {
		   var Fromal1 = "";
		   }
		   
		   if (Fromal2 == 0 || Fromal2 == "" ) {
		   var Fromal2 = "";
		   }
		   
		   if (Frompin == 0 || Frompin == "" ) {
		   var Frompin = "";
		   }
		   
		   if (Fromcity == 0 || Fromcity == "" ) {
		   var Fromcity = "";
		   }
		   
		   if (Fromstate == 0 || Fromstate == "" ) {
		   var Fromstate = "";
		   }
		   
		   if (Fromcountry == 0 || Fromcountry == "" ) {
		   var Fromcountry = "";
		   }
		   
		   if (Fromcontact == 0 || Fromcontact == "" ) {
		   var Fromcontact = "";
		   }
		   
		   if (Fromemailid == 0 || Fromemailid == "" ) {
		   var Fromemailid = "";
		   }
		   
		   var toname = data[i].toname;
		   var toal1 = data[i].toal1;
		   var toal2 = data[i].toal2;
		   var topin = data[i].topin;
		   var tocity = data[i].tocity;
		   var tostate = data[i].tostate;
		   var tocountry = data[i].tocountry;
		   var tocontact = data[i].tocontact;
		   var toemailid = data[i].toemailid;
		   
		   if (toal1 == 0 || toal1 == "" ) {
		   var toal1 = "";
		   }
		   
		   if (toal2 == 0 || toal2 == "" ) {
		   var toal2 = "";
		   }
		   
		   if (topin == 0 || topin == "" ) {
		   var topin = "";
		   }
		   
		   if (tocity == 0 || tocity == "" ) {
		   var tocity = "";
		   }
		   
		   if (tostate == 0 || tostate == "" ) {
		   var tostate = "";
		   }
		   
		   if (tocountry == 0 || tocountry == "" ) {
		   var tocountry = "";
		   }
		   
		   if (tocontact == 0 || tocontact == "" ) {
		   var tocontact = "";
		   }
		   
		   if (toemailid == 0 || toemailid == "" ) {
		   var toemailid = "";
		   }
		   
		   
		   //alert(data[i].did);
		  $("#docnum").html("Id. - &nbsp;" + data[i].docId + "<br/> D No.. -&nbsp;" + data[i].manualdocketnum + "<br/> Docket Date -&nbsp;" + data[i].date );
		  
		  $("#invno").html(invno);
		  $("#invamt").html(invamt);
		  $("#octno").html(octrino);
		  
		  $("#from").html("From, <br/>" + Fromname + "<br/>" + Fromal1 + "<br/>" + Fromal2 + "<br/>" + Fromstate + "&nbsp;-&nbsp;" +  Fromcity + "&nbsp;,&nbsp;" + Frompin + "<br/>" + "Contact -&nbsp;" + Fromcontact + "<br/>" + "Email -&nbsp;" + Fromemailid );
		  
		  $("#to").html("To, <br/>" + toname + "<br/>" + toal1 + "<br/>" + toal2 + "<br/>" + tostate + "&nbsp;-&nbsp;" +  tocity + "&nbsp;,&nbsp;" + topin + "<br/>" + "Contact -&nbsp;" + tocontact + "<br/>" + "Email -&nbsp;" + toemailid );
		  
		  
		  $("#idDivParentDetails").html( data[i].Paybyname + "<br/>" + data[i].Paybyal1 + "<br/>" + data[i].Paybyal2 + "<br/>" +
		   data[i].Paybystate + "&nbsp;" + data[i].Paybycity + "&nbsp;" + data[i].Paybypin + "<br/>" +
		   'Mobile -&nbsp;'+ data[i].Paybycontact + "&nbsp;&nbsp;" + 'Email -&nbsp;'+ data[i].Paybyemailid );

		  
		  
		}
	});
});
</script>


<script type="text/javascript">

$(document).ready(function () {
	var qs = $.url().param('id');
	
	$.ajax({
		type:"POST",
		url: "AjaxGetDocketDetailsParti.php?id="+qs,
		datatype: "json",
		data: "{}",
		contentType: "application/json; charset=utf-8",
		success: function(data,textStatus,xhr) {
		   data = JSON.parse(xhr.responseText);
		        var tot = 0;
				for (var i = 0, len = data.length; i < len; i++) {
					      $('#partirow').after( '<tr>' +
						    '<td>'+data[i].parti+'</td>' +
						    '<td>'+data[i].qty+'</td>' +
							'<td>'+data[i].kg+'</td>' +
							'<td>'+data[i].rate+'</td>' +
							'<td>'+data[i].amt+'</td>' +
							'</tr>' );///end Row
							$('#from').removeAttr("rowspan");
							$("#from" ).attr("rowspan", 1 * i + 2);
							$('#to').removeAttr("rowspan");
							$("#to" ).attr("rowspan", 1 * i + 2);
							tot = ( 1 * tot ) + ( 1 * data[i].amt );
							$('#subtot').html(tot);
							$('#gt').html(tot);
				}
		   		
				
		}
	});
	
	
	
});

</script>



<style>
td { text-align:left; vertical-align:top; padding-left:5px; }
</style>

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
        <td style="text-align:center;">
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
                 <a href="#">View Docket</a>
                 <a href="#" onclick="PrintTbl('printDiv')" style="float:right; color:#0000FF; margin-right:10px; text-decoration:underline;">Print</a>
                 </div>
                 <br />
                 
            <div id="printDiv">
            <table style="margin:0 auto;" border="1" >
            <tr>
            <td colspan="8" style=" text-align:center;">
            	<div style="font-size: 20px;font-weight: bold;color: rgb(255, 69, 0); padding-top:10px; display:block;
"> <?php echo($resultParentDetails['name']); echo("<br/>"); ?> </div> 
					<div>Parcel and Cargo Services</div> 
                 <?php echo($resultParentDetails['al1']); echo("<br/>"); ?>
                 <?php echo($resultParentDetails['al2']); echo("<br/>");  ?>
                 <?php echo($resultParentDetails['state']); echo("&nbsp;");  echo($resultParentDetails['city']); echo("&nbsp;");  echo($resultParentDetails['pin']); echo("<br/>"); ?>
                 <?php echo( "Phone - " . $resultParentDetails['contact'] . "&nbsp;&nbsp;&nbsp;Email - " . $resultParentDetails['emailid']); echo("<br/>");  ?>
                

            </td>
            </tr>
            <tr>
            <td colspan="8" style="">
			<div style="width:515px; min-height:50px; float:left;" id="idDivParentDetails">&nbsp;</div>
            <div style="width:170px; float:left;" id="docnum"> Docket No. -&nbsp; <br /> Docket Date -&nbsp;</div>
            </td>
            </tr>
       
            <tr>
            <td style="width:150px;" id="invno"></td>
            <td colspan="5" id="invamt"></td>
            <td style="width:150px;" id="octno"></td>
            </tr>
            
            <tr id="partirow">
            <td id="from">From</td>
            <td style="width:70px; font-weight:bold;">Particular</td>
            <td style="width:70px; font-weight:bold;">Qty</td>
            <td style="width:70px; font-weight:bold;">Weight</td>
            <td style="width:70px; font-weight:bold;">Rate</td>
            <td style="width:70px; font-weight:bold;">Amount</td>
            <td id="to" ></td>
            </tr>
                       
            <tr>
            <td colspan="2" rowspan="6" style="font-size:10pt;">I the Consignor take all terms & conditions printed overleaf.<br />Subject to Pune Jurisdiction<br /> <?php 
			if ($_SESSION['cid'] == 2) {
			echo "Service Tax No. - AGQPR7717PSD001"; 
			}
			?> </td>
            </tr>
            
            <tr>
            <td colspan="3" style="width:70px;">Total Freight Charges</td>
            <td style="width:70px;" id="subtot"></td>
            <td rowspan="2" style=" font-size:10px">Recieved in good condition. Recievers signature with rubber stamp and time.</td>
            
            </tr>
            
            <tr>
            <td colspan="3" style="width:70px;">Servcie Tax</td>
            <td style="width:70px;"></td>
            </tr>
            
            <tr>
            <td colspan="3" style="width:70px;">Octri Amount</td>
            <td style="width:70px;"></td>
            <td rowspan="3">For&nbsp;<?php  echo $_SESSION['companyname'];  ?></td>
            </tr>
            
            <tr>
            <td colspan="3" style="width:70px;">Octri Ser Charges</td>
            <td style="width:70px;"></td>
            
            </tr>
            
            <tr>
            <td colspan="3" style="width:70px;">Grand Total</td>
            <td style="width:70px;" id="gt"></td>
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