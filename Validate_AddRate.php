<?php

	session_start();	
	include("config.inc");
	
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];
	
	$fromid = $_REQUEST['idTxFromCid'];
	$toid = $_REQUEST['idTxToCid'];
	
	$validateError= "Client do not exist in the database.";
	$validateSuccess= "This username is available";
	
	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	
	if ( $validateId == 'idLocFrom' ) {
	
			$sql = "SELECT name FROM company WHERE cid='$fromid' and clienttype=2 and pid='{$_SESSION['cid']}' ";
			$result = mysql_query($sql)  or die(mysql_error());
			$count = mysql_num_rows($result);
				
			if($count == 0){		// validate??
				for($x=0;$x<1000000;$x++){
						if($x == 990000){
							$arrayToJs[1] = false;
							echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
						}
					}
				}
			else {
				
				$arrayToJs[1] = true;			// RETURN TRUE
				echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
			 }
	 
	 }
	 else if ( $validateId == 'idLocTo') {

			$sql = "SELECT name FROM company WHERE cid='$toid' and clienttype=2 and pid='{$_SESSION['cid']}' ";
			$result = mysql_query($sql)  or die(mysql_error());
			$count = mysql_num_rows($result);
				
			if($count == 0){		// validate??
				for($x=0;$x<1000000;$x++){
						if($x == 990000){
							$arrayToJs[1] = false;
							echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
						}
					}
				}
			else {
				
				$arrayToJs[1] = true;			// RETURN TRUE
				echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
			 }

	 }


?>