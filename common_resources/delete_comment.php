<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "CMS";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);


if (isset($_SESSION['userID']) && isset($_GET['comment_id'])) {
    $userId = $_SESSION['userID'];
    $commentId = intval($_GET['comment_id']);

    $isAdmin = false;

    if (isset($_SESSION['userID'])) {
        $userId = $_SESSION['userID'];
    
        $stmt = $conn->prepare("SELECT isAdmin FROM Users WHERE UserID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            $isAdmin = $row['isAdmin'] == 1; 
        }
    
        $stmt->close();
    }

    if ($isAdmin) {
        $deleteSql = "DELETE FROM Comments WHERE CommentID = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $commentId);
        $deleteStmt->execute();
        $deleteStmt->close();

        header("Location: recipes.php"); 
    } else {
        header("Location: recipes.php");
    }
}
$conn->close();
?>