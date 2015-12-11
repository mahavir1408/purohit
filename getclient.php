<?php
	include("config.inc");
	session_start();
	sleep( 1 );
	// no term passed - just exit early with no response
	if (empty($_GET['term'])) exit ;
	$q = strtolower($_GET["term"]);
	// remove slashes if they were magically added
	if (get_magic_quotes_gpc()) $q = stripslashes($q);

	$Pid = $_SESSION['cid'];

	//$sql = "SELECT name, cid FROM company WHERE clienttype=2 and pid='$Pid' and name LIKE '%".$_REQUEST['term']."%' ";
	$sql = "SELECT name, location, cid FROM company WHERE clienttype=2 and pid='$Pid' and name LIKE '" . mysql_real_escape_string($_REQUEST['term']) . "%'";
	$query = mysql_query($sql)  or die(mysql_error());
	//$row = mysql_fetch_assoc($query);
	
	while ($row = mysql_fetch_assoc($query))
		{
			 //$data[] = array ( $row['name'] => $row['cid'] );
			 $data[] = array( "id" => $row['cid'], "label"=>$row['name']." - ".$row['location'], "value" => $row['name']);
		}	

	$result = array();
	
	foreach ($data as $key=>$value) {
		if (strpos(strtolower($key), $q) !== false) {
			array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
		}
		if (count($result) > 11)
			break;
		}

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
	echo json_encode($data);

?>
