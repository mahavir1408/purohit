<?php
	session_start();
	
	include("config.inc");
	//echo $_SESSION['selectcompany'];
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
<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" src="js/jquery-1.8.2.min.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>

<script>
jQuery(document).ready(function(){

var roleid = <?php echo $_SESSION['role'] ?> ;
var cid = <?php echo $_SESSION['cid'] ?> ;
if (roleid = 3) {

$("#selectclient").val(2);
$("#selectclient").attr("readonly", true);
$("#idSelectCompany").val(cid);
$("#idSelectCompany").attr("readonly", true);

}
else if (roleid = 2) {

$("#selectclient").val(2);
$("#selectclient").attr("readonly", true);
$("#idSelectCompany").val(cid);
$("#idSelectCompany").attr("readonly", true);

}

});
</script>

<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
		//	jQuery("#formID").validationEngine();
			$("#comaster").validationEngine({promptPosition : "centerRight", scroll: false, showArrow: true });
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
		
		function beforesend() {
			var str = $("#userid").val().toLowerCase();
			var trim = str.replace(/\s/g, '');
			$("#userid").val(trim);
	  		}
			
		function beforesendsname() {
			var str = $("#snameid").val().toLowerCase();
			var trim = str.replace(/\s/g, '');
			$("#snameid").val(trim);
	  		}
			
		function srttrim() {
			var str = $("#userid").val().toLowerCase();
			var trstr = $.trim(str).replace(/\s(?=\s)/g,'')
			$("#userid").val(trstr);
			//alert($("#userid").val());
			$('input[name=naSelectedCid]').val($('#idSelectedCid').val());
			//alert($('input[name=naSelectedCid]').val());
			}
			
		function ddlselected() {
		if ( $("#selectclient").val() > 0 && $("#idSelectCompany").val() > 0 ) {
			$("#userid").attr('readonly', false);
			$("#snameid").attr('readonly', false);
			//var cxc = $('#userid').val();
			//$('#idSelectedCid').val() = cxc;
			$('input[name=naSelectedCid]').val($('#idSelectedCid').val());
			//alert($('input[name=naSelectedCid]').val());
		}
		else {
			//alert("SAM");
			$("#userid").val("");
			$("#snameid").val("");
			$("#userid").attr('readonly', true);
			$("#snameid").attr('readonly', true);
		}
		}
		
		function selectchange() {
			 var role = <?php echo $_SESSION['role'] ?> ;
			 var icid = <?php echo $_SESSION['cid'] ?> ;
			 	if ( role == 2 || role == 3 ) {
				$("#selectclient").val(2);
				$("#idSelectCompany").val(icid);
			 	}
	  		}
		
	</script>




</head>
<body>

<form name="comaster" id="comaster" action="addcompany.php" method="post" enctype="multipart/form-data">

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
    			
				<h2> Company / Client Master </h2>
        
				<table>
                
                <tr>
                <td>Type</td>
                <td> 
                <select class="validate[required]" id="selectclient" name="selectclient" onchange="selectchange()" onchange="ddlselected()">
                <option value="">Select Type - Company / Client </option>
                <option value="1">Company</option>
                <option value="2">Client</option>               
                </select>
                </td>
                </tr>
                  
                
                <tr>
                <td>Parent Company</td>
                <td>
                <select name="naSelectCompany" id="idSelectCompany" onchange="selectchange()" class="validate[required] text-input" onchange="ddlselected()"> 
						<option value="">Please Select Company</option>
                        <?php
								$dbselect = mysql_select_db("purohit",$connection);
								$sql = "SELECT cid, name FROM COMPANY WHERE clienttype=1";
								$result = mysql_query($sql)  or die(mysql_error());
								while($row = mysql_fetch_assoc($result))
								{
								?>
								<option value = "<?php echo($row['cid'])?>" >
									<?php echo($row['name']) ?>
								</option>
								<?php
								}               
						?>
					</select>
                </td>
                </tr>  
                  
                  
                <tr>
                <td>Company / Client Name </td>
                <td> 
   <input type="text" name="userid" id="userid" onchange="srttrim()" class="validate[required,ajax[ajaxUserCallCom],funcCall[srttrim]] text-input" size="30" />
   <input type="hidden" name="naSelectedCid" id="idSelectedCid" />
                </td>
                </tr>
                
                <tr>
                <td>Short Name</td>
                <td>
<input type="text" name="snameid" id="snameid" onchange="beforesendsname()" class="validate[required,ajax[ajaxUserCallsname],funcCall[beforesendsname]] text-input" size="30" /> 

                </td>
                </tr>
               
                
                
                
                <tr>
                <td>State</td>
                <td>
                <select name="naSelectStat"> 
						<option value="">Please Select State</option>
                        <option value="1">Maharashtra</option>
                        <option value="2">Goa</option>
                        <option value="3">Gujrat</option>
					</select>
                </td>
                </tr>
                
                <tr>
                <td>City</td>
                <td><input type="text" name="naCity" size="30" /></td>
                </tr>
                
                <tr>
                <td>Pin Code</td>
                <td><input type="text" name="naPin" size="30" /></td>
                </tr>
                
                <tr>
                <td>Contact</td>
                <td><input type="text" name="naContact" size="30" /></td>
                </tr>
                
                <tr>
                <td>Email</td>
                <td><input type="text" name="naEmail" size="30" /></td>
                </tr>
                
                <tr>
                <td>Address line 1</td>
                <td><input type="text" name="naAd1" size="30" /></td>
                </tr>
                
                <tr>
                <td>Address line 2</td>
                <td><input type="text" name="naAd2" size="30" /></td>
                </tr>
                
                <tr>
                <td>Monthly Rate</td>
                <td><input type="text" name="naMonthlyRate" class="validate[required,custom[onlyNumberSp]] text-input" size="30" /></td>
                </tr>
                
                <tr>
                <td>Till KG</td>
                <td><input type="text" name="naTillKg" class="validate[required,custom[onlyNumberSp]] text-input" size="30" /></td>
                </tr>
                
                <tr>
                <td>Till Kg Rate</td>
                <td><input type="text" name="naTillKgRate" class="validate[required,custom[onlyNumberSp]] text-input" size="30" /></td>
                </tr>
                
                <tr>
                <td>Above Till Kg Rate</td>
                <td><input type="text" name="naAboveTillKgRae" class="validate[required,custom[onlyNumberSp]] text-input" size="30" /></td>
                </tr>
                
                <tr> 
                <td colspan="2"> <button type="submit" onclick="validateform()" id="btnsubmit" value="Submit">Submit</button> </td>
                </tr>
				
                
                
                </table>
		
	</div>
</div>



	

		
<div id="footer">
	<p>Powered by iSAM IT</p>
</div>

</form>
</body>
</html>