<?php
	session_start();
	include("config.inc");
	
	
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
	
	
				
	/* RECEIVE VALUE */
	$rid = $_REQUEST['rid'];
	
	$sql = "DELETE FROM RATE WHERE rid='$rid'";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$rc = mysql_affected_rows();
	
	if ( $rc > 0 ) {
		$success[] = array( "success" => "true");
	}
	else {
		$success[] = array( "success" => "false");
	}
	
	echo json_encode($success);
		
	mysql_close($connection);
	
?>
