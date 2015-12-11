<?php
	session_start();
	include("config.inc");
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
	
	$bid = $_REQUEST['bid'];
	
	//$sqlReadBill = "Select paybyname, sname, country, state, city, pin, al1, al2, contact, emailid, finyear, manualbillnum, DATE_FORMAT(date, '%d-%m-%Y') as dt, subtot, setax, educhess, higheduchess, laborcharges, waitingcharges, othercharges, gt from bill where bid='$bid' and live=1 and deleted=1 and trantype=2";
	
		$sqlReadBill = "Select paybyname, sname, country, state, city, pin, al1, al2, contact, emailid, finyear, manualbillnum, DATE_FORMAT(date, '%d-%m-%Y') as dt, subtot, setax, educhess, higheduchess, laborcharges, waitingcharges, othercharges, gt, setaxrate, educhessrate, higheduchessrate from bill where bid='$bid' and live=1 and deleted=1 and trantype=2";
		$resultReadBill = mysql_query($sqlReadBill)  or die(mysql_error());
		$resultRow = mysql_fetch_array($resultReadBill);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link  rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="js/purl.js"></script>


<style>

</style>
 <script type="text/javascript">
    	function PrintTbl(TblDiv) {
			//var qs = $.url();
    		var printContents = document.getElementById(TblDiv).innerHTML;
    		var originalContents = document.body.innerHTML;
    		document.body.innerHTML = printContents;
			document.body.style.backgroundColor="#FFFFFF"; 
    		window.print();
    		document.body.innerHTML = originalContents;
    		location = location;
    		}
       </script>
       
       
<script  type="text/javascript">

function test_skill(rupees) {
    //var junkVal=document.getElementById('rupees').value;
	var junkVal = rupees;
    junkVal=Math.floor(junkVal);
    var obStr=new String(junkVal);
    numReversed=obStr.split("");
    actnumber=numReversed.reverse();

    if(Number(junkVal) >=0){
        //do nothing
    }
    else{
        alert('wrong Number cannot be converted');
        return false;
    }
    if(Number(junkVal)==0){
        document.getElementById('container').innerHTML=obStr+''+'Rupees Zero Only';
        return false;
    }
    if(actnumber.length>9){
        alert('Oops!!!! the Number is too big to covertes');
        return false;
    }

    var iWords=["Zero", " One", " Two", " Three", " Four", " Five", " Six", " Seven", " Eight", " Nine"];
    var ePlace=['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
    var tensPlace=['dummy', ' Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety' ];

    var iWordsLength=numReversed.length;
    var totalWords="";
    var inWords=new Array();
    var finalWord="";
    j=0;
    for(i=0; i<iWordsLength; i++){
        switch(i)
        {
        case 0:
            if(actnumber[i]==0 || actnumber[i+1]==1 ) {
                inWords[j]='';
            }
            else {
                inWords[j]=iWords[actnumber[i]];
            }
            inWords[j]=inWords[j];
            break;
        case 1:
            tens_complication();
            break;
        case 2:
            if(actnumber[i]==0) {
                inWords[j]='';
            }
            else if(actnumber[i-1]!=0 && actnumber[i-2]!=0) {
                inWords[j]=iWords[actnumber[i]]+' Hundred and';
            }
            else {
                inWords[j]=iWords[actnumber[i]]+' Hundred';
            }
            break;
        case 3:
            if(actnumber[i]==0 || actnumber[i+1]==1) {
                inWords[j]='';
            }
            else {
                inWords[j]=iWords[actnumber[i]];
            }
            if(actnumber[i+1] != 0 || actnumber[i] > 0){
                inWords[j]=inWords[j]+" Thousand";
            }
            break;
        case 4:
            tens_complication();
            break;
        case 5:
            if(actnumber[i]==0 || actnumber[i+1]==1 ) {
                inWords[j]='';
            }
            else {
                inWords[j]=iWords[actnumber[i]];
            }
            inWords[j]=inWords[j]+" Lakh";
            break;
        case 6:
            tens_complication();
            break;
        case 7:
            if(actnumber[i]==0 || actnumber[i+1]==1 ){
                inWords[j]='';
            }
            else {
                inWords[j]=iWords[actnumber[i]];
            }
            inWords[j]=inWords[j]+" Crore";
            break;
        case 8:
            tens_complication();
            break;
        default:
            break;
        }
        j++;
    }

    function tens_complication() {
        if(actnumber[i]==0) {
            inWords[j]='';
        }
        else if(actnumber[i]==1) {
            inWords[j]=ePlace[actnumber[i-1]];
        }
        else {
            inWords[j]=tensPlace[actnumber[i]];
        }
    }
    inWords.reverse();
    for(i=0; i<inWords.length; i++) {
        finalWord+=inWords[i];
    }
      return finalWord;
    //document.getElementById('container').innerHTML=obStr+'  '+;
      
}

function paisa_conver(){
        var finalWord1 = test_skill();
        var finalWord2;
    var val = document.getElementById('rupees').value;
        if(val.indexOf('.')!=-1)
    {
          val = val.substring(val.indexOf('.')+1,val.length);
              if(val.length==0){
           finalWord2 = "zero paisa only";
          }
              else{
               document.getElementById('rupees').value = val;
               finalWord2 = "Paisa" + test_skill() + " Only";
              }
    }
        else{
          finalWord2 = "zero paisa only";
    }
   document.getElementById('idwords').innerHTML=finalWord1 +" and " + finalWord2;
   ///var wordsss = finalWord1 +" and " + finalWord2;
   //return wordsss;
  
} 

	
</script>

<style>
#idTblBillFormat td {
line-height:15px;
font-size:13px;
}
/*.clDivPayByDetails {
width:450px;
}*/

</style>

<script language="javascript" src="js/ViewMonthlyBill.js" type="text/javascript" ></script>
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
		
                 
                 <br />
                 
                 <div class="pagehead">
                 <a href="#"> View Bill</a>
          
                 <a href="#" onclick="PrintTbl('printDiv')" style="float:right; color:#0000FF; margin-right:10px; text-decoration:underline;">Print</a>
                 <span id="oldformat" style="float:right; margin-right:20px; color: rgb(0, 0, 255); text-decoration:underline;"></span>
                 </div>
                 <br />
                 
                 <div id="printDiv">
                 <table id="idTblBillFormat">
                 </table>
                 </div>
                 
                 <br />
                 

	</div>    <!--END MID-->
</div>		 <!--END MID WRAPPER-->



	

		
<div id="footer">
	<p>Powered by iSAM IT</p>
</div>


</body>
</html>