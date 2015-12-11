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
<script type="text/javascript" language="javascript"  src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="js/purl.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$.ajax({
	type:"GET",
	url: "Get_ClientList.php",
	datatype: "json",
	data: "{}",
	contentType: "application/json; charset=utf-8",
	success: function(data,textStatus,xhr) {
		data = JSON.parse(xhr.responseText);
		   // do something with data
		   $('#idTblListClients').find("tr:gt(0)").remove();
		   for (var i = 0, len = data.length; i < len; i++) {
		   
				 $('#idTblListClients').append( '<tr>' +	
					'<td>'+data[i].name+'</td>' +
					'<td>'+data[i].sname+'</td>' +
					'<td>'+data[i].monthlyrate+'</td>' +
					'<td>'+data[i].tillkg+'</td>' +
					'<td>'+data[i].tillkgrate+'</td>' +
					'<td>'+data[i].kgRateabovetillkg+'</td>' +
					'<td><a href="EditClientDetails.php?cid='+data[i].cid+'">Edit Client Details</a></td>' +
					'</tr>' );///end success
			}
		}
    }); // End Ajax
}); // End Document Ready
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
		
		    <div class="pagehead">
            <a href="#">List Clients</a>
            </div>
            <br />
            <table id="idTblListClients" class="clTblListClients">
            <tr>
            <th style="width:100px;">Client Name</th>
            <th style="width:200px;">Client Short Name</th>
            <th style="width:100px;">Monthly Rate</th>
            <th style="width:100px;">Till Kg</th>
            <th style="width:100px;">Till Kg Rate</th>
            <th style="width:150px;">Above Till Kg Rate</th>
            <th style="width:150px;">Edit Client</th>
            </tr>
            </table>

	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>


</body>
</html>