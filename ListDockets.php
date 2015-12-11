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
<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.ui.core.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.ui.autocomplete.js" type="text/javascript" ></script>



<script type="text/javascript">
$(document).ready(function () {
	
	$("#frmIdListDockets").validationEngine({scroll: true, showArrow: true });
	
	$(function() {
		$( "#idFromDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	});
	
	$(function() {
		$( "#idToDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	});
	
	$("#idFromDate,#idToDate").change(function(){
	
	var frmDt = $('#idFromDate').val();
	var toDT = $('#idToDate').val();
	
	if ( frmDt != '' && toDT != '' ) {
	
		$.ajax({
		type:"POST",
		url: "Get_ListDockets_DocDetails.php?from="+frmDt+"&to="+toDT,
		datatype: "json",
		data: "{}",
		contentType: "application/json; charset=utf-8",
		success: function(data,textStatus,xhr) {
			data = JSON.parse(xhr.responseText);
			   // do something with data
			   $('#idTbUndelivered').find("tr:gt(2)").remove();
			   for (var i = 0, len = data.length; i < len; i++) {
	
				   if ( data[i].tran == 1) {
				   var tag = '<a href="#">View Docket</a>';
				   var EditDocket = '<a href="#">Edit Docket</a>';
				   }
				   else {
				   var tag = '<a href="ViewDocket.php?id='+data[i].did+'">View Docket</a>';
				   var EditDocket = '<a href="EditMonthlyTranscation.php?did='+data[i].did+'">Edit Docket</a>';
				   }
				   
					 $('#idTbUndelivered').append( '<tr>' +	
					 	'<td>'+data[i].date+'</td>' +
						'<td>'+data[i].docId+'</td>' +
						'<td>'+data[i].manualdocketnum+'</td>' +
						'<td>'+data[i].Paybyname+'</td>' +
						'<td>'+data[i].Fromname+'</td>' +
						'<td>'+data[i].toname+'</td>' +
						'<td>'+data[i].tot+'</td>' +
						'<td>'+tag+'</td>' + 
						'<td>'+EditDocket+'</td>' +  
						'</tr>' );///end success
					}
			}
		}); // End Ajax
	} // End IFs
	}); // End Change
	

}); // End Document Ready
</script>
</head>
<body>
<form id="frmIdListDockets" action="" method="post"  enctype="multipart/form-data">


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
		
		    <div class="pagehead">
            <a href="#">List Dockets</a>
            </div>
            <br />
            
            <?php
		
			include("config.inc");
		
			$sql="select did, docId, trantype, manualdocketnum, date_format(date ,'%d-%m-%Y') as  date, Paybyname, Fromname, toname, delivered, trantype from docket where pid='{$_SESSION['cid']}' and date=DATE(NOW()) ORDER BY paybyname, date DESC ";
		
			$result = mysql_query($sql);  
		
			?>
            
            <table class="clTbUndelivered" id="idTbUndelivered">
            <tr>
            <th colspan="9" style="background-color:#FFFFFF; border:none;">
            From <input id="idFromDate" readonly="readonly" class="validate[required] text-input" /> &nbsp;&nbsp;&nbsp; To <input id="idToDate" readonly="readonly" class="validate[required] text-input" />
            </th>
            </tr>
            <tr>
            <th colspan="9" style="background-color:#FFFFFF; height:15px; ">&nbsp;</th>
            </tr>
            <tr>
            <th style="width:100px;">Date</th>
            <th style="width:50px;">ID</th>
            <th style="width:70px;">D No.</th>
            <th style="width:100px;">Payby</th>
            <th style="width:100px;">From</th>
            <th style="width:100px;">To</th>
            <th style="width:100px;">Amount</th>
            <th style="width:100px;">View</th>
            <th style="width:100px;">Edit</th>
            </tr>
            
            <?php 
			
			while($row=mysql_fetch_array($result))  
			{  
			
			$did = $row['did'];
			$tran = $row['trantype'];
			
			$sqlGetPartiDetails = "select amt from particular where live=1 and deleted=1 and did=$did ";
			$queryGetPartiDetails = mysql_query($sqlGetPartiDetails)  or die(mysql_error());
			$amount = 0;
			while ( $fetchGetPartiDetails = mysql_fetch_assoc($queryGetPartiDetails) ) {
					$amt = $fetchGetPartiDetails['amt'];
					$amount = $amount + $amt;
			}
			
			$qryView = "";
			$qryEdit = "";
			
			if ( $tran == 1 ) {
			}
			else {
			$qryView = "ViewDocket.php?id=" . $did;
			$qryEdit = "EditMonthlyTranscation.php?did=" . $did;
			//echo $qryView;
			}
			
			?>
				
            <tr>
            <td style="width:50px;">  <?php echo $row['date']; ?> </td>
            <td style="width:50px;">  <?php echo $row['docId']; ?> </td>
            <td style="width:50px;">  <?php echo $row['manualdocketnum']; ?> </td>
            <td style="width:50px;">  <?php echo $row['Paybyname']; ?> </td>
            <td style="width:50px;">  <?php echo $row['Fromname']; ?> </td>
            <td style="width:50px;">  <?php echo $row['toname']; ?> </td>
            <td style="width:50px;">  <?php echo $amount ?> </td>
            <td style="width:70px;"> <a href="<?php echo $qryView ?> ">View Docket</a> </td>
            <td style="width:70px;"> <a href="<?php echo $qryEdit ?> ">Edit Docket</a> </td>
            </tr>
                
				
             
            <?php
			} 
			?>
            
            </table>
            
            

	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>

</form>
</body>
</html>