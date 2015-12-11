<?php
	include("config.inc");
	if (!isset($_SESSION))
		{
			// session is not started.
			session_start();
		}//session_start();
	if (isset($_SESSION['login_id'])) 
		{
			header('Location: welcome.php');
				
		}
	
	$dbselect = mysql_select_db("purohit",$connection);
	$sql = " SELECT cid, name FROM COMPANY where clienttype=1 ";
	$result = mysql_query($sql)  or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Purohit Transport Management System</title>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" src="js/jquery-1.8.2.min.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>

		<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
		//	jQuery("#formID").validationEngine();
			$("#info").validationEngine({promptPosition : "centerRight", scroll: false, showArrow: true });
			
			$("input").focus(function() {
			$("#errtd").text("");
		});	
			
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
			
		
			
	</script>

<script>
function validation()
{
	var valid = 0;
	var login_id = document.getElementById('login_id').value;
	var password = document.getElementById('password').value;
	
	if(login_id == '')
		{
			//alert('Enter login_id');	
			//return false;
			valid = 0;
		}
	else if(password == '')
		{
			//alert('Enter Password');	
			//return false;
			valid = 0;
		}
	//return true;
	else
	{valid = 1;}
	
	
if(valid == 1)
{
	document.info.action="login.php";
}
}
</script>

</head>
<body>
<form name="info" id="info" action="" method="post"  enctype="multipart/form-data">

<div class="head1"> <a href="logout.php" class="logout" >&nbsp;</a></div>
<div class="header-wrapper">
	<div class="header">
		<h1>Purohit Transport Managment System</h1>
	</div>
</div>


<div class="mid-wrapper">
	<div class="mid">
		
				<br/><br/><br/>
				<table border="0" style="margin:0 auto;">
				
				<tr>
				<td>Select Company</td>
				<td> 
					<select name="selectcompany" id="selectcompany" class="validate[required]"> 
						<option value="">Please Select Company</option>
							
<option value = "2" >
					PUROHIT EXPRESS SERVICES								</option>					
</select>
				</td>
				</tr>
				
				<tr>
				<td>Login Id</td>
				<td><input type="text" name="login_id"  class="validate[required]"  id="login_id" size="30" /></td>
				</tr>

				<tr>
				<td>Password</td>
				<td><input type="password" name="password" class="validate[required]" id="password" size="30" /></td>
				</tr>
												
				<tr>
				<td id="errtd"> &nbsp;
				<?php
					if (isset($_SESSION['login_page_error']))
					{
						if($_SESSION['login_page_error'])
						{  echo $_SESSION['login_page_error'];
						   $_SESSION['login_page_error'] = "0";
						}

					}
			   ?>
				</td>				
				<td> <input type="submit" value="Submit" onclick='validation()' /> </td>
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
