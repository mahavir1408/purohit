<?php
	
	include("config.inc");
	session_start();
	
	$bid = $_REQUEST['bid'];
	//$bid = 40;
	
	if (isset($bid)) 
	{
		$all_data = array();
		
		$sqlHeadCount ="SELECT distinct Fromname, toname FROM docket where bid='$bid' and live=1 and deleted=1 and trantype=2 and pid='{$_SESSION['cid']}'";
		$queryHeadCount = mysql_query($sqlHeadCount)  or die(mysql_error());
		
		$HeadCount = mysql_num_rows($queryHeadCount);
		
		$all_data[] = array("hcount" => $HeadCount);
		
		///////////////////////////////////////////////
		
		$sql ="SELECT count(Fromname) as count FROM docket where bid='$bid' and live=1 and deleted=1 and trantype=2 and pid='{$_SESSION['cid']}'";
		$result = mysql_query($sql)  or die(mysql_error());	
		
		
		while($row = mysql_fetch_assoc($result))
		{
			$all_data[] = $row;
		}
		  
		echo json_encode($all_data);
			
		mysql_close($connection);	
	}
	else {
		$all_data = array();
		echo json_encode($all_data);
	}

?>