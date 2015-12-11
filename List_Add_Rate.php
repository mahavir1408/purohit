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

<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>

<script language="javascript" src="js/jquery.ui.core.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.ui.autocomplete.js" type="text/javascript" ></script>

<script language="javascript" src="js/date.format.js" type="text/javascript" ></script>
<script language="javascript" src="js/addtran.js" type="text/javascript" ></script>

<script type="text/javascript" language="javascript">
function vali()
{
	var from = $("#idTxFromCid").val();
	var to = $("#idTxToCid").val();
	
	var result ="false";
	
	if ( ( from != '' ) && ( to != '' ) ) {
	
	var a =	$.ajax({
			type:"GET",
			url: "GetRate.php?from="+from+"&to="+to,
			datatype: "json",
			data: "{}",
			async: false,
			contentType: "application/json; charset=utf-8",
			success: function(data,textStatus,xhr) {
			   data = JSON.parse(xhr.responseText);
			   var i = 0;
			  
			   if ( data[i].status == "true" ) {
					result = "true";			// Rate not added is equal to true
			   }
			   else {
			  		result = "false";
			   }
			} // Success
		}); // End Ajax
	
	}
	else	
	{
		//return "To and From required.";
	}
	
	return result;
	
	if (result == "false") {
		//return "Rate already updated";
	}
	
		
} // End Function

function DeleteRate(rid) {

	$.ajax({
		type:"GET",
		url: "ajaxRateDelete.php?rid="+rid,
		datatype: "json",
		data: "{}",
		contentType: "application/json; charset=utf-8",
		success: function(data,textStatus,xhr) {
			data = JSON.parse(xhr.responseText);
			var i = 0;
			
		   if ( data[i].success == "true" ) {
				alert("Success");
		   }
		   else {
				alert("False");
		   }
		   
		}
	}); // End Ajax

}  // End Function

</script>

<script type="text/javascript"> 
jQuery(document).ready(function(){

	$("#idFrmListEditRate").validationEngine({scroll: true, showArrow: true });
	
	$('#idSubmit').click( function (e) {
			
		if ($("#idFrmListEditRate").validationEngine('validate') != true) {
			var status = vali();
			//alert(status);
			if (status == "true") {
				var fromid = $('#idTxFromCid').val();
				var toid = $('#idTxToCid').val();
			
				var from = $('#idLocFrom').val();
				var to = $('#idLocTo').val();
				
				var tillkg = $('#idTillKg').val();
				var tillkgrate = $('#idTillKgRate').val();
				var abovetillkgrate = $('#idAboveTillKgRate').val();
				
				$.ajax({
					type:"POST",
					url: "InsertRate.php",
					async: false,
					//datatype: "json",
					//data: {"data" : "value"},
					data: "from="+encodeURIComponent(from)+"&to="+encodeURIComponent(to)+"&tillkg="+encodeURIComponent(tillkg)+"&tillkgrate="+encodeURIComponent(tillkgrate)+"&abovetillkgrate="+encodeURIComponent(abovetillkgrate)+"&fromid="+encodeURIComponent(fromid)+"&toid="+encodeURIComponent(toid),
					//contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
					   data = JSON.parse(xhr.responseText);
					   var i = 0;
						
						if ( data = "false") {
							alert("successfully added");
							$('#idLocFrom').val("");
							$('#idTxFromCid').val("");
							$('#idLocTo').val("");
							$('#idTxToCid').val("");
							$('#idTillKg').val("");
							$('#idTillKgRate').val("");
							$('#idAboveTillKgRate').val("");
						}
						else {
							alert("error");
						}
						
					 } // End Success
				}); // End Ajax
			}
			else {
				alert("Rate already added.");
				return;
			}
	
		}
		else {
			
			alert("Rate Already Updated ");
			
		}
		
	});  // End Click
	
		
		$.ajax({
			type:"POST",
			url: "Get_ListRates.php",
			async: false,
			datatype: "json",
			data: {"data" : "value"},
			data: {},
			contentType: "application/json; charset=utf-8",
			success: function(data,textStatus,xhr) {
			   data = JSON.parse(xhr.responseText);
			   var i = 0;
			   
			   for (var i = 0, len = data.length; i < len; i++) {
	   
				 $('#idTblListClients').append( '<tr>' +	
					'<td>'+data[i].locationfrom+'</td>' +
					'<td>'+data[i].locationto+'</td>' +
					'<td>'+data[i].tillkg+'</td>' +
					'<td>'+data[i].tillkgrate+'</td>' +
					'<td>'+data[i].abovetillkgrate+'</td>' +
					'<td><a href="Edit_Rate.php?rid='+data[i].rid+'">Edit</a></td>' +
					'<td><a href="#" onclick="DeleteRate('+data[i].rid+')">Delete</a></td>' +
					//'<td><a href="#" onclick="DeleteRate(0)">Delete</a></td>' +
					'</tr>' );							//	End Success
					
				}
	
			 }
		}); // End Ajax
	
	
});  // End Doc Ready
		
