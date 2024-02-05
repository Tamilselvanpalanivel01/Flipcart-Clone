<?php

session_start();
include('connection.php');

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mobile = $_POST["mobile"];
        $userPassword = $_POST["password"];
        $pass_encode = md5($userPassword);

        $obj = $conn->prepare("SELECT * FROM RakiFlipkart WHERE MOBILE_NUM = :mobile AND PASS_WORD = :password");
        $obj->bindParam(':mobile', $mobile);
        $obj->bindParam(':password', $pass_encode);
        $obj->execute();

        $result = $obj->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (isset($result['ID']) && isset($result['USER_NAME'])) {
                $_SESSION['user_id'] = $result['ID'];
                $_SESSION['username'] = $result['USER_NAME'];

                $stmtUserDetails = $conn->prepare("SELECT * FROM RakiCart WHERE USER_ID = :userId");
                $stmtUserDetails->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
                $stmtUserDetails->execute();
                $userDetails = $stmtUserDetails->fetchAll(PDO::FETCH_ASSOC);

                if ($userDetails) {
                    $usemodel = array();
                    foreach ($userDetails as $user) {
                        $usemodel[] = $user["MODEL_NAME"];
                    }
                    $_SESSION['usemodel'] = $usemodel;
                    $_SESSION['addid'] = $userDetails[0]['ID'];

                    echo json_encode(["status" => "success", "userDetails" => $userDetails]);
                } else {
                    echo json_encode(["status" => "success", "userDetails" => []]);
                }
            } else {
                echo json_encode(["status" => "failure"]);
            }
        } else {
            echo json_encode(["status" => "user_not_found"]);
        }
    } else {
        http_response_code(400);
        echo "Invalid request method";
    }
} catch (PDOException $e) {
    error_log('Error during login ' . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Internal Server Error"]);
} finally {
    $conn = null;
}

?>
