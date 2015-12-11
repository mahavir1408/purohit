<?php
ob_start();
session_start();
// Delete certain session
include("purohit_database_backup.php");

unset($_SESSION['login_id']);
session_destroy();
 mysql_close($connection);
header('Location: index.php');
?>

