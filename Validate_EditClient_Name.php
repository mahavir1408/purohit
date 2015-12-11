<?php


	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];
	
	$pid = $_SESSION['cid'];
	$payByCid = $_REQUEST['idTxPaybyCid'];
	$cname = $_REQUEST['hfClientName'];
	
	
	$validateError= "This username is already taken";
	$validateSuccess= "This username is available";
	
	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	
	if ($validateValue == $cname) {
		$arrayToJs[1] = true;			// RETURN TRUE
		echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
	}
	else {
	
		$sql = "SELECT name FROM company WHERE  name='$validateValue' and clienttype=2 and pid='$pid' ";
		$result = mysql_query($sql)  or die(mysql_error());
		$count = mysql_num_rows($result);
	
		if($count == 0){		// validate??
			$arrayToJs[1] = true;			// RETURN TRUE
			echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
		}
		else {
			for($x=0;$x<1000000;$x++){
				if($x == 990000){
					$arrayToJs[1] = false;
					echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
				}
			}
		}
	
	}
?>