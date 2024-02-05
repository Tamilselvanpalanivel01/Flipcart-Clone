<?php

session_start();
include('connection.php');

try {
    $userId = $_POST['userId'];
    $firstname = $_POST['firstname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['conformpass'];
    $dob = $_POST['DOB'];
    $gender = $_POST['gender'];
    // $image = file_get_contents($_FILES["image"]["tmp_name"]);

    $query = "UPDATE RakiFlipkart 
              SET USER_NAME = :firstname, MOBILE_NUM = :mobile, EMAIL = :email, 
                  PASS_WORD = :password, CONFIRM_PASSWORD = :cpassword, 
                  DOB = :dob, GENDER = :gender
              WHERE ID = :userId";

    $obj = $conn->prepare($query);
    $obj->bindParam(':userId', $userId, PDO::PARAM_INT);
    $obj->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $obj->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $obj->bindParam(':email', $email, PDO::PARAM_STR);
    $obj->bindParam(':password', $password, PDO::PARAM_STR);
    $obj->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
    $obj->bindParam(':dob', $dob, PDO::PARAM_STR);
    $obj->bindParam(':gender', $gender, PDO::PARAM_STR);
    // $obj->bindParam(':image', $image, PDO::PARAM_LOB);

    $obj->execute();
    $updated = $conn->prepare("SELECT * FROM RakiFlipkart WHERE ID = :userId");
    $updated->bindParam(':userId', $userId, PDO::PARAM_INT);
    $updated->execute();
    $result = $updated->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (isset($result['ID']) && isset($result['USER_NAME'])) {
            $_SESSION['user_id'] = $result['ID'];
            $_SESSION['username'] = $result['USER_NAME'];
            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'Error updating user data']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error updating user data ' . $e->getMessage()]);
} finally {
    $conn = null;
}

?>






