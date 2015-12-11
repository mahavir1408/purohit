<?php 

	$connection = mysql_connect( "localhost" , "root" , "m@h@v!rm21" );
	
	if (!$connection)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	$dbselect = mysql_select_db("purohit",$connection);
	
   error_reporting(E_ALL ^ E_NOTICE);
   ini_set('display_errors', 1);
  // error_reporting(E_ALL);
?>