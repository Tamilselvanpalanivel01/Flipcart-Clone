<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "flipcart";
try {
    $conn = new PDO("mysql:host=$servername;databasename=$databasename", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>