<?php
session_start();

$cartStatus = ['isEmpty' => true];

if (isset($_SESSION['usemodel']) && !empty($_SESSION['usemodel'])) {
    $cartStatus['isEmpty'] = false;
}
echo json_encode($cartStatus);
?>
