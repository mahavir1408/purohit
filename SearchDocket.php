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

<script type="text/javascript" language="javascript" src="js/SearchDocket.js"></script>

<style>
.ui-autocomplete-loading { background:url('images/loading.gif') no-repeat right center;  }
</style>

</head>
<body>
<form name="SearchDocket" id="idSearchDocket" action="" method="post"  enctype="multipart/form-data">



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
                <a href="#">Search Docket</a>
                </div>
                <br /> 
                
             <?php  	
				
				if (isset($_SESSION['Derror'])) {
			?> 
                 <table style="width:400px; border:solid 1px #000; margin:0 auto; border-collapse:collapse; text-align:left; text-indent:5px;">
               
            <tr><td colspan="2" style="border:solid 1px #000; background-color:#eeeeee; font-weight:bold;"> 
            	
				
					
				<?php 	echo $_SESSION['Derror'];  ?>
				
				<?php 	unset($_SESSION['Derror']);  ?>
					
				 
             </td></tr>
            <tr><td  style="border:solid 1px #000;">Id No. -</td><td   style="border:solid 1px #000;">  
					<?php  	
						echo $_SESSION['Dnum']; unset($_SESSION['Dnum']); 	
					?>  
            </td></tr>
            <tr><td  style="border:solid 1px #000;">Docket No.-</td><td   style="border:solid 1px #000;">  
					<?php	
							echo $_SESSION['Cnum']; unset($_SESSION['Cnum']);						
					?>  
            </td></tr>
            
            </table>
            
            <?php	
            }
			?>
                
                <br />

                <table class="clTbSearchDoc">
                <tr>
                <td colspan="2" style="padding:5px; text-align:center; color:red;"> 
				
				
                
                </td>
                </tr>
                <tr>
                <td>Search by</td>
                <td>
             
               <!-- // 1 = id
				// 2 = Docket No.
				// 3 = Date	
                // 4 = Client Name -->
             
                <select id="idSeDocSearchOption" class="validate[required] text-input" >
                <option value="1">Id</option>
                <option value="2" SELECTED="SELECTED">Docket No.</option>
                <option value="3">Date</option>
                <option value="4">Client Name</option>
                </select>
                </td>
                </tr>
                <tr>
                <td> Enter Value </td>
                <td> <input type="text" name="txSearch" id="idTxSearch" class="clTxSearch" /> 
                <input type="hidden" name="hfSearchCid" id="ifHfSearchCid"  />
                </td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                <td style="text-align:right;">
                    <a href="#" id="idBtnSearch" class="clLnkBtnSearchDocket" >Search Docket</a>
                </td>
                </tr>
                </table>
                <br />
                
                <table class="clTblListBills" id="idTbListBills">
                <tr>
                <th style="width:70px;">Date</th>
                <th style="width:50px;">Id</th>
                <th style="width:50px;">D No.</th>
                <th style="width:220px;">Pay by</th>
                <th style="width:220px;">From</th>
                <th style="width:220px;">To</th>
                <th style="width:50px;">View</th>
                <th style="width:50px;">Edit</th>
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