<?php
session_start();
$_SESSION = array();
unset($_SESSION['usemodel']);
unset($_SESSION['addid']);
session_destroy();
echo 'success';
?>
