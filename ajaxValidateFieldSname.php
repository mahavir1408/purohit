<?php


	session_start();	
	include("config.inc");

	/* RECEIVE VALUE */
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];

	$validateError= "This username is already taken";
	$validateSuccess= "This username is available";

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	
	$cid = $_REQUEST['idSelectCompany'];
	
	$sql = "select sname from company where clienttype=2 and sname='$validateValue' and pid='$cid'";
	
	$result = mysql_query($sql)  or die(mysql_error());
	$count = mysql_num_rows($result);
	
	if($count == 0){		// validate??
		$arrayToJs[1] = true;			// RETURN TRUE
		echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
	}else{
		for($x=0;$x<1000000;$x++){
			if($x == 990000){
				$arrayToJs[1] = false;
				echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
			}
		}
		
	}

?>