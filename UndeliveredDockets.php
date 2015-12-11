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
<script type="text/javascript">
$(document).ready(function () {
	$.ajax({
	type:"POST",
	url: "Get_UndeliveredDockets.php",
	datatype: "json",
	data: "{}",
	contentType: "application/json; charset=utf-8",
	success: function(data,textStatus,xhr) {
		data = JSON.parse(xhr.responseText);
		   // do something with data
		   $('#idTbListBills').find("tr:gt(0)").remove();
		   for (var i = 0, len = data.length; i < len; i++) {

			   if ( data[i].trantype == 1) {
			  // var tag = '<a href="ViewDocket.php?id='+data[i].did+'">View Docket</a>';
//			   var EditDocket = '<a href="EditMonthlyTranscation.php?did='+data[i].did+'">Edit Docket</a>';
			   var tag = '<a href="#">View Docket</a>';
			   var EditDocket = '<a href="#">Edit Docket</a>';
			   }
			   else {
			   var tag = '<a href="ViewDocket.php?id='+data[i].did+'">View Docket</a>';
			   var EditDocket = '<a href="EditMonthlyTranscation.php?did='+data[i].did+'">Edit Docket</a>';
			   }
			   
				 $('#idTbUndelivered').append( '<tr>' +	
	                '<td>'+data[i].docId+'</td>' +
					'<td>'+data[i].manualdocketnum+'</td>' +
					'<td>'+data[i].idate+'</td>' +
					'<td>'+data[i].Paybyname+'</td>' +
					'<td>'+data[i].Fromname+'</td>' +
					'<td>'+data[i].toname+'</td>' +
					'<td>'+data[i].delivered+'</td>' +
					'<td>'+tag+'</td>' + 
					'<td>'+EditDocket+'</td>' +  
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
                            <li><a href="#">Servcie Tax Report</a></li>
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
            <a href="#">Pending Delivery</a>
            </div>
            <br />
            <table class="clTbUndelivered" id="idTbUndelivered">
            <tr>
            <th style="width:50px;">ID</th>
            <th style="width:70px;">D No.</th>
            <th style="width:100px;">Date</th>
            <th style="width:100px;">Payby</th>
            <th style="width:100px;">From</th>
            <th style="width:100px;">To</th>
            <th style="width:100px;">Delivered</th>
            <th style="width:100px;">View</th>
            <th style="width:100px;">Edit</th>
            </tr>
            </table>
            <br />
	</div>
</div>



	

		
<div class="footer">
	<a href="http://www.isamit.in">Developed by iSAM IT</a>
</div>


</body>
</html>