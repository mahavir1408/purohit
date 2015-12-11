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
<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />


<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="js/purl.js"></script>
<script type="text/javascript" language="javascript" src="js/EditClientDetails.js"></script>
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>

<script type="text/javascript" language="javascript">
		
		jQuery(document).ready(function(){
			$("#UpdateClient").validationEngine({ scroll: true, showArrow: true  });
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		
</script>

<script type="text/javascript">
function resetcid(e, ids, tid)
{
var TABKEY = 9;					
if (e.keyCode == TABKEY) { 
	
	}
	else {
	$('#'+ids).val(0);
	
	}

}

function PaybyNameTrim()
{
	var val = $('#idTxPayby').val();
	var val = val.replace(/(^\s+|\s+$)/g, '');
	var val = val.replace(/\s{2,}/g,' ');
	var val = val.toUpperCase();	
	$('#idTxPayby').val(val);	
}

function validatesname(ids) {
			var str = $('#'+ids).val();
			//alert ("sam");
			var str = $('#'+ids).val().toUpperCase();
			var trim = str.replace(/\s/g, '');
			$('#'+ids).val(trim);
}
function filedrequired()
{
	if ( $('#idTxShortName').val() == 0 ) {
		
		return "Shortname and Location compulsory required";
	 }
	
}

</script>


</head>
<body>

<form name="UpdateClient" id="UpdateClient" action="updateClientDetails.php"  method="post" enctype="multipart/form-data">

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
            <a href="#">Edit Client Details</a>
            </div>
            <br />
            
            <table class="clTblClientMaster" style="text-align:left; margin:0 auto;">  
        		<tr>
                <td><span style="font-weight:bold;">Pay by</span></td>
                <td colspan="3"> 
                	<input type="text" name="txPayBy"  class="validate[required,funcCall[PaybyNameTrim],ajax[Vali_EditClient_Name]] text-input" style="width:500px;"  id="idTxPayby" /> <br />
                	<label id="idPaybystatus" style="color:#FF0000; font-size:12px;"></label>
                    <input  type="hidden" id="hfClientName" value="0" />
                </td>
                </tr>
               <tr>
                <td>Cust Id</td>
                <td colspan="3"><input type="text" id="idTxPaybyCid" name="txPaybyCid" readonly="readonly" class="validate[required] text-input" /> 
                </td>
                </tr>
                <tr>
                <td>Short name</td>
                <td>
                <input type="text" id="idTxShortName" name="txShortName"  onkeydown="validatesname('idTxShortName')" class="validate[required,funcCall[filedrequired],groupRequired[payByShortName],custom[onlyLetterSp]] text-input"  /> 
                </td>
                <td style="width:120px;" >Location</td>
                <td> <input type="text" id="idTxLocation" name="txLocation" onkeydown="validatesname('idTxLocation')" class="validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[Vali_EditClient_Sname]] text-input"  /> 
                 <input  type="hidden" id="hfIdSname" value="0" />
                </td>
                </tr>
                <tr>
                <td>Country</td>
                <td>
                <select id="idSePaybyCountry" style="width:180px;"   name="sePaybyCountry">
                <option value="INDIA" selected="selected">India</option>
                </select>
                </td>
                <td>State</td>
                <td>
              	<input type="text" id="idTxState" name="txState"    />
                </td>
                </tr>
                <tr>
                <td>City</td>
                <td>
                <input type="text" id="idTxCity" name="txCity"   />
                </td>
                <td>Pin code</td>
                <td><input type="text"   id="idTxPaybyPin" name="txPaybyPin"/></td>
                </tr>
                <tr>
                <td>Email</td>
                <td><input type="text"  class="validate[custom[email]]"  id="idTxPaybyEmail" name="txPaybyEmail"/></td>
                <td>Phone</td>
                <td><input type="text"   id="idTxPaybyCell" name="txPaybyCell"/></td>
                </tr>
                <tr>
                <td>Address Line 1</td>
                <td colspan="3"><input type="text" id="idTxPaybyAl1"  style="width:500px;"  name="txPaybyAl1"/></td>
                </tr>
                <tr>
                <td>Address Line 2</td>
                <td colspan="3"><input type="text" id="idTxPaybyAl2"  style="width:500px;"  name="txPaybyAl2"/></td>
                </tr>
                
                <tr>
                <td>Monthly Rate</td>
                <td><input type="text" name="naMonthlyRate" id="idTxMonthlyRate" class="validate[custom[onlyNumberSp]] text-input" /></td
                ></tr>
                
                <tr>
                <td>Till KG</td>
                <td><input type="text" name="naTillKg"  id="idTxTillKg"  class="validate[custom[onlyNumberSp]] text-input" /></td>
                <td>Till Kg Rate</td>
                <td><input type="text" name="naTillKgRate" id="idTxTillKgRate" class="validate[custom[onlyNumberSp]] text-input" /></td>
                </tr>
                
               
                <tr>
                <td>Above Till Kg Rate</td>
                <td><input type="text" name="naAboveTillKgRae" id="idTxAboveTillKgRae" class="validate[custom[onlyNumberSp]] text-input"  /></td>
                </tr>
                
                <tr> 
                <td colspan="4" style="text-align:right;">  <button type="submit"  id="btnsubmit" value="Submit">Update Client</button> </td>
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