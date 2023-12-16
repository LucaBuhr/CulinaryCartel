<?php
include("login-data.php");

if (!empty($users)) {
    echo "<h2>Registered Users</h2>";
    echo "<ul>";
    foreach ($users as $user) {
        echo "<li>{$user['username']}</li>";
    }
    echo "</ul>";
} else {
    echo "No registered users.";
}
?>