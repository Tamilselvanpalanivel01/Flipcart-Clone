<?php

session_start();
include('connection.php');

try {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        if (isset($_POST['itemName'], $_POST['model'], $_POST['ram'], $_POST['price'])) {
            $itemName = $_POST['itemName'];
            $model = $_POST['model'];
            $ram = $_POST['ram'];
            $price = $_POST['price'];

            $stmt = $conn->prepare("INSERT INTO RakiCart (USER_ID, BRAND_NAME, MODEL_NAME, RAM, PRICE) VALUES (:userId, :itemName, :model, :ram, :price)");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
            $stmt->bindParam(':model', $model, PDO::PARAM_STR);
            $stmt->bindParam(':ram', $ram, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->execute();
            $lastinsert = $conn->lastInsertId();

            if ($lastinsert) {
                $_SESSION['addid'] = $lastinsert;
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
                }
                $response = ['status' => 'success', 'message' => 'Item added to cart'];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to add item to cart'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Incomplete data'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'User not logged in'];
    }
} catch (PDOException $e) {
    $response = ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
} finally {
    if (isset($conn)) {
        $conn = null;
    }
}
echo json_encode($response);
?>

