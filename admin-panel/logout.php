<?php
session_start();

// Unset all session variables
$_SESSION = array();

session_destroy();

header("Location: /aksdesign/index.php"); 
exit();
?>