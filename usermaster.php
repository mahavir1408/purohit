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

if (roleid == 3) {
$("input").attr("readonly", true);
}
else if (roleid == 2) {

$("#selectrole").val(3);
$("#selectcompany").val(cid);

}
else {
}

});
</script>



<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
		//	jQuery("#formID").validationEngine();
			$("#usermaster").validationEngine({promptPosition : "centerRight", scroll: false, showArrow: true });
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
			
		function selectchange() {
			 var role = <?php echo $_SESSION['role'] ?> ;
			 var icid = <?php echo $_SESSION['cid'] ?> ;
			 	if ( role == 2 || role == 3 ) {
				$("#selectrole").val(3);
				$("#selectcompany").val(icid);
			 	}
	  		}
	</script>







</head>
<body>
<form name="usermaster" id="usermaster" action="adduser.php" method="post"  enctype="multipart/form-data">


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
    			
				<h2>User Master</h2>
        
				<table>
                
                <tr>
                <td colspan="2"> Error </td>
                </tr>
                
                <tr>
                <td>User Name</td>
                <td> <input type="text" name="userid" id="userid" onchange="beforesend()" class="validate[required,ajax[ajaxUserCallPhp],funcCall[beforesend]] text-input" size="30" /> </td>
                <td> <!--<img src="images/ok.gif" alt="OK" style="display:none;" id="unameok" /> <img src="images/cross.png" alt="incorrect" id="unamenotok" style="display:none;" />--> <label id="lbluserid"></label>
                <input type="hidden"  id="hfuserid" name="hfuserid" value="z" />
                </td>
                </tr>
                
                <tr>
                <td>Password</td>
                <td><input type="password" name="password" id="password"  class="validate[required,minSize[6]] text-input" size="30" /></td>
                <td> <label id="lblpassword"></label> <img src="images/ok.gif" alt="OK" style="display:none;" id="passok" />  </td>
                </tr>
                
                <tr>
                <td>Re-Password</td>
                <td><input type="password" name="repassword" class="validate[required,,minSize[6],equals[password]] text-input" id="repassword" size="30" /></td>
                 <td> <label id="lblrepassword"></label> <img src="images/ok.gif" alt="OK" style="display:none;" id="repassok" /> </td>
                </tr>
                
                <tr>
                <td>Company</td>
                <td>
                <select name="selectcompany" class="validate[required]" id="selectcompany" onchange="selectchange()"> 
						<option value="">Please Select Company</option>
                        <?php
								$dbselect = mysql_select_db("purohit",$connection);
								$sql = " SELECT cid, name FROM COMPANY ";
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
                 <td> <label id="lblselectcompany"></label> </td>
                </tr>
                
                <tr>
                <td>Role</td>
                <td>
                <select name="selectrole" class="validate[required]" id="selectrole" onchange="selectchange()"> 
						<option value="">Please Select Role</option>
                        <option value="1">superadmin</option>
                        <option value="2">admin</option>
                        <option value="3">user</option>
					</select>
                </td>
                 <td> <label id="lblselectrole"></label> </td>
                </tr>
                
                <tr> 
                <td colspan="2">  <button type="submit" onclick="validateform()" id="btnsubmit" value="Submit">Submit</button> </td>
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