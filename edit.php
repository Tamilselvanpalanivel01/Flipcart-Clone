<?php
include('connection.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM RakiFlipkart WHERE ID = :userid";
        $obj = $conn->prepare($query);
        $obj->bindParam(':userid', $userid);
        $obj->execute();

        $userData = $obj->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $_SESSION['user_Data'] = $userData;
            echo json_encode($userData);
        } else {
            echo json_encode(array('error' => 'User data not found.'));
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error: " . $e->getMessage()]);
    } finally {
        $conn = null;
    }
} else {
    echo json_encode(["error" => "User not logged in"]);
}
?>
