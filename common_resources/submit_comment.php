<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "CMS";

$conn = new mysqli($servername, $username, $password, $dbname);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeId = $_POST['recipe_id'] ?? 0;
    $comment = $_POST['comment'] ?? '';
    $userId = $_SESSION['userID'] ?? 0;


    $sql = "INSERT INTO Comments (TextContent, PostingDate, UserID, RecipeID) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $comment, $userId, $recipeId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: view_comments.php?id=" . $recipeId);
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>