</script>

<script>
	
	$(function() {
		function log( message ) {
			$( "<div>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}

		$( "#idLocFrom" ).autocomplete({
			source: "getclient.php",
			minLength: 1,
			delay: 1000,
			select: function( event, ui ) {
				$('#idTxFromCid').val(ui.item.id);
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

		$( "#idLocTo" ).autocomplete({
			source: "getclient.php",
			minLength: 1,
			delay: 1000,
			select: function( event, ui ) {
				$('#idTxToCid').val(ui.item.id);
			}

		});
	});
	
	
	
</script>

<script>
function resetcid(e, ids, tid)
{
var TABKEY = 9;					
if (e.keyCode == TABKEY) { 
	
	}
	else {
	$('#'+ids).val(0);
	
	}

}

function fromNameTrim()
{
	var val = $('#idLocFrom').val();
	var val = val.replace(/(^\s+|\s+$)/g, '');
	var val = val.replace(/\s{2,}/g,' ');
	var val = val.toUpperCase();	
	$('#idLocFrom').val(val);
}
function toNameTrim()
{
	var val = $('#idLocTo').val();
	var val = val.replace(/(^\s+|\s+$)/g, '');
	var val = val.replace(/\s{2,}/g,' ');
	var val = val.toUpperCase();	
	$('#idLocTo').val(val);
}

</script>

<style type="text/css">
.ui-autocomplete-loading { background:url('images/loading.gif') no-repeat right center;  }
</style>

    
    
</head>
<body>
<form name="FrmListEditRate" id="idFrmListEditRate" action="" method="post" enctype"multipart/form-data">

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
            <a href="#">List Rates</a>
            </div>
            <br />
            
            <table style="margin: 0 auto; text-align:left;" class="clTbAddRate">
            
            <tr>
            <td>From</td> 
            <td>  <input type="text" id="idLocFrom" name="LocFrom" class="validate[required,funcCall[fromNameTrim],ajax[valClientNameRate]] text-input"  onkeypress="resetcid(event,'idTxFromCid','idLocFrom')" />
            <input type="hidden" id="idTxFromCid" value="" class="validate[required] " />
             </td> 
            </tr>
            
            <tr>
            <td>To</td>
            <td> <input type="text" id="idLocTo" name="LocTo" class="validate[required,funcCall[toNameTrim],ajax[valClientNameRate]] text-input"  onkeypress="resetcid(event,'idTxToCid','idLocTo')"  /> 
            <input type="hidden" id="idTxToCid" value="" class="validate[required]" />
            </td>
            </tr>
            
            <tr>
            <td>Kg Limit</td>
            <td>  <input type="text" id="idTillKg" name="TillKg"  class="validate[required,custom[posotivenumber]] text-input" />	</td>
            </tr>
            <tr>
            <td>Fix Rate</td>
            <td>  <input type="text" id="idTillKgRate" name="TillKgRate"  class="validate[required,custom[number]] text-input" />	</td>
            </tr>
            <tr>
            <td>Per KG Rate</td>
            <td>  <input type="text" id="idAboveTillKgRate" name="AboveTillKgRate"  class="validate[required,custom[number]] text-input" />	</td>
            </tr>
            <tr>
            <td colspan="2"> 
            <a id="idSubmit" href="#" style="float:right; width:75px;" >Submit</a>
           <!-- <input type="submit" title="Submit" value="Submit" id="idSubmit" style="float:right; width:75px;" />--> </td>
            </tr>
            </table>
            
            <br />
            <table id="idTblListClients" class="clTblListClients">
            <tr>
            <th style="width:100px;">From</th>
            <th style="width:200px;">To</th>
            <th style="width:100px;">Till Kg</th>
            <th style="width:100px;">Till Kg Rate</th>
            <th style="width:150px;">Above Till Kg Rate</th>
            <th style="width:150px;">Edit Rate</th>
            <th style="width:150px;">Delete Rate</th>
            </tr>
            </table>

	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>

</form>
</body>
</html>