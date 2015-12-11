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
	/*include("config.inc");
	$sql="Select Role, Company_Name from login where Login_Id='$login_id'";
	$result = mysql_query($sql);  
	while($row=mysql_fetch_array($result))  
	{  
		$role = $row['Role'];
		$company_name = $row['Company_Name'];
	} */ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />


<!--<script language="javascript" src="js/jquery-1.8.2.min.js" type="text/javascript" ></script>-->

<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>

<script language="javascript" src="js/jquery.ui.core.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.ui.autocomplete.js" type="text/javascript" ></script>

<script language="javascript" src="js/date.format.js" type="text/javascript" ></script>
<script language="javascript" src="js/addtran.js" type="text/javascript" ></script>
<!--<script language="javascript" src="js/SingleBill.js" type="text/javascript" ></script>-->

<script>
jQuery(document).ready(function(){
		
	$("#idaddtran").validationEngine({scroll: true, showArrow: true });
	
	$("#idTxClientName").keydown(function(){
  		$("#custid").val(0)
	});
	
  			
			
});  // End Doc Ready
		
</script>
    
    <script>
    
    $(function() {
		$( "#idTxDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
		$( "#idTxFromDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
		$( "#idTxToDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy",
		showButtonPanel: true,
		onSelect: function (dateText, inst) {
			
		}
		});
	});
    
    </script>
    
   <script>
	
	$(function() {
		function log( message ) {
			$( "<div>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
		
	$( "#idTxClientName" ).autocomplete({
			source: "getclient.php",
			minLength: 1,
			select: function( event, ui ) {
				$("#custid").val(ui.item.id);
				//alert(ui.item.id);
				
				var cid = $('#custid').val();
		
			if (cid != 0) {
				
				$.ajax({
				type:"POST",
				url: "Get_Accounts_PendingPayments.php?cid="+encodeURIComponent(cid),
				async: false,
				datatype: "json",
				//data: "cid="+encodeURIComponent(cid),
				contentType: "application/json; charset=utf-8",
				success: function(data,textStatus,xhr) {
				   data = JSON.parse(xhr.responseText);
				   var name = $('#idTxClientName').val();
				   deposit = "";
				   var i = 0;
				   var amt = data[i].g;
				   
					$.ajax({
					type:"POST",
					url: "Get_Accounts_PendingPaymentsDeposit.php?cid="+encodeURIComponent(cid),
					async: false,
					datatype: "json",
					//data: "cid="+encodeURIComponent(cid),
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
					   idata = JSON.parse(xhr.responseText);
					   //var name = $('#idTxClientName').val();
					   var j = 0;
					   deposit = idata[j].g;
					 
					$('#idTbListAcTran').find("tr:gt(2)").remove();
					
					$('#idTbListAcTran').append( '<tr>' +
					'<td style=" border:solid 1px #999999;">'+ui.item.value+'</td>' +
					'<td style=" border:solid 1px #999999;">'+amt+'</td>' +
					'<td style=" border:solid 1px #999999;">'+deposit+'</td>' +
					'<td style=" border:solid 1px #999999;">'+(amt - deposit)+'</td>' +
					
					'</tr>' );					
					
					}
					}); // End Ajax
				  
				 }
				}); // End Ajax
				
			}  // end if
				
			},
			response: function(event, ui) {
				// ui.content is the array that's about to be sent to the response callback.
				if (ui.content.length === 0) {
					$("#custid").val(0);
				}
			},
			close: function( event, ui ) {
				
			}
		});
	});
	
	
	

</script>


<title>Accounts - New Transation</title>
</head>
<body>


<form name="addtran" id="idaddtran" action="#" method="post"  enctype="multipart/form-data">

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
                            <li><a href="Accounts_ListTranscation.php">List Transcations</a></li>
                            <li><a href="Accounts_PendingPayment.php">List Pending Payments</a></li>
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
            <a href="#">List Pending Payments</a>
            </div>
            <br />
            
            
            <table style="margin:0 auto; text-align:left;" id="idTbListAcTran">
            <tr>
            <td style=" font-weight:bold;">Client name</td>
            <td colspan="4"><input type="text" id="idTxClientName" name="txClientName" class="validate[required] text-input" style="width:300px;" /> &nbsp;&nbsp; &nbsp; <span>Cust id - </span>&nbsp;&nbsp;<span ></span><input type="text" id="custid" readonly="readonly"  class="validate[required] text-input" /></td>

            </tr>
            <tr>
            <td colspan="5">&nbsp;</td>
            </tr>
            
            <tr>
            <th>Client Name</th>
            <th>Total Billing</th>
            <th>Total Money recieved</th>
            <th>Pending</th>
            <!--<th>View Transcation</th>
            <th>Add Transcation</th>-->
            </tr>
            
            </table>
            
            <br />

	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>

</form>
</body>
</html>