<?php
	include("config.inc");
	session_start();
	
	
			
	$SqlInsertAccountsTran = "INSERT INTO ACCOUNTS VALUES ('', '{$_POST['seTranTyp']}', STR_TO_DATE('{$_POST['txDate']}', '%d-%m-%Y'), '{$_POST['txDesc']}', '{$_POST['txAmt']}', '{$_POST['sePayMode']}', '{$_POST['txToFrom']}'  )";
	
	$QueryInsertAccountsTran = mysql_query($SqlInsertAccountsTran)  or die(mysql_error());
	
?>
