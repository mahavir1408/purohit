<?php
	session_start();
	
	$validateValue=$_REQUEST['fieldValue'];
	$validateId=$_REQUEST['fieldId'];
	
	$validateError= "This username is already taken";
	$validateSuccess= "This username is available";
	
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	
	$uname = $_GET['fieldValue']; 
	$sql = "SELECT user FROM users WHERE BINARY user='$uname' ";
	$result = mysql_query($sql)  or die(mysql_error());
	$count = mysql_num_rows($result);
	//echo $count;
	
	if ($count == "") {
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);
	}
	else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
		}
		}
  	
?>
