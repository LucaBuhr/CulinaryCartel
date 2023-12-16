<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "CMS";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['id'])) {
        $recipeID = intval($_GET['id']);

        $stmt = $conn->prepare("SELECT Title FROM Recipes WHERE RecipeID = ?");
        $stmt->bind_param("i", $recipeID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $recipe = $result->fetch_assoc();
            $recipeTitle = $recipe['Title'];

            echo "<h2>Confirm Deletion</h2>";
            echo "<p>Are you sure you want to delete the recipe '$recipeTitle'?</p>";
            echo "<form method='post' action='delete_recipe.php'>";
            echo "<input type='hidden' name='action' value='confirmed_delete'>";
            echo "<input type='hidden' name='id' value='$recipeID'>";
            echo "<input type='submit' value='Yes, Delete'>";
            echo "</form>";
        } else {
            echo "Recipe not found.";
        }

        $stmt->close();
    } else {
        echo "ID not provided in GET request.";
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'confirmed_delete') {
    if (isset($_POST['id'])) {
        $recipeID = intval($_POST['id']);

        $stmt = $conn->prepare("DELETE FROM Recipes WHERE RecipeID = ?");
        $stmt->bind_param("i", $recipeID);

        if ($stmt->execute()) {
            header('Location: recipes.php?msg=deletesuccess');
            exit;
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID not provided in POST request.";
    }
} else {
    echo "Invalid action or request method.";
}

$conn->close();
?>
