<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "flipcart";

try {
    $conn = new PDO("mysql:host=$servername;databasename=$databasename", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $sql = "CREATE TABLE RakiFlipkart (
    //     ID INT AUTO_INCREMENT PRIMARY KEY,
    //     USER_NAME VARCHAR(255) NOT NULL,
    //     MOBILE_NUM VARCHAR(15) NOT NULL,
    //     PASS_WORD VARCHAR(255) NOT NULL,
    //     CONFIRM_PASSWORD VARCHAR(255) NOT NULL,
    //     EMAIL VARCHAR(255) NOT NULL,
    //     GENDER ENUM('Male', 'Female') NOT NULL,
    //     DOB DATE,
    //     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    // )";
    // $conn->exec($sql);
    // echo "Table RakiFlipkart created successfully";
    // $sqlRakiCart = "CREATE TABLE RakiCart (
    //     ID INT AUTO_INCREMENT PRIMARY KEY,
    //     USER_ID INT,
    //     BRAND_NAME VARCHAR(255),
    //     MODEL_NAME VARCHAR(255),
    //     RAM VARCHAR(255),
    //     PRICE VARCHAR(255),
    //     FOREIGN KEY (USER_ID) REFERENCES RakiFlipkart(ID)
    // )";
    // $conn->exec($sqlRakiCart);
    // echo "Table RakiCart created successfully";
}
 catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
$conn = null;
?>
