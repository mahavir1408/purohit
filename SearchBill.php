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

<script type="text/javascript" language="javascript" src="js/SearchBills.js"></script>

<style>
.ui-autocomplete-loading { background:url('images/loading.gif') no-repeat right center;  }
</style>

</head>
<body>
<form name="frmSearchBill" id="idFrmSearchBill" action="" method="post"  enctype="multipart/form-data">
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
                <a href="#">Search Bill</a>
                </div>
                <br />
        
                <table class="clTbSearchBills">
                <tr>
                <td>Search by</td>
                <td>
                
                <!--
                // 1 = Bill No.
				// 2 = Bill Date
                // 3 = Client name
                -->
                
                <select id="idSeBillSearchOption">
                <option value="1">Bill No.</option>
                <option value="2" >Bill Date</option>
                <option value="3">Client Name</option>
                </select>
                
                </td>
                </tr>
                <tr id="row1">
                <td> Enter Value </td>
                <td> <input type="text" name="txSearch" id="idTxSearch" class="clTxSearch" /> </td>
                </tr>
                <tr id="row2">
                <td> From </td>
                <td> <input type="text" name="txFromDate" id="idTxFromDate"  readonly="readonly" /> </td>
                </tr>
                <tr id="row3">
                <td> To </td>
                <td> <input type="text" name="txToDate" id="idTxToDate"  readonly="readonly" /> </td>
                </tr>
                <tr  id="row4">
                <td>&nbsp;</td>
                <td  style="text-align:right;">
                <a href="#" id="idBtnSearch" class="clLnkBtnSearchBills" >Search Bill </a>
                </td>
                </tr>
                </table>
                
                <br />
                
                <table class="clTblListBills" id="idTbListBills">
                <tr>
                <th style="width:70px;">Date</th>
                <th style="width:70px;">Bill No.</th>
                <th style="width:150px;">Pay by</th>
                <th style="width:100px;">Grand Total</th>
                <th style="100px;">Payment</th>
                <th style="100px;">Payment Date</th>
                <th style="100px;">Bank Name</th>
                <th style="100px;">Cheque No.</th>
                <th>View Bill</th>
                <th>Edit Bill</th>
                <th></th>
                </tr>
                </table>
                
                <br />

	</div>
</div>



	

		
<div id="footer">
	<p>Powered by iSAM IT</p>
</div>

</form>
</body>
</html>