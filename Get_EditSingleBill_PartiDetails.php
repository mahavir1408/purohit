<?php

	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$did=$_REQUEST['did'];
	
	$sql = "select pid, parti, qty, kg, rate, amt from particular where did='$did' ";
		
	$result = mysql_query($sql)  or die(mysql_error());
	
	$rowcount = mysql_num_rows($result)  or die(mysql_error());

	//echo $result;
		
	$all_data = array();
	while($row = mysql_fetch_assoc($result))
	{
		//$all_data[] = "rowcout" => $row . "rowcount" => $rowcount;
		 $all_data[] = array( "pid" => $row['pid'], "parti" => $row['parti'], "qty"=>$row['qty'], "kg" => $row['kg'], "rate" => $row['rate'], "amt" => $row['amt'], "rowcount"=>$rowcount);
	}  
	echo json_encode($all_data);
		
	mysql_close($connection);
	
?>