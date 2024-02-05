<?php
session_start();
include('connection.php');

try {
    
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        if (isset($_POST['model'])) {
            $modelToRemove = $_POST['model'];
            $stmtRemove = $conn->prepare("DELETE FROM RakiCart WHERE USER_ID = :userId AND MODEL_NAME = :model");
            $stmtRemove->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmtRemove->bindParam(':model', $modelToRemove, PDO::PARAM_STR);
            $stmtRemove->execute();
            $rowCount = $stmtRemove->rowCount();
            if ($rowCount > 0) {
                
                $stmtUserDetails = $conn->prepare("SELECT MODEL_NAME FROM RakiCart WHERE USER_ID = :userId");
                $stmtUserDetails->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmtUserDetails->execute();
                $cartItems = $stmtUserDetails->fetchAll(PDO::FETCH_COLUMN);

                $_SESSION['usemodel'] = $cartItems;

                $response = [
                    'status' => 'success',
                    'message' => 'Item removed from cart',
                    'cartItems' => $cartItems,
                    'isEmpty' => empty($cartItems) 
                ];
            } else {
                $response = ['status' => 'error', 'message' => 'Item not found in cart'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Model not provided'];
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


