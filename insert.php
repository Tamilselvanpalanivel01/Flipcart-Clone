<?php

include('connection.php');

try {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $pass = md5($password);
    $cpassword = $_POST['cpassword'];
    $cpass = md5($cpassword);
    $dob = $_POST['DOB'];
    $gender = $_POST['gender'];

    $checkQuery = "SELECT COUNT(*) as count FROM RakiFlipkart WHERE EMAIL = :email OR MOBILE_NUM = :mobile";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->bindParam(':mobile', $mobile);
    $checkStmt->execute();
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "User already exists";
    } else {
        $insertData = "INSERT INTO RakiFlipkart (USER_NAME,EMAIL, MOBILE_NUM, PASS_WORD, CONFIRM_PASSWORD, DOB, GENDER) 
                        VALUES (:name, :email, :mobile, :password, :cpassword, :dob, :gender)";

        $insertStmt = $conn->prepare($insertData);
        $insertStmt->bindParam(':name', $name);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':mobile', $mobile);
        $insertStmt->bindParam(':password', $pass);
        $insertStmt->bindParam(':cpassword', $cpass);
        $insertStmt->bindParam(':dob', $dob);
        $insertStmt->bindParam(':gender', $gender);
        $insertStmt->execute();

        echo "Data inserted successfully";
    }
} catch (PDOException $e) {
    echo "Error inserting data: " . $e->getMessage();
}
$conn = null;
?>


