<?php
	
	include("config.inc");
	session_start();
	
	$bid = $_REQUEST['bid'];
		
	$sqlGetDidParti ="SELECT distinct Fromname, toname FROM docket where bid='$bid' and live=1 and deleted=1 and trantype=2 and pid='{$_SESSION['cid']}'";
	$queryGetDidParti = mysql_query($sqlGetDidParti)  or die(mysql_error());
		
	$all_data = array();
	
	while($row = mysql_fetch_assoc($queryGetDidParti))
	{
		$all_data[] = $row;
	}
	  
	echo json_encode($all_data);
		
	mysql_close($connection);
	

?>
