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
	
	var fromdt = "";
	var todt = "";
	
	//$.ajax({
//		type:"POST",
//		url: "Get_ListAccountsTran.php",
//		async: false,
//		datatype: "json",
//		data: {},
//		data: "fromdt="+encodeURIComponent(fromdt)+"&todt="+encodeURIComponent(fromdt),
//		contentType: "application/json; charset=utf-8",
//		success: function(data,textStatus,xhr) {
//		   data = JSON.parse(xhr.responseText);
//		   //var i = 0;
//		    $('#idTbListAcTran').find("tr:gt(2)").remove();
//			
//			var income = 0;
//			var expense = 0;
//			
//			 for (var i = 0, len = data.length; i < len; i++) {
//			 
//				if ( data[i].trantype == "EXPENSE" ) {
//				
//					 $('#idTbListAcTran').append( '<tr>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].date+'</td>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].name+'</td>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].des+'</td>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].paymode+'</td>' +
//						'<td style=" border:solid 1px #999999; text-align:right;">'+data[i].amt+'</td>' +
//						'<td style=" border:solid 1px #999999;">&nbsp;</td>' +
//						'<td style=" border:solid 1px #999999; text-align:center;"><a href="Edit_Accounts_Transcation.php?aid='+data[i].atid+'">Edit</a></td>' +
//						'</tr>' );///end success
//						
//					expense = ( 1 * expense	) +  ( 1 * data[i].amt );	
//					
//				}
//				else {
//					$('#idTbListAcTran').append( '<tr>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].date+'</td>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].name+'</td>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].des+'</td>' +
//						'<td style=" border:solid 1px #999999;">'+data[i].paymode+'</td>' +
//						'<td style=" border:solid 1px #999999;">&nbsp;</td>' +
//						'<td style=" border:solid 1px #999999; text-align:right;">'+data[i].amt+'</td>' +
//						'<td style=" border:solid 1px #999999; text-align:center;"><a href="Edit_Accounts_Transcation.php?aid='+data[i].atid+'">Edit</a></td>' +
//						'</tr>' );///end success
//					
//					income = ( 1 * income	) +  ( 1 * data[i].amt );
//					
//				}
//			 }
//		     
//		 $('#idTbListAcTran').append( '<tr>' +
//		 '<td style=" border:solid 1px #999999; text-align:center; font-weight:bold;" colspan="4">Total</td>' +
//		 '<td style=" border:solid 1px #999999;text-align:right;">'+expense+'</td>' +
//		 '<td style=" border:solid 1px #999999;text-align:right;">'+income+'</td>' +
//		 '<td style=" border:solid 1px #999999;">&nbsp;</td>' +
//		 '</tr>' );///end success
//		  
//		 $('#idTxFromDate').val("00-00-0000"); 
//		 $('#idTxToDate').val("00-00-0000"); 
//		  
//		 }
//	}); // End Ajax
	
	
	$("#idTxToFrom").keydown(function(){
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
		
	$( "#idTxToFrom").autocomplete({
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
				   
					 for (var i = 0, len = data.length; i < len; i++) {
					 
					 	$('#idTbListAcTran').append( '<tr>' +
						'<td style=" border:solid 1px #999999;">'+ui.item.value+'</td>' +
						'<td style=" border:solid 1px #999999;">'+data[i].g+'</td>' +
						'<td style=" border:solid 1px #999999;">'+data[i].des+'</td>' +
						'<td style=" border:solid 1px #999999;">'+data[i].paymode+'</td>' +
						'<td style=" border:solid 1px #999999; text-align:right;">'+data[i].amt+'</td>' +
						'<td style=" border:solid 1px #999999;">&nbsp;</td>' +
						'<td style=" border:solid 1px #999999; text-align:center;"><a href="Edit_Accounts_Transcation.php?aid='+data[i].atid+'">Edit</a></td>' +
						'</tr>' );
						}
				  
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


<form name="addtran" id="idaddtran" action="Insert_Accounts_Transcation.php" method="post"  enctype="multipart/form-data">

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
            <a href="#">Accounts - New Transcationss</a>
            </div>
            <br />
            
            <table class="clAccounts_Transcation">
            <tr>
            <td>TrsnscationType</td>
            <td>
            <select class="validate[required] text-input"  style="width:205px;"  name="seTranTyp" id="idSeTranType">
            <option value=""></option>
            <option value="INCOME">INCOME</option>
            <option value="EXPENSE">EXPENSE</option>
            </select>
            </td>
            </tr>
            <tr>
            <td>Date</td>
            <td><input type="text" id="idTxDate" name="txDate" readonly="readonly" class="validate[required] text-input" /> </td>
            </tr>
            <tr>
            <td>Description</td>
            <td>
            <textarea type="text" style="width:200px; height:100px;" id="idTxDesc" name="txDesc" class="validate[required] text-input"></textarea>          
            </td>
            </tr>
            <tr>
            <td>Amt</td>
            <td><input type="text" id="idTxAmt" name="txAmt" class="validate[required] text-input" /> </td>
            </tr>
            <tr>
            <td>Payment Mode</td>
            <td>
            <select class="validate[required] text-input" style="width:205px;" name="sePayMode" id="sePayMode">
            <option value=""></option>
            <option value="CHEQUE">CHEQUE</option>
            <option value="CASH">CASH</option>
            <option value="DD">DD</option>
            <option value="ONLINE TRANSFER">ONLINE TRANSFER</option>
            <option value="CREDIT CARD">CREDIT CARD</option>
            <option value="DEBIT CARD">DEBIT CARD</option>
            </select>
            </td>
            </tr>
            <tr>
            <td>To / From</td>
            <td> <input type="text" id="idTxToFrom" name="txToFrom"  class="validate[required] text-input" /> 
            &nbsp;&nbsp; Cust id - &nbsp;
            <input type="text" id="custid" name="txcustid" readonly="readonly" style="width:50px;"  class="validate[required,custom[posotivenumber]] text-input" />
            </td>
            </tr>
            <tr>
            <td colspan="2" style="text-align:right;">	
            <input type="submit" width="70" title="Submit"  name="submit" value="Add Transcation" style="float:right; " />
            </td>
            </tr>
            </table>
            
            <br />
            
            
            <!--<div class="pagehead">
            <a href="#">List Accounts Transcationss</a>
            </div>
            <br />
            
            
            <table style="margin:0 auto; text-align:left;" id="idTbListAcTran">
            <tr>
            <td style="width:120px; font-weight:bold;">From Date</td>
            <td><input type="text" id="idTxFromDate" name="txFromDate" readonly="readonly" class="validate[required] text-input" /></td>
            <td>&nbsp;</td>
            <td style=" font-weight:bold;">To Date</td>
            <td><input type="text" id="idTxToDate" name="txToDate" readonly="readonly" class="validate[required] text-input" /></td>
            </tr>
            <tr>
            <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
            <th>Date</th>
            <th>Name of Party</th>
            <th>Desc</th>
            <th>Mode of Payment</th>
            <th>Expense</th>
            <th>Income</th>
            <th>Edit Transcation</th>
            </tr>
            </table>-->
            
            <br />

	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>

</form>
</body>
</html>